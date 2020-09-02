<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tasks;
use App\Models\Boxes;
use App\Models\Users;
use App\Models\Matriels;
use App\Models\OperationResources;
use App\Models\StoreRequest;
use DB;

class StoreRequestController extends AdminController
{
    private $rules=[
	    "type_id"=>'required',
	    "qyt"=>'required|min:0|numeric',
//        'user_id'=>'required',
        "order_from"=>'required',
//        'order_date'=>'required|date',
//        'order_date_required'=>'required|date',
//        'order_date_actaual'=>'required|date',
        "title"=>'required',
        'cost'=>'required|min:0|numeric'
	];
    public function __construct() {
		parent::__construct();
    }

    public function index(){
        $this->passing_data['arr'] =StoreRequest::$del_col;
        $this->passing_data['Types']=StoreRequest::$type;
        $this->passing_data['Boxes']=Boxes::all();
        return $this->_view('Store/', 'request');
    }
    public function create(){

    }
    public function store(Request $req){
        $validation = $this->validation($this->rules, $req, true);
        if ($validation === true) {
            try {
                $code = StoreRequest::orderBy('created_at', 'desc')->first();
                if (!$code) {
                    $code= 1000;
                } else {
                    $code= $code->code + 1;
                }
                DB::beginTransaction();
                $Item = new StoreRequest();
                $Item->code = $code;
                $Item->type_id = $req->type_id;
                $Item->status_id = 1;
                $Item->qyt = strip_tags($req->qyt);
                $Item->cost = strip_tags($req->cost);
                $Item->title = strip_tags($req->title);
                $Item->ordered_from = strip_tags($req->order_from);
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
        $order= StoreRequest::where('id',$id)->first();
        $this->passing_data['users']=Users::all();
        $this->passing_data['Types']=StoreRequest::$type;
        $this->passing_data['order']=$order;
        return $this->_view('Store/', 'edit_request');
    }
    public function update(Request $req){
        $validation = $this->validation($this->rules, $req, true);
        if ($validation === true) {
            try {

                DB::beginTransaction();
                $Item =StoreRequest::where('id',$req->id)->first();
                $Item->type_id = $req->type_id;
                $Item->status_id =$req->status;
                $Item->qyt = $req->qyt;
                $Item->cost = $req->cost;
                $Item->title = $req->title;
                $Item->ordered_from = $req->order_from;
                if($req->user_id) {
                    $Item->user_id = $req->user_id;
                }
                if($req->order_date) {
                    $Item->order_date = $req->order_date;
                }
                if($req->order_date_required) {
                    $Item->order_date_required = $req->order_date_required;
                }
                if($req->order_date_actaual) {
                    $Item->order_date_actaual = $req->order_date_actaual;
                }
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
    public function dataTable(request $req){
        $data=StoreRequest::orderBy('created_at','desc');
        if($req->status){
            switch ($req->status){
                case 'all':
                    $data=$data;
                    break;
                case 1:
                    $data = $data->where('type_id',1);
                    break;
                case 2:
                    $data =$data->where('type_id',2);
                    break;
                case 3:
                    $data =$data->where('type_id',3);
                    break;
            }
        }


        if($req->type){
            switch ($req->type){
                case 'all':
                    $data=$data;
                    break;
                case 1:
                    $data = $data->where('status_id',1);
                    break;
                case 2:
                    $data =$data->where('status_id',2);
                    break;
                case 3:
                    $data =$data->where('status_id',3);
                    break;
            }
        }

        if($req->date_from){
            $data =$data->whereDate('order_date','>=',date('Y-m-d',strtotime($req->date_from)));
        }
        if($req->date_to){
            $data =$data->where('order_date','<=',date('Y-m-d',strtotime($req->date_to)));
        }
        $data =$data->get();
        $table=StoreRequest::transformCollection($data);
        return \Datatables::of($table) 
			->addColumn('status', function ($item) {

               if($item->status_id==1){
                    $back='<i class="fas fa-hourglass-half" style="color: rgb(241, 255, 47)"></i>
                    <span hidden>جاري التنفيذ</span>';
               }elseif($item->status_id==2){
                   $back='<i class="fas fa-times-circle" style="color: black"></i>
                    <span hidden>لم يتم</span>';
               }else{
                   $back='<i class="fas fa-check-circle" style="color: green"></i>
                  <span hidden>تم</span>';
               }


				return $back;
            })
            ->addColumn('option', function ($item) {
                if($this->_checkPermission(30,4)) {
                    $back = $this->_editButn($item, 'stores/requests');
                }else{
                    $back='';
                }
				return $back;
			})
			->addColumn('created_at', function ($item) {
				$back = date('Y-m-d', strtotime($item->created_at));

				return $back;
			})
			->rawColumns(['option', 'created_at','status'])
			->make(true);
    }
}
