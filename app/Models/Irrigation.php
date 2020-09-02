<?php

namespace App\Models;
use App\Models\Helper;
use App\Models\Boxes;
use Illuminate\Support\Facades\DB;

class Irrigation extends Helper
{
    protected $table = "irrigation";
//    static  $line_types=array("خط رئيسى"=>1, "خط فرعى"=>2, "خط تحت رئيسى"=>3,"خط ثانوى"=>4);
    public static  $line_types=[
        1=>"خط رئيسى",
        2=>"خط فرعى",
        3=>"خط تحت رئيسى",
        4=>"خط ثانوى",
    ];

    public static $del_col="id,signed_file,created_at,line_type_id,Mahbs,boxes";

    public function boxes(){
        return $this->hasMany(BoxIrrugation::class,'irrigation_id','id');
    }

    public function irrg_boxes($id){
        return DB::table('boxes')->where('id',$id)->first();
    }

    public function Mahbs(){
        return $this->hasMany(IrrigationMahbas::class,'irrigation_id','id');
    }


    public static function transform(Irrigation $items){
        
    $transaction=new \stdclass();
    $transaction->id=$items->id;
    $transaction->code=$items->code;
    $transaction->boxs_code='';
    if(!empty($items->boxes)) {
        $i = 0;
        foreach ($items->boxes as $box) {
            $code=Boxes::find($box->box_id);
            $transaction->boxes[$i] = $code->code;
            $transaction->boxs_code.=$code->code.' , ';
            $i++;
        }
    }

    if(empty( $transaction->boxes)){
        $transaction->boxes[]='000';
    }

    $transaction->title=$items->title;
    if($items->signed) {
        $transaction->signed = $items->signed;
    }else{
        $transaction->signed='0';
    }

    $transaction->signed_file=$items->signed_file;
    $transaction->cost=$items->cost;
    $transaction->line_type=self::$line_types[$items->line_type];
    $transaction->line_type_id=$items->line_type;
    $transaction->water_amount=$items->water_amount;
    $transaction->lenght=$items->lenght;
    $transaction->point1=$items->point1;
    $transaction->point2=$items->point2;
    $transaction->diameter_half=$items->diameter_half;
    $transaction->water_speed=$items->water_speed;
    $transaction->Mahbs=$items->Mahbs;
    foreach ($items->Mahbs as $mahbas){
        $transaction->Mahbs_code=$mahbas->code;
    }
    // dd($transaction);
    $transaction->created_at=$items->created_at;
//        dd($transaction);
    return $transaction;
}


//transform for reports
  public static function transformreport(Irrigation $items){
        $transaction=new \stdclass();
        $transaction->modelName='Irrigation';
        $transaction->id=$items->id;

      $transaction->point1= explode('|',$items->point1);
      $transaction->point2= explode('|',$items->point2);
      //point1 coordinate
      $transaction->point1_north=explode(',', $transaction->point1[1]);
      $transaction->point1_east=explode(',', $transaction->point1[2]);

      //point2 coordinate
      $transaction->point2_north=explode(',', $transaction->point2[1]);
      $transaction->point2_east=explode(',', $transaction->point2[2]);
       foreach ($items->boxes as $box){
           $boxes[]=DB::table('boxes')->find($box->box_id);
       }
        $transaction->boxes_in_irrig=$boxes;
        $transaction->code=$items->code;
        $transaction->boxs_code='';
        if(!empty($items->boxes)) {
            $i = 0;
            foreach ($items->boxes as $box) {
                $code=Boxes::find($box->box_id);
                $transaction->boxes[$i] = $code->code;
                $transaction->boxs_code.=$code->code.' , ';
                $i++;
            }
        }
        if(empty( $transaction->boxes)){
            $transaction->boxes[]='000';
        }

        $transaction->title=$items->title;
        if($items->signed) {
            $transaction->signed = 'تم التوقيع';
        }else{
            $transaction->signed='لم يتم التوقيع';
        }
        $transaction->signed_file=$items->signed_file;
        $transaction->cost=$items->cost;
        $transaction->line_type=self::$line_types[$items->line_type];
        $transaction->line_type_id=$items->line_type;
        $transaction->water_amount=$items->water_amount;
        $transaction->lenght=$items->lenght;
        $transaction->point1=$items->point1;
        $transaction->point2=$items->point2;
        $transaction->diameter_half=$items->diameter_half;
        $transaction->water_speed=$items->water_speed;
        if(!empty($items->Mahbs)) {
            $transaction->Mahbs = $items->Mahbs;

            $transaction->Mahbs_count=count($items->Mahbs);
        }else{
            $transaction->Mahbs='0';
        }

       //get faults for irrigation
      if( !empty(self::irrigation_relation('faults',$items->code,'fault_code',null,null)) ) {
          $transaction->irrigation_faults = self::irrigation_relation('faults',$items->code,'fault_code',null,null);
          $transaction->irrigation_faults_count=count($transaction->irrigation_faults);
      }
      else{
          $transaction->irrigation_faults='0';
      }


      //get notes for irrigation
      if(!empty(self::irrigation_relation('notes',$items->id,'post_id',null,null))) {
          $transaction->irrigation_notes = self::irrigation_relation('notes',$items->id,'post_id',null,null);
          $transaction->irrigation_notes_count=count( $transaction->irrigation_notes);
      }else{
          $transaction->irrigation_notes = '0';
      }

      //get all resources for irrigation
      if(!empty(self::irrigation_relation('operation_resources',$items->id,'post_id','moduel_id',12))) {
          $transaction->irrigation_resources = self::irrigation_relation('operation_resources',$items->id,'post_id','moduel_id',12);
          foreach ($transaction->irrigation_resources as $irrigation_resource){
              switch ($irrigation_resource->opertion_type_id){
                  case 1:
                      $transaction->irrigation_resources_cost[]=$irrigation_resource;
                      break;
                  case 2:
                      $transaction->irrigation_resources_worker[]=$irrigation_resource;
                      break;
                  case 3:
                      $transaction->irrigation_resources_equipment[]=$irrigation_resource;
                      break;
                  case 4:
                      $transaction->irrigation_resources_material[]=$irrigation_resource;
                      break;

              }
          }

          $transaction->irrigation_resources_count=count($transaction->irrigation_resources );
      }else{
          $transaction->irrigation_resources ='0';
      }


      //get all recommendations for irrigation
      if(!empty(self::irrigation_relation('recommendations',$items->id,'post_id','moduel_id',12))){
          $transaction->irrigation_recommendations=self::irrigation_relation('recommendations',$items->id,'post_id','moduel_id',12);
          $transaction->irrigation_recommendations_count=count($transaction->irrigation_recommendations);
      }else{
          $transaction->irrigation_recommendations='0';
      }

      $transaction->created_at=$items->created_at;
      return $transaction;
    }


    //dynamic function for all irrigation relation
    public static function irrigation_relation($table,$id,$column_name,$module_name=null,$module_value=''){
        $result = \DB::table($table)->where($column_name, $id);
        if(isset($module_name) && isset($module_value)){
            $result= $result->where($module_name,$module_value)->get();
        }else{
            $result=$result->get();
        }
        return $result;
    }


    //dynamic function for get materials and equipments
    public function get_item($table,$id){
        $var=DB::table($table)->where('id',$id)->first();
       return $var;

    }

}
