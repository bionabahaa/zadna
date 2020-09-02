<?php

namespace App\Models;

use App\Models\Helper;

class OperationResources extends Helper
{
    protected $table = 'operation_resources';
    public static $del_col="id,moduel_id";

    public static $operation_type=[
        1=>'تجهيز الجوره',
        2=>'عمليات الغرس',
        3=>'الرى',
        4=>'التسميد',
        5=>'الوقايه',
        6=>'فصل الفسائل',
        7=>'الكيب',
        8=>'العمليات المستديمه',
        9=>'الحصاد',
        14=>'المهمات',
        15=>'الامراض',
    ];
    public static $operation_type_genral=[
        10=>'الابار',
        11=>'المربعات',
        12=>'شبكه الرى',
        13=>'التجارب',
    ];

    public static function transform(OperationResources $items){
    $transaction=new \stdclass();
    $transaction->id=$items->id;
    $transaction->moduel_id=$items->moduel_id;
    $transaction->moduel_title = parent::$project_moduels[$items->moduel_id];
    $transaction->code=$items->code;
    if($items->post_id){
        $transaction->box_code=Planting::where('id',$items->post_id)->select('code')->first();
    }
    if($items->matrial_id){
        $matrial=Matriels::transform($items->matrial);
        $transaction->total_qyt=$matrial->qyt;
        $transaction->type=$matrial->material_type;
        $transaction->name=$matrial->title;
    }
    if($items->equipment_id){
        $equipments=Equipments::transform($items->equipment);
        $transaction->total_qyt=$equipments->QYT;
        $transaction->type=$equipments->type_title;
        $transaction->name=$equipments->title;
    }
    if($items->qyt){
        $transaction->qyt=$items->qyt;
    }
    else{
        $transaction->qyt='0';
    }


    if($items->sent_qyt) {
        $transaction->sent_qyt = $items->sent_qyt;
    }else{
        $transaction->sent_qyt='0';
    }

    if($items->rest_qyt) {
        $transaction->rest_qyt = $items->rest_qyt;
    }else{
        $transaction->rest_qyt =$items->qyt;
    }

    if($items->sent_qyt>$items->rest_qyt){
        $transaction->rest_qyt ='0';
    }

    $transaction->created_at=date('Y-m-d',strtotime($items->created_at));
    $transaction->datetime = $items->datetime;
    // dd($transaction);
    return $transaction;
}


    public static function transformreport(OperationResources $items){
        $transaction=new \stdclass();
        $transaction->id=$items->id;
        $transaction->moduel_id=$items->moduel_id;
        $transaction->moduel_title = parent::$project_moduels[$items->moduel_id];
        $transaction->code=$items->code;
        if($items->post_id){
            $transaction->box_code=Planting::where('id',$items->post_id)->select('code')->first();
        }
        if($items->matrial_id){
            $matrial=Matriels::transform($items->matrial);
            $transaction->total_qyt=$matrial->qyt;
            $transaction->type=$matrial->material_type;
            $transaction->name=$matrial->title;
        }
        if($items->equipment_id){
            $equipments=Equipments::transform($items->equipment);
            $transaction->total_qyt=$equipments->QYT;
            $transaction->type=$equipments->type_title;
            $transaction->name=$equipments->title;
        }
        if($items->qyt){
            $transaction->qyt=$items->qyt;
        }
        else{
            $transaction->qyt='0';
        }


        if($items->sent_qyt) {
            $transaction->sent_qyt = $items->sent_qyt;
        }else{
            $transaction->sent_qyt='0';
        }
        if($items->rest_qyt) {
            $transaction->rest_qyt = $items->rest_qyt;
        }else{
            $transaction->rest_qyt ='0';
        }
        $transaction->created_at=date('Y-m-d',strtotime($items->created_at));
        $transaction->datetime = $items->datetime;
        // dd($transaction);
        return $transaction;
    }
















    public function matrial(){
        return $this->belongsTo('App\Models\Matriels', 'matrial_id');
    }
    public function equipment(){
        return $this->belongsTo('App\Models\Equipments', 'equipment_id');
    }

    // public static function transformMainTable(){
    //     $data=OperationResources::select(['box_id',\DB::raw('sum(cost) as total'),\DB::raw('(select count(*) from plam_tree WHERE box_id=operation_resources.box_id) as "count_plam_tree"')])
    //     ->groupBy('box_id')
    //     ->get();
    //     if($data){
    //         return $data;
    //     }else{
    //         return [];
    //     }

    // }
}