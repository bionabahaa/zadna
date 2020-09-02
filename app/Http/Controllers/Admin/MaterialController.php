<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Matriels;
use App\Models\ModuelsType;
use App\Models\Material_Units;
use DB;

class MaterialController extends AdminController {

    private  $rules=[
        'type'=>'required',
        'main_groub'=>'required',
        'title'=>'required',
        'price'=>'required|min:0',
        'qyt'=>'required|numeric|min:0',
        'material_unit'=>'required',
    ];


    public function __construct() {
        parent::__construct();
    }

    public function index(Request $req) {
        $this->passing_data['arr'] = Matriels::$del_col;
        $this->passing_data['materials_type']=ModuelsType::where('moduel_id',7)->get();
        return $this->_view('Settings/Material', 'index');
    }

    public function create(Request $req) {

        $this->passing_data['main_groub']=Matriels::$main_groub;
        $this->passing_data['materials_type']=ModuelsType::where('moduel_id',7)->get();
        $this->passing_data['materials_unit']=Material_Units::all();
        return $this->_view('Settings/material', 'create');
    }

    public function store(Request $req) {

         $validation = $this->validation($this->rules, $req, true);
         if ($validation === true) {
        try {
            $code = Matriels::orderBy('created_at', 'desc')->first();
            if (!$code) {
                $code= 10;
            } else {
                $type_code=explode('_', $code->code);
                $code= (int)$type_code[0] + 1;
            }
            DB::beginTransaction();
            $Item = new Matriels();
            $Item->title = $req->title;
            $Item->main_groub = $req->main_groub;
            $Item->cost = $req->price;
            $Item->material_type_id = $req->type;
            $Item->material_unit_id = $req->material_unit;
            $Item->qyt = $req->qyt;
            $Item->note = $req->note;

            if ($Item->save()) {
                $material_type=Matriels::MatrielType($Item->material_type_id);
                DB::table('materials')->where('id',$Item->id)->update(['code'=>$code.'_'.$material_type->code]);
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
            $Item = Matriels::find($id);
            if ($Item) {
                $this->passing_data['main_groub']=Matriels::$main_groub;
                $result = Matriels::transform($Item);
                $this->passing_data['info'] = $result;
                $this->passing_data['materials_type']=ModuelsType::where('moduel_id',7)->get();
                $this->passing_data['materials_unit']=Material_Units::all();

                // dd($result);
                return $this->_view('Settings/material', 'edit');
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
            $Item = Matriels::where('id', $req->id)->first();
            $Item->title = $req->title;
            $Item->cost = $req->price;
            $Item->main_groub = $req->main_groub;
            $Item->material_type_id = $req->type;
            $Item->material_unit_id = $req->material_unit;
            $Item->qyt = $req->qyt;
            $Item->note = $req->note;


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
        $data=Matriels::orderBy('created_at','desc');
        if($req->status){
            if($req->status=='all'){
                $data=$data;
            }
            else {
                $data = $data->where('material_type_id', $req->status);
            }
        }
        if($req->date_from){
            $data=$data->where('created_at','>=',date('Y-m-d',strtotime($req->date_from)));
        }
        if($req->date_to){
            $data=$data->where('created_at','<=',date('Y-m-d',strtotime($req->date_to)));
        }

            $data = $data->get();
            $table = Matriels::transformCollection($data);

        return \Datatables::of($table)
            ->addColumn('option', function ($item) {
                if($this->_checkPermission(6,5)){
                    $back = $this->_editButn($item, 'setting/material/');
                }else{
                    $back='';
                }
                return $back;
            })->addColumn('code', function ($item) {
                $back ='<span style="cursor: pointer;" title="كود الخامه _ كود نوع الخامه ">'.$item->code.'</span>';
                return $back;
            })
            ->addColumn('created_at', function ($item) {
                $back = date('Y-m-d', strtotime($item->created_at));
                return $back;
            })
            ->rawColumns(['option','code','created_at'])
            ->make(true);
    }
    /////////////////////////
    public function typeStore(Request $req)
    {
        $rules=[
            'title_type'=>'required'
            ];
         $validation=$this->validation($rules,$req,true);
         if($validation===true){
        try {
            DB::beginTransaction();
            $Item = new ModuelsType();
            $Item->title = $req->title_type;
            $Item->moduel_id = 7;
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
         } else {
             return $this->json('warning', $validation);
         }
    }

    public function unitStore(Request $req)
    {
        $rules=[
            'unit_title'=>'required'
        ];
        $validation = $this->validation($rules, $req, true);
        if ($validation === true) {
            try {
                DB::beginTransaction();
                $Item = new Material_Units();
                $Item->title = $req->unit_title;
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
        }
        else{
            return $this->json('warning', $validation);
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

    public function unitDestroy($id){
        try{
            $Item=Material_Units::find($id);
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

