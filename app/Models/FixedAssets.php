<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\FixedAssets_type;
use App\Models\Helper;

class FixedAssets extends Helper
{
    protected $table = "FixedAssets";
    public static $del_col="id,created_at";
    public static function transform(FixedAssets $items){
        $transaction=new \stdclass();
        $transaction->id=$items->id;
        $transaction->code=$items->code;
//    $transaction->fixedasset_type=self::AssetType($items->id)->title;
        $type=self::AssetType($items->fixedasset_type_id);
        if($type){
            $transaction->fixedasset_type=$type->title;
        }else{
            $transaction->fixedasset_type='';
        }
        $transaction->title=$items->title;
        $transaction->desc=$items->desc;
        $transaction->note=$items->note;
        $transaction->Purchasing_value=$items->Purchasing_value;
        $transaction->Market_value=$items->Market_value;
        $transaction->created_at=$items->created_at;
        return $transaction;
    }
    public static function AssetType($id){
        return ModuelsType::where('id',$id)
        ->where('moduel_id',5)
        ->first();
    }
}

