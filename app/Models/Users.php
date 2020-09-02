<?php

namespace App\Models;

use App\Models\Helper;

class Users extends Helper
{
    protected $table = 'users';

    public static $type_worker=[
        1=>'دائم',
        2=>'مؤقت',
    ];
    public static $del_col="id,created_at,type_id,role_id,password,blocked,permission_login";

    public function role(){
        return $this->belongsTo('App\Models\Role','role_id');
    }

    public function crew(){
        return $this->hasOne('App\Models\Crew','user_id');
    }

    public function notes(){
        return $this->hasMany('App\Models\UserNote', 'user_id','id');
    }


    public function box(){
        return $this->belongsToMany('App\Models\Boxes','user_box','user_id','box_id');
    }
    public function tasks(){
        return $this->hasMany('App\Models\Tasks','to_id','id');
    }

    public static function transform($items){
        $transaction=new \stdclass();
        $transaction->id=$items->id;
        $transaction->role_id=$items->role_id;
        if($items->blocked==0) {
            $transaction->blocked = $items->blocked;
            $transaction->block ='لا';
        }else{
            $transaction->block='نعم';
        }
        $transaction->type_id=$items->type_id;
        $transaction->type_title=self::$type_worker[$items->type_id];
//        $transaction->role_id=$items->role->id;
        $transaction->role_title=$items->role->title;
        $transaction->username=$items->username;
        $transaction->password= $items->password;
        $transaction->email=$items->email;
        $transaction->hiring_date=$items->hiring_date;
        if($items->permission_login==1) {
            $transaction->permission_login = $items->permission_login;
            $transaction->system_access='مسموح';
        }else{
            $transaction->system_access='غير مسموح';
        }
        $transaction->created_at=$items->created_at;

        return $transaction;
    }
}
