<?php

namespace App\Models;

use App\Models\Helper;

class BoxCropPlanting extends Helper
{
    protected $table = 'plam_tree';
    public function Crop(){
		return $this->belongsTo('App\Models\Crops', 'crop_id');
	}
	public function Box(){
		return $this->belongsTo('App\Models\Boxes', 'box_id');
    }
    public function Planting(){
		return $this->belongsTo('App\Models\Planting', 'planting_id');
	}
}
