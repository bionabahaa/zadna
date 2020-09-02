<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Protections;
use App\Models\Boxes;
use App\Models\BoxCrops;
use App\Models\BoxesUsers;
use App\Models\Users;
use App\Models\Matriels;
use App\Models\Equipments;
use App\Models\OperationResources;
use DB;

class ProtectionController extends AdminController
{
    private $rules=[
        "matrial_id"=>'required',
	    "box_id"=>'required',
		"start_date"=>'required',
	];
	public function __construct() {
		parent::__construct();
    }
    public function index(Request $req) {
        $this->passing_data['arr'] = Protections::$del_col;
        if($req->reports){
			$this->passing_data['report']=true;
		}else{
			$this->passing_data['report']=0;
		}
        $this->passing_data['bath']=url('public/images/Uploads/config');
        $this->passing_data['Boxes']=Boxes::all();
        $this->passing_data['level_id']=$req->level_id;
        $this->passing_data['Matriels']=Matriels::where('material_type_id',2)->get();
		return $this->_view('Operations/Protection', 'index');
    }

    public function store(Request $req) {
        
        $validation = $this->validation($this->rules, $req, true);
        if ($validation === true) {
        try {
            $code = Protections::orderBy('created_at', 'desc')->first();
            if (!$code) {
                $code= 1000;
            } else {
                $code= $code->code + 1;
            }
            DB::beginTransaction();
            $Item = new Protections();
            $Item->code = $code;
            $Item->matrial_id = $req->matrial_id;
            $Item->box_id = $req->box_id;
            $Item->start_date = $req->start_date;
            $Item->level_id = 1;
            $Item->pesticide_QYT = $req->qyt;
            if ($Item->save()) {
                $Matriel=Matriels::where('id',$req->matrial_id)->first();
                $code2 = OperationResources::orderBy('code', 'desc')->first();

                if (!$code2) {
                    $code2= 1000;
                } else {
                    $code2= $code2->code + 1;
                }

                $Resource=new OperationResources();
                $Resource->code = $code2;
                $Resource->post_id = $Item->id;
                $Resource->moduel_id = 5;
                $Resource->box_id = $req->box_id;
                $Resource->opertion_type_id = 1;
                $Resource->matrial_id = $req->matrial_id;
                $Resource->title = 'نكاليف أساسيه';
                $Resource->qyt = $req->qyt;
                $Resource->cost = $Matriel->price * $req->qyt;
                $Resource->expected_cost = 0;
                $Resource->datetime = date('Y-m-d');
                $Resource->save();

                $Resource2=new OperationResources();
                $Resource2->code = $code2+1;
                $Resource2->post_id = $Item->id;
                $Resource2->moduel_id = 5;
                $Resource2->box_id = $req->box_id;
                $Resource2->opertion_type_id = 4;
                $Resource2->matrial_id = $req->matrial_id;
                $Resource2->title = 'خامه أساسيه';
                $Resource2->qyt = $req->qyt;
                $Resource2->datetime = date('Y-m-d');
                $Resource2->save();

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
            $Item = Protections::find($id);
            if ($Item) {
                $result = Protections::transform($Item);
                for($i=1;$i <= $result->box_column_count;$i++){
                    for($x=1;$x <= $result->box_row_count;$x++){
                        $this->passing_data['PalmTree'][]=$result->box_code.''.$i.''.$x;
                    }
                }
                $box_details=BoxCrops::where('box_id',$result->box_id)->get();
                $Crops[]=BoxCrops::transformCollection($box_details);
                $this->passing_data['Crops']=$Crops;
                $Users=BoxesUsers::where('box_id',$Item->box_id)->get();
                if($Users->count()>0){
                    foreach($Users as $value){
                        $this->passing_data['Users'][]=Users::find($value->user_id);
                    }
                }else{
                    $this->passing_data['Users']=[];
                }
                $this->passing_data['report']=false;
                $this->passing_data['Equipments']=Equipments::all();
                $this->passing_data['Matriels']=Matriels::all();
                $this->passing_data['OperationResources']=OperationResources::leftJoin('materials','operation_resources.matrial_id','materials.id')
                ->leftJoin('equipments','operation_resources.equipment_id','equipments.id')
                ->where('post_id',$id)->where('moduel_id',5)->select(['operation_resources.*','materials.title as "M_title"','equipments.title as "E_title"'])->get();
                $this->passing_data['used_type'] = Protections::$used_type;
                $this->passing_data['info'] = $result;
                // dd($this->passing_data['info']);
                return $this->_view('Operations/Protection', 'edit');
            } else {
                return abort(404);
            }
        } catch (Exception $ex) {
            return abort(500);
        }
    }

    public function update(Request $req) {
        $this->rules['id'] = 'required';
        unset($this->rules['box_id']);
        unset($this->rules['matrial_id']);
        $validation = $this->validation($this->rules, $req, true);
        if ($validation === true) {
            try {
                DB::beginTransaction();
                $Item = Protections::where('id', $req->id)->first();
                $Item->start_date = $req->start_date;
                $Item->end_date = $req->end_date;
                $Item->user_id = $req->user_id;
                // if($req->implementation){
                //     $Item->implementation = 2;
                // }else{
                //     $Item->implementation = 1;
                // }
                
                $Item->recommendation = $req->recommendtion;
                if($req->palm_tree){
                    // dd($req->palm_tree);
                    $Item->palm_tree = implode(',',$req->palm_tree);
                }
                if ($Item->save()) {
                    parent::addTask($req->user_id,5,'operation/protection/'.$Item->id.'/edit');
                    DB::commit();
                    $massage = 'تمت عمليه التعديل بنجاح';
                    return $this->json('success', $massage, 200);
                } else {
                    $massage = 'لم تتم عمليه التعديل';
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
        $data = Protections::get();
        $table = Protections::transformCollection($data);
        return \Datatables::of($table)
            ->addColumn('option', function ($item) {
                if($this->_checkPermission(20,5)) {
                    $back = $this->_editButn($item, 'operation/protection/');
                }else{
                    $back='';
                }

                return $back;
            })
            // ->addColumn('implementation_table', function ($item) {
            //     if($item->implementation){
            //         $back = '<i class="fas fa-check-circle text-center state execut " style="cursor:pointer;color:greenyellow"></i>
            //         </td>';
            //     }else{
            //         $back = '<i class="fas fa-times-circle text-center state execut " style="cursor:pointer;color:red"></i>
            //         </td>';
            //     }
            //     // $back = $this->_editButn($item, 'setting/crops/');
            //     // $back .= $this->_deleteBtn($item);
    
            //     return $back;
            // })
            ->addColumn('created_at', function ($item) {
                $back = date('Y-m-d', strtotime($item->created_at));

                return $back;
            })
            ->rawColumns(['option', 'created_at'])
            ->make(true);
    }
}
