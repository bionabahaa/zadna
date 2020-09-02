<?php

namespace App\Models;

use App\Models\Helper;

class Crops extends Helper
{
   protected $table = 'crops';
   public static $del_col="id,crop_id,created_at";

   public static function transform(Crops $items){
        $transaction=new \stdclass();
        $transaction->all_crops_in_type=$items->Crops;
        $transaction->id=$items->id;
        $transaction->crop_id=$items->crop_id;
        $transaction->code=$items->code;
        $transaction->title=$items->title;
       $crop=Crops::where('id',$items->crop_id)->select('id','title','code','date')->first();
       $transaction->crop_title=$crop['title'];
       $transaction->crop_id=$crop['id'];
       $transaction->crop_code=$crop['code'];

       if(($items->date)){
           $transaction->date=$items->date;
       }
       else{
           $transaction->date=$crop['date'];
       }

       $transaction->notes=$items->notes;
       $transaction->qyt=$items->qyt;
       $transaction->created_at=$items->created_at;
        return $transaction;
    }

// transform data for report
    public static function transformreport(Crops $items){
        $transaction=new \stdclass();
        $transaction->id=$items->id;
        $transaction->code=$items->code;
        $transaction->modelName='Crops';
        $transaction->title=$items->title;
        $crop=Crops::where('id',$items->crop_id)->select('id','title','code','date')->first();
        $transaction->crop_code=$crop['code'];
        $transaction->all_crops=$items->Crops; //list all crops in type
        if($items->Crops) {
            foreach ($items->Crops as $cropN) {
                $cropName[] = $cropN->title;
            }
            $transaction->all_crops_in_type = $cropName;
            $transaction->crops_name=implode(' , ',$cropName);
        }

        $transaction->date=$items->date;
        return $transaction;
    }


    public function Crops(){
        return $this->hasMany('App\Models\Crops', 'crop_id')->select('id','code','title','qyt');
    }

    public static function count(){
        return Crops::whereNull('crop_id')->count();
    }

   
}
