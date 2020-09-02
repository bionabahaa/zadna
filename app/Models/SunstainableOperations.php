<?php

namespace App\Models;

use App\Models\Helper;

class SunstainableOperations extends Helper
{
    protected $table = 'sustainable_operation';
    public static $used_type=[
        1=>'فسيله',
        2=>'نسيج',
    ];
    public static $operation_type=[
        1=>'فسيله',
        2=>'نسيج',
    ];
    public function boxes(){
        return $this->belongsTo(Boxes::class,'box_id');
    }
    public static function transform(SunstainableOperations $items){
        $transaction=new \stdclass();
        $transaction->id=$items->id;
        $transaction->code=$items->code;
        $transaction->used_type_id=$items->used_type_id;
        $transaction->used_type_title=self::$used_type[$items->used_type_id];
        $transaction->operation_type_id=$items->operation_type_id;
        $transaction->operation_type_title=self::$operation_type[$items->used_type_id];
        $transaction->box_id=$items->box_id;
        $transaction->box_code=$items->boxes->code;
        $transaction->box_column_count=$items->boxes->column_count;
        $transaction->box_row_count=$items->boxes->row_count;
        $transaction->start_date=date('Y-m-d',strtotime($items->start_date));
        $transaction->recommendation=$items->recommendation;
        $transaction->notes=$items->notes;
        $transaction->created_at=$items->created_at;
        // dd($transaction);
        return $transaction;
    }
}
