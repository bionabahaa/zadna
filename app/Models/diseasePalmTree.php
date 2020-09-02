<?php

namespace App\Models;
use App\Models\Helper;
//use App\Models\Diseases;

use Illuminate\Database\Eloquent\Model;

class diseasePalmTree extends Helper
{
    protected $table='disease_palm_tree';


    public static function transform(diseasePalmTree $items){
        $transaction=new \stdclass();
       $transaction->id=$items->id;
        $transaction->code=$items->code;
        $transaction->disease_id=$items->disease_id;
        $dises=Diseases::where('id',$items->disease_id)->first();
        $transaction->disease_name=$dises->title;
        $transaction->desc=$dises->desc;
        $transaction->box_id=$items->box_id;
        $transaction->plam_tree_id	=$items->plam_tree_id;
        $transaction->user_id=$items->user_id;
        $transaction->recovery_percent	=$items->recovery_percent;
        $transaction->losses_reason	=$items->losses_reason	;
        $transaction->status	=$items->status	;
        $transaction->date	=$items->date	;

        return $transaction;
    }

    public static function transformreport(diseasePalmTree $items){
        $transaction=new \stdclass();
        $transaction->id=$items->id;
        $transaction->modelName='diseasePalmTree';
        $transaction->code=$items->code;
        $transaction->disease_id=$items->disease_id;
        $dises=Diseases::where('id',$items->disease_id)->first();
        $transaction->disease=$dises;
        $transaction->disease_name=$dises->title;
        $transaction->desc=$dises->desc;
        $transaction->box_id=$items->box_id;
        $transaction->plam_tree_id	=$items->plam_tree_id;
        $transaction->user_id=$items->user_id;
        $transaction->recovery_percent	=$items->recovery_percent;
        $transaction->losses_reason	=$items->losses_reason	;
        $transaction->status	=$items->status	;
        $transaction->date=$items->date	;

        $box=self::palmDisease_relation('boxes',$items->box_id,'id');
        foreach ($box as $box){
            $transaction->box=$box;
        }

        $user=self::palmDisease_relation('users',$items->user_id,'id');
        foreach ($user as $user){
            $transaction->user=$user;
        }

        //disease follow on palm
        $transaction->disease_follow=self::palmDisease_relation('disease_follow',$items->code,'disease_code');
        $transaction->disease_follow_count=count($transaction->disease_follow);

        //experiments on palm
        $experiments=\DB::table('experiments')->get();
        foreach ($experiments as $exp){
            $palms_arr=explode(',',$exp->palms);

            if (in_array($items->plam_tree_id,(array)$palms_arr)) {
                $transaction->palm_experiment[]=$exp;
            }
        }

        //seperation on palm
        $separations=\DB::table('separation')->get();
        foreach ($separations as $separation){
            $palms_arr=explode(',',$separation->plam_tree);

            if ($separation->plam_tree==$items->plam_tree_id) {
                $transaction->palm_separations[]=$separation;
            }
        }



        //disease combact plan
        $transaction->disease_combact=self::palmDisease_relation('disease_combact_plan',$items->disease_id,'disease_id');
        $transaction->disease_combact_count=count($transaction->disease_combact);

        //get all resources for diseasePlam
        if(count (self::palmDisease_relation('operation_resources',$items->code,'post_id','moduel_id',15))==true) {
            $transaction->palmDisease_resources = self::palmDisease_relation('operation_resources',$items->code,'post_id','moduel_id',15);
            foreach ($transaction->palmDisease_resources as $palmDisease_resources){
                switch ($palmDisease_resources->opertion_type_id){
                    case 1:
                        $transaction->palm_resources_cost[]=$palmDisease_resources;
                        break;
                    case 2:
                        $transaction->palm_resources_worker[]=$palmDisease_resources;
                        break;
                    case 3:
                        $transaction->palm_resources_equipment[]=$palmDisease_resources;
                        break;
                    case 4:
                        $transaction->palm_resources_material[]=$palmDisease_resources;
                        break;
                }
            }

            $transaction->palmDisease_resourcess_count=count($transaction->palmDisease_resources );
        }else{
            $transaction->palmDisease_resourcess_count ='0';
        }

        //get notes for disease palm
        if(!empty(self::palmDisease_relation('notes',$items->code,'post_id','moduel_id',15))) {
            $transaction->diseasePalm_notes = self::palmDisease_relation('notes',$items->code,'post_id','moduel_id',15);
            $transaction->diseasePalm_notes_count=count( $transaction->diseasePalm_notes);
        }else{
            $transaction->diseasePalm_notes = '0';
        }

        //get all recommendations for disease palm
        if(!empty(self::palmDisease_relation('recommendations',$items->code,'post_id','moduel_id',15))){
            $transaction->diseasePalm_recommendations=self::palmDisease_relation('recommendations',$items->code,'post_id','moduel_id',15);
            $transaction->diseasePalm_recommendations_count=count($transaction->diseasePalm_recommendations);
        }else{
            $transaction->diseasePalm_recommendations='0';
        }

    //calculate cost for disease palm
        $OperationResources=OperationResources::leftJoin('materials','operation_resources.matrial_id','materials.id')
            ->leftJoin('equipments','operation_resources.equipment_id','equipments.id')
            ->where('post_id',$items->code)->where('moduel_id',15)->select(['operation_resources.*','materials.title as "M_title"','equipments.title as "E_title"'])->get();
        $cost=0;
        foreach ($OperationResources as $OperationResources) {
            switch ($OperationResources->opertion_type_id){
                //cost
                case 1:
                    $cost+=$OperationResources->cost;
                    break;
                //worker
                case 2:
                    $cost+=$OperationResources->cost;
                    break;
                //equipment
                case 3:
                    $quuipment=self::palmDisease_relation('equipments',$OperationResources->equipment_id,'id');
                    $cost+=($OperationResources->qyt) * preg_replace("/([^0-9\\.])/i", "", $quuipment[0]->price);
                    break;
                //material
                case 4:
                    $material=self::palmDisease_relation('materials',$OperationResources->matrial_id,'id');
                    $cost+=($OperationResources->qyt) * preg_replace("/([^0-9\\.])/i", "", $material[0]->cost);
                    break;
            }
        }

        $transaction->total_cost=$cost;


        return $transaction;
    }

    //dynamic function for all disease palm relation
    public static function palmDisease_relation($table,$id,$column_name,$module_name=null,$module_value=''){
        $result = \DB::table($table)->where($column_name, $id);
        if(isset($module_name) && isset($module_value)){
            $result= $result->where($module_name,$module_value)->get();
        }else{
            $result=$result->get();
        }
        return $result;
    }


    public static function transformTable(diseasePalmTree $items)
    {
        $palm_tree=diseasePalmTree::where('code',$items->code)->get();
        $transaction=new \stdclass();
        $transaction->box_id=Boxes::where('id',$palm_tree[0]->box_id)->select('code')->first()->code ;
        $transaction->disease_id=$palm_tree[0]->id;
        $transaction->id=$items->code;
        $transaction->code=$items->code;
        $transaction->disease_follow=$items->disease_follow->first();
        $dises=Diseases::where('id',$palm_tree[0]->disease_id)->first();
        $transaction->disease_name=$dises->title;
        $transaction->desc=$dises->desc;
        $transaction->date=date('Y-m-d',strtotime($palm_tree[0]->date));
        $transaction->tree=implode(" , ",$palm_tree->pluck('plam_tree_id')->toArray());
        return $transaction;
    }



    public function disease(){
        return $this->hasOne("App\Models\Diseases",'id','disease_id');
    }

    public function disease_follow(){
        return $this->hasMany("App\Models\diseaseFollow",'disease_code','code')->orderBy('id','desc');
    }
}
