<?php

namespace App\Models;

use App\Models\Helper;
use Illuminate\Support\Facades\DB;

class Cleaning extends Helper
{
    protected $table = 'cleaning';
    public static $del_col="id,code,created_at,box_id,PlanningIrrigation,user_id";

    public function Box(){
        return $this->belongsTo('App\Models\Boxes', 'box_id');
    }
    public function PlanningIrrigation(){
        return $this->hasMany('App\Models\PlanningIrrigation', 'planting_id');
    }
    public static function user($id){
        \DB::table('users')->where('id',$id)->select('username')->first();
    }

    public static function transform(Cleaning $items){
        $transaction=new \stdclass();
        $transaction->id=$items->id;
        $transaction->code=$items->code;
        $transaction->PlanningIrrigation=$items->PlanningIrrigation;
        $transaction->box_id=$items->box_id;
        $transaction->user_id=$items->user_id;
        $transaction->box_code=$items->Box->code;
        $transaction->start_date=date('Y-m-d',strtotime($items->start_date));
        $transaction->end_date=date('Y-m-d',strtotime($items->end_date));
        $transaction->palm_tree=$items->palm_tree;
        $transaction->implementation=($items->implementation==1)?false:true;
        $transaction->created_at=date('Y-m-d',strtotime($items->created_at));
        return $transaction;
    }

    public static function transformreport(Cleaning $items){
        $transaction=new \stdclass();
        $transaction->id=$items->id;
        $transaction->code=$items->code;
        $transaction->PlanningIrrigation=$items->PlanningIrrigation;
        $transaction->box_id=$items->box_id;
        $transaction->user_id=$items->user_id;
        $transaction->box_code=$items->Box->code;
        $transaction->start_date=date('Y-m-d',strtotime($items->start_date));
        $transaction->end_date=date('Y-m-d',strtotime($items->end_date));
        $transaction->palm_tree=$items->palm_tree;
        $transaction->implementation=($items->implementation==1)?false:true;
        $transaction->created_at=date('Y-m-d',strtotime($items->created_at));
        return $transaction;
    }
}
