<?php

namespace App\Models;

use App\Models\Helper;

class Moduels extends Helper
{
    protected $table = "moduels";

    public static function transform(Moduels $items){
        // dd(json_decode($items->operations));
        $transaction=new \stdclass();
        $transaction->id=$items->id;
        $transaction->title=$items->title;
        $transaction->controller=$items->controller;
        $transaction->order=$items->this_order;
        $transaction->icone=$items->icone;
        $transaction->active=$items->active;
        $transaction->config=json_decode($items->config);
        $transaction->operations=json_decode($items->operations);
        $transaction->permissions=json_decode($items->Permissions->permissions);
        $transaction->feature=$items->feature;
        if($items->moduel_id){
            $transaction->belongs_id=$items->moduel_id;
            $transaction->belongs_title=$items->moduel->title;
        }else{
            $transaction->belongs_id='';
            $transaction->belongs_title='';
        }
        $transaction->created_at=$items->created_at;
        // dd($transaction);
        return $transaction;
    }
    public function moduel(){
        return $this->belongsTo('App\Models\Moduels', 'moduel_id');
    }
    public function permissions(){
        return $this->hasOne('App\Models\Permissions', 'moduel_id');
    }
    public function feature(){
        return $this->hasMany('App\Models\Features', 'moduel_id')->where('active',0);
    }
}
