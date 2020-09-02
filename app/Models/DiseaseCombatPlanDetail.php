<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Helper;
class DiseaseCombatPlanDetail extends Helper
{
    protected $table='disease_combat_plan_detail';

    public static function transform(DiseaseCombatPlan $items){
        $transaction=new \stdclass();
        $transaction->id=$items->id;
        $transaction->code=$items->code;
        $transaction->Pesticide_name=$items->Pesticide_name;
        $transaction->achieve=$items->achieve;
        $transaction->amount=$items->amount;
        $transaction->use_method=$items->use_method;
        $transaction->repeat=$items->repeat;
        $transaction->date=$items->date;
        $transaction->created_at=$items->created_at;
        return $transaction;
    }
}
