<?php

namespace App\Models;
use App\Models\Helper;
use Illuminate\Database\Eloquent\Model;

class experimentExecuteStep extends Helper
{
    public static function transform(experimentExecuteStep $items){
        $transaction=new \stdclass();
        $transaction->id=$items->id;
        $transaction->code=$items->code;
        $transaction->experiment_id=$items->experiment_id;
        $transaction->description=$items->description;
        $transaction->recommendation=$items->recommendation;
        $transaction->date=$items->date;
        return $transaction;
    }
}
