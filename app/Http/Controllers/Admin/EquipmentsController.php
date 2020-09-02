<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;
use App\Models\Equipments;
use App\Models\ModuelsTest;
use App\Models\ModuelsType;
use App\Models\ModuelDetails;
use App\Models\Matriels;
use App\Models\OperationResources;
use App\Models\MatrielEquipment;
use DB;

class EquipmentsController extends AdminController
{
    	private $rules = [
			'title' => 'required',
			'price' => 'required|numeric|min:0',
			'QYT' => 'required|numeric|min:0',
			'type' => 'required',
			'matriels' => 'required',
		];

	public function __construct() {
		parent::__construct();
	}

	public function index(Request $req) {
        $this->passing_data['arr'] = Equipments::$del_col;
		$this->passing_data['Types']=ModuelsType::where('moduel_id',4)->get();
		return $this->_view('Settings/Equipment', 'index');
	}

	public function create(Request $req) {
		
		$this->passing_data['Matriels']=Matriels::all();
		$code = Equipments::orderBy('created_at', 'desc')->first();
		if (!$code) {
			$this->passing_data['code']= 1000;
		} else {
			$this->passing_data['code']= $code->code + 1;
		}
		$this->passing_data['EquipmentType']=ModuelsType::where('moduel_id',4)->get();
		return $this->_view('Settings/Equipment', 'create');
	}

	public function store(Request $req) {
		$validation = $this->validation($this->rules, $req, true);
		if ($validation === true) {
			try {
                $code = Equipments::orderBy('created_at', 'desc')->first();
				if (!$code) {
					$code= 10;
				} else {
					$code= $code->code + 1;
				}
				DB::beginTransaction();
				$Item = new Equipments();
				$Item->code =$code;
				$Item->title = $req->title;
				$Item->price = $req->price;
				$Item->QYT = $req->QYT;
				$Item->type_id = $req->type;
				if ($Item->save()) {
					if ($req->config) {
						$data = [];
						foreach ($req->config as $key => $value) {
							$data[] = [
								'name' => $key,
								'value' => $value,
								'post_id' => $Item->id,
								'moduel_id'=>4
							   ];
						}
						if (!empty($data)) {
							// FarmDetails::where('farm_id',$req->id)->delete();
							ModuelDetails::insert($data);
						}
					}
					if ($req->matriels) {
						$rows = [];
						foreach ($req->matriels as $value) {
							$row = [
								'equipment_id' => $Item->id,
								'matrial_id' => $value,
							];
							$rows[] = $row;
						}
						if (!empty($rows)) {
							MatrielEquipment::insert($rows);
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
			$Item = Equipments::find($id);
			if ($Item) {
				$result = Equipments::transform($Item);
				$this->passing_data['info'] = $result;
				// dd($result);
				$this->passing_data['Matriels']=Matriels::all();
				$this->passing_data['EquipmentType']=ModuelsType::where('moduel_id',4)->get();
				$this->passing_data['EquipmentTest']=ModuelsTest::where('post_id',$id)
				->where('moduel_id',4)
				->get();
				$this->passing_data['Equipments']=Equipments::all();
				$this->passing_data['Matriels']=Matriels::all();
				$this->passing_data['OperationResources']=OperationResources::leftJoin('materials','operation_resources.matrial_id','materials.id')
				->leftJoin('equipments','operation_resources.equipment_id','equipments.id')
				->where('post_id',$id)->where('moduel_id',4)->select(['operation_resources.*','materials.title as "M_title"','equipments.title as "E_title"'])->get();
				return $this->_view('Settings/Equipment', 'edit');
			} else {
				return abort(404);
			}
		} catch (Exception $ex) {
			return abort(500);
		}
	}

	public function update(Request $req) {
		$this->rules['id'] = 'required';
		$validation = $this->validation($this->rules, $req, true);
		if ($validation === true) {
			try {
				DB::beginTransaction();
				$Item = Equipments::where('id', $req->id)->first();
				$Item->title = $req->title;
				$Item->price = $req->price;
				$Item->QYT = $req->QYT;
				if ($Item->save()) {
					if ($req->config) {
						$data = [];
						foreach ($req->config as $key => $value) {
							$data[] = [
								'name' => $key,
								'value' => $value,
								'post_id' => $req->id,
								'moduel_id'=>4
							   ];
						}
						if (!empty($data)) {
							ModuelDetails::where('post_id', $req->id)
							->where('moduel_id',4)
							->delete();
							ModuelDetails::insert($data);
						}
					}
					if ($req->matriels) {
						
						$rows = [];
						foreach ($req->matriels as $value) {
							$row = [
								'equipment_id' => $Item->id,
								'matrial_id' => $value,
							];
							$rows[] = $row;
						}
						if (!empty($rows)) {
							MatrielEquipment::where('equipment_id', $req->id)->delete();
							MatrielEquipment::insert($rows);
						}
					}
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
		if($req->type){
		    if($req->type=='all'){
                $data = Equipments::all();
            }
            else {
                $data = Equipments::where('type_id', $req->type)
                    ->get();
            }
		}else{
			$data = Equipments::all();
		}
		
		$table = Equipments::transformCollection($data);
		return \Datatables::of($table)
			->addColumn('option', function ($item) {
                if($this->_checkPermission(7,5)) {
                    $back = $this->_editButn($item, 'setting/equipments/');
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
	/////////////////////////////////////////////////////////////
	public function typeStore(Request $req) {
        $rules=[
            'title_type'=>'required'
        ];
		 $validation=$this->validation($rules,$req,true);
		 if($validation===true){
		try {
			DB::beginTransaction();
			$Item = new ModuelsType;
			$Item->title = $req->title_type;
			$Item->moduel_id = 4;
			if ($Item->save()) {
				DB::commit();
				$massage = "تمت عمليه الادخال بنجاح";
				return $this->json('success', $massage, 200);
			} else {
				$massage = "لم تتم عمليه الادخال";
				return $this->json('warning', $massage);
			}
		} catch (Exception $ex) {
			DB::rollBack();
		}
		 }else{
		     return $this->json('warning',$validation);
		 }
	}
	public function typeDestroy($id){
		try{
            $Item=ModuelsType::find($id);
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
	////////////////////////////////////////////////////////////
	public function testStore(Request $req)
    {
        $rules=[
            'title_main'=>'required',
            'datetime'=>'required|date',
            'test_num'=>'required',
            'test_duration'=>'required'
        ];
        $validation=$this->validation($rules,$req,true);
        if($validation===true){
        try {
            DB::beginTransaction();
            $code = ModuelsTest::orderBy('created_at', 'desc')->first();
            if (!$code) {
                $code = 1000;
            } else {
                $code = $code->code + 1;
            }
            $Item = new ModuelsTest();
            $Item->code = $code;
            $Item->post_id = $req->equipment_id;
            $Item->title = $req->title_main;
            $Item->test_num = $req->test_num;
            $Item->test_duration = $req->test_duration;
            $Item->datetime = $req->datetime;
            $Item->moduel_id = 4;
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
        else{
            return $this->json('warning',$validation);
        }
	}
	public function testDestroy($id){
		try{
            $Item=ModuelsTest::find($id);
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
