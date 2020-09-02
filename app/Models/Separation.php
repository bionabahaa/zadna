<?php

namespace App\Models;

use App\Models\Helper;
use App\Models\BoxCropPlanting;
use App\Models\BoxCrops;
use DB;

class Separation extends Helper
{
      protected $table = "separation";
    public static $del_col="id,created_at,box_id,crops_in_box,palms,case";

      public function boxes(){
        return $this->belongsTo(Boxes::class,'box_id');
      }

      public static function transform(Separation $items){
        $transaction=new \stdclass();
        $transaction->id=$items->id;
        $transaction->code=$items->code;
        $transaction->box_id=$items->box_id;
//       get palm trees in box
        $result=BoxCropPlanting::where('box_id',$items->box_id)->get();
        $plam_tree_code=array();
        if($result) {
            foreach ($result as $value) {
                $plam_tree_code[] = $value->Box->code . '_' . $value->row . '_' . $value->column . '_' . $value->Crop->code;
            }
        }
//////////////////////
///
//get crops in box
          $box_crops=BoxCrops::where('box_id',$items->box_id)->get();
          $crops_in_box=array();
        foreach ($box_crops as $box_crop){
            $crops_in_box[]=$box_crop->Crop;
        }
////////////////////////

        $transaction->palms=$plam_tree_code;
        $transaction->crops_in_box=$crops_in_box;
        $transaction->box_code=$items->boxes->code;
        $transaction->size=$items->size;
        $transaction->market_price=$items->market_price;
        $transaction->box_column_count=$items->boxes->column_count;
        $transaction->plam_tree=$items->plam_tree;
        $transaction->start_date=date('Y-m-d',strtotime($items->start_date));
        $transaction->number_of_separation=$items->number_of_separation;
        $transaction->case=$items->case;
        $transaction->status=$items->case==1?'زرعت':'بيعت';
        $transaction->created_at=$items->created_at;
        return $transaction;
    }
}
