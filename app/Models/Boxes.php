<?php

namespace App\Models;

use App\Models\Helper;
use Illuminate\Support\Facades\DB;

class Boxes extends Helper
{
    protected $table = 'boxes';
    public static $del_col="id,signed_file,Users,'Crops',created_at,Crops,type_id,crop_title";
    protected static $BoxesType=[
        1=>'Main',
        2=>'Sub',
    ];

    public static function transform(Boxes $items){
        $transaction=new \stdclass();
        $transaction->id=$items->id;
        $transaction->code=$items->code;
        $transaction->point1=$items->point1;
        $transaction->point2=$items->point2;
        $transaction->point3=$items->point3;
        $transaction->point4=$items->point4;
        if($items->signed) {
            $transaction->signed = $items->signed;
        }else{
            $transaction->signed='0';
        }
        $transaction->signed_file=$items->signed_file;
        $transaction->row=$items->row;
        $transaction->type_id=$items->crop_id; //get id of type(crop)
        //get type crop in box
        // if($items->crop_id != 0){
        //     $transaction->type_crop_in_box=self::type_in_box($items->crop_id); //get type in box
        // }
        $transaction->column=$items->column;
        $transaction->row_count=$items->row_count;
        $transaction->column_count=$items->column_count;
        $transaction->size=$items->size;
        $transaction->note=$items->note;
        $transaction->created_at=$items->created_at;
        $Users=$items->Users;
        $transaction->Users=$Users->pluck('id')->toArray();

        //users work in box
        $transaction->user_in_box=$items->Users;
        $Crops=$items->Crops;
        if(!empty($items->Crops)) {
            foreach ($items->Crops as $crop_id){
                $crops_in_box[] = DB::table('crops')->where('id', $crop_id['crop_id'])->pluck('title')->toArray();
            }
            foreach ($crops_in_box as $crops) {
                $all_crops_in_box[] = $crops[0];
            }
        }
        $Crops=$items->CropsAll;
        foreach ($Crops as $crop){
            $cropsbox[] = $crop->crop_id;
            $rowsbox[] = $crop->rows;
            $columnsbox[] = $crop->columns;
        }
        $transaction->cropsbox=$cropsbox;
        $transaction->rowsbox=$rowsbox;
        $transaction->columnsbox=$columnsbox;
        $transaction->crop_title=$crops_in_box;
        $transaction->crops_in_box=implode(' , ',$all_crops_in_box);
        $transaction->Crops=$Crops->pluck('crop_id')->toArray();
        //get map_earth for use in reports
        $map_earth=DB::table('config')->where('name','box_signature')->pluck('value')->first();
        if(!empty($map_earth)){
            $transaction->map_earth=$map_earth;
        }else{
            $transaction->map_earth='';
        }

        //get operation resorces for box

        if(!empty( self::operation_resource($items->id))){
            $transaction->box_operation_resource=self::operation_resource($items->id);
        }

        return $transaction;
    }

    public static function transformreport(Boxes $items){
        $transaction=new \stdclass();
        $transaction->id=$items->id;
        $transaction->modelName='Boxes';
        $transaction->code=$items->row.$items->column;
        $transaction->point1= explode('|',$items->point1);
        $transaction->point2= explode('|',$items->point2);
        $transaction->point3= explode('|',$items->point3);
        $transaction->point4= explode('|',$items->point4);

        //point1 coordinate
        $transaction->point1_north=explode(',', $transaction->point1[1]);
        $transaction->point1_east=explode(',', $transaction->point1[2]);

        //point2 coordinate
        $transaction->point2_north=explode(',', $transaction->point2[1]);
        $transaction->point2_east=explode(',', $transaction->point2[2]);

        //point3 coordinate
        $transaction->point3_north=explode(',', $transaction->point3[1]);
        $transaction->point3_east=explode(',', $transaction->point3[2]);

        //point4 coordinate
        $transaction->point4_north=explode(',', $transaction->point4[1]);
        $transaction->point4_east=explode(',', $transaction->point4[2]);



        if($items->signed) {
            $transaction->signed = 'تم التوقيع';
        }else{
            $transaction->signed='لم يتم التوقيع';
        }
        $transaction->signed_file=$items->signed_file;
        $transaction->row=$items->row;
        $transaction->column=$items->column;
        $transaction->type_id=$items->crop_id;
        //get type crop in box
        if($items->crop_id != 0){
            $transaction->type_crop_in_box=self::type_in_box($items->crop_id);
        }
        $transaction->row_count=$items->row_count;
        $transaction->column_count=$items->column_count;
        $transaction->size=$items->size;
        $transaction->note=$items->note;
        $transaction->created_at=$items->created_at;
        $Users=$items->Users;
        $transaction->Users=$Users->pluck('id')->toArray();

        //users work in box
        $transaction->user_in_box=$Users;
        $Crops=$items->Crops;
        foreach ($items->Crops as $crop_id){
            $crops_in_box[]=DB::table('crops')->where('id',$crop_id['crop_id'])->get();
        }
        foreach ($crops_in_box as $crop){
            $all_crops_in_box[]=$crop[0]->title;
        }
        $transaction->crop_title=$crops_in_box;
        $transaction->crops_in_box=implode(' , ',$all_crops_in_box);
        $transaction->Crops=$Crops->pluck('crop_id')->toArray();
        //get map_earth for use in reports
        $map_earth=DB::table('config')->where('name','box_signature')->pluck('value')->first();
        if(!empty($map_earth)){
            $transaction->map_earth=$map_earth;
        }else{
            $transaction->map_earth='';
        }

        //get operation resorces for box
        if(!empty( self::operation_resource($items->id))){
            $transaction->box_operation_resource=self::operation_resource($items->id);
        }

        //get all jura in box
            $transaction->all_jura = self::box_relation('jura',$items->id,'box_id');
            $transaction->jura_count=count($transaction->all_jura);

        //get all palms in box
        $transaction->palms= self::box_relation('planting',$items->id,'box_id');
        $transaction->palm_count=count($transaction->palms);


        //get all palms tree in box
        $transaction->palm_tree= self::box_relation('plam_tree',$items->id,'box_id');
        if($transaction->palm_tree) {
            $plam_tree_code=[];
            foreach ($transaction->palm_tree as $palm){
                $crop_code= self::box_relation('crops',$palm->crop_id,'id');
                $plam_tree_code[]=$items->code.'_'.$palm->row.'_'.$palm->column.'_'.$crop_code[0]->code;
            }
            $transaction->palm_code=$plam_tree_code ;
          }

        //get all tasks in box
        $transaction->tasks= self::box_relation('tasks',$items->id,'box_id');
        $transaction->tasks_count=count($transaction->tasks);

        //naturia
        $transaction->nutria= self::box_relation('nutria',$items->id,'box_id');
        $transaction->nutria_count =count($transaction->nutria);

        //diseases in boxes
        $transaction->disease_palm= self::box_relation('disease_palm_tree',$items->id,'box_id');
        $transaction->disease_palm_count =count($transaction->disease_palm);



        ///////         get all operation_production in box         //////

        //cleaning
        $transaction->cleaning= self::box_relation('cleaning',$items->id,'box_id');
        $transaction->cleaning_count=count($transaction->cleaning);

        //fertilizing
        $transaction->fertilizing=self::box_relation('fertilizing',$items->id,'box_id');
//        $transaction->material=self::box_relation('materials',1,'id');
        $transaction->fertilizing_count=count($transaction->fertilizing);

        //protection
        $transaction->protection= self::box_relation('protection',$items->id,'box_id');
        $transaction->protection_count=count($transaction->protection);

        //separation
        $transaction->separation= self::box_relation('separation',$items->id,'box_id');
        $transaction->separation_count=count($transaction->separation);

        //harvest
        $transaction->harvest= self::box_relation('harvest',$items->id,'box_id');
        $transaction->harvest_count=count($transaction->harvest);

        return $transaction;
    }



    public function material($id){
        return DB::table('materials')->where('id',$id)->first();
    }

    public function Crops(){
        return $this->hasMany('App\Models\BoxCrops', 'box_id','id')->select('crop_id');
    }
    public function CropsAll(){
        return $this->hasMany('App\Models\BoxCrops', 'box_id','id');
    }
    public function Users(){
        return $this->belongsToMany('App\Models\Users','user_box','box_id','user_id');
    }
    public function Irrigation(){
        return $this->belongsTo('App\Models\Irrigation', 'irrigation_id');
    }
    public static function type_in_box($id){
        return Crops::where('id',$id)->first();
    }
    public static function operation_resource($id){
        return OperationResources::where('post_id',$id)->get();
    }

    //dynamic function for all boxe relation
    public static function box_relation($table,$id,$column_name){
            $result = \DB::table($table)->where($column_name, $id)->get();
            return $result;
    }




}
