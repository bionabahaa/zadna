<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Helper;
class diseaseFollow extends Helper
{
    protected $table='disease_follow';
    public static function transform(diseaseFollow $items){
        $transaction=new \stdclass();
        $transaction->id=$items->id;
        $transaction->code=$items->code;
        $transaction->note=$items->note;
        $transaction->note_date=$items->note_date;
        $transaction->writen_by=$items->writen_by;
        $transaction->created_at=$items->created_at;
        return $transaction;
    }
}
