<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use App\Models\BoxCrops;
use App\Models\Boxes;
use App\Models\Users;
use App\Models\BoxesUsers;
use App\Models\Crops;
use App\Models\SoilAnalysis;
use App\Models\BoxCropPlanting;
use App\Models\Matriels;
use App\Models\Equipments;
use App\Models\OperationResources;
use DB;
use Excel;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Location;

class BoxesController extends AdminController {


    private $rules = [
        'row_count' => 'required|numeric|min:0',
        'column_count' => 'required|numeric|min:0',
        'size' => 'required|numeric|min:0',
        'users' => 'required',
        'point1'=>'required|numeric|min:0',
        'point2'=>'required|numeric|min:0',
        'point3'=>'required|numeric|min:0',
        'point4'=>'required|numeric|min:0',
        'Workers' => 'required',
        'Supervisors' => 'required',
        
       
        
         
    ];

    public function __construct() {
        parent::__construct();
    }


    public function importExcel(Request $req)
    {
        $array=['xlsx','xlsm','xlsb','xltx','xltm','xls','xlt','xml','xlam','xla','xlw','xlr'];
        if(Request()->hasFile('import_file')) {
            $path = $req->file('import_file')->getRealPath();
            $extension = $req->file('import_file')->getClientOriginalExtension();
            if (in_array($extension,$array)) {
                $data = Excel::load($path)->get();
                if (!empty($data) && $data->count()) {
                    foreach ($data as $key => $value) {
                        $insert[] = [
                            'code' => $value->code,
                            'north' => $value->north,
                            'south' => $value->south,
                            'east' => $value->east,
                            'west' => $value->west,
                            'size' => $value->size,
                            'rows' => $value->rows,
                            'columns' => $value->columns,
                            'column_count' => $value->column_count,

                            'row_count' => $value->row_count,
                            'desc' => $value->desc,
                            'note' => $value->note,
                            'irrigation_id' => $value->irrigation_id,
                            'created_at' => $value->created_at,
                            'updated_at' => $value->updated_at,
                        ];
                    }
                    if (!empty($insert)) {
                        DB::table('boxes')->insert($insert);
                        dd('Insert Record successfully.');
                    }
                }
            }
            else{
                Session::flash('invalid_format','Please choose invalid excel format');

            }
        }
        else{
            return 'file not exists';
        }
        return back();
    }


    public function index(Request $req) {
         
        global  $boxes;
        
       $boxes = Boxes::all();

       


        
        $this->passing_data['arr'] = Boxes::$del_col;
        $this->passing_data['report']=false;
        $this->passing_data['bath']=url('public/images/Uploads/config');
        $this->passing_data['box_signature']=DB::table('config')->select('value')->where('name','box_signature')->first();
        $this->passing_data['map_earth']=DB::table('config')->select('value')->where('name','map_earth')->first();
        return $this->_view('Settings/box', 'index');
    }

    public function create(Request $req) {

        $this->passing_data['Users']=Users::all();
        $this->passing_data['Crops']=Crops::whereNotNull('crop_id')->get();
        //dd($this->passing_data['Crops']);
        $this->passing_data['types']=Crops::whereNull('crop_id')->get();
        return $this->_view('Settings/box', 'create');
    }

    public function store(Request $req) {
        $validation = $this->validation($this->rules, $req, true);
        
        if ($validation === true) {
            try {
                $north=$req->north;
                $east=$req->east;
                $degree[]=$req->degree;
                $minute=$req->minute;
                $second=$req->second;
                $point1=$req->point1.'|'.$req->north[0].','.$req->degree[0].','.$req->minute[0].','.$req->second[0].'|'.$req->east[0].','.$req->degree[1].','.$req->minute[1].','.$req->second[1];
                $point2=$req->point2.'|'.$req->north[1].','.$req->degree[2].','.$req->minute[2].','.$req->second[2].'|'.$req->east[1].','.$req->degree[3].','.$req->minute[3].','.$req->second[3];
                $point3=$req->point3.'|'.$req->north[2].','.$req->degree[4].','.$req->minute[4].','.$req->second[4].'|'.$req->east[2].','.$req->degree[5].','.$req->minute[5].','.$req->second[5];
                $point4=$req->point4.'|'.$req->north[3].','.$req->degree[6].','.$req->minute[6].','.$req->second[6].'|'.$req->east[3].','.$req->degree[7].','.$req->minute[7].','.$req->second[7];
                DB::beginTransaction();
                $Item = new Boxes();
               
                $Item->code = $this->random(2);

                // $Item->type_id = $req->user_type;
                $Item->point1 = $point1;
                $Item->point2 = $point2;
                $Item->point3 = $point3;
                $Item->point4 = $point4;
                $Item->row_count = $req->row_count;
                $Item->column_count = $req->column_count;
                $Item->size =$req->size;
              
                $Item->Workers =$req->Workers;
                $Item->Supervisors =$req->Supervisors;
                if ($Item->save()) {
                    
                    
                    if ($req->users) {
                        $rows = [];
                        foreach ($req->users as $value) {
                            $row = [
                                'user_id' => $value,
                                'box_id' => $Item->id,
                            ];
                            $rows[] = $row;

                            parent::addTask($value,1,'setting/boxes/'.$Item->id.'/edit?operation_page=0');

                        }
                        if (!empty($rows)) {
                            BoxesUsers::insert($rows);
                        }
                    }
                    if ($req->crops) {
                        $rows = [];
                        foreach ($req->crops as $key=>$value) {
                            $row = [
                                'box_id' => $Item->id,
                                'crop_id' => $value,
                                'rows' =>$req->row[$key],
                                'columns' => $req->column[$key],
                            ];
                            $rows[] = $row;
                        }
                        if (!empty($rows)) {
                            BoxCrops::insert($rows);
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
    public function edit(Request $req,$id) {
        try {
            $Item = Boxes::find($id);
            if ($Item) {
                $result = Boxes::transform($Item);
                $point1=explode('|',$result->point1);
                $point1_north=explode(',',$point1[1]);
                $point1_east=explode(',',$point1[2]);
                $point2=explode('|',$result->point2);
                $point2_north=explode(',',$point2[1]);
                $point2_east=explode(',',$point2[2]);
                $point3=explode('|',$result->point3);
                $point3_north=explode(',',$point3[1]);
                $point3_east=explode(',',$point3[2]);
                $point4=explode('|',$result->point4);
                $point4_north=explode(',',$point4[1]);
                $point4_east=explode(',',$point4[2]);
                $this->passing_data['point1'] = $point1;
                $this->passing_data['point2'] = $point2;
                $this->passing_data['point3'] = $point3;
                $this->passing_data['point4'] = $point4;
                $this->passing_data['point1_north'] = $point1_north;
                $this->passing_data['point1_east'] = $point1_east;
                $this->passing_data['point2_north'] = $point2_north;
                $this->passing_data['point2_east'] = $point2_east;
                $this->passing_data['point3_north'] = $point3_north;
                $this->passing_data['point3_east'] = $point3_east;
                $this->passing_data['point4_north'] = $point4_north;
                $this->passing_data['point4_east'] = $point4_east;
                $this->passing_data['info'] = $result;
                $this->passing_data['Users']=Users::all();
                $this->passing_data['types']=Crops::whereNull('crop_id')->get();
                $this->passing_data['Crops']=Crops::whereNotNull('crop_id')->get();
                $this->passing_data['operation_page']=false;
                $this->passing_data['report']=false;
                if($req->operation_page==1){
                    
                    $this->passing_data['operation_page']=true;
                    $this->passing_data['BoxCropPlanting']=BoxCropPlanting::where('crop_id',$id)->get();
                    $this->passing_data['soil_analysis']=SoilAnalysis::where('box_id',$id)
                        ->get();
                    $this->passing_data['Equipments']=Equipments::all();
                    $this->passing_data['Matriels']=Matriels::all();
                    $this->passing_data['OperationResources']=OperationResources::leftJoin('materials','operation_resources.matrial_id','materials.id')
                        ->leftJoin('equipments','operation_resources.equipment_id','equipments.id')
                        ->where('post_id',$id)->where('moduel_id',11)->select(['operation_resources.*','materials.title as "M_title"','equipments.title as "E_title"'])->get();
                }
                return $this->_view('Settings/box', 'edit');
            } else {
                return abort(404);
            }
        } catch (Exception $ex) {
            return abort(500);
        }
    }

    public function update(Request $req) {
        $this->rules['id'] = "required";
        $validation = $this->validation($this->rules, $req, true);
        if ($validation === true) {
            try {
                $north=$req->north;
                $east=$req->east;
                $degree[]=$req->degree;
                $minute=$req->minute;
                $second=$req->second;
                $point1=$req->point1.'|'.$req->north[0].','.$req->degree[0].','.$req->minute[0].','.$req->second[0].'|'.$req->east[0].','.$req->degree[1].','.$req->minute[1].','.$req->second[1];
                $point2=$req->point2.'|'.$req->north[1].','.$req->degree[2].','.$req->minute[2].','.$req->second[2].'|'.$req->east[1].','.$req->degree[3].','.$req->minute[3].','.$req->second[3];
                $point3=$req->point3.'|'.$req->north[2].','.$req->degree[4].','.$req->minute[4].','.$req->second[4].'|'.$req->east[2].','.$req->degree[5].','.$req->minute[5].','.$req->second[5];
                $point4=$req->point4.'|'.$req->north[3].','.$req->degree[6].','.$req->minute[6].','.$req->second[6].'|'.$req->east[3].','.$req->degree[7].','.$req->minute[7].','.$req->second[7];


                DB::beginTransaction();
                $Item = Boxes::where('id', $req->id)->first();
                $Item->code = $Item->row.$Item->column;

                if(isset($req->signed) ){
                    $Item->signed=1;
                }
                else{
                    $Item->signed=0;
                }

                if($req->hasFile('signed_file')){
                    $file=$req->signed_file;
                    $extension=['doc','docx','pdf','rtf','tex','txt'];
                    $file_extension=$file->getClientOriginalExtension();
                    if(in_array($file_extension,$extension)){
                        $url_image = url('public//images/Uploads/box/') . '/' . $Item->signed_file;
                        $this->deleteImage($url_image);
                        $Item->signed_file = $this->uploadFile('signed_file', 'box');

                    }
                }


                $Item->point1 = $point1;
                $Item->point2 = $point2;
                $Item->point3 = $point3;
                $Item->point4 = $point4;
                $Item->crop_id = $req->type;
                $Item->row_count = $req->row_count;
                $Item->column_count = $req->column_count;
                $Item->row = $req->row;
                $Item->column = $req->column;
                $Item->size = $req->size;
                $Item->note = $req->note;
                if ($Item->save()) {

                    if ($req->users) {
                        BoxesUsers::where('box_id', $req->id)->delete();
                        $rows = [];
                        foreach ($req->users as $value) {
                            $row = [
                                'user_id' => $value,
                                'box_id' => $Item->id,
                            ];
                            //parent::addTask($value,1,'setting/boxes/'.$Item->id.'/edit?operation_page=0');
                            $rows[] = $row;
                        }
                        if (!empty($rows)) {
                            BoxesUsers::insert($rows);
                        }
                    }
                    if ($req->crops) {
                        BoxCrops::where('box_id', $req->id)->delete();
                        $rows = [];
                        foreach ($req->crops as $value) {
                            $row = [
                                'box_id' => $Item->id,
                                'crop_id' => $value,
                            ];
                            $rows[] = $row;
                        }
                        if (!empty($rows)) {
                            BoxCrops::insert($rows);
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
        if ($req->farm_id) {
            $data = Boxes::where('farm_id', $req->farm_id)->get();
        } else {
            $data = Boxes::all();
        }
        $table = Boxes::transformCollection($data);
        return \Datatables::of($table)
            ->addColumn('option', function ($item) use($req) {
                if($this->_checkPermission(4,5)) {
                    $back = $this->_editButn($item, 'setting/boxes/', ['operation_page' => $req->operation_page]);
                }else{
                    $back='';
                }
                // $back .= $this->_deleteBtn($item);
                return $back;
            })->addColumn('signed', function ($item) use($req) {
                if($item->signed==0){
                    $back='<i class="fa fa-times" style="color: red">'.'</i>';
                }
                else{
                    $back='<i class="fa fa-thumbs-up">'.'</i>';
                }
                return $back;
            })
            ->addColumn('created_at', function ($item) {
                $back = date('Y-m-d', strtotime($item->created_at));

                return $back;
            })
            ->rawColumns(['option', 'created_at','signed'])
            ->make(true);
    }

    public function upload(Request $req){

        $rules = [
            'box_signature' => 'file|mimes:pdf',
            'map_earth' => 'file|mimes:pdf',
        ];
        $validation = $this->validation($rules, $req, true);
        if ($validation === true) {
            $file = $req->file($req->name);
            $extension=$file->getClientOriginalExtension();
            $file = DB::table('config')->select('value')->where('name', $req->name)->first();
            if ($file) {
                $filename = $this->uploadFile($req->name, 'config');
                DB::table('config')->where('name', $req->name)->update(['value' => $filename]);
            } else {
                $filename = $this->uploadFile($req->name, 'config');
                if($filename===false){
                    $errors['Files']='يوجد مشكله فى الملف المرفوع';
                    return response()->json([
                        'type' => 'error',
                        'errors' => $errors
                    ]);
                }
                DB::table('config')->insert(['name' => $req->name, 'value' => $filename]);
            }
            $massage = "Successfuly";
            return $this->json('success', $massage, 200);
        }else{
            return $this->json('warning', $validation);
        }

    }
    ////////////////////////////////////////
    public function operation_index(Request $req){
 global $file;

        $this->passing_data['arr'] = Boxes::$del_col;
        if($req->reports){
            $this->passing_data['report']=true;
        }else{
            $this->passing_data['report']=0;
        }
//        dd($this->passing_data['report']);
        $file=DB::table('config')->select('value')->where('name', 'box_signature')->first();
        
        if($file){
            $this->passing_data['bath']=url('public/images/Uploads/config').'/'.$file->value;
        }else{
            $this->passing_data['bath']='';
        }

        return $this->_view('Operations/Box', 'index');
    }
    ////////////////////////////////////////
    public function soilanalysisStore(Request $req){
        $rules = [
            'fileSoil' => 'file|mimes:pdf,doc,docx,pptx',
            'date'=>'required',
            'note'=>'required'
        ];
        $validation = $this->validation($rules, $req, true);
        if ($validation === true) {
            try {
                DB::beginTransaction();
                $Item = new SoilAnalysis();
                $Item->box_id = $req->box_id;
                $Item->datetime = $req->date;
                $Item->note = $req->note;
                $Item->recommendation = $req->recommendation;
                if ($req->file('fileSoil')) {
                    $Item->file = $this->uploadFile('fileSoil', 'box');
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
        }
        else{
            return $this->json('warning', $validation);
        }
    }
    public function soilanalysisDestroy($id){
        try{
            $Item=SoilAnalysis::find($id);
            if($Item->delete()){
                $url_image = url('public//images/Uploads/box/') . '/' . $Item->file;
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
    ////////////////////////////////////////
    public function cropBoxStore(Request $req){
        try {
            DB::beginTransaction();
            $Item = new BoxCropPlanting();
            $Item->box_id = $req->box_id;
            $Item->crop_id = $req->crop_id;
            $Item->planting_id = $req->planting_id;
            $Item->row = $req->row;
            $Item->column = $req->column;
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
    public function cropBoxDestroy($id){
        try{
            $Item=BoxCropPlanting::find($id);
            if($Item->delete()){
                $url_image = url('public//images/Uploads/box/') . '/' . $Item->file;
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

    public function get_crops($id){
        $crops=Crops::where('crop_id',$id)->get();
        $select='<option  disabled >اختر الصنف</option>';

        foreach ($crops as $crop){
            $select.='
	                <option title="'.$crop->title.'" value="'.$crop->id.'">'.$crop->code.'</option>
	      
	       ';
        }
        return response()->json(['crops'=>$select]);
    }



}
