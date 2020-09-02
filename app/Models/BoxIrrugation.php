<?php

namespace App\Models;

use App\Models\Helper;

class BoxIrrugation extends Helper
{
    protected $table = 'box_irrigation';

    public function Irrigation(){
         return $this->hasOne('App\Models\Irrigation', 'irrigation_id');
     }
     public function Box(){
         return $this->hasOne('App\Models\Boxes', 'box_id');
     }
}
