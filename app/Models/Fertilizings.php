<?php

namespace App\Models;

use App\Models\Helper;

class Fertilizings extends Helper
{
    protected $table = "fertilizing";
    public static $operation_type=[
        1=>'مرسله',
        2=>'مستقبله',
    ];
    public static $del_col="id,box_id,code,created_at,palm_tree_QYT,recommendation,start_date,end_date,operation_type_id";
    public function boxes(){
        return $this->belongsTo('App\Models\Boxes','box_id');
    }
    public function Crop(){
        return $this->belongsTo('App\Models\Crops', 'crop_id');
    }

    public function matrials(){
        return $this->belongsTo(Matriels::class,'matrial_id');
    }
    public static function transform(Fertilizings $items){
        $transaction=new \stdclass();
        $transaction->id=$items->id;
        $transaction->code=$items->code;
        $transaction->operation_type_id=$items->used_type_id;
        $transaction->box_id=$items->box_id;
        $transaction->box_code=$items->boxes->code;
        $transaction->box_column_count=$items->boxes->column_count;
        $transaction->box_row_count=$items->boxes->row_count;
        $transaction->start_date=date('Y-m-d',strtotime($items->start_date));
        $transaction->end_date=date('Y-m-d',strtotime($items->end_date));
        $transaction->recommendation=$items->recommendation;
        $transaction->palm_tree_QYT=$items->palm_tree_QYT;
        $transaction->Fertilizer=$items->matrials->title;
        $transaction->fertilizer_QYT=$items->fertilizer_QYT;
      
        $transaction->created_at=$items->created_at;
        // dd($transaction);
        return $transaction;
    }


    public static function transformreport(Fertilizings $items){
        $transaction=new \stdclass();
        $transaction->id=$items->id;
        $transaction->code=$items->code;
        $transaction->operation_type_id=$items->used_type_id;
        $transaction->box_id=$items->box_id;
        $transaction->box_code=$items->boxes->code;
        $transaction->box_column_count=$items->boxes->column_count;
        $transaction->box_row_count=$items->boxes->row_count;
        $transaction->start_date=date('Y-m-d',strtotime($items->start_date));
        $transaction->end_date=date('Y-m-d',strtotime($items->end_date));
        $transaction->recommendation=$items->recommendation;
        $transaction->palm_tree_QYT=$items->palm_tree_QYT;
        $transaction->Fertilizer=$items->matrials->title;
        $transaction->fertilizer_QYT=$items->fertilizer_QYT;

        $transaction->created_at=$items->created_at;
        // dd($transaction);
        return $transaction;
    }
}
