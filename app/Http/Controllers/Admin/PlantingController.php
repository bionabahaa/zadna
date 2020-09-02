<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Boxes;
use App\Models\BoxCrops;
use App\Models\BoxesUsers;
use App\Models\Planting;
use App\Models\Crops;
use App\Models\BoxCropPlanting;
use App\Models\Users;
use App\Models\Matriels;
use App\Models\Equipments;
use App\Models\OperationResources;
use App\Models\ModuelDetails;
use App\Models\PlanningIrrigation;
use App\Models\Irrigation;
// use App\Models\PlanningIrrigation;
use Response;
use DB;

class PlantingController extends AdminController
{
    private $rules=[
	    "start_date"=>'required',
        "end_date"=>'required',
		"box_id"=>'required',
        "type_id"=>'required',
	];
	public function __construct() {
		parent::__construct();
    }
    public function index(Request $req) {
        $this->passing_data['arr'] = Planting::$del_col;
        if($req->reports){
			$this->passing_data['report']=true;
		}else{
			$this->passing_data['report']=0;
		}
        $file=DB::table('config')->select('value')->where('name', 'signature_wells')->first();
        if($file){
			$this->passing_data['bath']=url('public/images/Uploads/config').'/'.$file->value;
		}else{
			$this->passing_data['bath']='';
		}
        $this->passing_data['Boxes']=Boxes::all();
		return $this->_view('Operations/Planting', 'index');
    }

    public function create(Request $req) {
        $this->passing_data['Boxes']=Boxes::all();
        $this->passing_data['OperationResources']=OperationResources::leftJoin('materials','operation_resources.matrial_id','materials.id')
				->leftJoin('equipments','operation_resources.equipment_id','equipments.id')
            ->where('moduel_id',15)->select(['operation_resources.*','materials.title as "M_title"','equipments.title as "E_title"'])->get();
            $this->passing_data['Equipments']=Equipments::all();
            $this->passing_data['Matriels']=Matriels::all();
            $this->passing_data['report']=false;
        return $this->_view('Operations/Planting', 'create');
    }

    public function store(Request $req) {
        $validation = $this->validation($this->rules, $req, true);
        if ($validation === true) {
        try {
            $code = Planting::orderBy('created_at', 'desc')->first();
            if (!$code) {
                $code= 1000;
            } else {
                $code= $code->code + 1;
            }
            DB::beginTransaction();
            $Item = new Planting();
            $Item->code = $code;
            $Item->type_id = $req->type_id;
            $Item->box_id = $req->box_id;
            $Item->start_date = $req->start_date;
            $Item->end_date = $req->end_date;
            $Item->fertlize_crop_id = $req->fertlize_crop_id;
            $Item->protection_user_id = $req->protection_user_id;
            $Item->irrigation_user_id = $req->irrigation_user_id;
            
            if ($Item->save()) {

                parent::addTask($req->protection_user_id,2,'operation/planting/'.$Item->id.'/edit');
                parent::addTask($req->irrigation_user_id,3,'operation/planting/'.$Item->id.'/edit');

                if ($req->config) {
                    $data = [];
                    foreach ($req->config as $key => $value) {
                        $data[] = [
                            'name' => $key,
                            'value' => $value,
                            'post_id' => $Item->id,
                            'moduel_id'=>15
                           ];
                    }
                    if (!empty($data)) {
//                         FarmDetails::where('farm_id',$req->id)->delete();
                        ModuelDetails::insert($data);
                    }
                }
                if ($req->plamtree) {
                    $data = [];
                    foreach ($req->plamtree['crop'] as $key => $value) {
                        $data[] = [
                            'crop_id' => $value,
                            'box_id' => $req->box_id,
                            'planting_id' => $Item->id,
                            'row'=>$req->plamtree['row'][$key],
                            'column'=>$req->plamtree['column'][$key]
                           ];
                    }
                    if (!empty($data)) {
                        // FarmDetails::where('farm_id',$req->id)->delete();
                        BoxCropPlanting::insert($data);
                    }
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
    public function edit($id) {
        try {
            $Item = Planting::find($id);
            if ($Item) {
                $result = Planting::transform($Item);
                $box_details=Boxes::find($result->box_id)->Crops; //crop_id

                foreach($box_details as $value){
                    $Crops[]=Crops::find($value->crop_id);
                }
                $module_details=ModuelDetails::where('post_id',$id)->where('moduel_id',15)->get();
                $selected_material=ModuelDetails::where('post_id',$id)->where('moduel_id',15)->where('name','protection_pesticide')->first();
                $this->passing_data['selected_material']=$selected_material;
                $this->passing_data['module_details']=$module_details;
                $crop_detail=BoxCropPlanting::where('planting_id',$id)->first();
                $this->passing_data['crop_detail']=$crop_detail;
                $users_box=BoxesUsers::where('box_id',$result->box_id)->select('user_id')->get();
                $users=Users::whereIn('id',$users_box)->select('id','username')->get();
                $this->passing_data['users']=$users;
                $this->passing_data['report']=false;
                $this->passing_data['Boxes']=Boxes::all();
                $this->passing_data['Crops']=$Crops;
                $this->passing_data['info'] = $result;
                $this->passing_data['Equipments']=Equipments::all();
//                $this->passing_data['Irrigation']=Irrigation::join('box_irrigation','box_irrigation.irrigation_id','irrigation.id')->get();

                $irrigations=[];
                // get code of mahbas in irrrigation that pass on box in that plant
                $irrigations_id=Planting::join('box_irrigation','planting.box_id','box_irrigation.box_id')->where('planting.box_id',$Item->box_id)->select('irrigation_id')->get();
                if($irrigations_id) {
                    foreach ($irrigations_id as $irrigation_id) {
                        $irrigations[] = DB::table('irrigation_mahbas')->where('irrigation_id', $irrigation_id['irrigation_id'])->select('id', 'code', 'irrigation_id')->first();
                    }
                }
                $this->passing_data['Irrigation'] = $irrigations;



//
//                $this->passing_data['PlanningIrrigation']=PlanningIrrigation::join('irrigation','planning_irrigation.irrigation_id','irrigation.id')
//                ->where('planning_irrigation.cleaning_id',$id)
//                ->select(['planning_irrigation.*','irrigation.code_mahbas'])
//                ->get();
                    $this->passing_data['PlanningIrrigation']=PlanningIrrigation::leftJoin('irrigation_mahbas','irrigation_mahbas.id','planning_irrigation.irrigation_id')->where('planting_id',$id)
                        ->select('irrigation_mahbas.code as code_mahbas','planning_irrigation.*')
                        ->get();




                $this->passing_data['Matriels']=Matriels::all();
				$this->passing_data['OperationResources']=OperationResources::leftJoin('materials','operation_resources.matrial_id','materials.id')
				->leftJoin('equipments','operation_resources.equipment_id','equipments.id')
				->where('post_id',$id)->where('moduel_id',2)->select(['operation_resources.*','materials.title as "M_title"','equipments.title as "E_title"'])->get();
                return $this->_view('Operations/Planting', 'edit');
                   /* it had an error of not seeing Crops variable that should be sent by passing data function,
                    so my contributon " return View('pages/backEnd/Operation/Planting/edit.blade.php/')
                     ->with('Crops', $Crops);" had solved the problem but erased another one, he cant see this route
                     but i think it's just a sayntics problem i forgot how to type url. */
            } else {
                return abort(404);
            }
        } catch (Exception $ex) {
            return abort(500);
        }
    }

    public function update(Request $req) {

        
        $validation = $this->validation($this->rules, $req, true);
        if ($validation === true) {
            try {

                DB::beginTransaction();
                $Item =Planting::where('id',$req->id)->first();
                $Item->type_id = $req->type_id;
                $Item->box_id = $req->box_id;
                $Item->start_date = $req->start_date;
                $Item->end_date = $req->end_date;
                $Item->fertlize_crop_id = $req->fertlize_crop_id;
                $Item->protection_user_id = $req->protection_user_id;
                $Item->irrigation_user_id = $req->irrigation_user_id;
                if ($Item->save()) {
                    parent::addTask($req->protection_user_id,2,'operation/planting/'.$Item->id.'/edit');
                    parent::addTask($req->irrigation_user_id,3,'operation/planting/'.$Item->id.'/edit');

                    if ($req->config) {
                        $data = [];
                        foreach ($req->config as $key => $value) {
                            $data[] = [
                                'name' => $key,
                                'value' => $value,
                                'post_id' => $Item->id,
                                'moduel_id'=>15
                            ];
                        }
                        if (!empty($data)) {
                            ModuelDetails::where('post_id',$Item->id)->where('moduel_id',15)->delete();
                            ModuelDetails::insert($data);
                        }
                    }
                    if ($req->plamtree) {
                        $data = [];
                        foreach ($req->plamtree['crop'] as $key => $value) {
                            $data[] = [
                                'crop_id' => $value,
                                'box_id' => $req->box_id,
                                'planting_id' => $Item->id,
                                'row'=>$req->plamtree['row'][$key],
                                'column'=>$req->plamtree['column'][$key]
                            ];
                        }
                        if (!empty($data)) {
                            BoxCropPlanting::where('planting_id',$req->id)->delete();
                            BoxCropPlanting::insert($data);
                        }
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

    public function dataTable(Request $req) {
        $data=Planting::orderBy('created_at','desc');
        if($req->status){
            switch ($req->status){
                case 'all':
                    $data=$data;
                    break;
                case 1:
                    $data = Planting::where('type_id',1);
                    break;
                case 2:
                    $data =Planting::where('type_id',2);
                    break;
            }

        }
        if($req->date_from){
            $data =$data->whereDate('created_at','>=',date('Y-m-d',strtotime($req->date_from)));
        }
        if($req->date_to){
            $data =$data->where('created_at','<=',date('Y-m-d',strtotime($req->date_to)));
        }
        $data =$data->get();

        $table = Planting::transformCollection($data);
        return \Datatables::of($table)
            ->addColumn('option', function ($item) {
                if($this->_checkPermission(16,5)) {
                    $back = $this->_editButn($item, 'operation/planting/');
                }else{
                    $back='';
                }
                return $back;
            })
            ->addColumn('created_at', function ($item) {
                $back = date('Y-m-d', strtotime($item->created_at));

                return $back;
            })
            ->rawColumns(['option', 'created_at'])
            ->make(true);
    }
    public function box_crop(Request $req){
        // dd($req);
        $box_details=Boxes::find($req->box_id)->crop_id;
         //dd($box_details);
       // foreach($box_details as $value){
            $Crop=Crops::find($box_details);
            echo '<option value="'.$Crop->id.'">'.$Crop->title.'</option>';
       // }
       

         //Response::json($Crop);
    }
    
    public function box_user(Request $req){
        // dd($req);
        $Users=BoxesUsers::where('box_id',$req->box_id)->get();
        foreach($Users as $value){
            $result=Users::where('id',$value->user_id)->first();
            echo '<option value="'.$result->id.'">'.$result->username.'</option>';
        }
        
    }
    ////////////////////////////////////////////////////////////
	public function PlanStore(Request $req){
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
        }
        else {
            return $this->json('warning', $validation);
        }
	}
	public function PlanDestroy($id){
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
