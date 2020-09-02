<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Seasons;
use DB;
use Carbon\Carbon;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;
use phpDocumentor\Reflection\Types\Compound;

class SeasonController extends AdminController {

    private  $rules=[
        'title'=>'required',
        'season_start'=>'required',
        'season_end'=>'required',
           ];

    public function __construct() {
        parent::__construct();
    }

    public function index(Request $req) {
            return $this->_view('Seasons', 'season');
    }

    public function getview(Request $req,$name){
        $this->passing_data['view_name']=$name;
        if($name=='current_season'){
            $start_date=$req->start_date;
            $end_date=$req->end_date;
            if($start_date!='' && $end_date!=''){
                $reports=Seasons::CounterReports($start_date,$end_date);
            }elseif($start_date!='' && $end_date==''){
                $reports=Seasons::CounterReports($start_date,'');
            }elseif($start_date=='' && $end_date!=''){
                $reports=Seasons::CounterReports('',$end_date);
            }elseif($start_date=='' && $end_date==''){
                $reports=Seasons::CounterReports();
            }
            // dd($reports);
            $this->passing_data['reports']=$reports;
        }
        return $this->_view('Seasons', $name);
    }

    public function store(Request $req) {
        $validation = $this->validation($this->rules, $req, true);
        if($validation===true) {
            try {
                $code = Seasons::orderBy('created_at', 'desc')->first();
                if (!$code) {
                    $code = 1000;
                } else {
                    $code = $code->code + 1;
                }
                DB::beginTransaction();
                $Item = new Seasons();
                $Item->code = $code;
                $Item->title = $req->title;
                $Item->season_start = $req->season_start;
                $Item->season_end = $req->season_end;

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
    public function edit($id)
    {
        try {
            $season = Seasons::find($id);
            if ($season) {
                $this->passing_data['season']=$season;
                return $this->_view('Seasons', 'edit_next_season');
            } else {
                return abort(404);
            }
        } catch (Exception $ex) {
            return abort(500);
        }
    }

    public function update(Request $req) {
//        $this->rules['id'] = $req->id;
        $validation = $this->validation($this->rules, $req, true);
        if($validation===true) {
        try {
            DB::beginTransaction();
            $Item = Seasons::where('id', $req->id)->first();

            $Item->title =$req->title;
            $Item->season_start = $req->season_start;
            $Item->season_end = $req->season_end;

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

    public function dataTable(Request $req,$view_name=null)
    {
            if($view_name=='next_season') {
                $data = Seasons::where('id','!=',0);
                if($req->date_from){
                    $data =$data->whereDate('season_start','>=',date('Y-m-d',strtotime($req->date_from)));
                }
                if($req->date_to){
                    $data =$data->where('season_end','<=',date('Y-m-d',strtotime($req->date_to)));
                }
                $data =$data->get();

            }
            else if($view_name=='previous-season'){
                $date=Carbon::today();
                $data=Seasons::where('season_end','<',$date);
                if($req->date_from){
                    $data =$data->whereDate('season_start','>=',date('Y-m-d',strtotime($req->date_from)));
                }
                if($req->date_to){
                    $data =$data->where('season_end','<=',date('Y-m-d',strtotime($req->date_to)));
                }
                $data =$data->get();


            }
        $table = Seasons::transformCollection($data);
            return \Datatables::of($table)
                ->addColumn('option', function ($item) {
                    if($this->_checkPermission(38,4)) {
                        $back = $this->_editButn($item, 'setting/seasons/');
                    }else{
                        $back='';
                    }
                    return $back;
                })
                ->addColumn('created_at', function ($item) {
                    $back = date('Y-m-d', strtotime($item->created_at));
                    return $back;
                })
                ->rawColumns(['option', 'created_at'])
                ->make(true);


    }



    public function import(Request $req){
return($req->all());
        if( ($handle=fopen($_FILES['fileexcel']['tmp_name'],'r')) !==false ){
            fgetcsv($handle);
            while( ($data=fgetcsv($handle,'1000',',')) !==false ){
                echo $data[0];
            }
        }
    }
}
