<?php

namespace App\Models;

use App\Models\Helper;
use App\Models\ModuelDetails;
use App\Models\Matriels;
use App\Models\ModuelsType;
use App\Models\ModuelsTest;

class Equipments extends Helper
{
    protected $table = "equipments";
    public static $del_col="id,created_at,type_id,EquipmentTest,Matrials,Matrials_id";
    public static function transform(Equipments $items){
        $transaction=new \stdclass();
        $transaction->id=$items->id;
        $transaction->QYT=$items->QYT;
        $transaction->title=$items->title;
        $transaction->code=$items->code;
        $transaction->price=$items->price;
        $transaction->type_id=$items->type_id;
        $transaction->type_title=self::EquipmentType($items->type_id)->title;
        foreach(ModuelDetails::$FieldsEquipments as $value){
            $data=self::EquipmentDetails($items->id,$value);
            if($data){
                $transaction->$value=$data->value;
            }else{
                $transaction->$value='';
            }
            
        }
        $transaction->created_at=$items->created_at;
        $transaction->EquipmentTest=self::EquipmentTest($items->id);

        foreach($items->EquipmentMatriels as $value){
            $matrial_title=Matriels::where('id',$value->matrial_id)->first();
            $row['id']=$value->matrial_id;
            $row['title']=$matrial_title->title;
            $transaction->Matrials[]=$row;
        }
        $collection_id=collect($transaction->Matrials)->pluck('id');
        $collection_id=$collection_id->toArray();
        $transaction->Matrials_id=$collection_id;

        $collection=collect($transaction->Matrials)->pluck('title');
        $collection=$collection->toArray();
        $transaction->Matrials_table=implode(',',$collection);
        // dd($transaction);
        return $transaction;
    }
    public static function EquipmentDetails($post_id,$name){
        return ModuelDetails::where('post_id',$post_id)
        ->where('moduel_id',4)
        ->where('name',$name)
        ->first();
    }
    public static function EquipmentTest($post_id){
        return ModuelsTest::where('post_id',$post_id)
        ->where('moduel_id',4)
        ->get();
    }
    public function EquipmentMatriels(){
        return $this->hasMany('App\Models\MatrielEquipment', 'equipment_id')->select('matrial_id');
    }
    public static function EquipmentType($id){
        return ModuelsType::where('id',$id)
        ->where('moduel_id',4)
        ->first();
    }
}
