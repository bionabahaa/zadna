<?php

namespace App\Models;

use App\Models\Helper;

class Protections extends Helper
{
    protected $table = 'protection';
    public static $used_type=[
        1=>'فسيله',
        2=>'نسيج',
    ];
    public static $del_col="id,created_at,box_id,matrial_id,user_id,used_type_id,implementation";
    public function boxes(){
        return $this->belongsTo(Boxes::class,'box_id');
    }
    public function users(){
        return $this->belongsTo(Users::class,'user_id');
    }

    public function matrials(){
        return $this->belongsTo(Matriels::class,'matrial_id');
    }

    public static function transform(Protections $items){
        $transaction=new \stdclass();
        $transaction->id=$items->id;
        $transaction->code=$items->code;
        $transaction->used_type_id=$items->used_type_id;
//        if($items->used_type_id){
//            $transaction->used_type_title=self::$used_type[$items->used_type_id];
//        }else{
//            $transaction->used_type_title='';
//        }
        $transaction->box_id=$items->box_id;
        $transaction->box_code=$items->boxes->code;
        $transaction->box_column_count=$items->boxes->column_count;
        $transaction->box_row_count=$items->boxes->row_count;
        $transaction->start_date=date('Y-m-d',strtotime($items->start_date));
        $transaction->end_date=date('Y-m-d',strtotime($items->end_date));
        $transaction->implementation=($items->implementation==1)?false:true;
        $transaction->implement_protection=($items->implementation==1)?'تم':'لم يتم';

        $transaction->pesticide_QYT=$items->Pesticide_QYT;
        $transaction->matrial_id=$items->matrial_id;
        $transaction->pesticide_title=$items->matrials->title;
        $transaction->palm_tree_QYT=$items->palm_tree_QYT;
        $transaction->recommendation=$items->recommendation;
        $transaction->user_id=$items->user_id;
        if($items->palm_tree){
            $transaction->palm_tree=explode(',',$items->palm_tree);
        }else{
            $transaction->palm_tree=[];
        }
        $transaction->created_at=$items->created_at;
        // dd($transaction);
        return $transaction;
    }
}
