<?php

namespace App\Models;

use App\Models\Helper;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Self_;

class Planting extends Helper
{
    protected $table = 'planting';

    public static $planting_type=[
        1=>'فسيله',
        2=>'نسيج',
    ];

    public static $del_col="id,created_at,protection_user_id,irrigation_user_id,box_id,type_id,user_protection,user_irrigation,crop_plant,Crops";

    public static function transform(Planting $items){
        $transaction=new \stdclass();
        $transaction->id=$items->id;
        $transaction->code=$items->code;
        $transaction->type_id=$items->type_id;
        $transaction->protection_user_id=$items->protection_user_id;
       $transaction->user_responsible_for_protection=$items->user_protection->username;
        $transaction->irrigation_user_id=$items->irrigation_user_id;
        $transaction->user_responsible_for_irrigation=$items->user_irrigation->username;
        $transaction->user_protection=$items->user_protection;
        $transaction->user_irrigation=$items->user_irrigation;
        $transaction->type_title=self::$planting_type[$items->type_id];
        $transaction->crop_plant=$items->crop_plant;
        $transaction->crop_plants=$items->crop_plant->title;
        $transaction->box_id=$items->box_id;
        $transaction->box_code=$items->boxes->code;
        $transaction->start_date=date('Y-m-d',strtotime($items->start_date));
        $transaction->end_date=date('Y-m-d',strtotime($items->end_date));
        $Crops=$items->Crops;
        $transaction->Crops=$Crops->pluck('crop_id','title')->toArray();
        $transaction->created_at=$items->created_at;
        foreach(ModuelDetails::$FieldsPlanting as $value){
            $data=self::PlantingDetails($items->id,$value);
            if($data){
                $transaction->$value=$data->value;
            }else{
                $transaction->$value='';
            }

        }
        // dd($transaction);
        return $transaction;
    }


    public static function transformreport(Planting $items){
        $transaction=new \stdclass();
        $transaction->id=$items->id;
        $transaction->code=$items->code;
        $transaction->type_id=$items->type_id;
        $transaction->protection_user_id=$items->protection_user_id;
        $transaction->user_responsible_for_protection=$items->user_protection->username;
        $transaction->irrigation_user_id=$items->irrigation_user_id;
        $transaction->user_responsible_for_irrigation=$items->user_irrigation->username;
        $transaction->user_protection=$items->user_protection;
        $transaction->user_irrigation=$items->user_irrigation;
        $transaction->type_title=self::$planting_type[$items->type_id];
        $transaction->crop_plant=$items->crop_plant;
        $transaction->crop_plants=$items->crop_plant->title;
        $transaction->box_id=$items->box_id;
        $transaction->box_code=$items->boxes->code;
        $transaction->start_date=date('Y-m-d',strtotime($items->start_date));
        $transaction->end_date=date('Y-m-d',strtotime($items->end_date));
        $Crops=$items->Crops;
        $transaction->Crops=$Crops->pluck('crop_id','title')->toArray();
        $transaction->created_at=$items->created_at;
        foreach(ModuelDetails::$FieldsPlanting as $value){
            $data=self::PlantingDetails($items->id,$value);
            if($data){
                $transaction->$value=$data->value;
            }else{
                $transaction->$value='';
            }

        }
        // dd($transaction);
        return $transaction;
    }


    public static function user($id){
        return \DB::table('user')->where('id',$id)->select('username');
    }

    public function boxes(){
        return $this->belongsTo(Boxes::class,'box_id');
    }
    public function Crops(){
        return $this->hasMany(BoxCropPlanting::class,'planting_id');
    }


    public function crop_plant(){
        return $this->hasOne('App\Models\Crops','id','fertlize_crop_id');
    }
    public function user_protection(){
        return $this->hasOne('App\Models\Users','id','protection_user_id');
    }

    public function user_irrigation(){
        return $this->hasOne('App\Models\Users','id','irrigation_user_id');
    }

    public static function PlantingDetails($post_id,$name){
        return ModuelDetails::where('post_id',$post_id)
            ->where('moduel_id',15)
            ->where('name',$name)
            ->first();
    }
}
