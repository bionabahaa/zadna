<?php

namespace App\Models;

use App\Models\Helper;
use App\Models\ModuelDetails;
use App\Models\Matriels;
use Illuminate\Support\Facades\DB;

class Wells extends Helper
{
    protected $table = "wells";
    public static $del_col="id,created_at,signed_file,geological_profile_file,water_analysis_file,WellTest,Pipes,External_pipes_coating,status,Generator,Trumpet";

    public static $type_well = [
        1=>"تحت الدراسه",
        2=>"تحت التنفيذ",
        3=>"تم التنفيذ",
    ];
    public static function transform(Wells $items){
        $transaction=new \stdclass();
        $transaction->id=$items->id;
        $transaction->code=$items->code;
        $transaction->location=$items->location;
        $transaction->well_status=self::$type_well[$items->status];
        $transaction->status=$items->status;
        if($items->signed) {
            $transaction->signed = $items->signed;
        }else{
            $transaction->signed ='0';
        }
        $transaction->signed_file=$items->signed_file;
        $transaction->title=$items->title;
        $transaction->note=$items->note;
        $transaction->geological_profile_file=$items->geological_profile_file;
        $transaction->date_of_excavation=date('Y-m-d',strtotime($items->date_of_excavation));
        foreach(ModuelDetails::$FieldsWells as $value){
            $data=self::WellsDetails($items->id,$value);
            if($data){
                $transaction->$value=$data->value;
            }else{
                $transaction->$value=null;
            }
        }
        $transaction->created_at=$items->created_at;
        $transaction->WellTest=self::WellTest($items->id);
        foreach(WellTecSpecification::$Type as $key=>$value){
            $transaction->$value=$items->WellTecSpecification($key)->get();
        }
        return $transaction;
    }


//    report transform
    public static function transformreport(Wells $items){
        $transaction=new \stdclass();
        $transaction->id=$items->id;
        $transaction->modelName='Wells';
        $transaction->code=$items->code;
        $transaction->location=$items->location;
        $transaction->well_status=self::$type_well[$items->status];
        $transaction->status=$items->status;
        if($items->signed) {
            $transaction->signed = 'تم التوقيع';
        }else{
            $transaction->signed ='لم تم التوقيع';
        }
        if(isset($items->signed_file)) {
            $transaction->signed_file = $items->signed_file;
        }else{
            $transaction->signed_file='لا يوجد ملف';
        }
        $transaction->title=$items->title;
        $transaction->note=$items->note;
        $transaction->geological_profile_file=$items->geological_profile_file;
        $transaction->date_of_excavation=date('Y-m-d',strtotime($items->date_of_excavation));
        foreach(ModuelDetails::$FieldsWells as $value){
            $data=self::WellsDetails($items->id,$value);
            if($data){
                $transaction->$value=$data->value;
            }else{
                $transaction->$value=null;
            }
        }
        $transaction->created_at=$items->created_at;
        $transaction->WellTest=self::WellTest($items->id);
        foreach(WellTecSpecification::$Type as $key=>$value){
            $transaction->$value=$items->WellTecSpecification($key)->get();
        }

//   well mainentance
        $transaction->well_mainentance=self::well_relation('moduels_test',$items->id,'post_id','moduel_id',8);
        $transaction->well_mainentance_count=count($transaction->well_mainentance);

//   well pipe
        $transaction->well_pipe=self::well_relation('well_tec_specifications',1,'tec_type','well_id',$items->id);
        $transaction->well_pipe_count=count($transaction->well_pipe);

//   well external pipe
        $transaction->well_external_pipe=self::well_relation('well_tec_specifications',2,'tec_type','well_id',$items->id);
        $transaction->well_external_pipe_count=count($transaction->well_external_pipe);

//   well generator
        $transaction->well_generator=self::well_relation('well_tec_specifications',3,'tec_type','well_id',$items->id);

        $transaction->well_generator_count=count($transaction->well_generator);

//   well tramp
        $transaction->well_tramp=self::well_relation('well_tec_specifications',4,'tec_type','well_id',$items->id);
        $transaction->well_tramp_count=count($transaction->well_tramp);

//   well faults
        $transaction->well_faults=self::well_relation('faults',$items->code,'fault_code','type',1);
        $transaction->well_fault_count=count($transaction->well_tramp);

        return $transaction;

    }

    //dynamic function for all well relation
    public static function well_relation($table,$id,$column_name,$module_name=null,$module_value=''){
        $result = \DB::table($table)->where($column_name, $id);
        if(isset($module_name) && isset($module_value)){
            $result= $result->where($module_name,$module_value)->get();
        }else{
            $result=$result->get();
        }
        return $result;
    }


    public static function transformTecSpecifications($items){
        $transaction=new \stdclass();
        $transaction->id=$items->id;
        $transaction->code=$items->code;
        $transaction->title=$items->title;
        $transaction->repetition=$items->test_num.' '.$items->test_duration;
        $transaction->datetime=date('Y-m-d',strtotime($items->datetime));
        $transaction->extension=$items->extension;
        $transaction->created_at=$items->created_at;
        return $transaction;
    }
    public static function WellsDetails($post_id,$name){
        return ModuelDetails::where('post_id',$post_id)
        ->where('moduel_id',8)
        ->where('name',$name)
        ->first();
    }
    public static function WellTest($post_id){
        return ModuelsTest::where('post_id',$post_id)
        ->where('moduel_id',8)
        ->get();
    }
    public function WellTecSpecification($type_id){
        return $this->hasMany('App\Models\WellTecSpecification', 'well_id')->where('tec_type',$type_id);
    }
}
