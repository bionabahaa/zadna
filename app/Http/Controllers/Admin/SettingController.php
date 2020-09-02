<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;
use App\Models\Configs;
use DB;

class SettingController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index(){
        $config=Configs::where('sys_type','admin')->get();
        if($config){
            $config=Configs::transform($config);
        }
        $this->passing_data['ConfigAdmin']=$config;
        // dd($config);
        return $this->_view('setting','index');
    }
    public function store(Request $req){
        // dd($req->about);
        try {
            DB::beginTransaction();
            if($req->Lang){
                $cookie_name='Lang_Admin';
                $cookie_value=$req->Lang;
                setcookie($cookie_name, $cookie_value, time() + (86400 * 366), "/");
            }

            $data=array();
            $rows=$req->email;
            $data[]=['name'=>'email','value'=>$rows,'sys_type'=>'admin'];

            if($req->address){
                $rows=$req->address;
                $data[]=['name'=>'address','value'=>json_encode($rows),'sys_type'=>'admin'];
            }
            if($req->about){
                $rows=$req->about;
                $data[]=['name'=>'about','value'=>json_encode($rows),'sys_type'=>'admin'];
            }
            if($req->police){
                $rows=$req->police;
                $data[]=['name'=>'police','value'=>json_encode($rows),'sys_type'=>'admin'];
            }
            if($req->mission){
                $rows=$req->mission;
                $data[]=['name'=>'mission','value'=>json_encode($rows),'sys_type'=>'admin'];
            }
            if($req->vission){
                $rows=$req->vission;
                $data[]=['name'=>'vission','value'=>json_encode($rows),'sys_type'=>'admin'];
            }
            if($req->phone){
                $rows=$req->phone;
                $data[]=['name'=>'phone','value'=>json_encode($rows),'sys_type'=>'admin'];
            }
            if($req->location){
                $rows=$req->location;
                $data[]=['name'=>'location','value'=>json_encode($rows),'sys_type'=>'admin'];
            }
            if($req->seo){
                $rows=$req->seo;
                $data[]=['name'=>'seo','value'=>json_encode($rows),'sys_type'=>'admin'];
            }
            if($req->sociel){
                $rows=$req->sociel;
                $data[]=['name'=>'sociel','value'=>json_encode($rows),'sys_type'=>'admin'];
            }
            if(count($data) > 0){
                Configs::where('sys_type','admin')->delete();
                Configs::insert($data);
            }
            DB::commit();
            $massage="Added Successfuly";
            return $this->json('success',$massage,200);
        }catch(Exception $ex){
            $massage="Data Not Added";
            return $this->json('warning',$massage,400);
            DB::rollBack();
        }
    }
}
