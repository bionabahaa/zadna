<?php

namespace App\Models;

use App\Models\Helper;

class BoxCrops extends Helper
{
	protected $table = 'crop_box';
	public static function transform(BoxCrops $items){
        $transaction=new \stdclass();
        $transaction->id=$items->Crop->id;
        $transaction->code=$items->Crop->code;
        $transaction->title=$items->Crop->title;
        $transaction->created_at=$items->Crop->created_at;
        // dd($transaction);
        return $transaction;
    }
    public function Crop(){
		return $this->belongsTo('App\Models\Crops', 'crop_id');
	}
	public function Box(){
		return $this->belongsTo('App\Models\Boxes', 'box_id');
	}
}
