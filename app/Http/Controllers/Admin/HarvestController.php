<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Harvests;
use App\Models\Boxes;
use App\Models\Matriels;
use App\Models\Equipments;
use App\Models\OperationResources;
use App\Models\Crops;
use DB;

class HarvestController extends AdminController
{
    private $rules=[
        "box_id"=>'required',
        "crop_id"=>'required',
        "qyt"=>'required|numeric|min:0',
        "row"=>'required|numeric|min:0',
        "column"=>'required|numeric|min:0',
        "date"=>'required',
	];
	public function __construct() {
		parent::__construct();
    }
    public function index(Request $req) {
        $this->passing_data['arr'] = Harvests::$del_col;
        if($req->reports){
			$this->passing_data['report']=true;
		}else{
			$this->passing_data['report']=0;
		}
        $this->passing_data['bath']=url('public/images/Uploads/config');
        $this->passing_data['Boxes']=Boxes::all();
        $this->passing_data['used_type']=Harvests::$used_type;
        $this->passing_data['operation_type']=Harvests::$operation_type;
		return $this->_view('Operations/Harvests', 'index');
    }
    public function store(Request $req) {
      
        $validation = $this->validation($this->rules, $req, true);
        if ($validation === true) {
        try {
            $code = Harvests::orderBy('created_at', 'desc')->first();
            if (!$code) {
                $code= 1000;
            } else {
                $code= $code->code + 1;
            }
            DB::beginTransaction();
            $Item = new Harvests();
            $Item->code = $code;
            $Item->row = $req->row;
            $Item->column = $req->column;
            $Item->box_id = $req->box_id;
            $Item->crop_id = $req->crop_id;
            $Item->qyt = $req->qyt;
            $Item->date = $req->date;
            if ($Item->save()) {
                $crops=Crops::find($req->crop_id);
                $crops->qyt = (int)$crops->qyt+$req->qyt;
                $crops->save();
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
            $Item = Harvests::find($id);
            if ($Item) {
                $result = Harvests::transform($Item);
                $this->passing_data['info'] = $result;
               
                $this->passing_data['report']=false;
                $this->passing_data['Equipments']=Equipments::all();
                $this->passing_data['Matriels']=Matriels::all();
                $this->passing_data['OperationResources']=OperationResources::leftJoin('materials','operation_resources.matrial_id','materials.id')
                ->leftJoin('equipments','operation_resources.equipment_id','equipments.id')
                ->where('post_id',$id)->where('moduel_id',9)->select(['operation_resources.*','materials.title as "M_title"','equipments.title as "E_title"'])->get();
                return $this->_view('Operations/Harvests', 'edit');
            } else {
                return abort(404);
            }
        } catch (Exception $ex) {
            return abort(500);
        }
    }
    public function update(Request $req) {
        $this->rules['id'] = 'required';
//        unset($this->rules['box_id']);
         $rules=[
//            "qyt"=>'required|numeric|min:0',
            "date"=>'required',
        ];
        $validation = $this->validation($rules, $req, true);
        if ($validation === true) {
            try {
                DB::beginTransaction();
                $Item = Harvests::where('id', $req->id)->first();
                // $Item->row = $req->row;
                // $Item->column = $req->column;
                $Item->date = $req->date;
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
        $data = Harvests::where('id','!=',0);
        if($req->date_from){
            $data =$data->whereDate('date','>=',date('Y-m-d',strtotime($req->date_from)));
        }
        if($req->date_to){
            $data =$data->where('date','<=',date('Y-m-d',strtotime($req->date_to)));
        }
        $data =$data->get();

        $table = Harvests::transformCollection($data);
        return \Datatables::of($table)
            ->addColumn('option', function ($item) {
                if($this->_checkPermission(22,5)) {
                    $back = $this->_editButn($item, 'operation/harvest/');
                }else{
                    $back='';
                }
                return $back;
            })
            ->addColumn('qyt', function ($item) {
                $back = $item->qyt.' '.'شوال ';
                // $back .= $this->_deleteBtn($item);
                return $back;
            })
            ->addColumn('created_at', function ($item) {
                $back = date('Y-m-d', strtotime($item->created_at));
                return $back;
            })
            ->rawColumns(['option', 'created_at','qyt'])
            ->make(true);
    }
}
