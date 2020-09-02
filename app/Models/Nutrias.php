<?php

namespace App\Models;

use App\Models\Helper;

class Nutrias extends Helper
{
    protected $table = 'nutria';
    public function boxes(){
        return $this->belongsTo(Boxes::class,'box_id');
    }
    public static $del_col="id,code,created_at,box_id";
    public static function transform(Nutrias $items){
        $transaction=new \stdclass();
        $transaction->id=$items->id;
        $transaction->code=$items->code;
        $transaction->box_id=$items->box_id;
        $transaction->box_code=$items->boxes->code;
        $transaction->box_column_count=$items->boxes->column_count;
        $transaction->box_row_count=$items->boxes->row_count;
        $transaction->palm_tree_QYT=$items->palm_tree_QYT;
        // if($items->palm_tree){
        //     $transaction->palm_tree=explode(',',$items->palm_tree);
        // }else{
        //     $transaction->palm_tree=[];
        // }
        $transaction->created_at=$items->created_at;
        // dd($transaction);
        return $transaction;
    }
}
