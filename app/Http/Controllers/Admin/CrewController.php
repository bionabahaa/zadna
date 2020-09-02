<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\AdminController;
use App\Models\Boxes;

use App\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Crew;
use App\Models\Role;
use App\Models\Users;
use App\Models\UserNote;
use DB;

class CrewController extends AdminController {
 public  static $nationality=[1=>'مصرى',2=>'سعودى',3=>'ايطالى',4=>'سورى'];
    public function __construct() {
        parent::__construct();
    }


    private $rules=[
        "username"=>'required',
        "email"=>'required|unique:users|email',
        "password"=>'required',
        "role"=>'required',
        'gender'=>'required',
        'nationality'=>'required',
        'national_id'=>'required',
        'cost_by_day'=>'required|numeric',
       'cost_by_month'=>'required|numeric',
        'hire_date'=>'required|date',
    ];

    private $rulesEdit=[
        "username"=>'required',
        "email"=>'required|email',
        "role"=>'required',
        'gender'=>'required',
        'nationality'=>'required',
        'national_id'=>'required',
        'cost_by_day'=>'required|numeric',
//        'cost_by_month'=>'required|numeric',
        'hire_date'=>'required|date',
    ];
    private $rules_note=[
        "note"=>'required',
//        "job"=>'required',
//        "process"=>'required',
        'date'=>'required'

    ];

    public function index(Request $req) {
        return $this->_view('crew', 'crew');
    }

    public function getview($crew_type){
        $this->passing_data['arr'] = Crew::$del_col;
        $roles=Role::all();
        $users=Crew::all();
      
        $boxes=Boxes::all();
        $this->passing_data['roles'] = $roles;
        $this->passing_data['crews'] = $users;
        $this->passing_data['boxes'] = $boxes;
         $this->passing_data['nationality'] =self::$nationality;
        // print_r( $bo);
        // exit;

        return $this->_view('crew', $crew_type);
    }


    public function store(Request $req) {

        $validation = $this->validation($this->rules, $req, true);
        if ($validation === true) {

            try {
                DB::beginTransaction();
                $user = new Users();
                $user->role_id = $req->role;
                $user->type_id = 1;
                $user->username = $req->username;
                $user->email = $req->email;
                $user->password = bcrypt($req->password);
                $user->hiring_date = $req->hire_date;
                $user->save();

                $Item = new Crew();

                if ($req->has('temporary_user')) {
                    $user->type_id = 2;
                    $Item->phone = $req->phone;
                    $Item->process = $req->process;
                    $Item->day_work_num = $req->day_work_num;
                    $Item->total_cost = $req->total_cost;
                    $boxes = $req->boxes;
                    if ($boxes) {
                        foreach ($boxes as $box) {
                            DB::table('user_box')->insert(['user_id' => $user->id, 'box_id' => $box]);
                        }
                    }
                }


                $Item->user_id = $user->id;
                $Item->gender = $req->gender;
                $Item->nationality = $req->nationality;
                $Item->national_id = $req->national_id;
                $Item->cost_by_day = $req->cost_by_day;
                $Item->cost_by_month = $req->cost_by_month;
                $Item->birthdate = $req->birthdate;
                $Item->save();
                if (!empty($req->responsible_for)) {
                    DB::table('crew')->whereIn('user_id', $req->responsible_for)->update(['crew_id' => $Item->id]);
                }

                if ($user->save() && $Item->save()) {

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
    public function edit($id) {
        try {
            $Item = Users::find($id);
            if ($Item) {
                $this->passing_data['nationality'] =self::$nationality;
                $result = Users::transform($Item);
                $this->passing_data['user'] = $result;
                $this->passing_data['crews'] = Crew::all();
                $crew=$Item->crew;
                $this->passing_data['crew'] = $crew;
                $this->passing_data['tasks'] = $Item->tasks;
                $this->passing_data['roles'] =Role::all();
                $selected=[];
                if(!empty($Item->crew)) {
                    $selected_user = Crew::where('crew_id', $Item->crew->id)->select('user_id')->get();
                    foreach ($selected_user as $value){
                        $selected[]=$value->user_id;
                    }
                }


                $this->passing_data['selected_user'] = $selected;

                return $this->_view('crew', 'permanent_crew_edit');
            } else {
                return abort(404);
            }
        } catch (Exception $ex) {
            return abort(500);
        }
    }

    public function update(Request $req,$id) {

        $validation = $this->validation($this->rulesEdit, $req, true);
        if ($validation === true) {
            try {
                DB::beginTransaction();
                $user = Users::where('id', $id)->first();
                $user->role_id = $req->role;
                $user->type_id = 1;
                $user->username = $req->username;
                $user->email = $req->email;
                if ($req->password) {
                    $user->password = bcrypt($req->password);
                }

                $user->hiring_date = $req->hire_date;
                $user->save();

                $Item = Crew::where('user_id', $id)->first();
                if($Item){
                    $Item=$Item;
                }else{
                    $Item=new Crew();
                }

                    if ($req->has('temporary_user')) {
                        dd('herh me');
                        $user->type_id = 2;
                        $Item->phone = $req->phone;
                        $Item->process = $req->process;
                        $Item->day_work_num = $req->day_work_num;
                        $Item->total_cost = $req->total_cost;
                        $boxes = $req->boxes;
                        if ($boxes) {
                            DB::table('user_box')->where('user_id', $id)->delete();
                            foreach ($boxes as $box) {
                                DB::table('user_box')->insert(['user_id' => $user->id, 'box_id' => $box]);

                            }
                        }
                    }
                    $Item->user_id = $user->id;
                    $Item->gender = $req->gender;
                    $Item->note = $req->note;
                    $Item->nationality = $req->nationality;
                    $Item->national_id = $req->national_id;
                    $Item->cost_by_day = $req->cost_by_day;
                    $Item->cost_by_month = $req->cost_by_month;
                    $Item->birthdate = $req->birthdate;
                    $Item->save();
                    if (!empty($req->responsible_for)) {
                        DB::table('crew')->where('crew_id', $Item->id)->update(['crew_id' => null]);
                        DB::table('crew')->whereIn('user_id', $req->responsible_for)->update(['crew_id' => $Item->id]);
                    } else {
                        DB::table('crew')->where('crew_id', $Item->id)->update(['crew_id' => null]);

                    }

                if ($user->save() && $Item->save()) {

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

    public function addTemoraryUser(Request $req){
        $rules=[
            "username"=>'required',
            "email"=>'required|unique:users|email',
            "password"=>'required',
            "role"=>'required',
            'process'=>'required',
            'gender'=>'required',
            'nationality'=>'required',
            'national_id'=>'required|numeric',
            'cost_by_day'=>'required|numeric',
            'day_work_num'=>'required|numeric',
            'hire_date'=>'required|date',
        ];

        $validation = $this->validation($rules, $req, true);
        if ($validation === true) {

            try {
                DB::beginTransaction();
                $user = new Users();
                $user->role_id = $req->role;
                $user->type_id = 2;
                $user->username = $req->username;
                $user->email = $req->email;
                $user->password = bcrypt($req->password);
                $user->hiring_date = $req->hire_date;
                $user->save();

                $Item = new Crew();
                $Item->phone = $req->phone;
                $Item->process = $req->process;
                $Item->day_work_num = $req->day_work_num;
                $Item->cost_by_day = $req->cost_by_day;
                $Item->total_cost =$req->day_work_num*$req->cost_by_day ;
//                    $boxes = $req->boxes;
//                    if ($boxes) {
//                        foreach ($boxes as $box) {
//                            DB::table('user_box')->insert(['user_id' => $user->id, 'box_id' => $box]);
//                        }
//                    }
                $Item->user_id = $user->id;
                $Item->gender = $req->gender;
                $Item->nationality = $req->nationality;
                $Item->national_id = $req->national_id;
                $Item->birthdate = $req->birthdate;
                $Item->save();
                if (!empty($req->responsible_for)) {
                    DB::table('crew')->whereIn('user_id', $req->responsible_for)->update(['crew_id' => $Item->id]);
                }

                if ($user->save() && $Item->save()) {

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


public function updateTemporaryUser(request $req){
    $rules=[
        "username"=>'required',
        "email"=>'required|email',
        "role"=>'required',
        'process'=>'required',
        'gender'=>'required',
        'nationality'=>'required',
        'national_id'=>'required',
        'cost_by_day'=>'required|numeric',
        'day_work_num'=>'required|numeric',
        'hire_date'=>'required|date',
    ];

    $validation = $this->validation($rules, $req, true);
    if ($validation === true) {
        try {
            DB::beginTransaction();
            $user = Users::where('id', $req->id)->first();
            $user->role_id = $req->role;
            $user->username = $req->username;
            $user->email = $req->email;
            if ($req->password) {
                $user->password = bcrypt($req->password);
            }
            $user->hiring_date = $req->hire_date;
            $user->save();

            $Item = Crew::where('user_id', $req->id)->first();
            if($Item){
                $Item=$Item;
            }else{
                $Item=new Crew();
            }
                $Item->phone = $req->phone;
                $Item->process = $req->process;
               $Item->cost_by_day = $req->cost_by_day;
                $Item->day_work_num = $req->day_work_num;
                $Item->total_cost = $req->day_work_num * $req->cost_by_day;
//                $boxes = $req->boxes;
//                if ($boxes) {
//                    DB::table('user_box')->where('user_id', $req->id)->delete();
//                    foreach ($boxes as $box) {
//                        DB::table('user_box')->insert(['user_id' => $user->id, 'box_id' => $box]);
//
//                    }
//                }
//                else{
//                    DB::table('user_box')->where('user_id', $req->id)->delete();
//                }

            $Item->user_id = $user->id;
            $Item->gender = $req->gender;
            $Item->note = $req->note;
            $Item->nationality = $req->nationality;
            $Item->national_id = $req->national_id;
            $Item->birthdate = $req->birthdate;
            $Item->save();
            if (!empty($req->responsible_for)) {
                DB::table('crew')->where('crew_id', $Item->id)->update(['crew_id' => null]);
                DB::table('crew')->whereIn('user_id', $req->responsible_for)->update(['crew_id' => $Item->id]);
            } else {
                DB::table('crew')->where('crew_id', $Item->id)->update(['crew_id' => null]);

            }

            if ($user->save() && $Item->save()) {

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



    public function dataTable(Request $req) {
        $data=Users::where('type_id',1);
        if($req->status){
            switch ($req->status){
                case 'all':
                    $data=$data;
                    break;
                default:
                    $data=$data->where('role_id',$req->status);
            }
        }
        $data =$data->get();
        $table = Users::transformCollection($data);

        return \Datatables::of($table)
            ->addColumn('option', function ($item) {
                if($this->_checkPermission(26,4)) {
                    $back = $this->_editButn($item, 'setting/crews');
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


function edit_temporary_user($id){
    $user=Users::find($id);
    $this->passing_data['tasks'] = $user->tasks;
    $this->passing_data['nationality'] =self::$nationality;
    $this->passing_data['user'] =$user;
    $this->passing_data['crews'] = Crew::all();
    $this->passing_data['boxes'] = Boxes::all();
    $this->passing_data['user_box'] = $user->box;
    $this->passing_data['crew'] = $user->crew;

    if(!empty($user->notes)) {
        $this->passing_data['user_notes'] = $user->notes;
    }
    $selected_boxes=[];
    foreach ($user->box as $box_id){
        $selected_boxes[]=$box_id->id;
    }
    $this->passing_data['selected_boxes']=$selected_boxes;
    $this->passing_data['roles']=Role::all();
    $this->passing_data['user_role']=$user->role;
    $selected=[];

        if(!empty($user->crew)) {
        $selected_user = Crew::where('crew_id', $user->crew->id)->select('user_id')->get();
        foreach ($selected_user as $value){
            $selected[]=$value->user_id;
        }
    }

//$user_boxes=[];
//
//    if(!empty($user->box)) {
//
//        foreach ($user->box as $user_box){
//            $user_boxes=$user_box->id;
//        }
//
//    }


    $this->passing_data['selected_user'] = $selected;
//    $this->passing_data['$user_boxes'] = $user_boxes;
    $this->passing_data['open_model'] = true;

  //  return view('pages/backEnd/crew/temporary_crew',['user'=>$user,'open_model'=>true,'nationality'=>$nationality]);
    return $this->_view('crew', 'temporary_crew_edit');



}

//datatable form laod   user-note
    public function dataTable_Usernote($id=null) {
            //datatable for  user notes

            $data = UserNote::where('user_id',$id)->get();
            $table = UserNote::transformCollection($data);
            return \Datatables::of($table)
                ->addColumn('option', function ($item) {
                    $back = '<i class="fa fa-eye" data-target="#addNotesModal" data-toggle="modal" onclick="editNote('.$item->id.')"></i>';
                    return $back;
                })
                ->addColumn('created_at', function ($item) {
                    $back = date('Y-m-d', strtotime($item->created_at));

                    return $back;
                })
                ->rawColumns(['option', 'created_at'])
                ->make(true);

    }



//dataTable for temporary user
    public function dataTableTemporery(Request $req) {
        $data=Users::where('type_id',2);
        if($req->status){
            switch ($req->status){
                case 'all':
                    $data=$data;
                    break;
                default:
                    $data=$data->where('role_id',$req->status);
            }
        }
        if($req->date_from){
            $data =$data->whereDate('hiring_date','>=',date('Y-m-d',strtotime($req->date_from)));
        }
        if($req->date_to){
            $data =$data->where('hiring_date','<=',date('Y-m-d',strtotime($req->date_to)));
        }
        $data =$data->get();
        $table = Users::transformCollection($data);

        return \Datatables::of($table)
            ->addColumn('option', function ($item) {
                if($this->_checkPermission(25,4)) {
                    $back = $this->_editButn($item, '/setting/temporary_user');
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
    public function block(Request $req){

        $user=Users::where('id',$req->user_id)->first();

       if($user->blocked==0) {
           Users::where('id', $req->user_id)->update(['blocked' => 1]);
           $user = Users::where('id', $req->user_id)->pluck('username');
           $title='هل انت متاكد من حذف';
           $text='عند الحذف لا يظهر المستخدم على السيستم';
           $success='تم الحذف بنجاح';
           $cancle="حذف";
       }
       else{
            Users::where('id', $req->user_id)->update(['blocked' => 0]);
            $user = Users::where('id', $req->user_id)->pluck('username');
           $title='هل انت متاكد من استرجاع ';
           $text='عند الاسترجاع  يظهر المستخدم على السيستم';
           $success='تم الاسترجاع بنجاح';
           $cancle="استرجاع";
        }
       return response()->json(['username'=>$user,'title'=>$title,'text'=>$text,'success'=>$success,'cancle'=>$cancle]);

    }

    public function add_note(Request $req){
        $validation = $this->validation($this->rules_note, $req, true);
        if ($validation === true) {
            try {

                $code = UserNote::orderBy('created_at', 'desc')->first();
                if (!$code) {
                    $code = 1000;
                } else {
                    $code = $code->code + 1;
                }

                DB::beginTransaction();
                if($req->id){
                    $user=UserNote::where('id',$req->id)->first();
                }
                else {
                    $user = new UserNote();
                    $user->user_id = $req->user_id;
                    $user->code = $code;
                    $user->added_from =auth()->user()->username;
                }
                $user->note = $req->note;
                $user->job = $req->job;
                $user->process = $req->process;
                $user->date = $req->date;
                $user->save();
                if ($user->save()) {

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


    public function editNote($id){
       $userNote=UserNote::where('id',$id)->first();
       return response()->json(['userNote'=>$userNote]);
    }



}

