<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;
use App\Models\Wells;
use App\Models\ModuelDetails;
use App\Models\WellTecSpecification;
use App\Models\ModuelsTest;
use App\Models\WellStatisticsWater;
use App\Models\Farms;
use App\Models\Equipments;
use App\Models\Matriels;
use App\Models\OperationResources;
use DB;
use Excel;

class WellsController extends AdminController
{
    	 private $rules = [
	 	'title' => 'required',
	 	'date_of_excavation' => 'required|date',
        'status'=>'required',
        'point1'=>'required',


	 ];

	public function __construct() {
		parent::__construct();
	}

	public function index(Request $req) {

        $export_data = DB::table('wells')->get();

        
        $this->passing_data['arr'] = Wells::$del_col;
        if($req->reports){
            $this->passing_data['report']=true;
        }else{
            $this->passing_data['report']=0;
        }
        return $this->_view('Settings/Well', 'index');
        



        function excel()
    {

     
     $export_data = DB::table('wells')->get()->toArray();
     $customer_array[] = array('code', 'title','status', 'location', 'date_of_excavation' ,'signed');
     foreach($export_data as $data)
     {
      $customer_array[] = array(
       'code'  => $data->code,
       'title'   => $data->title,
       'location'    => $data->location,
       'date_of_excavation'  => $data->PostalCode,
       'signed'   => $data->signed
      );
     }
     Excel::create('export_data', function($excel) use ($customer_array){
      $excel->setTitle('export_data');
      $excel->sheet('export_data', function($sheet) use ($customer_array){
       $sheet->fromArray($customer_array, null, 'A1', false, false);
      });
     })->download('xlsx');
    }
	}
       



    














































	public function create(Request $req) {
        if($req->reports){
            $this->passing_data['report']=true;
        }else{
            $this->passing_data['report']=0;
        }
		$this->passing_data['Farms']=Farms::all();
		$this->passing_data['Status']=Wells::$type_well;
		return $this->_view('Settings/Well', 'create');
	}

	public function store(Request $req) {
	    $validation = $this->validation($this->rules, $req, true);
		 if ($validation === true) {
            $code = Wells::orderBy('created_at', 'desc')->first();
            if (!$code) {
                $code= 10;
            } else {
                $code= $code->code + 1;
            }
			try {
				DB::beginTransaction();
				$Item = new Wells();
				$Item->code =$code;
				$Item->title = $req->title;
                $location=$req->point1.'|'.$req->north.','.$req->degree[0].','.$req->minute[0].','.$req->second[0].'|'.$req->east.','.$req->degree[1].','.$req->minute[1].','.$req->second[1];
                $Item->location =$location;
				$Item->status = $req->status;
				$Item->date_of_excavation = $req->date_of_excavation;
				if ($req->file('water_quantity_file')) {
					$Item->water_quantity_file = $this->uploadFile('water_quantity_file', 'well');
				}
				if ($req->file('water_analysis_file')) {
					$Item->water_analysis_file = $this->uploadFile('water_analysis_file', 'well');
				}
				if ($Item->save()) {
					if ($req->config) {
						$data = [];
						foreach ($req->config as $key => $value) {
						    if($key=='locations'){
						        $value=$value.','.$req->degree.','.$req->minute.','.$req->second;
                            }

							$data[] = [
								'name' => $key,
								'value' => $value,
								'post_id' => $Item->id,
								'moduel_id'=>8
							   ];
							
						}
						if (!empty($data)) {
							ModuelDetails::insert($data);
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
			$Item = Wells::find($id);
			if ($Item) {
				$result = Wells::transform($Item);
		        $location=explode('|',$result->location);
		        $point1=$location[0];
		        $location_north=explode(',',$location[1]);
                $location_east=explode(',',$location[2]);
                $this->passing_data['point1'] =$point1;
                $this->passing_data['location_north'] = $location_north;
                $this->passing_data['location_east'] = $location_east;
                if($req->reports){
                    $this->passing_data['report']=true;
                }else{
                    $this->passing_data['report']=0;
                }
				$this->passing_data['info'] = $result;
				$this->passing_data['type_well'] = Wells::$type_well;
				$this->passing_data['WellTech_type_Pipes']=WellTecSpecification::$type_Pipes;
				$this->passing_data['WellTech_type_External_pipes_coating']=WellTecSpecification::$type_External_pipes_coating;
				$this->passing_data['WellTech_type_Generator']=WellTecSpecification::$type_Generator;
				$this->passing_data['WellTech_type_Trumpet']=WellTecSpecification::$type_Trumpet;
				$this->passing_data['operation_page']=false;
				if($req->operation_page==1){
					$this->passing_data['operation_page']=true;
					$this->passing_data['Equipments']=Equipments::all();
					$this->passing_data['Matriels']=Matriels::all();
					$this->passing_data['OperationResources']=OperationResources::leftJoin('materials','operation_resources.matrial_id','materials.id')
					->leftJoin('equipments','operation_resources.equipment_id','equipments.id')
					->where('post_id',$id)->where('moduel_id',10)->select(['operation_resources.*','materials.title as "M_title"','equipments.title as "E_title"'])->get();
					// dd($this->passing_data['OperationResources']);
					$this->passing_data['water_quantity']=WellStatisticsWater::where('statistics_type',1)
					->where('well_id',$id)
					->get();
					$this->passing_data['water_analysis']=WellStatisticsWater::where('statistics_type',2)
					->where('well_id',$id)
					->get();
				}
				return $this->_view('Settings/Well', 'edit');
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
				$Item = Wells::where('id', $req->id)->first();

                if($req->hasFile('geological_profile_file')){
                    $file=$req->geological_profile_file;
                    $extension=['ods ','xlr ','xls ','xlsx','doc','docx','pdf','rtf','tex','txt'];
                    $file_extension=$file->getClientOriginalExtension();
                    if(in_array($file_extension,$extension)){
                        $url_image = url('public//images/Uploads/well/') . '/' . $Item->geological_profile_file;
                        $this->deleteImage($url_image);
                        $Item->geological_profile_file = $this->uploadFile('geological_profile_file', 'well');

                    }
                }

                if($req->hasFile('signed_file')){
                    $file=$req->signed_file;
                    $extension=['doc','docx','pdf','rtf','tex','txt'];
                    $file_extension=$file->getClientOriginalExtension();
                    if(in_array($file_extension,$extension)){
                        $url_image = url('public//images/Uploads/well/') . '/' . $Item->signed_file;
                        $this->deleteImage($url_image);
                        $Item->signed_file = $this->uploadFile('signed_file', 'well');

                    }
                }

				$Item->title = $req->title;
				$Item->status = $req->status;
                $location=$req->point1.'|'.$req->north.','.$req->degree[0].','.$req->minute[0].','.$req->second[0].'|'.$req->east.','.$req->degree[1].','.$req->minute[1].','.$req->second[1];
                $Item->location =$location;
                if(isset($req->signed) ){
				    $Item->signed=1;
                }
                else{
                    $Item->signed=0;
                }
				$Item->date_of_excavation = $req->date_of_excavation;
				if ($req->file('water_quantity_file')) {
					$url_image = url('public//images/Uploads/well/') . '/' . $Item->water_quantity_file;
					$this->deleteImage($url_image);
					$Item->water_quantity_file = $this->uploadFile('water_quantity_file', 'well');
				}
				if ($req->file('water_analysis_file')) {
					$url_image = url('public//images/Uploads/well/') . '/' . $Item->water_analysis_file;
					$this->deleteImage($url_image);
					$Item->water_analysis_file = $this->uploadFile('water_analysis_file', 'well');
				}
				if ($Item->save()) {
					if ($req->config) {
						$data = [];
						foreach ($req->config as $key => $value) {
                            if($key=='locations'){
                                $value=$value.','.$req->degree.','.$req->minute.','.$req->second;
                            }
							$data[] = [
								'name' => $key,
								'value' => $value,
								'post_id' => $req->id,
								'moduel_id'=>8
							   ];
						}
						if (!empty($data)) {
							ModuelDetails::where('post_id', $req->id)
							->where('moduel_id',8)
							->delete();
							ModuelDetails::insert($data);
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
		$data=Wells::orderBy('created_at','desc');
		if($req->status){
		    if($req->status=='all'){
		        $data=$data;
            }else {
                $data = $data->where('status', $req->status);
            }
		}
		if($req->date_from){
			$data =$data->whereDate('date_of_excavation','>=',date('Y-m-d',strtotime($req->date_from)));

		}
		if($req->date_to){
			$data =$data->where('date_of_excavation','<=',date('Y-m-d',strtotime($req->date_to)));
		}
		$data =$data->get();
		$table = Wells::transformCollection($data);
		return \Datatables::of($table) 
			->addColumn('option', function ($item) use($req) {
                if($this->_checkPermission(8,5)) {
                    $back = $this->_editButn($item, 'setting/wells', ['operation_page' => $req->operation_page]);
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
	////////////////////////////////////////
    public function upload(Request $req){

        $rules = [
            'signature_wells' => 'file|mimes:pdf',

        ];
        $validation = $this->validation($rules, $req, true);
        if ($validation === true) {
            $file = $req->file($req->name);
            $file = DB::table('config')->select('value')->where('name', $req->name)->first();
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
        else{
            return $this->json('warning', $validation);
        }
    }
	////////////////////////////////////////
	public function testStore(Request $req){
        $rules=[
            'datetime'=>'required',
            'test_num'=>'required',
            'test_duration'=>'required',
            'extension'=>'required'
        ];
        $validation = $this->validation($rules, $req, true);
        if ($validation === true) {

            try {
                DB::beginTransaction();
                $code = ModuelsTest::orderBy('created_at', 'desc')->first();
                if (!$code) {
                    $code = 1000;
                } else {
                    $code = $code->code + 1;
                }
                $Item = new ModuelsTest();
                $Item->code = $code;
                $Item->post_id = $req->well_id;
                $Item->title = $req->title;
                $Item->test_num = $req->test_num;
                $Item->test_duration = $req->test_duration;
                $Item->extension = $req->extension;
                $Item->datetime = $req->datetime;
                $Item->moduel_id = 8;
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
        else {
            return $this->json('warning', $validation);
        }

	}
	public function testDestroy($id){
		try{
            $Item=ModuelsTest::find($id);
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
	////////////////////////////////////////
	public function tecStore(Request $req){
        $rules=[
            'ability'=>'required|numeric',
            'desc'=>'required',
        ];
        $validation = $this->validation($rules, $req, true);
        if ($validation === true) {
            try {
                DB::beginTransaction();
                $code = WellTecSpecification::orderBy('created_at', 'desc')->first();
                if (!$code) {
                    $code = 1000;
                } else {
                    $code = $code->code + 1;
                }
                $Item = new WellTecSpecification();
                $Item->code = $code;
                $Item->well_id = $req->well_id;
                $Item->length = $req->length;
                $Item->type = $req->type;
                $Item->desc = $req->desc;
                $Item->ability = $req->ability;
                $Item->diameter = $req->diameter;
                $Item->tec_type = $req->tec_type;
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
        }else {
            return $this->json('warning', $validation);
        }
	}
	public function tecDestroy($id){
		try{
            $Item=WellTecSpecification::find($id);
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
	////////////////////////////////////////
	public function tecTestStore(Request $req)
    {

        $rules = [
            'title' => 'required',
            'datetime' => 'required',
            'test_duration' => 'required|numeric',
            'extension' => 'required|numeric',
        ];
        $validation = $this->validation($rules, $req, true);
        if ($validation === true) {
            try {
                DB::beginTransaction();
                $code = ModuelsTest::orderBy('created_at', 'desc')->first();
                if (!$code) {
                    $code = 1000;
                } else {
                    $code = $code->code + 1;
                }
                $Item = new ModuelsTest();
                $Item->code = $code;
                $Item->post_id = $req->well_tec_specifications_id;
                $Item->title = $req->title;
                $Item->test_num = $req->test_num;
                $Item->test_duration = $req->test_duration;
                $Item->extension = $req->extension;
                $Item->datetime = $req->datetime;
                $Item->moduel_id = 12;
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
        {
            return $this->json('warning', $validation);
        }
    }
	public function tecTestDestroy($id){
		try{
			$Item=ModuelsTest::find($id);
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
	public function test_dataTable(Request $req){
		$data = ModuelsTest::where('post_id',$req->id)->where('moduel_id',12)->get();
		$table = WellTecSpecification::transformCollection($data,'TecSpecifications');
		return \Datatables::of($table)
			->addColumn('option', function ($item) {
				//$back = $this->_editButn($item, 'setting/wells/');
				 $back = $this->_deleteBtn($item);

				return $back;
			})
			->addColumn('created_at', function ($item) {
				$back = date('Y-m-d', strtotime($item->created_at));
				return $back;
			})
			->rawColumns(['option', 'created_at'])
			->make(true);
	}
	////////////////////////////////////////
	public function operation_index(Request $req){
        $this->passing_data['arr'] = Wells::$del_col;
		if($req->reports){
			$this->passing_data['report']=true;
		}else{
			$this->passing_data['report']=0;
		}
//		 dd($this->passing_data['report']);
		$file=DB::table('config')->select('value')->where('name', 'signature_wells')->first();
		if($file){
			$this->passing_data['bath']=url('public/images/Uploads/config').'/'.$file->value;
		}else{
			$this->passing_data['bath']='';
		}
		return $this->_view('Operations/Well', 'index');
	}
	////////////////////////////////////////
	public function statisticsWaterStore(Request $req){
        $rules = [
            'file' => 'file|mimes:pdf,doc,docx,pptx',
        ];
        $validation = $this->validation($rules, $req, true);
        if ($validation === true) {
            try {
                DB::beginTransaction();
                $Item = new WellStatisticsWater();
                $Item->well_id = $req->well_id;
                $Item->datetime = $req->date;
                $Item->qyt = $req->qyt;
                $Item->statistics_type = $req->statistics_type;
                if ($req->file('file')) {
                    $Item->file = $this->uploadFile('file', 'well');
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
	public function statisticsWaterDestroy($id){
		try{
            $Item=WellStatisticsWater::find($id);
            if($Item->delete()){
				$url_image = url('public//images/Uploads/well/') . '/' . $Item->file;
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

	public function generator_mainentance($id){
	    $mainentance=ModuelsTest::where('post_id',$id)->get();
	    $html='
	         <table class="table table-striped">
                  <thead>
                    <tr>
                      <th scope="col">وصف الصيانه</th>
                      <th scope="col">تاريخ الصيانه</th>
                      <th scope="col">التكرار</th>
                      <th scope="col">لمده</th>
                    </tr>
                  </thead>
                  <tbody>
	    ';

	    foreach ($mainentance as $mainentance){
	        $test_duration='';
	        switch ($mainentance->test_duration){
                case 1:
                   $test_duration= 'يوم';
                  break;
                case 2:
                    $test_duration= 'اسبوع';
                    break;
                case 3:
                    $test_duration= 'شهر';
                    break;
                default:
                    $test_duration= 'سنه';

            }
	        $html.='
                <tr>
                        <td> '.$mainentance->title.' </td>
                        <td> '.date('Y/m/d',strtotime($mainentance->datetime)).' </td>
                        <td> '. $mainentance->test_num .'  '. $test_duration.' </td>
                        <td> '.$mainentance->extension. '  سنه '. '</td>
	            </tr> 
	        ';
        }
        $html.='</tbody>
               </table> ';


	    return response()->json(['html'=>$html]);


    }
}
