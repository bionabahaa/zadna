<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Helper;
class IrrigationMahbas extends Helper
{
   protected $table='irrigation_mahbas';



    public static function transform(IrrigationMahbas $items){
        $transaction=new \stdclass();
        $transaction->id=$items->id;
        $transaction->code=$items->code;
        $transaction->irrigation_id=$items->irrigation_id;
        $transaction->desc=$items->desc;
        $transaction->location=$items->location;
        $transaction->created_at=$items->created_at;
        return $transaction;
    }

    public function irrigation(){
        return $this->belongsTo(Irrigation::class,'irrigation_id');
    }
}
