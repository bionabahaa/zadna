<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\Helper;

class Diseases extends Helper
{
    protected $table='diseases';
    public static function transform(Diseases $items){
        $transaction=new \stdclass();
        $transaction->id=$items->id;
        $transaction->title=$items->title;
        $transaction->description=$items->description;
        return $transaction;
    }

    public function disease_detail(){
        return $this->hasMany('App\Models\diseasePalmTree','disease_id','id');
    }
//
//    public function disease_plans(){
//        return $this->hasMany('App\Models\DiseaseCombatPlan', 'disease_id','id');
//    }

}
