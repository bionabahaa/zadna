<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Helper;
class Experiments extends Helper
{
    public static $del_col="id,box_id";

    public static $alert_measure=[
        1=>'ايام',
        2=>'اسابيع',
        3=>'شهور',
    ];
    public static function transform(Experiments $items){
        $transaction=new \stdclass();
        $transaction->id=$items->id;
        $transaction->code=$items->code;
        $transaction->box_id=$items->box['code'];
        $transaction->name=$items->name;
        $transaction->experiment_type=$items->experiment_type;
        $transaction->create_date=$items->create_date;
        $transaction->execution_appointment	=$items->execution_appointment;
        $transaction->success_percent=$items->success_percent;
        $transaction->palms	=$items->palms;
        $transaction->execution_date=$items->execution_date;
        $transaction->alert_before_execution=$items->alert_before_execution.'  '.self::$alert_measure[$items->alert_measure];
        $transaction->experiment_reason=$items->experiment_reason;
        $transaction->description=$items->description;
        return $transaction;
    }

    public function users(){
        return $this->hasMany('App\Models\userExperiment','experiment_id','id');
    }

    public function box(){
        return $this->hasOne('App\Models\Boxes','id','box_id')->select('code');
    }
}
