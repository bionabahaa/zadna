<?php

namespace App\Models;
use App\Models\Material_type;
use App\Models\Material_Units;
use App\Models\Helper;

class Matriels extends Helper
{

    protected $table = "materials";
    public static $del_col="id,created_at,material_type_id,material_unit_id";

public static $main_groub=[
        1=>'خامه اساسيه',
        2=>'خامه مساعده',
        3=>' قطع غيار',
        4=>'المعدات ',
        5=>'المهمات ',
    ];

    public function material_unit(){
        return $this->belongsTo(Material_Units::class);
    }

    public static function transform(Matriels $items){
        $transaction=new \stdclass();
        $transaction->id=$items->id;
        $transaction->material_type_id=$items->material_type_id;
        $transaction->material_unit_id=$items->material_unit_id;
        $transaction->material_type=self::MatrielType($items->material_type_id)->title;
        $transaction->material_unit=$items->material_unit->title;
        $transaction->code=$items->code;
        $transaction->title=$items->title;
        $transaction->main_groub=$items->main_groub;
        $transaction->cost=$items->cost;
        $transaction->qyt=$items->QYT;
        $transaction->note=$items->note;
        $transaction->created_at=$items->created_at;
        return $transaction;
    }

    public static function transformreport(Matriels $items){
        $transaction=new \stdclass();
        $transaction->id=$items->id;
        $transaction->modelName='Matriels';
        $transaction->material_type_id=$items->material_type_id;
        $transaction->material_unit_id=$items->material_unit_id;
        $transaction->material_type=self::MatrielType($items->material_type_id)->title;
        $transaction->material_unit=$items->material_unit->title;
        $transaction->code=$items->code;
        $transaction->title=$items->title;
        $transaction->cost=$items->cost;
        $transaction->qyt=$items->QYT;
        $transaction->note=$items->note;
        $transaction->created_at=$items->created_at;
        if(!empty(self::irrigation_relation($items->id))) {
            $transaction->irrigation_resources = self::irrigation_relation($items->id);
            foreach ($transaction->irrigation_resources as $irrigation_resource){
                        $transaction->irrigation_resources_materials[]=$irrigation_resource;
                        $transaction->irrigation_resources_count=count($transaction->irrigation_resources );
                }
            }

        else{
            $transaction->irrigation_resources ='0';
        }

        return $transaction;
    }


    public static function irrigation_relation($id){
        $result = \DB::table('operation_resources')->where('opertion_type_id', 4)->where('matrial_id',$id)->get();
        return $result;
    }



    public static function MatrielType($id){
        return ModuelsType::where('id',$id)
        ->where('moduel_id',7)
        ->first();
        
    }
}
