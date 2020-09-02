<?php

namespace App\Models;

use App\Models\Helper;
use App\Models\ModuelDetails;
use App\Models\Crops;
use App\Models\ModuelsTest;
class Farms extends Helper
{
    protected $table = "farms";
    public static function transform(Farms $items){
        $transaction=new \stdclass();
        $transaction->id=$items->id;
        $transaction->title=$items->title;
        $transaction->code=$items->code;
        $transaction->price=$items->price;
        $transaction->net_budget=url('public/images/Uploads/farms/' . $items->net_budget);
        $transaction->map_area=url('public/images/Uploads/farms/' . $items->map_area);
        // dd(ModuelDetails::$FieldsFarm);
        foreach(ModuelDetails::$FieldsFarm as $value){
           
            $data=self::farmDetails($items->id,$value);
            if($data){
                $transaction->$value=$data->value;
            }else{
                $transaction->$value=null;
            }
        }
        $transaction->created_at=$items->created_at;
        $transaction->FarmTest=self::FarmTest($items->id);
        // dd($transaction->FarmTest);
        $transaction->PlanOfAgriculture=$items->PlanOfAgriculture;
        $transaction->Crops=[];
        foreach($items->FarmCrops as $value){
            $crop_title=Crops::where('id',$value->crop_id)->first();
            $row['id']=$value->crop_id;
            $row['title']=$crop_title->title;
            $transaction->Crops[]=$row;
        }
        if(!empty($transaction->Crops)){
            $collection_id=collect($transaction->Crops)->pluck('id');
            $collection_id=$collection_id->toArray();
            $transaction->Crops_id=$collection_id;

            $collection=collect($transaction->Crops)->pluck('title');
            $collection=$collection->toArray();
            $transaction->Crops_table=implode(',',$collection);
        }else{
            $transaction->Crops_id=[];
            $transaction->Crops_table=null;
        }
        
        // dd($transaction);
        return $transaction;
    }
    public static function farmDetails($post_id,$name){
        return ModuelDetails::where('post_id',$post_id)
        ->where('moduel_id',1)
        ->where('name',$name)
        ->first();
    }
    public static function FarmTest($id){
        return ModuelsTest::where('id',$id)
        ->where('moduel_id',1)
        ->get();
    }
    public function PlanOfAgriculture(){
        return $this->hasMany('App\Models\PlanOfAgriculture', 'farm_id');
    }
    public function FarmCrops(){
        return $this->hasMany('App\Models\FarmCrops', 'farm_id')->select('crop_id');
    }
}
