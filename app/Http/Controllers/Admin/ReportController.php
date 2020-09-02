<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Boxes;
use App\Models\BoxCrops;
use App\Models\BoxesUsers;
use App\Models\Planting;
use App\Models\Crops;
use App\Models\BoxCropPlanting;
use App\Models\Users;
use App\Models\Matriels;
use App\Models\Equipments;
use App\Models\OperationResources;
use App\Models\ModuelDetails;
use App\Models\PlanningIrrigation;
use App\Models\Irrigation;
use App\Models\StoreRequest;
use App\Models\Helper;
// use App\Models\PlanningIrrigation;
use Response;
use DB;

class ReportController extends AdminController
{
    public function __construct() {
		parent::__construct();
    }
    // return reports
    public function index(Request $req){
        $columns=Helper::$report_columns_name;
        $modelName=$req->type;
        $columns_name=[];
        foreach ($columns as $key=>$val) {
            if($key==$modelName){
                $columns_name=$val;
            }
        }
        $this->passing_data['model_attr']=$req;
        $this->passing_data['columns_name']=$columns_name;
        $this->passing_data['modelName']=$modelName;
        return $this->_view('reports', 'index');

    }



    public function dataTable(Request $req,$modelName){

        $model_name = '\App\Models\\'.$modelName;
        $model = new $model_name;
        switch ($modelName){
            case 'Crops':
                $data=$model::whereNull('crop_id')->get();
                break;
            case 'StoreRequest':
                $first_table = Matriels::Join('moduels_type', 'moduels_type.id', 'materials.material_type_id')
                    ->select(['materials.id', 'materials.title', 'moduels_type.title as type_title', 'materials.code','materials.cost', 'materials.updated_at', 'materials.QYT as QYT', 'moduels_type.moduel_id']);
                $table = Equipments::Join('moduels_type', 'moduels_type.id', 'equipments.type_id')
                    ->select(['equipments.id', 'equipments.title', 'moduels_type.title as type_title', 'equipments.code','equipments.price', 'equipments.updated_at', 'equipments.QYT as QYT', 'moduels_type.moduel_id'])->union($first_table);
                $data = $table->get();
                break;
            default:
                $data=$model::all();
        }

            $table=$model::transformCollection($data,'report'); //read data from transformreport
//     return($table);
        return \Datatables::of($table)
            ->addColumn('show_report', function ($item) {
                      $back='<i class="report fa fa-eye"  data-id="'.$item->id.'" data-modelName="'.$item->modelName.'"   ></i>';
                      return $back;
            })
            ->rawColumns(['show_report'])
            ->make(true);
    }


    //show report for each item
    public function show_report($id,$view_name){
        $model_name = '\App\Models\\'.$view_name;
        $model = new $model_name;
        $data=$model::where('id',$id)->get();
        $table=$model::transformCollection($data,'report');
        $this->passing_data['info']=$table;
        return $this->_view('reports', $view_name);
    }






}
