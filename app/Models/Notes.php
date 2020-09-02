<?php

namespace App\Models;

use App\Models\Helper;

class Notes extends Helper
{
    protected $table = "notes";

    public static $Note_Type=[
        1=>'عادى',
        2=>'غير عادى',
    ];

    public function user(){
        return $this->hasOne('App\Models\Users','id','from_id')->select('username');
    }
}
