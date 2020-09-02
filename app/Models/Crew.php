<?php

namespace App\Models;
use App\Models\Helper;
use Illuminate\Database\Eloquent\Model;


class Crew extends Helper
{
    protected $table = "crew";
    public static $del_col="id,user_id,gender,crew_id,nationality";

    public  static $nationality=[1=>'مصرى',2=>'سعودى',3=>'ايطالى',4=>'سورى'];
    public function user()
    {
        return $this->belongsTo('App\Models\Users', 'user_id');
    }
    public static function get_username($id){
        $t=Crew::find($id);
       return $t->user->username;
    }
    public function user_notes()
    {
        return $this->hasMany('App\Models\UserNote', 'user_id','user_id');
    }
        public static function transform(Crew $items){
            $transaction=new \stdclass();
            $transaction->id=$items->id;
            $transaction->user_id=$items->user_id;
            $transaction->username=$items->user->username;
            $transaction->crew_id=$items->crew_id;
            if($items->crew_id) {
                $transaction->responsible_from=self::get_username($items->crew_id);
            }
            else{
                $transaction->responsible_from='مش مسئول من احد';
            }
            $transaction->gender=$items->gender;
            $transaction->user_gender=$items->gender==1?'ذكر':'انثى';
            if($items->user->process){
                $transaction->process = $items->user->process;
            }
            if($items->day_work_num) {
                $transaction->day_work_num = $items->day_work_num;
            }
            $transaction->hire_date=$items->user->hiring_date;
            $transaction->nationality=$items->nationality;
            $transaction->user_nationality=self::$nationality[$items->nationality];
            $transaction->cost_by_day=$items->cost_by_day;
            if($items->cost_by_month) {
                $transaction->cost_by_month = $items->cost_by_month;
            }
            if($items->total_cost) {
                $transaction->total_cost = $items->total_cost;
            }
            $transaction->birthdate=$items->birthdate;
            $transaction->note=$items->note;
            $transaction->created_at=$items->created_at;
            return $transaction;
        }

}
