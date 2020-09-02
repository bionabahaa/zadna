<?php

namespace App\Http\Controllers\Admin;

use App\Models\Fault;
use App\Models\Irrigation;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\AdminController;
use DB;
use App\Models\Wells;
use App\Models\Equipments;
class FaultController extends AdminController
{
    private  $rules=[
        'type'=>'required',
        'fault_code'=>'required',
        'date'=>'required',
    ];
    public function index()
    {
        $this->passing_data['arr'] = Fault::$del_col;
        return $this->_view('faults', 'faults');
    }
    public function store(Request $req)
    {
        $validation = $this->validation($this->rules, $req, true);
        if ($validation === true) {
            try {
                DB::beginTransaction();
                $Item = new Fault();
                $Item->type = $req->type;
                $Item->fault_code = $req->fault_code;
                $Item->desc =strip_tags($req->desc);
                $Item->date = $req->date;
                $Item->fault_status = $req->fault_status;
                $Item->save();
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
    public function show($id)
    {
        //
    }

  function edit($id)
    {
    }


    public function update(Request $req, $id)
    {
        $validation = $this->validation($this->rules, $req, true);
        if ($validation === true) {
            try {
                DB::beginTransaction();
                $Item =Fault::where('id',$id)->first();
                $Item->type = $req->type;
                $Item->fault_code = $req->fault_code;
                $Item->desc =strip_tags($req->desc);
                $Item->date = $req->date;
                $Item->fault_status = $req->fault_status;
                $Item->save();
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


    public function dataTable(Request $req)
    {
        $data=Fault::orderBy('created_at','desc');
        if($req->type){
            switch ($req->type){
                case 'all':
                    $data=$data;
                    break;
                default:
                    $data=Fault::where('type',$req->type);
            }
        }
        if($req->status){
            switch ($req->status){
                case 'all_status':
                    $data=$data;
                    break;
                case 1:
                    $data = $data->where('fault_status',1);
                    break;
                case 2:
                    $data = $data->where('fault_status',2);
                    break;
                case 3:
                    $data = $data->where('fault_status',3);
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


        $table = Fault::transformCollection($data);
        return \Datatables::of($table)
            ->addColumn('status', function ($item) {
                $back='';
                if($item->fault_status==1){
                    $back='<i class="fas fa-hourglass-half" style="color: yellow"></i>';
                }
                elseif($item->fault_status==2){
                    $back='<i class="fa fa-times" style="color: red"></i>';
                }
                else{
                    $back='<i class="fa fa-thumbs-up" ></i>';
                }

                return $back;
            })
            ->addColumn('option', function ($item) {
                if($this->_checkPermission(32,4)) {
                    $back = '<i class="fas fa-eye view-row text-dark" title="View" data-toggle="modal"
                               data-target="#add-falut" onclick="editFault(' . $item->id . ')"></i>';
                }else{
                    $back='';
                }
                return $back;
            })
            ->rawColumns(['option','status'])
            ->make(true);

    }



    public function faultType(Request $req)
    {
        try {
            $selection = '';
            $types='<option selected disabled>'.'اختر'.'</option>';
            if ($req->status == 1) {
                $selection = Wells::all();
            } elseif ($req->status == 2)  {
                $selection = Equipments::all();
            }
            elseif ($req->status == 3)  {
                $selection = Irrigation::all();
            }

            if ($selection) {
                foreach ($selection as $selection) {
                    $types .= '<option   value="' . $selection->code . '" >' . $selection->code . '</option>';
                }
            }
            return response()->json(['types'=>$types]);
        } catch (Exception $ex) {
            DB::rollBack();
        }
    }

    public function editFault(Request $req){
       $fault=Fault::where('id',$req->id)->first();

        $selection = '';
        $types='<option selected disabled>'.'اختر'.'</option>';
        if ($fault->type == 1) {
            $selection = Wells::all();

        } elseif($fault->type == 2) {
            $selection = Equipments::all();

        }elseif($fault->type == 3) {
            $selection = Irrigation::all();

        }

        if ($selection) {
            foreach ($selection as $selection) {
                $selected=$selection->code==$fault->fault_code?'selected':'';
                $types .= '<option   value="'.$selection->code .'" '.$selected.' >' . $selection->code . '</option>';
            }
        }


       return Response()->json(['fault'=>$fault,'types'=>$types]);
    }
}
