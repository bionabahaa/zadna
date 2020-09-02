<?php

namespace App\Models;

use App\Models\Helper;

class Harvests extends Helper
{
    protected $table = 'harvest';
    public static $del_col="id,created_at,box_id,crop_id,crop";
    public static $used_type=[
        1=>'فسيله',
        2=>'نسيج',
    ];
    public static $operation_type=[
        1=>'مرسله',
        2=>'مستقبله',
    ];
    public function boxes(){
        return $this->belongsTo(Boxes::class,'box_id');
    }
    public function crops(){
        return $this->belongsTo(Crops::class,'crop_id');
    }
    public static function transform(Harvests $items){
        $transaction=new \stdclass();
        $transaction->id=$items->id;
        $transaction->code=$items->code;
        $transaction->row=$items->row;
        $transaction->column=$items->column;
        $transaction->box_id=$items->box_id;
        $transaction->box_code=$items->boxes->code;
        $transaction->crop_id=$items->crop_id;
        $transaction->crop=$items->crops->code;
        $transaction->crop_title=$items->crops->title;
        $transaction->qyt=$items->qyt;
        $transaction->date=date('Y-m-d',strtotime($items->date));
        $transaction->created_at=$items->created_at;
        // dd($transaction);
        return $transaction;
    }
}
