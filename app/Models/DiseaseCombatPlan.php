<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Helper;
class DiseaseCombatPlan extends Helper
{
    protected $table='disease_combact_plan';

    public static function transform(DiseaseCombatPlan $items){
        $transaction=new \stdclass();
        $transaction->id=$items->id;
        $transaction->code=$items->code;
$material=[];
$amount=[];
foreach ($items->plan_materials_details as $detail){
    $material[]=$detail->pesticide;
    $amount[]=$detail->amount;
}


        $transaction->pesticide=implode(',',$material);
        $transaction->used_materials=$material;
        $transaction->amount=$amount;
        $transaction->used_way=$items->used_way;
        $transaction->repeat=$items->repeat;
        $transaction->date=$items->date;
        $transaction->created_at=$items->created_at;
        return $transaction;
    }

//    public function disease_plan_detail(){
//        return $this->hasOne('App\Models\DiseaseCombatPlanDetail', 'disease_combat_plan_id','id');
//    }

    public function material(){
        return $this->hasOne('App\Models\Matriels','id','pesticide')->select('title');
    }

    public function plan_materials_details(){
        return $this->hasMany('App\Models\DiseasePlanMaterial','disease_combact_plan_id','id')->select('pesticide','amount');
    }

}
