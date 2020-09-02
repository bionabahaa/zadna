<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SunstainableOperations;
use App\Models\Boxes;
use App\Models\Matriels;
use App\Models\Equipments;
use App\Models\OperationResources;
use DB;


class SunstainableOperationsController extends AdminController
{
    private $rules=[
        "used_type_id"=>'required',
	    "operation_type_id"=>'required',
        "box_id"=>'required',
        "start_date"=>'required',
	];
	public function __construct() {
		parent::__construct();
    }
    public function index(Request $req) {
        if($req->reports){
			$this->passing_data['report']=true;
		}else{
			$this->passing_data['report']=0;
		}
        $this->passing_data['bath']=url('public/images/Uploads/config');
        $this->passing_data['Boxes']=Boxes::all();
        $this->passing_data['used_type']=SunstainableOperations::$used_type;
        $this->passing_data['operation_type']=SunstainableOperations::$operation_type;
		return $this->_view('Operations/SunstainableOperations', 'index');
    }
    public function store(Request $req) {
        $validation = $this->validation($this->rules, $req, true);
        if ($validation === true) {
        try {
            $code = SunstainableOperations::orderBy('created_at', 'desc')->first();
            if (!$code) {
                $code= 1000;
            } else {
                $code= $code->code + 1;
            }
            DB::beginTransaction();
            $Item = new SunstainableOperations();
            $Item->code = $code;
            $Item->used_type_id = $req->used_type_id;
            $Item->operation_type_id = $req->operation_type_id;
            $Item->box_id = $req->box_id;
            $Item->start_date = $req->start_date;
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
    public function edit($id) {
        try {
            $Item = SunstainableOperations::find($id);
            if ($Item) {
                $result = SunstainableOperations::transform($Item);
                $this->passing_data['info'] = $result;
                $this->passing_data['used_type']=SunstainableOperations::$used_type;
                $this->passing_data['operation_type']=SunstainableOperations::$operation_type;
                $this->passing_data['report'] = false;
                $this->passing_data['Equipments']=Equipments::all();
                $this->passing_data['Matriels']=Matriels::all();
                $this->passing_data['OperationResources']=OperationResources::leftJoin('materials','operation_resources.matrial_id','materials.id')
                ->leftJoin('equipments','operation_resources.equipment_id','equipments.id')
                ->where('post_id',$id)->where('moduel_id',8)->select(['operation_resources.*','materials.title as "M_title"','equipments.title as "E_title"'])->get();

                return $this->_view('Operations/SunstainableOperations', 'edit');
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
        unset($this->rules['level_id']);
        $validation = $this->validation($this->rules, $req, true);
        if ($validation === true) {
            try {
                DB::beginTransaction();
                $Item = SunstainableOperations::where('id', $req->id)->first();
                $Item->used_type_id = $req->used_type_id;
                $Item->operation_type_id = $req->operation_type_id;
                $Item->notes = $req->notes;
                $Item->recommendation = $req->recommendation;
                $Item->start_date = $req->start_date;
                if ($Item->save()) {
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
        $data = SunstainableOperations::get();
        $table = SunstainableOperations::transformCollection($data);
        return \Datatables::of($table)
            ->addColumn('option', function ($item) {
                $back = $this->_editButn($item, 'operation/sunstainable_operations/');
                // $back .= $this->_deleteBtn($item);
                return $back;
            })
            ->addColumn('created_at', function ($item) {
                $back = date('Y-m-d', strtotime($item->created_at));
                return $back;
            })
            ->rawColumns(['option', 'created_at'])
            ->make(true);
    }
}
