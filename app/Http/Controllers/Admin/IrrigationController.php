<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Irrigation;
use App\Models\Intersection;
use App\Models\Boxes;
use App\Models\BoxIrrugation;
use App\Models\Matriels;
use App\Models\Equipments;
use App\Models\OperationResources;
use App\Models\IrrigationMahbas;
use App\Models\Material_Units;
use DB;

class IrrigationController extends AdminController
{
    public  $rules=[
             'title'=>'required',
             'line_type'=>'',
             'cost'=>'required',
             'water_amount'=>'required',
             'water_speed'=>'required|numeric|min:0',
             'diameter_half'=>'numeric',
             'north'=>'required',
             'point1'=>'required',
             'point2'=>'required',
        ];
    public function __construct() {
        parent::__construct();
    }

    public function index(Request $req) {
        $this->passing_data['arr'] = Irrigation::$del_col;
        $this->passing_data['bath']=url('public/images/Uploads/config');
        $this->passing_data['irrigation_file']=DB::table('config')->select('value')->where('name','irrigation_files')->first();
        $line_types= $this->passing_data['line_types']=Irrigation::$line_types;
    //   dd($line_types) ;
    //    exit;
        return $this->_view('Settings/Irrigation', 'index');
    }

    public function create(Request $req) {
      
        $this->passing_data['all_boxes']=Boxes::all();
      $this->passing_data['line_types']=Irrigation::$line_types;
        
        //$this->passing_data['materials_unit']=Material_Units::all();
        return $this->_view('Settings/Irrigation', 'create');
    }

    public function store(Request $req) {
            
       
      
         $validation = $this->validation($this->rules, $req, true);
         if ($validation === true) {
        try {
            $code = Irrigation::orderBy('created_at', 'desc')->first();
            if (!$code) {
                $code= 10;
            } else {
                $line_code=explode(',',$code->code);
                
                $code_num=count($line_code);
                switch ($code_num){
                    case 1:
                        $code=$line_code[0]+1;
                        break;
                    case 2:
                        $code=$line_code[1]+1;
                        break;
                    case 3:
                        $code=$line_code[2]+1;
                        break;
                    case 4:
                        $code=$line_code[3]+1;
                        break;
                }
            }
            DB::beginTransaction();
            $north=$req->north;
            $east=$req->east;
            $degree[]=$req->degree;
            $minute=$req->minute;
            $second=$req->second;
            $point1=$req->point1.'|'.$req->north[0].','.$req->degree[0].','.$req->minute[0].','.$req->second[0].'|'.$req->east[0].','.$req->degree[1].','.$req->minute[1].','.$req->second[1];
            $point2=$req->point2.'|'.$req->north[1].','.$req->degree[2].','.$req->minute[2].','.$req->second[2].'|'.$req->east[1].','.$req->degree[3].','.$req->minute[3].','.$req->second[3];
            $Item = new Irrigation();
            switch ($req->line_type){
                case 3:
                   $Item->code =$req->primary_line.','.$code;
                 
                    break;
                case 2:
                    $Item->code =$req->under_primary_line.','.$code;
                    break;
                case 4:
                    $Item->code =$req->sub.','.$code;
                    break;
                default:
                    $Item->code =$code;

                    

            }
            $Item->point1 = $point1;
            $Item->point2 = $point2;
            $Item->title = $req->title;
            $Item->line_type = $req->line_type;
            $Item->cost = $req->cost;
            $Item->water_amount = $req->water_amount;
            $Item->lenght = $req->lenght;
            $Item->diameter_half = $req->diameter_half;
            $Item->water_speed = $req->water_speed;

            if ($Item->save()) {
                if ($req->boxes){
                    $data = [];
                foreach ($req->boxes as $key => $value) {
                    $data[] = [
                        'box_id' => $value,
                        'irrigation_id' => $Item->id,
                    ];
                }
                if (!empty($data)) {
                    BoxIrrugation::insert($data);
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
            $Item = Irrigation::find($id);

            
            if ($Item) {
                $result = Irrigation::transform($Item);
             
                $code=explode(',',$result->code);
//              $this->passing_data['code_count'] = count($code);
                $this->passing_data['info'] = $result;

                switch ($result->line_type_id){
                    case '3':
                        $lines=$this->get_lines(1);
                        break;

                    case '2':
                        $lines=$this->get_lines(3);
                        break;

                    case '4':
                        $lines=$this->get_lines(2);
                        break;
                    default:
                        $lines=[];
                }
                $this->passing_data['code_irrig'] = substr($result->code,0,-3) ;
                if(isset($lines)) {
                    $this->passing_data['lines'] = $lines;
                }
                $point1=explode('|',$result->point1);
                $point1_north=explode(',',$point1[1]);
                $point1_east=explode(',',$point1[2]);
                $point2=explode('|',$result->point2);
                $point2_north=explode(',',$point2[1]);
                $point2_east=explode(',',$point2[2]);
                $this->passing_data['point1'] = $point1;
                $this->passing_data['point2'] = $point2;
                $this->passing_data['point1_north'] = $point1_north;
                $this->passing_data['point1_east'] = $point1_east;
                $this->passing_data['point2_north'] = $point2_north;
                $this->passing_data['point2_east'] = $point2_east;
                $this->passing_data['all_boxes']=Boxes::all();
                $this->passing_data['line_types']=Irrigation::$line_types;
                $this->passing_data['Intersection']=Intersection::all();
                $this->passing_data['operation_page']=false;
                $this->passing_data['report']=false;
				if($req->operation_page==1){
                $this->passing_data['Equipments']=Equipments::all();
				$this->passing_data['Matriels']=Matriels::all();
				$this->passing_data['OperationResources']=OperationResources::leftJoin('materials','operation_resources.matrial_id','materials.id')
				->leftJoin('equipments','operation_resources.equipment_id','equipments.id')
				->where('post_id',$id)->where('moduel_id',12)->select(['operation_resources.*','materials.title as "M_title"','equipments.title as "E_title"'])->get();
                $this->passing_data['operation_page']=true;
                }
                return $this->_view('Settings/Irrigation', 'edit');
            } else {
                return abort(404);
            }
        } catch (Exception $ex) {
            return abort(500);
        }
    }

    public function update(Request $req) {
    
        $this->rules['id'] = 'required';
       switch ($req->line_type){
           case 3:
               $this->rules['primary_line'] = 'required';
               break;
           case 2:
               $this->rules['under_primary_line'] = 'required';
               break;
           case 4:
               $this->rules['sub'] = 'required';
               break;

       }
         $validation = $this->validation($this->rules, $req, true);
         if ($validation === true) {
        try {

            $code = Irrigation::orderBy('created_at', 'desc')->first();
            if (!$code) {
                $code= 10;
            } else {
                $line_code=explode(',',$code->code);
                $code_num=count($line_code);
                switch ($code_num){
                    case 1:
                        $code=$line_code[0]+1;
                        break;
                    case 2:
                        $code=$line_code[1]+1;
                        break;
                    case 3:
                        $code=$line_code[2]+1;
                        break;
                    case 4:
                        $code=$line_code[3]+1;
                        break;
                }
            }

            DB::beginTransaction();
            $Item = Irrigation::where('id', $req->id)->first();
            $Item->title = $req->title;
            $Item->line_type = $req->line_type;

            switch ($req->line_type){
                case 3:
                    $Item->code =$req->primary_line.','.$code;
                    break;
                case 2:
                    $Item->code =$req->under_primary_line.','.$code;
                    break;
                case 4:
                    $Item->code =$req->sub.','.$code;
                    break;


            }

            $Item->water_amount = $req->water_amount;
            $Item->water_speed = $req->water_speed;
            $Item->cost = $req->cost;
            $Item->lenght = $req->lenght;
            if(isset($req->signed) ){
                $Item->signed=1;
            }
            else{
                $Item->signed=0;
            }

            $north=$req->north;
            $east=$req->east;
            $degree[]=$req->degree;
            $minute=$req->minute;
            $second=$req->second;
            $point1=$req->point1.'|'.$req->north[0].','.$req->degree[0].','.$req->minute[0].','.$req->second[0].'|'.$req->east[0].','.$req->degree[1].','.$req->minute[1].','.$req->second[1];
            $point2=$req->point2.'|'.$req->north[1].','.$req->degree[2].','.$req->minute[2].','.$req->second[2].'|'.$req->east[1].','.$req->degree[3].','.$req->minute[3].','.$req->second[3];
            $Item->point1 =$point1;
            $Item->point2 =$point2 ;
            if($req->hasFile('signed_file')){
                $file=$req->signed_file;
                $extension=['doc','docx','pdf','rtf','tex','txt'];
                $file_extension=$file->getClientOriginalExtension();
                if(in_array($file_extension,$extension)){
                    $url_image = url('public//images/Uploads/irrigation/') . '/' .  $Item->signed_file ;
                    $this->deleteImage($url_image);
                    $Item->signed_file = $this->uploadFile('signed_file', 'irrigation');

                }
            }
            if ($Item->save()) {
                DB::commit();
                if(isset($req->boxes)) {
                   $boxes = DB::table('box_irrigation')->where('irrigation_id', $Item->id)->delete();

                    $data = [];
                    foreach ($req->boxes as $key => $value) {
                        $data[] = [
                            'box_id' => $value,
                            'irrigation_id' => $Item->id,
                        ];
                    }
                    if (!empty($data)) {
                        // FarmDetails::where('farm_id',$req->id)->delete();
                        BoxIrrugation::insert($data);
                    }


               }
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

    public function addMahbas(request $req){
        $rule=[
            'desc'=>'required',
            'mahbas_point1'=>'required',
        ];
        $validation = $this->validation($rule, $req, true);
        if ($validation === true) {
            try {
                $code = IrrigationMahbas::orderBy('created_at', 'desc')->first();
                if (!$code) {
                    $code= 10;
                } else {
                    $code= $code->code + 1;
                }
                DB::beginTransaction();
                $north=$req->north;
                $east=$req->east;
                $degree[]=$req->degree;
                $minute=$req->minute;
                $second=$req->second;

                if(isset($req->irrigation_id)){
                    $Item=IrrigationMahbas::where('id',$req->irrigation_id)->first();
                    $Item->location=$req->mahbas_point1.'|'.$req->north.','.$req->degree[0].','.$req->minute[0].','.$req->second[0].'|'.$req->east.','.$req->degree[1].','.$req->minute[1].','.$req->second[1];
                    $Item->desc = $req->desc;
                    $Item->save();

                }
            else {
                $Item = new IrrigationMahbas();
                $Item->irrigation_id = $req->id;
                $Item->code = $code;
                $Item->location=$req->mahbas_point1.'|'.$req->north.','.$req->degree[0].','.$req->minute[0].','.$req->second[0].'|'.$req->east.','.$req->degree[1].','.$req->minute[1].','.$req->second[1];
                $Item->desc = $req->desc;
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


    public function editMahbas(Request $req,$id)
    {

            $mahbas = IrrigationMahbas::find($id);
            $location = explode('|', $mahbas->location);
            $point1 = $location[0];
            $location_north = explode(',', $location[1]);
            $location_east = explode(',', $location[2]);
            return response()->json(['mahbas' => $mahbas, 'point1' => $point1, 'location_north' => $location_north, 'location_east' => $location_east]);
    }


    public function dataTable(Request $req) {
        $data=Irrigation::orderBy('created_at','desc');
        if($req->status){
            if($req->status=='all'){
                $data=$data;
            }else {
                $data = $data->where('line_type', $req->status);
            }
        }
        if($req->date_from){
            $data =$data->whereDate('created_at','>=',date('Y-m-d',strtotime($req->date_from)));

        }
        if($req->date_to){
            $data =$data->where('created_at','<=',date('Y-m-d',strtotime($req->date_to)));
        }
        $data =$data->get();

        $table = Irrigation::transformCollection($data);
        return \Datatables::of($table)
            ->addColumn('option', function ($item) use($req) {
                if($this->_checkPermission(9,5)) {
                    $back = $this->_editButn($item, 'setting/irrigation/', ['operation_page' => $req->operation_page]);
                }
                else{
                    $back='';
                }
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

    public function mahbasDatatable(request $req){
        $data =IrrigationMahbas::where('irrigation_id',$req->id)->get();
        $table = IrrigationMahbas::transformCollection($data);
        return \Datatables::of($table)
            ->addColumn('option', function ($item) use($req) {
                $back ='<i class="fas fa-eye view-row" data-target="#addnew" data-toggle="modal" onclick="editMahbas('.$item->id.')" ></i>';
                return $back;
            })
            ->addColumn('created_at', function ($item) {
                $back = date('Y-m-d', strtotime($item->created_at));

                return $back;
            })
            ->rawColumns(['option', 'created_at'])
            ->make(true);
    }

    /////////////////////////
    public function typeStore(Request $req) {
        // $validation=$this->validation($this->rules,$req,true);
        // if($validation===true){
        try {
            DB::beginTransaction();
            $Item = new Material_type();
            $Item->title = $req->title;
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

    public function unitStore(Request $req) {
        // $validation=$this->validation($this->rules,$req,true);
        // if($validation===true){
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
    public function typeDestroy($id){
        try{
            $Item=Material_type::find($id);
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

    public function upload(Request $req){

        $rules = [
            'irrigation_files' => 'file|mimes:pdf',

        ];
        $validation = $this->validation($rules, $req, true);
        if ($validation === true) {
            if ($req->hasfile($req->name)) {
                $file = $req->file('file');
                $file = DB::table('config')->select('value')->where('name', 'irrigation_files')->first();
                if ($file) {
                    $filename = $this->uploadFile($req->name, 'config');
                    DB::table('config')->where('name', $req->name)->update(['value' => $filename]);
                } else {
                    $filename = $this->uploadFile($req->name, 'config');
                    DB::table('config')->insert(['name' => $req->name, 'value' => $filename]);
                }
                $massage = "Successfuly";
                return $this->json('success', $massage, 200);
            }
        }
        else{
            return $this->json('warning', $validation);
        }
    }
    ////////////////////////////////////////
	public function operation_index(Request $req){
        $this->passing_data['arr'] = Irrigation::$del_col;
        if($req->reports){
			$this->passing_data['report']=true;
		}else{
			$this->passing_data['report']=0;
		}
        $file=DB::table('config')->select('value')->where('name', 'irrigation_files')->first();
        if($file){
			$this->passing_data['bath']=url('public/images/Uploads/config').'/'.$file->value;
		}else{
			$this->passing_data['bath']='';
		}
		return $this->_view('Operations/Irrigation', 'index');
    }
    ////////////////////////////////////////
	public function intersectionStore(Request $req){
		try {
			DB::beginTransaction();
			$Item = new Intersection();
			$Item->irrigation_id = $req->irrigation_id;
			$Item->line_type_id = $req->line_type_id;
			$Item->coordinates = $req->coordinates;
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
	public function intersectionDestroy($id){
		try{
            $Item=Intersection::find($id);
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

	public function get_lines($line_id){
      $irrigations=Irrigation::where('line_type',$line_id)->get();
        if($line_id==1){
            $title='كل الخطوط  الرئيسيه';
        }elseif ($line_id==3){
            $title='كل الخطوط تحت الرئيسيه';
        }else{
            $title='كل الخطوط الفرعيه';
        }
      $lines='<option selected disabled>'. $title.'</option>';

      foreach ($irrigations as $irrigation){
         $lines.='<option   value="'.$irrigation->code .'" >' . $irrigation->code . '</option>';
      }
      if(Request()->Ajax()){
          return Response()->json(['lines'=>$lines]);
      }else{
          return $irrigations;
      }


    }

    public function mahbasCoordinate($id){
        $point=DB::table('irrigation_mahbas')->where('id',$id)->first();
        $point= explode('|',$point->location);
            //point coordinate
        $point_north=explode(',', $point[1]);
        $point_east=explode(',', $point[2]);
        return response()->json(['point'=>$point,'point_north'=>$point_north,'point_east'=>$point_east]);

    }
}
