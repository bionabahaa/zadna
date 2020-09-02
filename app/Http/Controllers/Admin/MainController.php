<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use App\Models\diseaseFollow;
use App\Models\diseasePalmTree;
use App\Models\Diseases;
use DB;
use Illuminate\Http\Request;
use App\Models\Jura;
use App\Models\OperationResources;
use App\Models\RolePermission;
use App\Models\Crew;
use App\Models\Fault;
use App\Models\StoreRequest;
use App\Models\Tasks;
use App\Models\Users;
use App\Models\Seasons;
use App\Models\Recommendtions;
use App\Models\ModuelDetails;
use Auth;
class MainController extends AdminController
{
    public function __construct() {
		parent::__construct();
	}

	public function index(Request $req) {
        //dd(Auth::user());
        $user=Auth::user()->id;
        $this->passing_data['count_tasks_Done']=Tasks::where('status',1)->where('to_id',$user)->count();
        $this->passing_data['count_tasks_Notdone']=Tasks::where('status',2)->where('to_id',$user)->count();
        $this->passing_data['count_tasks_Wateing']=Tasks::where('status',0)->where('to_id',$user)->count();

        $this->passing_data['count_worker_Permanent']=Users::where('type_id',1)->count();
        $this->passing_data['count_worker_Temporary']=Users::where('type_id',2)->count();

        $this->passing_data['count_recommendation']=Recommendtions::where('from_id',$user)->whereNull('recommendation_id')->count();
        $data=Recommendtions::select('id')->where('from_id',$user)->get();
        if(!$data){
            $this->passing_data['count_replay_recommendation']=0;
        }else{
            $this->passing_data['count_replay_recommendation']=Recommendtions::whereIn('recommendation_id',$data)->count();
        }
        $start_date=date('Y-m-d');
        $this->passing_data['reports']=Seasons::CounterReports($start_date,'');
        if(in_array(Auth::user()->role_id,[1,2])){
            $this->passing_data['show_reports']=true;
        }else{
            $this->passing_data['show_reports']=false;
        }
        $this->passing_data['bath']=url('public/images/Uploads/config');
        //get all diseases
        $data =diseasePalmTree::select('code')
            ->groupBy('code')->get();
        $diseases = diseasePalmTree::transformCollection($data,'Table');
        $this->passing_data['diseases']=$diseases;
        //get all faults
        $faults=Fault::all();
        $faults=Fault::transformCollection($faults);
        $this->passing_data['faults']=$faults;

        //get all orders
        $orders = OperationResources::whereIn('opertion_type_id', [3, 4])
            ->where('store_done', 0)->get();
        $orders=OperationResources::transformCollection($orders);
        $this->passing_data['orders']=$orders;

        //get all exports
        $exports=StoreRequest::all();
        $exports=StoreRequest::transformCollection($exports);
        $this->passing_data['exports']=$exports;






		return $this->_view('Main', 'index');
    }


    public function get_palms($id){
        $palms=diseasePalmTree::where('disease_id',$id)->pluck('plam_tree_id');
           return $palms;
    }

    public function get_diseaseFollow($id){
        $palms=diseaseFollow::where('disease_id',$id)->pluck('plam_tree_id');
        return $palms;
    }



    public function profile(){
        $data=Users::find(Auth::user()->id);
        $this->passing_data['info']=Users::transform($data);
        // dd($this->passing_data['info']);
        return $this->_view('Main', 'profile');
    }
    public function get_tasks(){
        $user=Auth::user()->id;
        $tasks=Tasks::whereIn('status',[0,1,2])->where('to_id',$user)->get();
        $this->passing_data['tasks']=Tasks::transformCollection($tasks);
        // dd($this->passing_data['tasks']);
        $this->passing_data['bath']=url('public/images/Uploads/config');
		return $this->_view('Main', 'tasks');
    }
}
