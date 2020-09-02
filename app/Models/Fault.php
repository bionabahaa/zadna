<?php

namespace App\Models;

use App\Models\Helper;
use DB;

class Fault extends Helper
{
    protected $table = 'faults';
    public static $del_col="id,created_at,fault_code,fault_status";

    public static $status=[
        1=>'في الانتظار',
        2=>' رفض',
        3=>' قبول',
    ];

    public static function get_fault($code,$type){
        if($type==1){
             $fault=DB::table('wells')->where('code',$code)->pluck('title');
             return $fault;
        }
        else{
            $fault= DB::table('equipments')->where('code',$code)->pluck('title');
            return $fault;
        }
    }

    public static function transform(Fault $items){
        $transaction=new \stdclass();
        $transaction->id=$items->id;
        if($items->type==1){
            $transaction->type='بير';
        }
        elseif ($items->type==2){
            $transaction->type='معدات';
        }
        elseif ($items->type==3){
            $transaction->type='شبكه رى';
        }

        $transaction->fault_code=$items->fault_code;
        $transaction->fault_in=self::get_fault($items->fault_code,$items->type);
        $transaction->desc=$items->desc;
        $transaction->date=$items->date;
        $transaction->fault_status=$items->fault_status	;
        $transaction->status_fault=self::$status[$items->fault_status]	;
        return $transaction;
    }




}
