<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Nutrias;
use App\Models\Boxes;
use App\Models\Matriels;
use App\Models\Equipments;
use App\Models\OperationResources;
use DB;

class NutriaController extends AdminController
{
    private $rules=[
        "palm_tree_QYT"=>'required|numeric|min:0',
	    "box_id"=>'required',
	];
	public function __construct() {
		parent::__construct();
    }
    public function index(Request $req) {

        $this->passing_data['arr'] = Nutrias::$del_col;
        if($req->reports){
			$this->passing_data['report']=true;
		}else{
			$this->passing_data['report']=0;
		}
        $this->passing_data['bath']=url('public/images/Uploads/config');
        $this->passing_data['Boxes']=Boxes::all();
		return $this->_view('Operations/Nutria', 'index');
    }
    public function store(Request $req) {
        // dd($req);
        $validation = $this->validation($this->rules, $req, true);
        if ($validation === true) {
        try {
            $code = Nutrias::orderBy('created_at', 'desc')->first();
            if (!$code) {
                $code= 1000;
            } else {
                $code= $code->code + 1;
            }
            DB::beginTransaction();
            $Item = new Nutrias();
            $Item->code = $code;
            $Item->palm_tree_QYT = $req->palm_tree_QYT;
            $Item->box_id = $req->box_id;
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
        $this->passing_data['report']=0;
        try {
            $Item = Nutrias::find($id);
            if ($Item) {
                $result = Nutrias::transform($Item);
                $this->passing_data['info'] = $result;
                $this->passing_data['Equipments']=Equipments::all();
				$this->passing_data['Matriels']=Matriels::all();
				$this->passing_data['OperationResources']=OperationResources::leftJoin('materials','operation_resources.matrial_id','materials.id')
				->leftJoin('equipments','operation_resources.equipment_id','equipments.id')
				->where('post_id',$id)->where('moduel_id',7)->select(['operation_resources.*','materials.title as "M_title"','equipments.title as "E_title"'])->get();
                // dd($result);
                return $this->_view('Operations/Nutria', 'edit');
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
        $validation = $this->validation($this->rules, $req, true);
        if ($validation === true) {
            try {
                DB::beginTransaction();
                $Item = Nutrias::where('id', $req->id)->first();
                $Item->palm_tree_QYT = $req->palm_tree_QYT;
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
        $data = Nutrias::all();
        $table = Nutrias::transformCollection($data);
        return \Datatables::of($table)
            ->addColumn('option', function ($item) {
                if($this->_checkPermission(17,5)) {
                    $back = $this->_editButn($item, 'operation/nutria/');
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
}
