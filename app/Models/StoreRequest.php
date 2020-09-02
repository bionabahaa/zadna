<?php

namespace App\Models;

use App\Models\Helper;

class StoreRequest extends Helper
{
    protected $table = 'store_request';
    public static $del_col="id,tyoe_id,status_id,created_at";

    public static $type=[
        1=>'مبيد',
        2=>'سماد',
        3=>'محصول',
    ];
    public static $status=[
        1=>'جاري التنفيذ',
        2=>'لم يتم',
        3=>'تم',
    ];

    public static function transform(StoreRequest $items){
        $transaction=new \stdclass();
        $transaction->id=$items->id;
        $transaction->code=$items->code;
        $transaction->QYT=$items->qyt;
        $transaction->tyoe_id=$items->type_id;
        $transaction->type_title=self::$type[$items->type_id];
        $transaction->status_id=$items->status_id;
        $transaction->request_status=self::$status[$items->status_id];
        $transaction->ordered_from=$items->ordered_from;
        $transaction->cost=$items->cost;
        $transaction->title=$items->title;
        if($items->order_date){
            $transaction->order_date=date('Y-m-d',strtotime($items->order_date));
        }else{
            $transaction->order_date='';
        }
        
        $transaction->created_at=$items->created_at;
        return $transaction;
    }

    public static function transformreport($items){

        $transaction=new \stdclass();
        $transaction->modelName='StoreRequest';
        $transaction->id=$items->id;
        $transaction->title=$items->title;
        $transaction->code=$items->code;
        $transaction->QYT=$items->QYT;
        $transaction->cost=$items->price;
        $transaction->type=$items->type_title;

        $transaction->item=self::store_relation('operation_resources',$items->id,'post_id','opertion_type_id',3);




        $transaction->created_at=$items->created_at;
        return $transaction;
    }




    //dynamic function for all store relation
    public static function store_relation($table,$id,$column_name,$module_name=null,$module_value=''){
        $result = \DB::table($table)->where($column_name, $id);
        if(isset($module_name) && isset($module_value)){
            $result= $result->where($module_name,$module_value)->get();
        }else{
            $result=$result->get();
        }
        return $result;
    }


}
