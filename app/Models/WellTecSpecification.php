<?php

namespace App\Models;

use App\Models\Helper;

class WellTecSpecification extends Helper
{
    protected $table = "well_tec_specifications";

    public static $Type=[
        1=>'Pipes',
        2=>'External_pipes_coating',
        3=>'Generator',
        4=>'Trumpet',
    ];
    public static $type_Pipes=[
        1=>'عادى',
        2=>'غير عادى',
    ];
    public static $type_External_pipes_coating=[
        1=>'عادى',
        2=>'غير عادى',
    ];
    public static $type_Generator=[
        1=>'عادى',
        2=>'غير عادى',
    ];
    public static $type_Trumpet=[
        1=>'عادى',
        2=>'غير عادى',
    ];
    public static function WellTecSpecificationTest($post_id){
        return ModuelsTest::where('post_id',$post_id)
        ->where('moduel_id',12)
        ->get();
    }

    public static function transformTecSpecifications($items){
        $transaction=new \stdclass();
        $transaction->id=$items->id;
        $transaction->code=$items->code;
        $transaction->title=$items->title;
        $transaction->repetition=$items->test_num.' '.$items->test_duration;
        $transaction->datetime=date('Y-m-d',strtotime($items->datetime));
        $transaction->extension=$items->extension;
        $transaction->created_at=$items->created_at;
        return $transaction;
    }
}
