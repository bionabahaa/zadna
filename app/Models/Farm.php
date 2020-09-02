<?php

namespace App\Models;
use App\Models\Helper;
use Illuminate\Database\Eloquent\Model;

class Farm extends Helper
{
    protected $table = 'farms';


    public static function transformreport(Farm $items){
        $transaction=new \stdclass();
        $transaction->id=$items->id;
        $transaction->modelName='Farm';
        $transaction->title=$items->title;
        $transaction->location=$items->location;
        $transaction->area=$items->area;
        $transaction->creation_date=$items->creation_date;
        $transaction->map_farm=$items->map_farm;

        //boxes in farm
        $transaction->boxes=self::farm('boxes');
        $transaction->boxe_count=count($transaction->boxes);

        //crops_type in farm
        $transaction->crops=self::farm('crops');
        $transaction->crop_count=count($transaction->crops);

        //crops_in farm
        $transaction->crops_in_type= \DB::table('crops')->whereNotNull('crop_id')->get();
        $transaction->crops_in_type_count=count($transaction->crops_in_type);

        //faultsin farm
        $transaction->faults=self::farm('faults');
        $transaction->faults_count=count($transaction->faults);


        return $transaction;
    }

//    farm_relation
    public static function farm($table){
        if($table=='crops'){
            $result = \DB::table($table)->whereNull('crop_id')->get();
        }
        else {
            $result = \DB::table($table)->get();
        }
        return $result;
    }

}
