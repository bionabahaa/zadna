<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\AdminController;
use App\Models\ModuelsType;
use App\Models\StoreRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Matriels;
use App\Models\Equipments;
use App\Models\Separation;
use App\Models\OperationResources;
use DB;
use ReCaptcha\Response;

class StoreController extends AdminController
{
    public function __construct()
    {

        parent::__construct();
    }

    public function index(Request $req)
    {
        $this->passing_data['arr'] = StoreRequest::$del_col;
        $types = ModuelsType::whereIn('moduel_id', [4, 7])->get();
        $this->passing_data['types'] = $types;
        return $this->_view('Store', 'index');
    }

    public function edit(Request $req, $id)
    {
        try {
            $data = OperationResources::whereIn('opertion_type_id', [3, 4])->get();
            $this->passing_data['data'] = OperationResources::transformCollection($data);
            // dd($this->passing_data['data']);
            return $this->_view('Store/', 'edit');
        } catch (Exception $ex) {
            return abort(500);
        }

    }

    public function update(Request $req)
    {

    }

    public function dataTable(Request $req)
    {
        $first_table = Matriels::Join('moduels_type', 'moduels_type.id', 'materials.material_type_id')
            ->select(['materials.id', 'materials.title', 'moduels_type.title as type_title', 'materials.code', 'materials.updated_at', 'materials.QYT as QYT', 'moduels_type.moduel_id']);
        $table = Equipments::Join('moduels_type', 'moduels_type.id', 'equipments.type_id')
            ->select(['equipments.id', 'equipments.title', 'moduels_type.title as type_title', 'equipments.code', 'equipments.updated_at', 'equipments.QYT as QYT', 'moduels_type.moduel_id'])->union($first_table);

        if ($req->status) {
            if ($req->status == 'all') {
                $first_table = $first_table;
                $table = $table;
            } else {
                $first_table = Matriels::Join('moduels_type', 'moduels_type.id', 'materials.material_type_id')
                    ->select(['materials.id', 'materials.title', 'moduels_type.title as type_title', 'materials.code', 'materials.updated_at', 'materials.QYT as QYT', 'moduels_type.moduel_id'])->where('moduels_type.id', $req->status);
                if ($req->date_from) {
                    $first_table = $first_table->where('materials.updated_at', '>=', date('Y-m-d', strtotime($req->date_from)));

                }
                if ($req->date_to) {
                    $first_table = $first_table->where('materials.updated_at', '<=', date('Y-m-d', strtotime($req->date_to)));
                }
                $table = Equipments::Join('moduels_type', 'moduels_type.id', 'equipments.type_id')
                    ->select(['equipments.id', 'equipments.title', 'moduels_type.title as type_title', 'equipments.code', 'equipments.updated_at', 'equipments.QYT as QYT', 'moduels_type.moduel_id'])->where('moduels_type.id', $req->status)->union($first_table);

            }

        }

        if ($req->date_from) {
            $table = $table->where('equipments.updated_at', '>=', date('Y-m-d', strtotime($req->date_from)));

        }
        if ($req->date_to) {
            $table = $table->where('equipments.updated_at', '<=', date('Y-m-d', strtotime($req->date_to)));
        }
        $table = $table->get();


        return \Datatables::of($table)
            ->addColumn('option', function ($item) {
                $back = '<i class="fa fa-eye" onclick="material_operation(' . $item->id . ')"></i>';
                return $back;
            })
            ->addColumn('created_at', function ($item) {
                $back = date('Y-m-d', strtotime($item->created_at));
                return $back;
            })
            ->rawColumns([ 'created_at','option'])
            ->make(true);
    }
    /////////////////////////////////////////////////
    /*
    / Show Orders
    */
    public function show_orders(Request $req)
    {
        $this->passing_data['arr'] = OperationResources::$del_col;
        $types = ModuelsType::whereIn('moduel_id', [4, 7])->get();
        $this->passing_data['types'] = $types;
        return $this->_view('Store', 'order');
    }

    public function dataTable_orders(Request $req)
    {
        $data = OperationResources::whereIn('opertion_type_id', [3, 4])
            ->where('store_done', 0);
        if ($req->status) {
            switch ($req->status) {
                case 'all':
                    $data = $data;
                    break;
                case 1:
                    $data = $data->where('matrial_id', '!=', null);
                    break;
                case 2:
                    $data = $data->where('equipment_id', '!=', null);
                    break;
            }

        }
        if ($req->date_from) {
            $data = $data->whereDate('datetime', '>=', date('Y-m-d', strtotime($req->date_from)));
        }
        if ($req->date_to) {
            $data = $data->where('datetime', '<=', date('Y-m-d', strtotime($req->date_to)));
        }
        $data = $data->get();

        $table = OperationResources::transformCollection($data);
        return \Datatables::of($table)
            ->addColumn('option', function ($item) {
//                $back='<i class="fas fa-hourglass-start iconchange col-val" onclick="change_status('.$item->id.')"></i>';
                $back = '<i class="fa fa-eye" onclick="show_order(' . $item->id . ')"></i>';
                return $back;
            })
            ->addColumn('created_at', function ($item) {
                $back = date('Y-m-d', strtotime($item->created_at));

                return $back;
            })
            ->rawColumns(['option', 'created_at'])
            ->make(true);
    }

//    public function update_status(Request $req)
//    {
//        try {
//            $Item = OperationResources::where('id', $req->id)->first();
//            $Item->store_done = 1;
//            if ($Item->save()) {
//                $massage = 'تمت عمليه التعديل بنجاح';
//                return $this->json('success', $massage, 200);
//            }
//        } catch (Exception $ex) {
//            return abort(500);
//        }
//    }

    public function get_order($id)
    {
        $result = OperationResources::find($id);
        if ($result->opertion_type_id == 3) {
            $result = OperationResources::join('equipments', 'equipments.id', 'operation_resources.equipment_id')->select('*', 'operation_resources.id as operation_resources_id')->where('operation_resources.id', $id)->where('store_done', 0)->first();

        } elseif ($result->opertion_type_id == 4) {
            $result = OperationResources::join('materials', 'operation_resources.matrial_id', 'materials.id')->where('operation_resources.id', $id)->select('*', 'operation_resources.id as operation_resources_id')->where('store_done', 0)->first();

        }
        return Response()->json(['result' => $result]);
    }

    public function material_operation($id)
    {
        $result = OperationResources::where('matrial_id',$id)->where('opertion_type_id',4)->get();
        $material_info=Matriels::where('id',$result[0]->matrial_id)->first();
        $info='';
        foreach ($result as $material){
            $info.='
                <tr>
                    <td>'.$material_info->QYT.'</td>
                    <td>'.$material->qyt.'</td>
                    <td>'.$material->sent_qyt.'</td>
                    <td>'.$material->rest_qyt.'</td>
                </tr>
                    
            ';


        }

        return Response()->json(['result' => $info,'material_info'=>$material_info]);
    }

    public function save_order(Request $req, $id)
    {
         $rules = [
            'sent_qyt' => 'required|numeric|integer|min:0|max:'.$req->total_qyt,
        ];
        $validation = $this->validation($rules, $req, true);
        try{
        if ($validation === true) {
            DB::beginTransaction();
            $item = OperationResources::find($id);
            if($item->rest_qyt){
                $item->rest_qyt=$item->rest_qyt - (int)$req->sent_qyt;
            }else{
                $item->rest_qyt=$item->qyt - (int)$req->sent_qyt;
            }

            $item->qyt= (int)$item->qyt;
            $item->sent_qyt=(int)$req->sent_qyt + (int)$item->sent_qyt;
            if($item->save()){

                if($item->qyt == 0){
                    DB::table('operation_resources')->where('id', $item->id)->update(['store_done'=>1]);
                }
                else{
                    DB::table('operation_resources')->where('id', $item->id)->update(['store_done'=>0]);

                }
                DB::commit();
            }
            if ($item->matrial_id) {
                $raw_material = Matriels::where('id', $item->matrial_id)->first();
                DB::table('materials')->where('id', $raw_material->id)->update(['QYT' => $raw_material->QYT - $req->sent_qyt]);
            } else {
                $raw_material = Equipments::where('id', $item->equipment_id)->first();
                DB::table('equipments')->where('id', $raw_material->id)->update(['QYT' => $raw_material->QYT - $req->sent_qyt]);
            }
            $massage = 'تمت عمليه التعديل بنجاح';
            return $this->json('success', $massage, 200);
        } else {
            return $this->json('warning', $validation);
        }
        }
        catch (Exception $ex) {
            DB::rollBack();
        }

    }

    public function store_incomplete(){
//        $materials=OperationResources::join('materials','materials.id','operation_resources.matrial_id')->where('opertion_type_id',4)->get();
//        $data=[];
//        foreach ($materials as $material){
//            if($material->QYT < $material->sent_qyt){
//                $data[]=$material;
//            }
//        }

        $data=OperationResources::whereColumn('sent_qyt','>','qyt')->get();
        $materials = OperationResources::transformCollection($data);
        $this->passing_data['materials'] = $materials;
        return $this->_view('Store', 'incomplete_store');
    }
}



