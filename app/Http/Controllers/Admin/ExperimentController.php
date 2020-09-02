<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Boxes;
use App\Models\Users;
use App\Models\Experiments;
use App\Models\userExperiment;
use App\Models\experimentExecuteStep;
use App\Models\Matriels;
use App\Models\Equipments;
use App\Models\OperationResources;
use DB;

class ExperimentController extends AdminController
{

    private  $rules=[
        'name'=>'required',
        'experiment_type'=>'required',
        'create_date'=>'required',
        'execution_appointment'=>'required',
//        'success_percent'=>'required',
        'box'=>'required',
        'palms'=>'required',
        'users'=>'required',
        'execution_date'=>'required',
        'alert_before_execution'=>'required',
//        'alert_measure'=>'required',
//        'experiment_reason'=>'required',
//        'description'=>'required',
    ];

    public function __construct() {
        parent::__construct();
    }


    public function index(Request $req)
    {
        $this->passing_data['arr'] = Experiments::$del_col;
        return $this->_view('experiments', 'experiments');
    }


    public function getview($experiment_view){
           $this->passing_data['boxes']=Boxes::all();
           $this->passing_data['users']=Users::all();
            return $this->_view('experiments', $experiment_view);


    }
    public function store(Request $req)
    {
        
        $validation = $this->validation($this->rules, $req, true);

        if($validation===true) {
            try {
                $code = Experiments::orderBy('created_at', 'desc')->first();
                if (!$code) {
                    $code = 1000;
                } else {
                    $code = $code->code + 1;
                }
                DB::beginTransaction();
                $Item = new Experiments();
                $Item->box_id =strip_tags($req->box);
                $Item->code =$code;
                $Item->name =strip_tags($req->name);
                $Item->experiment_type=strip_tags($req->experiment_type);
                $Item->create_date = $req->create_date;
                $Item->execution_appointment = $req->execution_appointment;
                $Item->success_percent =strip_tags( $req->success_percent);
                if(isset($req->palms)) {
                    $Item->palms = implode(',', $req->palms);
                }
                $Item->execution_date=strip_tags( $req->execution_date)	;
                $Item->alert_before_execution = $req->alert_before_execution;
                if($req->alert_measure) {
                    $Item->alert_measure = $req->alert_measure;
                }
                $Item->experiment_reason =strip_tags($req->experiment_reason);
                $Item->description =strip_tags( $req->description);



                if ($Item->save()) {
                    foreach($req->users as $user){
                        DB::table('user_experiments')->insert(['experiment_id'=>$Item->id,'user_id'=>$user]);
                        parent::addTask($user,8,'Disease/diseases/'.$Item->id.'/edit');
                    }
                    DB::commit();
                    $this->experiment_id=$Item->id;
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

    public function edit(Request $req, $id) {
        $this->passing_data['OperationResources']=OperationResources::leftJoin('materials','operation_resources.matrial_id','materials.id')
            ->leftJoin('equipments','operation_resources.equipment_id','equipments.id')
            ->where('post_id',$id)->where('moduel_id',4)->select(['operation_resources.*','materials.title as "M_title"','equipments.title as "E_title"'])->get();

        $this->passing_data['boxes']=Boxes::all();
        $this->passing_data['users']=Users::all();
        $experiment=Experiments::where('id',$id)->first();
        $this->passing_data['info']=$experiment;
        $selected_user=[];
        foreach ($experiment->users as $user){
            $selected_user[]=$user->user_id;
        }
        $this->passing_data['selected_user']=$selected_user;
        $this->passing_data['palms']=explode(',', $experiment->palms);

        $this->passing_data['Equipments']=Equipments::all();
        $this->passing_data['Matriels']=Matriels::all();
        $this->passing_data['OperationResources']=OperationResources::leftJoin('materials','operation_resources.matrial_id','materials.id')
            ->leftJoin('equipments','operation_resources.equipment_id','equipments.id')
            ->where('post_id',$id)->where('moduel_id',13)->select(['operation_resources.*','materials.title as "M_title"','equipments.title as "E_title"'])->get();

        return $this->_view('experiments', 'add_experiment');

    }


    public function update(Request $req,$id)
    {

        $validation = $this->validation($this->rules, $req, true);
        if($validation===true) {
            try {

                DB::beginTransaction();
                $Item = Experiments::where('id',$id)->first();
                $Item->box_id =strip_tags( $req->box);
                $Item->name =strip_tags( $req->name);
                $Item->experiment_type=strip_tags( $req->experiment_type);
                $Item->create_date = $req->create_date;
                $Item->execution_appointment = $req->execution_appointment;
                $Item->success_percent =strip_tags( $req->success_percent);
                if(isset($req->palms)) {
                    $Item->palms = implode(',', $req->palms);
                }
                $Item->execution_date=strip_tags( $req->execution_date)	;
                $Item->alert_before_execution = $req->alert_before_execution;
                if($req->alert_measure) {
                    $Item->alert_measure = $req->alert_measure;
                }
                $Item->experiment_reason =strip_tags($req->experiment_reason);
                $Item->description =strip_tags( $req->description);
                if ($Item->save()) {
                    DB::table('user_experiments')->where('experiment_id',$id)->delete();
                    if(isset($req->users)) {
                        foreach ($req->users as $user) {
                            DB::table('user_experiments')->insert(['experiment_id' => $Item->id, 'user_id' => $user]);
                        }
                    }
                    DB::commit();
                    $this->experiment_id=$Item->id;
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

    public function dataTable(Request $req,$name=null,$id=null)
    {
        if($name=='experiment_step'){
            $data = experimentExecuteStep::where('experiment_id',$id)->get();
            $table = experimentExecuteStep::transformCollection($data);

            return \Datatables::of($table)
                ->addColumn('option', function ($item) {
                    if($this->_checkPermission(31,7)) {
                        $back = '<i class="fas fa-eye view-row" data-target="#addStepsModal" onclick="experimentStep(' . $item->id . ')" data-id="' . $item->id . '" data-toggle="modal"></i>';
                    }else{
                        $back='';
                    }
                    return $back;
                })

                ->rawColumns(['option'])
                ->make(true);
        }

        elseif ($name=='experiment') {
            $data = Experiments::orderBy('created_at','desc');
            if($req->status) {
                switch ($req->status) {
                    case 'all':
                        $data = $data;
                        break;
                    default;
                    $data=$data->where('experiment_type',$req->status);
                }
            }
            $data=$data->get();
            $table = Experiments::transformCollection($data);

            return \Datatables::of($table)
                ->addColumn('option', function ($item) {
                    if($this->_checkPermission(31,4)) {
                        $back = $this->_editButn($item, 'Experiments/experiments/');
                    }else{
                        $back='';
                    }
                    return $back;
                })
                ->rawColumns(['option'])
                ->make(true);
        }
    }



    public function add_execution_step(Request $req){
        $rule_step=[
            'description_step'=>'required',
            'recommendation'=>'required',
            'date'=>'required',
        ];
        $validation = $this->validation($rule_step, $req, true);
        if($validation===true) {
            try {

                $code = experimentExecuteStep::orderBy('created_at', 'desc')->first();
                if (!$code) {
                    $code = 1000;
                } else {
                    $code = $code->code + 1;
                }
                DB::beginTransaction();

                if(isset( $req->step_id)){
                    $Item =experimentExecuteStep::where('id', $req->step_id)->first();
                }
               else{
                   $Item = new experimentExecuteStep();
                   $Item->code =$code;
                   $Item->experiment_id =$req->experiment_id;
               }


                $Item->description =strip_tags( $req->description_step);
                $Item->recommendation=strip_tags( $req->recommendation);
                $Item->date = $req->date;
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

    public function getExperimentData($id){
        $experiment_step=experimentExecuteStep::where('id',$id)->first();
        return response()->json(['experiment_step'=>$experiment_step]);
    }
}
