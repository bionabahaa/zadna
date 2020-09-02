<?php

namespace App\Models;
use App\Models\Helper;

use Illuminate\Database\Eloquent\Model;

class UserNote extends Helper
{
    protected $table = "user_notes";

    public static function transform(UserNote $items){
        $transaction=new \stdclass();
        $transaction->id=$items->id;
        $transaction->code=$items->code;
        $transaction->user_id=$items->user_id;
        $transaction->note=$items->note;
        $transaction->added_from=$items->added_from;
        $transaction->job=$items->job;
        $transaction->process=$items->process;
        $transaction->date=$items->date;
        $transaction->created_at=$items->created_at;
        return $transaction;
    }
}
