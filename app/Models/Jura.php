<?php

namespace App\Models;

use App\Models\Helper;
use App\Models\Boxes;
use App\Models\Matriels;
use Illuminate\Support\Facades\DB;

class Jura extends Helper
{
    protected $table = "jura";
    public static $del_col="id,created_at,box_id,achieve,cleansing_matrial_id,service_matrial_id,recommendation,service_matrial_qyt,cleansing_start_date,cleansing_end_date,cleansing_matrial_qyt";
    
    public static function transform(Jura $items){
        $transaction=new \stdclass();
        $transaction->id=$items->id;
        $transaction->code=$items->code;
        $transaction->box_id=$items->box_id;
        $transaction->box_code=$items->boxes->code;
        $transaction->start_date=date('Y-m-d',strtotime($items->start_date));
        $transaction->end_date=date('Y-m-d',strtotime($items->end_date));
        if($items->achieve==1){
            $transaction->achieveed='لم يتم التنفيذ';
        }else{
            $transaction->achieveed=' يتم التنفيذ';
        }
        $transaction->achieve=$items->achieve;
        $transaction->recommendation=$items->recommendation;
        $transaction->specifications=$items->specifications;
        $transaction->depth=$items->depth;
        $transaction->created_at=$items->created_at;
        $transaction->service_material_title='';
        $transaction->cleaning_material_title='';
        foreach(ModuelDetails::$FieldsJura as $value){
            if($value=='service_matrial_id'){
                $data=self::JuraMaterials($items->id,$value);
                foreach ($data as $data1){
                    $transaction->service_material_title.=$data1->title.' , ';
                }
                $transaction->service_matrial_id=$data;
            }
            elseif($value=='cleansing_matrial_id'){
                $data=self::JuraMaterials($items->id,$value);
                foreach ($data as $data1){
                    $transaction->cleaning_material_title.=$data1->title.' , ';
                }
                $transaction->cleansing_matrial_id=$data;
            }
            else {
                $data = self::JuraDetails($items->id, $value);
                if ($data) {
                    $transaction->$value = $data->value;
                } else {
                    $transaction->$value = '';
                }
            }
        }
        return $transaction;
    }



    public function boxes(){
        return $this->belongsTo(Boxes::class,'box_id');
    }
    public static function JuraDetails($post_id,$name){
        return ModuelDetails::where('post_id',$post_id)
        ->where('moduel_id',14)
        ->where('name',$name)
        ->first();
    }

    public static function JuraMaterials($post_id,$name){
//        return JuraMaterials::where('post_id',$post_id)
//            ->where('moduel_id',14)
//            ->where('name',$name)
//            ->select('material_id','amount')->get();

        $data=JuraMaterials::join('materials','materials.id','jura_materials.material_id')->where('post_id',$post_id)
            ->where('moduel_id',14)
            ->where('name',$name)->get();
             return $data;
    }

    public static function materialNmae($id){
        return Matriels::where('id',$id)
            ->select('title')->first();
    }
}
