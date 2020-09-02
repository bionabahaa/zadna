<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use DB;
use Illuminate\Http\Request;
use App\Models\Jura;
use App\Models\Boxes;
use App\Models\Matriels;
use App\Models\Irrigation;
use App\Models\Equipments;
use App\Models\OperationResources;
use App\Models\JuraMaterials;
use App\Models\ModuelDetails;

class JuraController extends AdminController{
    private $rules = [
		'box_id' => 'required',
		'start_date' => 'required',
		'end_date' => 'required',
	];

	public function __construct() {
		parent::__construct();
	}

	public function index(Request $req) {
        $this->passing_data['arr'] = Jura::$del_col;
        if($req->reports){
			$this->passing_data['report']=true;
		}else{
			$this->passing_data['report']=0;
		}
        $this->passing_data['bath']=url('public/images/Uploads/config');
        $this->passing_data['Boxes']=Boxes::all();
      
		return $this->_view('Operations/Jura', 'index');
    }
    public function create(Request $req) {
        $this->passing_data['report']=false;
        $this->passing_data['Boxes']=Boxes::all();
        $this->passing_data['irrigations']=Irrigation::all();
        $this->passing_data['Matrials']=Matriels::all();
        return $this->_view('Operations/Jura', 'create');
    }

    public function store(Request $req) {
        $validation = $this->validation($this->rules, $req, true);
        if ($validation === true) {
        try {
            $code = Jura::orderBy('created_at', 'desc')->first();
            if (!$code) {
                $code= 1000;
            } else {
                $code= $code->code + 1;
            }

            DB::beginTransaction();
            $Item = new Jura();
            $Item->code = $code;
            $Item->box_id = $req->box_id;
            $Item->start_date = $req->start_date;
            $Item->end_date = $req->end_date;
            $Item->specifications = $req->specifications;
            $Item->depth = $req->depth;
            if ($Item->save()) {
                if ($req->config) {
                    $data = [];
                    foreach ($req->config as $key => $value) {
                        if (($key == 'service_matrial_id')) {
                            $data1 = [];
                            for ($i = 0; $i < count($req->config['service_matrial_id']); $i++) {
                                $data1[] = [
                                    'name' => $key,
                                    'material_id' => $req->config['service_matrial_id'][$i],
                                    'amount' => $req->config['service_matrial_qyt'][$i],
                                    'post_id' => $Item->id,
                                    'moduel_id' => 14
                                ];
                            }
                            JuraMaterials::insert($data1);
                        } elseif (($key == 'cleansing_matrial_id')) {
                            $data2 = [];
                            for ($i = 0; $i < count($req->config['cleansing_matrial_id']); $i++) {
                                $data2[] = [
                                    'name' => $key,
                                    'material_id' => $req->config['cleansing_matrial_id'][$i],
                                    'amount' => $req->config['cleansing_matrial_qyt'][$i],
                                    'post_id' => $Item->id,
                                    'moduel_id' => 14
                                ];
                            }
                            JuraMaterials::insert($data2);
                        } else {
                            if(!is_array($value)){
                                $data[] = [
                                    'name' => $key,
                                    'value' => $value,
                                    'post_id' => $Item->id,
                                    'moduel_id' => 14
                                ];
                            }
                        }

                    }
                    if (!empty($data)) {
                        ModuelDetails::insert($data);
                    }
                }
                DB::commit();
                $massage = 'تمت عمليه التعديل بنجاح';
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
    public function edit(Request $req,$id) {
        $this->passing_data['report']=0;
        try {
            $Item = Jura::find($id);
            if ($Item) {
                $result = Jura::transform($Item);
//                foreach($result->service_matrial_id as $material_id){
//                    $i=0;
//                        $material_name_service[]=Jura::materialNmae($material_id['material_id']);
//                        $amount_service[]=$material_id['amount'][$i];
//                        $i++;
//                }

                $this->passing_data['info'] = $result;
                $this->passing_data['Boxes']=Boxes::all();
                $this->passing_data['Matriels']=Matriels::all();
                $this->passing_data['Equipments']=Equipments::all();
				$this->passing_data['OperationResources']=OperationResources::leftJoin('materials','operation_resources.matrial_id','materials.id')
				->leftJoin('equipments','operation_resources.equipment_id','equipments.id')
                ->where('post_id',$id)
                ->where('moduel_id',1)
                ->select(['operation_resources.*','materials.title as "M_title"','equipments.title as "E_title"'])
                ->get();
                // dd($result);
                return $this->_view('Operations/Jura', 'edit');
            } else {
                return abort(404);
            }
        } catch (Exception $ex) {
            return abort(500);
        }
    }

    public function update(Request $req) {

        unset($this->rules['box_id']);
        $this->rules['id'] = 'required';
        $validation = $this->validation($this->rules, $req, true);
        if ($validation === true) {
        try {
            DB::beginTransaction();
            $Item = Jura::where('id', $req->id)->first();
            $Item->start_date = $req->start_date;
            $Item->end_date = $req->end_date;
            $Item->specifications = $req->specifications;
            if($req->achieve){
                $Item->achieve=$req->achieve;
            }
            $Item->depth = $req->depth;
            if ($Item->save()) {
                if ($req->config) {
                    $data = [];
                    foreach ($req->config as $key => $value) {
                        if (($key == 'service_matrial_id')) {
                            $data1 = [];
                            for ($i = 0; $i < count($req->config['service_matrial_id']); $i++) {
                                $data1[] = [
                                    'name' => $key,
                                    'material_id' => $req->config['service_matrial_id'][$i],
                                    'amount' => $req->config['service_matrial_qyt'][$i],
                                    'post_id' => $Item->id,
                                    'moduel_id' => 14
                                ];
                            }
                            JuraMaterials::where('post_id',$req->id)->where('name','service_matrial_id')->where('moduel_id',14)->delete();
                            JuraMaterials::insert($data1);
                        } elseif (($key == 'cleansing_matrial_id')) {
                            $data2 = [];
                            for ($i = 0; $i < count($req->config['cleansing_matrial_id']); $i++) {
                                $data2[] = [
                                    'name' => $key,
                                    'material_id' => $req->config['cleansing_matrial_id'][$i],
                                    'amount' => $req->config['cleansing_matrial_qyt'][$i],
                                    'post_id' => $Item->id,
                                    'moduel_id' => 14
                                ];
                            }
                            JuraMaterials::where('post_id',$req->id)->where('name','cleansing_matrial_id')->where('moduel_id',14)->delete();
                            JuraMaterials::insert($data2);
                        } else {

                            if(!is_array($value)){
                                $data[] = [
                                    'name' => $key,
                                    'value' => $value,
                                    'post_id' => $Item->id,
                                    'moduel_id' => 14
                                ];
                            }
                        }
                        if (!empty($data)) {
                            ModuelDetails::where('post_id',$req->id)->where('moduel_id',14)->delete();
                            ModuelDetails::insert($data);
                        }
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
        $data=Jura::orderBy('created_at','desc');
        if($req->status){

            switch ($req->status){
                case 'all':
                    $data=$data;
                    break;
                case 1:
                    $data = Jura::where('achieve',1);
                    break;
                case 2:
                    $data = Jura::where('achieve',2);
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

        $table = Jura::transformCollection($data);
        return \Datatables::of($table)
            ->addColumn('option', function ($item) use($req) {
                if($this->_checkPermission(15,5)) {
                    $back = $this->_editButn($item, 'operation/jura/');
                }else{
                    $back='';
                }
                return $back;
            })
            ->addColumn('implementation', function ($item) use($req) {
                if($item->achieve==1){
                    $back='<i class="fas fa-times-circle state not-solved" style=" cursor:pointer"></i>';
                }else{
                    $back='<i class="fas fa-check-circle state solved" style="cursor:pointer"></i>';
                }
                return $back;
            })
            ->addColumn('created_at', function ($item) {
                $back = date('Y-m-d', strtotime($item->created_at));

                return $back;
            })
            ->rawColumns(['option', 'created_at','implementation'])
            ->make(true);
    }
}
