<?php


namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Boxes;
use App\Models\Separation;

use App\Models\Matriels;
use App\Models\ModuelsType;
use App\Models\Material_Units;

use App\Models\Equipments;
use App\Models\OperationResources;
use DB;

class SeparationController extends AdminController
{
    public function __construct() {
        parent::__construct();
    }

    protected $rules=[
        'box_id'=>'required',
        'start_date'=>'required',
        'number_of_separation'=>'numeric|min:0',
        'case'=>'required',

    ];

    public function index(Request $req) {
        $this->passing_data['arr'] = Separation::$del_col;
        if($req->reports){
			$this->passing_data['report']=true;
		}else{
			$this->passing_data['report']=0;
		}
        $this->passing_data['Boxes']=Boxes::all();
        return $this->_view('Operations/Separation', 'index');
    }

    public function create(Request $req) {
     
        $this->passing_data['Boxes']=Boxes::all();
        return $this->_view('Operations/Separation', 'create');
    }

    public function store(Request $req) {
        
       

         $validation = $this->validation($this->rules, $req, true);
         if ($validation === true) {
        try {
            $code = Separation::orderBy('created_at', 'desc')->first();
            if (!$code) {
                $code= 1000;
            } else {
                $code= $code->code + 1;
            }
            DB::beginTransaction();
            $Item = new Separation();
            $Item->code = $code;
            $Item->box_id = $req->box_id;
            $Item->plam_tree = $req->plam_tree;
            $Item->start_date = $req->start_date;
            $Item->number_of_separation = $req->number_of_separation;
            $Item->case = $req->case;
            if ($Item->save()) {
                DB::commit();
                $massage = 'تمت عمليه الادخال بنجاح';
                return $this->json('success', $massage, 200);
            } else {
                $massage = 'لم تتم عمليه الادخال';
                return $this->json('warning', $massage);
            }
        } catch (Exception $ex) {
            DB::rollBack();
        }
         } else {
         	return $this->json('warning', $validation);
         }
    }
    public function edit($id) {

        try {
            $Item = Separation::find($id);
            if ($Item) {
                $result = Separation::transform($Item);
                $this->passing_data['info'] = $result;
                $this->passing_data['report'] = false;
                $this->passing_data['materials_type']=ModuelsType::where('moduel_id',7)->get();
                $this->passing_data['materials_unit']=Material_Units::all();
                $this->passing_data['Matriels']=Matriels::all();
                $this->passing_data['Equipments']=Equipments::all();
				$this->passing_data['OperationResources']=OperationResources::leftJoin('materials','operation_resources.matrial_id','materials.id')
				->leftJoin('equipments','operation_resources.equipment_id','equipments.id')
                ->where('post_id',$id)
                ->where('moduel_id',6)
                ->select(['operation_resources.*','materials.title as "M_title"','equipments.title as "E_title"'])
                ->get();

                $this->passing_data['report']=false;

                return $this->_view('Operations/separation', 'edit');
            } else {
                return abort(404);
            }
        } catch (Exception $ex) {
            return abort(500);
        }
    }

    public function update(Request $req)
    {
        $rules=[
            'case'=>'required',
        ];
        $this->rules['id'] = $req->id;
        $validation = $this->validation($rules, $req, true);
        if ($validation === true) {
            try {
                DB::beginTransaction();
                $Item =Separation::where('id',$req->id)->first();
                // $Item->plam_tree = $req->plam_tree;
                $Item->number_of_separation = $req->number_of_separation;
                $Item->case = $req->case;
                $Item->crop_id =$req->crops;
                $Item->size = $req->size;
                $Item->size = $req->size;
                $Item->market_price = $req->market_price;

                if ($Item->save()) {
                    DB::commit();
                    $massage = 'تمت عمليه الادخال بنجاح';
                    return $this->json('success', $massage, 200);
                } else {
                    $massage = 'لم تتم عمليه الادخال';
                    return $this->json('warning', $massage);
                }
            } catch (Exception $ex) {
                DB::rollBack();
            }
        } else {
            return $this->json('warning', $validation);
        }
    }

    public function dataTable(Request $req) {
            $data=Separation::orderBy('created_at','desc');
        if($req->status){

            switch ($req->status){
                case 'all':
                    $data=$data;
                    break;
                case 1:
                    $data = Separation::where('case',1);
                    break;
                case 2:
                    $data = Separation::where('case',2);
                    break;
            }

        }
        if($req->date_from){
            $data =$data->whereDate('created_at','>=',date('Y-m-d',strtotime($req->date_from)));
        }
        if($req->date_to){
            $data =$data->where('created_at','<=',date('Y-m-d',strtotime($req->date_to)));
        }
        $data =$data->get();



        $table = Separation::transformCollection($data);

        return \Datatables::of($table)
            ->addColumn('option', function ($item) {
                if($this->_checkPermission(21,5)) {
                    $back = $this->_editButn($item, 'operation/separation/');
                }else{
                    $back='';
                }

                return $back;
            })
            ->addColumn('created_at', function ($item) {
                $back = date('Y-m-d', strtotime($item->created_at));

                return $back;
            })
            ->addColumn('case', function ($item) {
                if($item->case==1){
                    $back='زرعت';
                }else{
                    $back='بيعت';
                }
                return $back;
            })
            ->rawColumns(['option', 'created_at'])
            ->make(true);
    }
    ////////////////////////////////////////////////////////////
    
}
