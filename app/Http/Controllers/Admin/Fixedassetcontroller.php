<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\AdminController;
use App\Models\FixedAssets;
use App\Models\ModuelsType;
use App\DataTables\AdminDataTable;
use Datatables;
use DB;
use Mockery\Exception;
class Fixedassetcontroller extends AdminController {

    private  $rules=[
        'title'=>'required',
        'type'=>'required',
        'Purchasing_value'=>'required|numeric|min:0',
        'Market_value'=>'required|numeric|min:0',
    ];


    public function __construct() {
        parent::__construct();
    }

    public function index(Request $req) {
        $this->passing_data['arr'] = FixedAssets::$del_col;
        $fixedasset_types=ModuelsType::where('moduel_id',5)->get();
        $this->passing_data['fixedasset_types']=$fixedasset_types;
        return $this->_view('Settings/Fixedasset', 'index');
    }

    public function create(Request $req) {

        $this->passing_data['FixedAssets_type']=ModuelsType::where('moduel_id',5)->get();
        return $this->_view('Settings/Fixedasset', 'create');
    }

    public function store(Request $req) {
       $validation = $this->validation($this->rules, $req, true);
        if ($validation === true) {
        try {
            $code = FixedAssets::orderBy('created_at', 'desc')->first();
            if (!$code) {
                $code= 1000;
            } else {
                $code= $code->code + 1;
            }
            DB::beginTransaction();
            $Item = new FixedAssets();
            $Item->code = $code;
            $Item->title = $req->title;
            $Item->fixedasset_type_id = $req->type;
            $Item->desc = $req->desc;
            $Item->note = $req->note;
            $Item->Purchasing_value = $req->Purchasing_value;
            $Item->Market_value = $req->Market_value;


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
            $Item = FixedAssets::find($id);
            if ($Item) {
                $result = FixedAssets::transform($Item);
                $this->passing_data['info'] = $result;
                $this->passing_data['FixedAssets_type']=ModuelsType::where('moduel_id',5)->get();
               // $this->passing_data['materials_unit']=Material_Units::all();

                // dd($result);
                return $this->_view('Settings/fixedasset', 'edit');
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
            $Item = FixedAssets::where('id', $req->id)->first();
            $Item->title = $req->title;
            $Item->Purchasing_value = $req->Purchasing_value;
            $Item->Market_value = $req->Market_value;
            $Item->fixedasset_type_id = $req->type;
            $Item->desc = $req->desc;
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


        if($req->type){
            if ($req->type=='all'){
                $data = FixedAssets::all();
            }else{
                $data=FixedAssets::where('fixedasset_type_id',$req->type)->get();
        }
        }
        else{
            $data = FixedAssets::all();
        }

        $table = FixedAssets::transformCollection($data);

        return \Datatables::of($table)
            ->addColumn('option', function ($item) {
                if($this->_checkPermission(5,5)){
                    $back = $this->_editButn($item, 'setting/fixedasset/');
                }
                else{
                    $back='';
                }

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
    //////////////////////////////
    public function typeStore(Request $req)
    {
        $rules=[
            'title_type'=>'required'
        ];
         $validation=$this->validation($rules,$req,true);
         if($validation===true) {
             try {
                 DB::beginTransaction();
                 $Item = new ModuelsType();
                 $Item->title = $req->title_type;
                 $Item->moduel_id = 5;
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
         else {
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


}

