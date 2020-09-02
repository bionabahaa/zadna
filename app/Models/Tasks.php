<?php

namespace App\Models;

use App\Models\Helper;

class Tasks extends Helper
{
    protected $table = "tasks";
    public static $type_assign_task=[
        1=>'فسيله',
        2=>'نسيج',
    ];
    public static $task_type=[
        1=>'ادارية',
        2=>'زراعية',
        3=>'تسويق',
    ];
    public static $status_type=[
        0=>'فى الانتظار',
        1=>'تم التنفيذ',
        2=>'لم يتم التنفيذ',
        3=>'تم الالغاء',
    ];
    public function from(){
        return $this->belongsTo('App\Models\Users', 'from_id');
    }
    public function to(){
        return $this->belongsTo('App\Models\Users', 'to_id');
    }
    public function boxes(){
        return $this->belongsTo(Boxes::class,'box_id');
    }
    public static function transform(Tasks $items){
        $transaction=new \stdclass();
        $transaction->id=$items->id;
        $transaction->from_id=$items->from_id;
        $transaction->from=$items->from->username;
        $transaction->to_id=$items->to_id;
        $transaction->to=$items->to->username;
        $transaction->status_id=$items->status;
        $transaction->status=self::$status_type[$items->status];
        $transaction->seen=($items->seen==0)?false:true;
        $transaction->task_type_id=$items->task_type_id;
        $transaction->task_type=self::$task_type[$items->task_type_id];
        // $transaction->type_assign_task_id=$items->type_assign_task_id;
        // $transaction->type_assign_task=self::$type_assign_task[$items->type_assign_task_id];
        $transaction->box_id=$items->box_id;
        $transaction->box_code=$items->boxes->code;
        $transaction->implementation_at=date('Y-m-d',strtotime($items->implementation_at));
        $transaction->task=$items->task;
        $transaction->notes=$items->note;
        $transaction->created_at=$items->created_at;
        // dd($transaction);
        return $transaction;
    }
}
