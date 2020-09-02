<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;
use App\Models\Users;
use App\Models\Permissions;
use App\Models\Role;
use App\Models\RolePermission;
use DB;

class UsersController extends AdminController
{
    private $rules=[
	    "username"=>'required|unique:users',
        "email"=>'required|unique:users',
        "password"=>'required',
        "role_id"=>'required',
        'user_type'=>'required'
	];
    public function __construct()
    {
        parent::__construct();
    }
    public function create(Request $req)
    {
        $this->passing_data['Role']=Role::all();
        return $this->_view('Settings/User', 'create');
    }
    public function store(Request $req) {

        $validation = $this->validation($this->rules, $req, true);
        if ($validation === true) {
        try {
            DB::beginTransaction();
            $Item = new Users();
            $Item->username = $req->username;
            $Item->email = $req->email;
            $Item->type_id = $req->user_type;
            $Item->password = bcrypt($req->password);
            $Item->role_id = $req->role_id;
            $Item->hiring_date = $req->hiring_date;
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
    public function edit($id){
        try {
            $Item = Users::find($id);
            $Item = Users::transform($Item);
            if ($Item) {
                $this->passing_data['info'] = $Item;
                $this->passing_data['Role']=Role::all();
                // dd($this->passing_data['Check_Permissions']);
                return $this->_view('Settings/User', 'edit');
            } else {
                return abort(404);
            }
        } catch (Exception $ex) {
            return abort(500);
        }
    }
    public function update(Request $req) {
        $rules=[
            "id"=>'required',
            "username"=>'required',
            "email"=>'required',
            "role_id"=>'required',
        ];
        $validation = $this->validation($rules, $req, true);
        if ($validation === true) {
            $arr_check=[
                'username'=>$req->input('username'),
                'email'=>$req->input('email'),
            ];
            $validation=$this->checkUnique('users',$arr_check,$req->id);
            if($validation!==true){
                return $this->json('warning',$validation);
            }
        try {
            DB::beginTransaction();
            $Item = Users::where('id', $req->id)->first();
            $Item->username = $req->username;
            $Item->email = $req->email;
            if($req->password){
                $Item->password = bcrypt($req->password);
            }
            $Item->role_id = $req->role_id;
            $Item->type_id = $req->user_type;
            $Item->hiring_date = $req->hiring_date;
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
}
