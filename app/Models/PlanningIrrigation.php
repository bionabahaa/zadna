<?php

namespace App\Models;

use App\Models\Helper;

class PlanningIrrigation extends Helper
{
    protected $table = "planning_irrigation";

    // public function Irrigation(){
    //     return $this->hasOne('App\Models\Irrigation', 'irrigation_id');
    // }

    public static function transform(PlanningIrrigation $items){
        $transaction=new \stdclass();
        $transaction->id=$items->id;
        $transaction->irrigation_id=$items->irrigation_id;
        $transaction->cleaning_id=$items->cleaning_id;
        /*  $transaction->mahbs=$items->mahbs->code;*/
        
        
        $transaction->code=$items->code;
        $transaction->start_date=$items->start_date;
        $transaction->end_date=$items->end_date;
        $transaction->qyt=$items->qyt;
        $transaction->repeat=$items->repeat;
        $transaction->irrigation_date=$items->irrigation_date;
        $transaction->note=$items->note;
        $transaction->created_at=$items->created_at;
        // dd($transaction);
        return $transaction;
    }

    public function mahbs(){
		return $this->belongsTo('App\Models\IrrigationMahbas', 'irrigation_id');
    }
}

