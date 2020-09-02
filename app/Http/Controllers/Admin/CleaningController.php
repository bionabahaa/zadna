<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use App\Models\BoxCrops;
use App\Models\Boxes;
use App\Models\Users;
use App\Models\BoxesUsers;
use App\Models\Crops;
use App\Models\Cleaning;
use App\Models\Planting;
use App\Models\Irrigation;
use App\Models\BoxIrrugation;
use App\Models\Matriels;
use App\Models\Equipments;
use App\Models\OperationResources;
use App\Models\PlanningIrrigation;
use App\Models\IrrigationMahbas;
use DB;
use Illuminate\Http\Request;

class CleaningController extends AdminController
{
    private $rules = [
		'box_id' => 'required',
		'start_date' => 'required',
	];

	public function __construct() {
		parent::__construct();
	}

	public function index(Request $req) {
       

        $this->passing_data['arr'] = Cleaning::$del_col;
        if($req->reports){
			$this->passing_data['report']=true;
		}else{
			$this->passing_data['report']=0;
		}
        $this->passing_data['bath']=url('public/images/Uploads/config');
        $this->passing_data['level_id']=$req->level_id;
        $this->passing_data['Boxes']=Boxes::all();
		return $this->_view('operations/Cleaning', 'index');
    }
    
    public function create(Request $req) {
        $this->passing_data['bath']=url('public/images/Uploads/config');
        $this->passing_data['Boxes']=Boxes::all();
		return $this->_view('operations/Cleaning', 'index');
    }
    public function store(Request $req){
        $validation = $this->validation($this->rules, $req, true);
		if ($validation === true) {
			try {
				DB::beginTransaction();
                
                $code = Cleaning::orderBy('created_at', 'desc')->first();
                if (!$code) {
                    $code= 1000;
                } else {
                    $code= $code->code + 1;
                }
                $Item = new Cleaning();
                $Item->code = $code;
                $Item->box_id = $req->box_id;
                $Item->start_date = $req->start_date;
                $Item->end_date = $req->end_date;

				if ($Item->save()) {
					DB::commit();
					$massage = 'تمت عمليه الادخال بنجاح';
					return $this->json('success', $massage, 200);
				} else {
					$massage = 'لم تتم عمليه الادخال';
					return $this->json('warning', $massage);
				}
			} catch (Exception $ex) {
				DB::rollBack();
			}
		} else {
			return $this->json('warning', $validation);
		}
    }
    public function edit($id){

        
        try {
            $Item = Cleaning::find($id);
              
            
			if ($Item) {
				$result = Cleaning::transform($Item);
				$this->passing_data['info'] = $result;
				$this->passing_data['report']=false;
                $this->passing_data['Boxes']=Boxes::all();
                $irrigation=Irrigation::join('box_irrigation','box_irrigation.irrigation_id','irrigation.id')
                ->where('box_irrigation.box_id',$result->box_id)->first();
                
                // dd($this->passing_data['Irrigation']);

                $PlanningIrrigation=PlanningIrrigation::where('planning_irrigation.planting_id',$id)
                ->get();
                $this->passing_data['Irrigation']=PlanningIrrigation::transformCollection($PlanningIrrigation);

                $this->passing_data['PlanningIrrigation']=PlanningIrrigation::transformCollection($PlanningIrrigation);
                $this->passing_data['Equipments']=Equipments::all();
                $this->passing_data['Matriels']=Matriels::all();
                $this->passing_data['OperationResources']=OperationResources::leftJoin('materials','operation_resources.matrial_id','materials.id')
                ->leftJoin('equipments','operation_resources.equipment_id','equipments.id')
                ->where('post_id',$id)->where('moduel_id',3)->select(['operation_resources.*','materials.title as "M_title"','equipments.title as "E_title"'])->get();
                $Users=BoxesUsers::where('box_id',$id)->get();
                $this->passing_data['Users']=[];
                foreach($Users as $value){
                    $this->passing_data['Users'][]=Users::find($value->user_id);
                }
                $this->passing_data['report']=false;

                // get code of mahbas in irrrigation that pass on box in that plant
                $irrigations_id=Cleaning::join('box_irrigation','cleaning.box_id','box_irrigation.box_id')->where('cleaning.box_id',$Item->box_id)->select('irrigation_id')->get();
                foreach ($irrigations_id as $irrigation_id){
                    $irrigations[]=DB::table('irrigation_mahbas')->where('irrigation_id',$irrigation_id['irrigation_id'])->select('id','code','irrigation_id')->first();
                }
               // $this->passing_data['Irrigation']=$irrigations;


                return $this->_view('operations/Cleaning','edit');
			} else {
				return abort(404);
			}
		} catch (Exception $ex) {
			return abort(500);
		}
    }
    public function update(Request $req){
        $this->rules['id']='required';
        unset($this->rules['box_id']);
        $validation = $this->validation($this->rules, $req, true);
		if ($validation === true) {
			try {
				DB::beginTransaction();
				$Item = Cleaning::where('id', $req->id)->first();
                $Item->start_date = $req->start_date;
                $Item->end_date = $req->end_date;
                $Item->qyt = $req->palm_tree;
                if($req->user_id){
                    $Item->user_id = $req->user_id;
                }
                
                $Item->end_date = $req->end_date;
                $Item->palm_tree = $req->palm_tree;
                if($req->implementation){
                    $Item->implementation = 2;
                }else{
                    $Item->implementation=1;
                }
				if ($Item->save()) {
                    if($req->user_id){
                        parent::addTask($req->user_id,4,'operation/clean/'.$req->id.'/edit');
                    }
                    
					DB::commit();
					$massage = 'تمت عمليه الادخال بنجاح';
					return $this->json('success', $massage, 200);
				} else {
					$massage = 'لم تتم عمليه الادخال';
					return $this->json('warning', $massage);
				}
			} catch (Exception $ex) {
				DB::rollBack();
			}
		} else {
			return $this->json('warning', $validation);
		}
    }
    public function dataTable(Request $req){
        $data=Cleaning::orderBy('created_at','desc');
        if($req->date_from){
            $data =Cleaning::where('start_date','>=',date('Y-m-d',strtotime($req->date_from)));
        }
        if($req->date_to){
            $data =Cleaning::where('end_date','<=',date('Y-m-d',strtotime($req->date_to)));
        }
        if($req->date_from && $req->date_to){
            $data =$data->whereDate('created_at','>=',[date('Y-m-d',strtotime($req->date_from)),date('Y-m-d',strtotime($req->date_from))]);
        }
        $data =$data->get();

		$table = Cleaning::transformCollection($data);
		return \Datatables::of($table)
        ->addColumn('option', function ($item) {

            if($this->_checkPermission(18,5)){
                $back = $this->_editButn($item, 'operation/clean/');
            }else{
                $back='';
            }
            return $back;
        })
        ->addColumn('implementation_table', function ($item) {
            if($item->implementation){
                $back = '<i class="fas fa-check-circle text-center state execut " style="cursor:pointer;color:greenyellow"></i>
                </td>';
            }else{
                $back = '<i class="fas fa-times-circle text-center state execut " style="cursor:pointer;color:red"></i>
                </td>';
            }
            // $back = $this->_editButn($item, 'setting/crops/');
            // $back .= $this->_deleteBtn($item);

            return $back;
        })
        ->addColumn('created_at', function ($item) {
            $back = date('Y-m-d', strtotime($item->created_at));

            return $back;
        })
        ->rawColumns(['option', 'created_at','implementation_table'])
        ->make(true);
    }
    //////////////////////////////////////////////////////////
    public function planningIrrigationStore(Request $req){
        $rules=[
            'start_date_plan'=>'required|date',
            'end_date_plan'=>'required|date',
            'qyt'=>'required|numeric',
            'repeat'=>'required|numeric',
            'irrigation_date'=>'required|date',

        ];
        $validation = $this->validation($rules, $req, true);
        if ($validation === true) {
            try {
                DB::beginTransaction();
                $code = PlanningIrrigation::orderBy('created_at', 'desc')->first();
                if (!$code) {
                    $code = 1000;
                } else {
                    $code = $code->code + 1;
                }
                $Item = new PlanningIrrigation();
                $Item->code = $code;
                $Item->irrigation_id = $req->irrigation_id;
                $Item->planting_id = $req->planting_id;
                $Item->start_date = $req->start_date_plan;
                $Item->end_date = $req->end_date_plan;
                $Item->qyt = $req->qyt;
                $Item->repeat = $req->repeat;
                $Item->irrigation_date = $req->irrigation_date;
                $Item->note = $req->note;
                if ($Item->save()) {
//                $mahbas_info=IrrigationMahbas::find($req->irrigation_id);
//                $post_info = Cleaning::find($req->post_id);
//
//                $code2 = OperationResources::orderBy('code', 'desc')->first();
//                if (!$code2) {
//                    $code2= 1000;
//                } else {
//                    $code2= $code2->code + 1;
//                }
//                $Resource=new OperationResources();
//                $Resource->code = $code2;
//                $Resource->post_id = $Item->post_id;
//                $Resource->moduel_id = 3;
//                $Resource->box_id = $post_info->box_id;
//                $Resource->opertion_type_id = 1;
//                $Resource->title = 'نكاليف أساسيه';
//                $Resource->cost = ($mahbas_info->irrigation->cost * $req->duration) * $req->repet;
//                $Resource->expected_cost = 0;
//                $Resource->datetime = date('Y-m-d');
//                $Resource->save();

                    DB::commit();
                    $massage = 'تمت عمليه الادخال بنجاح';
                    return $this->json('success', $massage, 200);
                } else {
                    $massage = 'لم تتم عمليه الادخال';
                    return $this->json('warning', $massage);
                }
            } catch (Exception $ex) {
                DB::rollBack();
            }
        }else {
            return $this->json('warning', $validation);
        }
    }
    public function planningIrrigationDestroy($id){
		try{
            $Item=PlanningIrrigation::find($id);
            if($Item->delete()){
                $massage="Deleted Successfuly";
                return $this->json('success',$massage);
            }else{
                $massage="Deleted Field";
                return $this->json('warning',$massage);
            }
        }catch(Exception $ex){
            $massage="Deleted Field";
                return $this->json('error',$massage);
        }
	}
}
