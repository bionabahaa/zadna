<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use App\Models\BoxCrops;
use App\Models\Boxes;
use App\Models\Users;
use App\Models\BoxesUsers;
use App\Models\Crops;
use App\Models\Matriels;
use App\Models\Equipments;
use App\Models\OperationResources;
use App\Models\BoxCropPlanting;
use DB;
use http\Env\Response;
use Illuminate\Http\Request;

class CostsController extends AdminController
{
    private $rules = [
		'box_id' => 'required',
		'start_date' => 'required',
	];

    public static $operation_type_genral=[
        10=>'الابار',
        11=>'المربعات',
        12=>'شبكه الرى',
        13=>'التجارب',
    ];

	public function __construct() {
		parent::__construct();
	}

	public function index(Request $req) {
        $this->passing_data['arr'] = OperationResources::$del_col;
        $this->passing_data['bath']=url('public/images/Uploads/config');
               if($req->generall){
                       if($req->status){
                           switch ($req->status){
                               case 'all':
                                   $table = OperationResources::select('moduel_id as id', \DB::raw('sum(cost) as total'))
                                       ->whereIn('moduel_id', array_keys(OperationResources::$operation_type_genral))
                                       ->whereNull('box_id')
                                       ->groupBy('moduel_id');
                                   break;
                               default:
                                   $table =OperationResources::select('moduel_id as id',\DB::raw('sum(cost) as total'))
                                       ->where('moduel_id',$req->status)
                                       ->whereNull('box_id')
                                       ->groupBy('moduel_id');
                           }

                           if($req->date_from){
                               $table =$table->whereDate('datetime','>=',date('Y-m-d',strtotime($req->date_from)));
                           }
                           if($req->date_to){
                               $table =$table->where('datetime','<=',date('Y-m-d',strtotime($req->date_to)));
                           }
                           $table=$table->get();
                           $res='';
                           foreach ($table as $value){
                              $total_value=$value->total?$value->total:'0';
                               $res.='
                               <tr>
                                    <td> '.OperationResources::$operation_type_genral[$value->id].' </td>
                                    <td> '.$total_value.' </td>
                                    <td class="query-td">
                                        <a href=" '.url('costs/boxes/'.$value->id.'/edit?generall=1').' " class="text-dark">
                                            <i class="fas fa-eye view-row"></i>
                                        </a>
                                    </td>
                             </tr>
                             
                                ';
                           }
                           return Response()->json(['res'=>$res]);

                       }

                   else {
                            $this->passing_data['operation_type'] = OperationResources::$operation_type_genral;
                            // dd($this->passing_data['operation_type']);
                            $table = OperationResources::select('moduel_id as id', \DB::raw('sum(cost) as total'))
                                ->whereIn('moduel_id', array_keys(OperationResources::$operation_type_genral))
                                ->whereNull('box_id')
                                ->groupBy('moduel_id')
                                ->get();
                            $this->passing_data['data'] = $table;
                            return $this->_view('Costs', 'generall');
                        }
        }
        else{
            $this->passing_data['level_id']=$req->level_id;
            $this->passing_data['Boxes']=Boxes::all();
            $this->passing_data['PalmTree']=BoxCropPlanting::get();
            // dd($this->passing_data['PalmTree']);
            return $this->_view('Costs', 'index');
        }
		
    }
    
    public function create(Request $req) {
        $this->passing_data['bath']=url('public/images/Uploads/config');
        $this->passing_data['Boxes']=Boxes::all();
		return $this->_view('Cleaning', 'index');
    }
    public function edit(Request $req,$id){
        $this->passing_data['operation_type']=OperationResources::$operation_type;
        if($req->generall){
            $data=OperationResources::leftJoin('materials','operation_resources.matrial_id','materials.id')
            ->leftJoin('equipments','operation_resources.equipment_id','equipments.id')
            ->where('moduel_id',$id)->select(['operation_resources.*','materials.title as "M_title"','equipments.title as "E_title"'])->get();
           
            $this->passing_data['OperationResources']=$data;
            return $this->_view('Costs', 'edit_general');
        }else{
            $data=OperationResources::leftJoin('materials','operation_resources.matrial_id','materials.id')
            ->leftJoin('equipments','operation_resources.equipment_id','equipments.id')
            ->where('box_id',$id)->select(['operation_resources.*','materials.title as "M_title"','equipments.title as "E_title"'])->get();
            // dd($data);.
            if($data){
                $data=$data->groupBy('moduel_id')->toArray();
            }
            // dd($data);
            
            $this->passing_data['OperationResources']=$data;
            // dd(OperationResources::transformMainTable());
            return $this->_view('Costs', 'edit');
        }
    }
    public function dataTable(Request $req){
        if($req->generall){
            $data =OperationResources::select(['moduel_id as id',\DB::raw('sum(cost) as total')])
            ->whereIn('moduel_id',array_keys(OperationResources::$operation_type_genral))
            ->whereNull('box_id')
            ->groupBy('moduel_id');
            if($req->status) {
                if($req->status=='all'){
                    $data=$data;
                }
                else{
                $data = OperationResources::select(['moduel_id as id', \DB::raw('sum(cost) as total')])
                    ->where('moduel_id', $req->status)
                    ->groupBy('moduel_id');
            }
            }



            return \Datatables::of($data)
            ->addColumn('option', function ($item) {
                if($this->_checkPermission(36,3)) {
                    $back = $this->_editButn($item, 'costs/boxes');
                }else{
                    $back='';
                }
                return $back;
            })
            ->rawColumns(['option'])
            ->make(true);
        }else{
            $table =OperationResources::select(['box_id as id',\DB::raw('sum(cost) as total'),\DB::raw('(select count(*) from plam_tree WHERE box_id=operation_resources.box_id) as "count_plam_tree"')])
            ->whereIn('moduel_id',array_keys(OperationResources::$operation_type))
            ->whereNotNull('box_id')
            ->groupBy('box_id')
            ->get();
            return \Datatables::of($table)
            ->addColumn('option', function ($item) {
                if($this->_checkPermission(35,3)) {
                    $back = $this->_editButn($item, 'costs/boxes');
                }else{
                    $back='';
                }
                // $back .= $this->_deleteBtn($item);

                return $back;
            })
            ->addColumn('code', function ($item) {
                $box =Boxes::where('id',$item->id)->first();
                $back=$box->code;
                return $back;
            })
            ->rawColumns(['option','code'])
            ->make(true);
        }
       
    }

    public function plam_tree_index(){
        return $this->_view('Costs', 'plamTree');
    }
    public function palm_tree_cost(Request $req){
        $array_details=explode("_", $req->palm_tree);
        $box_code=$array_details[0];
        
        $box_id=Boxes::where('code',$box_code)->first();
        $sum_opertion_box=OperationResources::where('box_id', $box_id->id)
        ->sum('cost');
        $sum_opertion_box2=OperationResources::where('palm_tree',$req->palm_tree)
        ->sum('cost');
        $count_plam=$box_id->column_count*$box_id->row_count;
        echo ($sum_opertion_box/$count_plam)+$sum_opertion_box2;

    }
}
