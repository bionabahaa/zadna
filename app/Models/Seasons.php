<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Helper;

class Seasons extends Helper
{
    protected $table = "seasons";
    


    public static function transform(Seasons $items){
        $transaction=new \stdclass();
        $transaction->id=$items->id;
        $transaction->code=$items->code;
        $transaction->title=$items->title;
        $transaction->season_start=$items->season_start;
        $transaction->season_end=$items->season_end;
        $transaction->created_at=$items->created_at;
        return $transaction;
    }

    public static function CounterReports($start_date='',$end_date=''){
        if($start_date==''){
            $start_date=date('Y-m-d',strtotime(date('Y').'-1-1'));
        }
        if($end_date==''){
            $end_date=date('Y-m-d',strtotime(date('Y').'-12-31'));
        }
        // dd($end_date);
        $array=[];
        $array['operation_planting']=Planting::whereBetween('start_date',[$start_date,$end_date])->count();
        $array['operation_cleaning']=Cleaning::whereBetween('start_date',[$start_date,$end_date])->count();
        $array['operation_fertilizings']=Fertilizings::whereBetween('start_date',[$start_date,$end_date])->count();
        $array['operation_protections']=Protections::whereBetween('start_date',[$start_date,$end_date])->count();
        $array['operation_sunstainable_operations']=SunstainableOperations::whereBetween('start_date',[$start_date,$end_date])->count();
        $array['operation_harvests']=Harvests::whereBetween('date',[$start_date,$end_date])->count();

        $array['task_done']=Tasks::whereBetween('created_at',[$start_date,$end_date])->where('status',1)->count();
        $array['task_not_done']=Tasks::whereBetween('created_at',[$start_date,$end_date])->where('status',2)->count();
        $array['task_waiting']=Tasks::whereBetween('created_at',[$start_date,$end_date])->where('status',0)->count();
        $array['task_all']=$array['task_done']+$array['task_not_done']+$array['task_waiting'];

        $array['store_one']=StoreRequest::whereBetween('order_date',[$start_date,$end_date])
        ->where('type_id',1)->where('status_id',3)->sum('qyt');
        $array['store_one_not']=StoreRequest::whereBetween('order_date',[$start_date,$end_date])
        ->where('type_id',1)->where('status_id',1)->sum('qyt');
        $array['store_two']=StoreRequest::whereBetween('order_date',[$start_date,$end_date])
        ->where('type_id',2)->where('status_id',3)->sum('qyt');
        $array['store_two_not']=StoreRequest::whereBetween('order_date',[$start_date,$end_date])
        ->where('type_id',2)->where('status_id',1)->sum('qyt');
        $array['store_three']=StoreRequest::whereBetween('order_date',[$start_date,$end_date])
        ->where('type_id',3)->where('status_id',3)->sum('qyt');
        $array['store_three_not']=StoreRequest::whereBetween('order_date',[$start_date,$end_date])
        ->where('type_id',3)->where('status_id',1)->sum('qyt');

        $array['users_permanent']=Users::whereBetween('hiring_date',[$start_date,$end_date])->where('type_id',1)->count();
        $array['users_temporar']=Users::whereBetween('hiring_date',[$start_date,$end_date])->where('type_id',0)->count();
        $array['costs_box']=OperationResources::whereBetween('datetime',[$start_date,$end_date])->whereIn('moduel_id',array_keys(OperationResources::$operation_type))->sum('cost');
        $array['costs_all']=OperationResources::whereBetween('datetime',[$start_date,$end_date])->whereIn('moduel_id',array_keys(OperationResources::$operation_type_genral))->sum('cost');
        $array['disease_done']=count(diseasePalmTree::select('disease_id')
        ->where(function($query){
            $query->where('status',1)->where('recovery_percent',100);
        })
        ->whereBetween('date',[$start_date,$end_date])
        ->groupBy('disease_id')
        ->get());
        $array['disease_not_done']=count(diseasePalmTree::select('disease_id')
        ->where(function($query){
            $query->where('status',2);
        })
        ->whereBetween('date',[$start_date,$end_date])
        ->groupBy('disease_id')
        ->get());
        $array['disease_all']=$array['disease_done']+$array['disease_not_done'];
        // diseasePalmTree::where()
        // dd($array);
        return $array;

    }
}
