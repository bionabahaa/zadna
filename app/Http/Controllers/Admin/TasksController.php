<?php


namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\AdminController;
use App\Models\Users;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tasks;
use App\Models\Boxes;
use App\Models\Matriels;
use App\Models\OperationResources;
use App\Models\Equipments;
use DB;

class TasksController extends AdminController
{
    public function __construct() {
		parent::__construct();
    }
    
    public function index(){
        $this->passing_data['Types']=Tasks::$task_type;
        $this->passing_data['Boxes']=Boxes::all();
        return $this->_view('Mission/', 'index');
    }
    public function edit(Request $req,$id){
        try {
            $data=Tasks::where('id',$id)->first();
            $this->passing_data['Types']=Tasks::$task_type;
            $this->passing_data['Boxes']=Boxes::all();
            $this->passing_data['info']=Tasks::transform($data);
            $this->passing_data['Matriels']=Matriels::all();
            $this->passing_data['Equipments']=Equipments::all();
            $this->passing_data['OperationResources']=OperationResources::leftJoin('materials','operation_resources.matrial_id','materials.id')
            ->leftJoin('equipments','operation_resources.equipment_id','equipments.id')
            ->where('post_id',$id)->where('moduel_id',15)->select(['operation_resources.*','materials.title as "M_title"','equipments.title as "E_title"'])->get();
            // dd($this->passing_data['data']);
            $this->passing_data['show']=true;
            if($req->type){
                $this->passing_data['show']=false;
            }
			return $this->_view('Mission/', 'edit');
		} catch (Exception $ex) {
			return abort(500);
		}
    }
    public function store(Request $req){
        if($this->addTask2($req->toArray())){
            $massage = 'تمت عمليه التعديل بنجاح';
            return $this->json('success', $massage, 200);
        }else{
            $massage = 'لم تتم عمليه التعديل';
            return $this->json('warning', $massage);
        }
    }
    public function update(Request $req){
        // dd($req);
        $Item=Tasks::where('id',$req->id)->first();
        $Item->status = 3;
        if ($Item->save()) {
            $massage = 'تمت عمليه التعديل بنجاح';
            return $this->json('success', $massage, 200);
        } else {
            $massage = 'لم تتم عمليه التعديل';
            return $this->json('warning', $massage);
        }
    }
    public function dataTable(Request $req){
        $data=Tasks::orderBy('created_at','desc');
        if($req->status){
            switch ($req->status){
                case 'all':
                    $data=$data;
                    break;
                case 1:
                    $data = $data->where('task_type_id',1);
                    break;
                case 2:
                    $data =$data->where('task_type_id',2);
                    break;
                case 3:
                    $data =$data->where('task_type_id',3);
                    break;
            }

        }
        if($req->date_from){
            $data =$data->whereDate('implementation_at','>=',date('Y-m-d',strtotime($req->date_from)));
        }
        if($req->date_to){
            $data =$data->where('implementation_at','<=',date('Y-m-d',strtotime($req->date_to)));
        }
        $data =$data->get();


        $table=Tasks::transformCollection($data);
        return \Datatables::of($table) 
			->addColumn('option', function ($item) {
                if($this->_checkPermission(33,4)) {
                    $back = $this->_editButn($item, 'missions/tasks/');
                }
                else{
                    $back='';
                }


                if ($item->status_id == 2 && !$item->seen) {
                        if ($this->_checkPermission(33, 6)) {
                            $back .= '<i class="fas fa-ban  stop" title="ايقاف المهمة" style="cursor:pointer" onclick="showStopModel(' . $item->id . ')"></i>';
                        }
                        else{
                            $back.='';
                        }
                    }



                
				return $back;
			})
			->addColumn('created_at', function ($item) {
				$back = date('Y-m-d', strtotime($item->created_at));

				return $back;
			})
			->rawColumns(['option', 'created_at'])
			->make(true);
    }
}
