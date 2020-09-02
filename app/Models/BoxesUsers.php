<?php

namespace App\Models;

use App\Models\Helper;

class BoxesUsers extends Helper
{
   protected $table = 'user_box';

   public function User(){
//		return $this->hasOne('App\Models\Users', 'user_id');
       return $this->hasMany('App\Models\Users','id','user-id');
	}
	public function Box(){
		return $this->hasOne('App\Models\Boxes', 'box_id');
	}
}
