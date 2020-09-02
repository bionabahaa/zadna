<?php
/*
    Provided By "Ayman Bassiony" / php Developer
    - This Controller has many function php help any developer php laravel
*/
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notes;
use App\Models\Recommendtions;
use App\Models\BoxCropPlanting;
use App\Models\RolePermission;
use Session;
use File;
use Image;
use Storage;
use Validator;
use Auth;
use App;


class BladeController extends Controller{
    ////////////////////////////////////////////
    /*
    | Ganeral
    */

    function config($param,$value=''){

        $data=Configs::where('sys_type','cpanel')->get();
        $info=array();
        if($data){
            $config=Configs::transform($data);
        }
        if($config){
            if(isset($config[$param])){
                if($param=='language' || $param=='setting'){
                    if(array_search($value,(array)$config[$param])!==false){
                        return true;
                    }
                    return false;
                }else{
                    return (array)$config[$param];
                }
            }
            return false;
        }
    }
    function package($param){

        $data=Configs::where('sys_type','cpanel')->where('name','packages')->first();
        $info=array();
        if($data){
            $config=Configs::transformPackages($data);
            if(isset($config[$param])){
                return $config[$param];
            }else{
                return 1;
            }

        }
        return 1;
    }
    function Cp_setting($param){

    }
    function Ad_setting(){

    }
    function Ws_setting(){

    }
    ////////////////////////////////////////////////////////
    /*
    | Cpanel
    */

    ////////////////////////////////////////////////////////
    /*
    | Admin Panel
    */

    public function get_notes_type(){
        return Notes::$Note_Type;
    }
    public function get_Notes($moduel_id,$post_id){
        return Notes::leftJoin('users','users.id','notes.from_id')
            ->where('moduel_id',$moduel_id)
            ->where('post_id',$post_id)
            ->select(['notes.*','users.username'])
            ->get();
    }
    public function get_Recommendtions($moduel_id,$post_id){
        return Recommendtions::leftJoin('users','users.id','recommendations.from_id')
            ->where('moduel_id',$moduel_id)
            ->where('post_id',$post_id)
            ->whereNull('recommendation_id')
            ->select(['recommendations.*','users.username'])
            ->get();
    }
    public function get_Recommendtions_Details($post_id){
        $data= Recommendtions::leftJoin('users','users.id','recommendations.from_id')
            ->where('recommendation_id',$post_id)
            ->select(['recommendations.*','users.username'])
            ->get();
        $return='';
        if($data){
            $user_id=1;
            foreach($data as $value){
                if($value->from_id==$user_id){
                    $return .='<li class=" clearfix rec">
                        <div class="chat-body clearfix">
                            <div class="header">
                                <small class=" text-muted float-right">
                                <span class="glyphicon glyphicon-time"></span>'.date('Y-m-d',strtotime($value->datetime)).'</small>
                                <strong class="primary-font">'.$value->username.'</strong>
                            </div>
                            <p>
                            '.$value->comment.'
                            </p>
                        </div>
                    </li>';
                }else{
                    $return .='<li class=" clearfix sent">
                        <div class="chat-body clearfix">
                            <div class="header">
                            <strong class="primary-font">'.$value->username.'</strong>
                                <small class="text-muted">
                                    <span class="glyphicon glyphicon-time"></span>'.date('Y-m-d',strtotime($value->datetime)).'</small>
                            </div>
                            <p class="float-right">
                            '.$value->comment.'
                            </p>
                        </div>
                    </li>';
                }
            }
            echo $return;
        }
    }

    public function getPalmTree($id){
        $result=BoxCropPlanting::where('box_id',$id)->get();
        $return ='<option disabled  value="">أختار كود النخله </option>';
        if($result){
            foreach($result as $value){
                $plam_tree_code=$value->Box->code.'_'.$value->row.'_'.$value->column.'_'.$value->Crop->code;
                $return .='<option value="'.$plam_tree_code.'"  >'.$plam_tree_code.'</option>';
            }
        }
        echo $return;
    }

    public function check_permission($moduel_id,$permission_id){
        $role_id=Auth::user()->role_id;
        if(in_array($role_id,[1,2])){
            return true;
        }else{
            $data=RolePermission::where('permission_id',$permission_id)
            ->where('role_id',$role_id)
            ->where('moduel_id',$moduel_id)
            ->first();
            if($data){
                return true;
            }else{
                return false;
            }
        }
    }
}
