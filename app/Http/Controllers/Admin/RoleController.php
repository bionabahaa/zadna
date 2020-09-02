<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;
use App\Models\Users;
use App\Models\Permissions;
use App\Models\Role;
use App\Models\RolePermission;
use DB;

class RoleController extends AdminController
{
    private $rules=[
	    "code"=>'required',
	    "title"=>'required',
	];
    public function __construct()
    {
        parent::__construct();
    }
    public function index(Request $req)
    {
        $this->passing_data['arr'] = Users::$del_col;
        $this->passing_data['Roles'] = Role::all();
        $this->passing_data['Users'] = Users::join('role','role.id','users.role_id')->select(['users.id','users.username','users.hiring_date','role.title'])->get();
        return $this->_view('Settings/Role', 'index');
    }
    public function create(Request $req)
    {
        $data = Role::orderBy('created_at', 'desc')->first();
		if (!$data) {
			$Code = 1000;
		} else {
			$Code = $data->code + 1;
        }
        // $this->passing_data['roles']=
		$this->passing_data['code'] = $Code;
        $this->passing_data['Moduels']=Role::$moduels_permissions;
//        dd($this->passing_data['Moduels']);
        $this->passing_data['Permissions']=Permissions::get();
        foreach(Role::$moduels_permissions as $value){
            if($value['main']===true){
                $this->passing_data['Main_Moduels'][]=$value;
            }
        }
        // dd($this->passing_data['Main_Moduels']);
        return $this->_view('Settings/Role', 'create');
    }
    public function store(Request $req) {
        // dd($req);
        $validation = $this->validation($this->rules, $req, true);
        if ($validation === true) {
        try {
            $code = Role::orderBy('id', 'desc')->first();
            if (!$code) {
                $code= 1000;
            } else {
                $code= $code->code + 1;
            }
            DB::beginTransaction();
            $Item = new Role();
            $Item->code =$code;
            $Item->title = $req->title;
            if ($Item->save()) {
                if ($req->permission) {
					$data = [];
					foreach ($req->permission as $key => $value) {
                        // $permissions_key=array_keys($req->permission[$key]);
                        // foreach($permissions_key as $permission_value){
                        //     $data[] = [
                        //         'moduel_id' => $key,
                        //         'permission_id' => $permission_value,
                        //         'role_id' => $Item->id,
                        //        ];
                        // }
                        $permissions_key= explode(",", $value);
                        $data[] = [
                            'moduel_id' => $permissions_key[0],
                            'permission_id' => $permissions_key[1],
                            'role_id' => $Item->id,
                        ];
					}
					if (!empty($data)) {
						// FarmDetails::where('farm_id',$req->id)->delete();
						RolePermission::insert($data);
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
    public function edit($id){
        try {
            $Item = Role::find($id);
            if ($Item) {
                $this->passing_data['info'] = $Item;
                $this->passing_data['Moduels']=Role::$moduels_permissions;
                $this->passing_data['Permissions']=Permissions::get();
                foreach(Role::$moduels_permissions as $value){
                    if($value['main']===true){
                        $this->passing_data['Main_Moduels'][]=$value;
                    }
                }
                $this->passing_data['Check_Permissions']=RolePermission::where('role_id',$id)->select('permission_id','moduel_id')->get()->toArray();
                // dd($this->passing_data['Check_Permissions']);
                return $this->_view('Settings/Role', 'edit');
            } else {
                return abort(404);
            }
        } catch (Exception $ex) {
            return abort(500);
        }
    }
    public function update(Request $req) {
//        dd($req);
        $this->rules['id'] = 'required';
        $validation = $this->validation($this->rules, $req, true);
        if ($validation === true) {
        try {
            DB::beginTransaction();
            $Item = Role::where('id', $req->id)->first();
            $Item->title = $req->title;
            if ($Item->save()) {
                if ($req->permission) {
					$data = [];
					foreach ($req->permission as $key => $value) {
//					    dd($req->permission[$key]);
//                        $permissions_key=array_keys($req->permission[$key]);
//                        foreach($permissions_key as $permission_value){
//                            $data[] = [
//                                'moduel_id' => $key,
//                                'permission_id' => $permission_value,
//                                'role_id' => $Item->id,
//                               ];
//                        }
                        $permissions_key= explode(",", $value);
                        $data[] = [
                            'moduel_id' => $permissions_key[0],
                            'permission_id' => $permissions_key[1],
                            'role_id' => $Item->id,
                        ];
					}
					if (!empty($data)) {
						RolePermission::where('role_id',$req->id)->delete();
						RolePermission::insert($data);
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
}
