<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;
use App\Models\Crops;
use DB;
use Session;
use View;

use Redirect;









class CropsController extends AdminController
{
    public $rules=[
        'title'=>'required',
        //'type'=>'required',
        'date'=>'required',
        "qyt.*" => 'required|integer|min:1',
        'notes'=>'required',
        'type_id'=>'required|numeric|min:0',
    ];


    



    public function __construct(){
        parent::__construct();
    }




    public function index(){
       
         

         global  $crops;
        
         $crops=Crops::all();
  
         
       
         $this->passing_data['arr'] = Crops::$del_col;
         $this->passing_data['crops'] = Crops::where('crop_id',null)->get();
      
         return $this->_view('Settings/Crops','index');

 }
    public function create(){

       
        return $this->_view('Settings/Crops','create');

    }
    public function store(Request $req){

        $validation = $this->validation($this->rules, $req, true);
        $code = Crops::orderBy('id', 'desc')->first();
        if (!$code) {
            $code= 10;
        } else {
            $code= $code->code + 1;
        }
        if ($validation === true) {
           
            try {
                DB::beginTransaction();
                $Item = new Crops();
             
                $Item->code = $code;
                $Item->title = $req->title;
                $Item->date = $req->date;
                $Item->notes = $req->notes;
                $Item->type_id = $req->type_id;
                $Item->description= $req->description;
                $Item->save();


                if ($Item->save()) {
                    
                    DB::commit();
                    Session::flash('message', "تم التسجيل بنجاح");
                    
                    return redirect('setting/crops/');
                    Session::flash('message', "تم التسجيل بنجاح");

                    

                } else {
                    $massage = 'لم تتم عمليه الادخال';

                    return $this->json('warning', $massage);
                }

            } catch (Exception $ex) {
                DB::rollBack();
            }

        } else {
            //return $this->json('warning', $validation);
            return redirect()->back()->with('error' ,'error message');
        // return Redirect::back();
        // Session::flash('message', "Special message goes here");
        }
    }
     


    































    public function edit($id){
        try {

            $Item = Crops::find($id);
            
            if ($Item) {
			$result = Crops::transform($Item);
                $this->passing_data['info'] = $result;
               // return $this->_view('Settings/Crops','edit');

                
               return $this->_view('Settings/Crops','edit')->with(compact('Item'));
               
			} else {
				return abort(404);
			}
		} catch (Exception $ex) {
			return abort(500);
		}
    }
    public function update($id){

        $item = Crops::find($id);
        
        $item->title = request('title');
        $item->date = request('date');
        $item->notes = request('notes');
        $item->type_id = request('type_id');
        $item->description = request('description');
        $item->save();

        if ($item->save()) {
            DB::commit();
            Session::flash('message', "تم التسجيل بنجاح");
            
            return redirect('setting/crops/');
           

            

        } else {
            $massage = 'لم تتم عمليه الادخال';

            return $this->json('warning', $massage);
        }
  
      
                      




    }



    public function dataTable(Request $req){


     $data=Crops::where('crop_id','!=',null);
        if($req->status){
            $data=Crops::where('crop_id',$req->status);
        }
        if($req->date_from){
//            $data=Crops::whereNull('crop_id');
            $data =$data->whereDate('created_at','>=',date('Y-m-d',strtotime($req->date_from)));
        }
        if($req->date_to){
//            $data=Crops::whereNull('crop_id');
            $data =$data->where('created_at','<=',date('Y-m-d',strtotime($req->date_to)));
        }
        $data =$data->get();
		$table = Crops::transformCollection($data);
		return \Datatables::of($table)
			->addColumn('option', function ($item) {
                if($this->_checkPermission(3,5)){
                    $back = $this->_editButn($item, 'setting/crops/');
                }else{
                    $back = '';
                }

				return $back;
			})
			->addColumn('created_at', function ($item) {
				$back = date('Y-m-d', strtotime($item->created_at));
				return $back;
			})->addColumn('code', function ($item) {
                $back = '<p title="'.$item->title.'">'.$item->code.'</p>';
                return $back;
            })
			->rawColumns(['option', 'created_at','code'])
			->make(true);
    }





    public function destroy($id)
    {
         $Crops = Crops::find($id);
         
         $Crops->delete();
         return back();
        }
}
