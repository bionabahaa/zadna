<?php

namespace App\Http\Controllers\Admin;

use App\Models\Diseases;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Auth;
use App\Models\Users;
use App\Models\Permissions;
use App\Models\Role;
use App\Models\RolePermission;
use App\Rules\Captcha;
use DB;
use App\Models\diseasePalmTree;


class SignController extends AdminController
{
    private $rules=[
        'username' => 'required',
        'password' => 'required',
//        'g-recaptcha-response' => 'required|captcha',

    ];
    public function __construct()
    {
        parent::__construct();
    }
    public function index(){
       
        if (!Auth::check()) {
            return $this->_view('Main', 'login');
        }else{
            
            return redirect('/main');
        }
    }
    public function Login(Request $req){
        
        $validation = $this->validation($this->rules , $req, true);
        if ($validation === true){
            if($req->remmber_me){
                $remmber_me=true;
            }else{
                $remmber_me=false;
            }
            $credentials=array(
                'username'=>$req->username,
                'password'=>$req->password,
            );
            //$check=Auth::attempt($credentials,$remmber_me);
            //dd(Auth::attempt($credentials,$remmber_me));
            if (Auth::attempt($credentials,$remmber_me)) {
                //dd(Auth::attempt($credentials,$remmber_me));
                return redirect('main/');
            }
            return redirect('/')->with('error', 'يوجد خطاء فى الرقم السرى او أسم المستخدم');;
        }else{
            return $this->json('warning', $validation);
        }
    
    }
    public function Logout(){
        Auth::logout();
        return redirect('/');
    }
}
