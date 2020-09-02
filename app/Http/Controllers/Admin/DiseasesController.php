<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\AdminController;
use App\Models\Boxes;
use App\Models\DiseaseDetail;
use App\Models\diseasePalmTree;
use App\Models\Diseases;
use App\Models\DiseaseCombatPlan;
use App\Models\DiseaseCombatPlanDetail;
use App\Models\diseaseFollow;
use App\Models\BoxCropPlanting;
use App\Models\Users;
use App\Models\Matriels;
use App\Models\DiseasePlanMaterial;
use App\User;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Models\Equipments;
use App\Models\OperationResources;
use App\Http\Controllers\Controller;
use Excel;
use DB;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Stmt\Return_;

class DiseasesController extends AdminController {
    private  $rules=[
        'disease_id'=>'required',
        'box_id'=>'required',
        'palms'=>'required',
        'date'=>'required',
        'user_id'=>'required'
    ];
    public function __construct() {
        parent::__construct();
    }

    public function index(Request $req) {

        return $this->_view('Diseases', 'diseases');
    }

    public function getview($disease_view){
        $this->passing_data['boxes']=Boxes::all();
        $this->passing_data['diseases']=Diseases::all();
        $this->passing_data['users']=Users::all();
//        $this->passing_data['disease_status']=diseasePalmTree::where('')
        if ( Request()->ajax() )
        {
            $disease_detail=Diseases::find(Request("disease_id"))->disease_detail;
            return Response()->json(['disease_detail'=>$disease_detail]);
        }else{
            return $this->_view('Diseases', $disease_view);
        }

    }


    public function add_new_disease(Request $req)
    {
        $rule = [
            'title' => 'required',
            'desc' => 'required',
        ];
        $array=['xlsx','xlsm','xlsb','xltx','xltm','xls','xlt','xml','xlam','xla','xlw','xlr'];
        if ($req->hasFile('import_excel')) {
           $path=$req->import_excel->getRealPath();
           $extension = $req->file('import_excel')->getClientOriginalExtension();
            if (in_array($extension,$array)) {
                $data = Excel::load($path)->get();

                if (!empty($data)) {
                    foreach ($data[0] as $key => $value) {
                        $insert[] = ['title' => $value['title'], 'desc' => $value['desc'],'created_at'=>date('Y-m-d H:i:s')];
                    }
                }
                $insert=DB::table('diseases')->insert($insert);
                if ($insert) {
                    DB::commit();
                    $massage = 'تمت عمليه الادخال بنجاح';
                    return $this->json('success', $massage, 200);
                }
            }
            else{
                Session::flash('invalid_format','Please choose invalid excel format');
            }
        }

        else {
            $validation = $this->validation($rule, $req, true);
            if ($validation === true) {
                try {
                    DB::beginTransaction();
                    $Item = new Diseases();
                    $Item->title = strip_tags($req->title);
                    $Item->desc = strip_tags($req->desc);

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
    }
    public function store(Request $req) {
        $validation = $this->validation($this->rules, $req, true);
        if($validation===true) {
            try {
                $code = diseasePalmTree::orderBy('id', 'desc')->first();
                if (!$code) {
                    $code = 1000;
                } else {
                    $code = $code->code + 1;
                }
                DB::beginTransaction();

                if($req->palms) {
                    foreach ($req->palms as $palm) {
                        $Item = new diseasePalmTree();
                        $Item->code = $code;
                        $Item->disease_id = $req->disease_id;
                        $Item->box_id = $req->box_id;
                        $Item->plam_tree_id =$palm;
                        $Item->user_id  =$req->user_id;
                        $Item->date = $req->date;
                        $Item->save();
                    }
                }
                if ($Item->save()) {
                    parent::addTask($req->user_id,6,'Disease/diseases/'.$code.'/edit');
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
        }

        else {
            return $this->json('warning', $validation);
        }

    }

    public function edit(Request $req, $id) {
            $this->passing_data['users']=Users::all();
            $this->passing_data['boxes']=Boxes::all();
            $this->passing_data['materials']=Matriels::all();
            $this->passing_data['material_type']=Matriels::where('material_type_id',1)->get();
            $disease_detail=diseasePalmTree::where('code',$id)->first();
            $palms=diseasePalmTree::where('code',$id)->pluck('plam_tree_id')->toArray();

            $this->passing_data['palms']=$palms;
            $this->passing_data['info_detail']=$disease_detail;
            $disease=$disease_detail->disease;
            $this->passing_data['info']=$disease;

            $palms_code=BoxCropPlanting::where('box_id',$disease_detail->box_id)->get();
            if($palms_code){
                $plam_tree_code=array();
                foreach($palms_code as $palm_code){
                    $plam_tree_code[]=$palm_code->Box->code.'_'.$palm_code->row.'_'.$palm_code->column.'_'.$palm_code->Crop->code;
                }
            }


        $this->passing_data['plam_tree_code']=$plam_tree_code;

        $this->passing_data['bath']=url('public/images/Uploads/diseases');
        if($req->record){
            $this->passing_data['record']=true;
        }else{
            $this->passing_data['record']=false;
        }

        $this->passing_data['Equipments']=Equipments::all();
        $this->passing_data['Matriels']=Matriels::all();
       $OperationResources=OperationResources::leftJoin('materials','operation_resources.matrial_id','materials.id')
            ->leftJoin('equipments','operation_resources.equipment_id','equipments.id')
            ->where('post_id',$disease_detail->code)->where('moduel_id',15)->select(['operation_resources.*','materials.title as "M_title"','equipments.title as "E_title"'])->get();

        $this->passing_data['OperationResources']=$OperationResources;
        $cost=0;
    foreach ($OperationResources as $OperationResources) {
            switch ($OperationResources->opertion_type_id){
                //cost
                case 1:
                    $cost+=$OperationResources->cost;
                    break;
                 //worker
                case 2:
                    $cost+=$OperationResources->cost;
                    break;
                //equipment
                case 3:
                    $quuipment=$disease_detail->palmDisease_relation('equipments',$OperationResources->equipment_id,'id');
                    $cost+=($OperationResources->qyt) * preg_replace("/([^0-9\\.])/i", "", $quuipment[0]->price);
                    break;
                //material
                case 4:
                    $material=$disease_detail->palmDisease_relation('materials',$OperationResources->matrial_id,'id');
                    $cost+=($OperationResources->qyt) * preg_replace("/([^0-9\\.])/i", "", $material[0]->cost);
                    break;
            }
    }


        return $this->_view('Diseases', 'disease_tap');
    }

    public function update(Request $req,$id) {
        $rules=[
            'disease_id'=>'required',
            'palms'=>'required',
            'title'=>'required',
            'date'=>'required',
            'user_id'=>'required'
        ];
        $validation = $this->validation($rules, $req, true);
        if($validation===true) {

            try {
                DB::beginTransaction();
                $disease=Diseases::where('id',$id)->first();
                $disease->title=$req->title;
                $disease->desc=$req->desc;
                $disease->save();
                $Item =diseasePalmTree::where('disease_id',$id)->where('box_id',$req->box_id)->where('code',$req->disease_code)->get();
                        if($req->palms) {
                            diseasePalmTree::where('disease_id',$id)->where('box_id',$req->box_id)->where('code',$req->disease_code)->delete();
                            foreach ($req->palms as $palm) {
                                    $disease_detail = new diseasePalmTree();
                                    $disease_detail->code = $Item[0]->code;
                                    $disease_detail->disease_id = $Item[0]->disease_id;
                                    $disease_detail->box_id = $Item[0]->box_id;
                                    $disease_detail->plam_tree_id = $palm;
                                    $disease_detail->user_id = $req->user_id;
                                    $disease_detail->recovery_percent = $req->recovery_percent;
                                    $disease_detail->losses_reason = $req->looses_reason;
                                    $disease_detail->status = $req->status;
                                    $disease_detail->date = $req->date;
                                    $disease_detail->save();
                                }
                            }

                if ($disease->save()) {
                    parent::addTask($req->user_id,6,'Disease/diseases/'.$Item[0]->code.'/edit');
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
        }

        else {
            return $this->json('warning', $validation);
        }

    }

    public function dataTable(Request $req)
    {
        $data =diseasePalmTree::select('code')
            ->groupBy('code');

            $data =$data->Where(function($query){
                $query->where('status',2);
            })->orWhere(function ($query){
                $query->where('status',1)->where('recovery_percent','!=',100);
            })
                ->groupBy('code');
            if($req->status){
                if($req->status=='all'){
                    $data=diseasePalmTree::select('code')
                        ->groupBy('code');
                }
                elseif($req->status=='1') {
                    $data = diseasePalmTree::select('code')->where('status',1)
                        ->groupBy('code');
                }
                else{
                    $data = diseasePalmTree::select('code')->where('status',0)
                        ->groupBy('code');
                }
            }

        if($req->date_from){
            $data =$data->whereDate('date','>=',date('Y-m-d',strtotime($req->date_from)));

        }
        if($req->date_to){
            $data =$data->where('date','<=',date('Y-m-d',strtotime($req->date_to)));
        }
        $data =$data->get();
        $table = diseasePalmTree::transformCollection($data,'Table');

            return \Datatables::of($table)
                ->addColumn('option', function ($item) {
                    if($this->_checkPermission(42,4)) {
                        $back = $this->_editButn($item, 'Disease/diseases/');
                    }else{
                        $back='';
                    }
                    return $back;
               })
                ->rawColumns(['option'])
                ->make(true);

    }

    public function dataTable_disease_folow($disease_code){
    $data = diseaseFollow::where('disease_code',$disease_code)->get();
    $table = diseaseFollow::transformCollection($data);

    return \Datatables::of($table)
        ->make(true);
}

    public function dataTable_disease_plan($id){
        $data = DiseaseCombatPlan::where('disease_id',$id)->get();
        $table = DiseaseCombatPlan::transformCollection($data);

        return \Datatables::of($table)
            ->addColumn('option', function ($item) {
                $back='<i class="fas fa-eye view-row view-plane" data-id="'.$item->id.'"  data-toggle="modal" data-target="#addPlaneModal" onclick="disease_plan_view('.$item->id.')"></i>';
                return $back;
            })
            ->rawColumns(['option'])
            ->make(true);
    }

    public function addDiseasePlan(Request $req){
        $rule=[
                'pesticide'=>'required',
                'amount.*'=>'required',
                'used_way'=>'required',
                'repeat'=>'required|numeric',
            ];


        $validation = $this->validation($rule, $req, true);
        if($validation===true) {
            try {
                $code = DiseaseCombatPlan::orderBy('id', 'desc')->first();
                if (!$code) {
                    $code = 1000;
                } else {
                    $code = $code->code + 1;
                }
                DB::beginTransaction();
                $Item = new DiseaseCombatPlan();
                $Item->code = $code;
                $Item->disease_id = $req->disease_id;
                $Item->used_way = $req->used_way;
                $Item->repeat = $req->repeat;
                $Item->date = $req->date;

                if ($Item->save()) {

                    $data=[];
                    for($i=0;$i<count($req->pesticide);$i++){
                        $data[]=[
                            'disease_combact_plan_id'=>$Item->id,
                            'pesticide'=>$req->pesticide[$i],
                            'amount'=>$req->amount[$i]
                   ];
                    }
                    DB::table('disease_plan_materials')->insert($data);
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
        }

        else {
            return $this->json('warning', $validation);
        }


    }

    public function editDiseasePlan(Request $req,$id){

        try {

            DB::beginTransaction();
            $disease_plan = DiseaseCombatPlan::where('id',$id)->get();
            $result=DiseaseCombatPlan::transformCollection($disease_plan);

//            foreach ($disease_plan->plan_materials_details as $detail){
//                $material_selected[]=$detail->pesticide;
//            }
            $used_materials=[];
            foreach ($result[0]->used_materials as $material){
                $used_materials[]=Matriels::where('id',$material)->first();
            }
            $materials=Matriels::where('material_type_id',1)->get();
            $pesticide_id='';


            if($disease_plan){

                for ($i=0;$i<count($result[0]->used_materials);$i++){

                    $pesticide_id.=  '
                    <div class="plane-detail">
                                                                    <div class="row">
                                                                        <div class="col-10">
                                                                            <div class="row form-inline">
                                                                                <label class="col-4" for="row">المبيد:</label>
                                                                                <select  name="pesticide[]" id="pesticide" class="select2 reset_select col-6"   style="width: 246px;"> 
                                                                                ';
                   foreach ($materials as $material) {
                      $selected=$material->id==$result[0]->used_materials[$i]?'selected':'';
                       $pesticide_id .= '
                      
                                  <option  value="' . $material->id . '" '.$selected.'>' . $material->title . '</option>
                                
                        ';
                   }
                    $pesticide_id.=  '
                                                                                </select>   
                                                                                <div id="pesticide_demo"></div>
                                                                            </div>
                                                                        </div>
                                                                    
                                                                    </div>

                                                                    <div class="row mb-4 mt-4">
                                                                        <div class="row form-inline">
                                                                            <label class="col-5" for="col">الكميه للنخله</label>
                                                                            <input name="amount[]" id="amount" value="'.$result[0]->amount[$i].'" type="number" class="border-style col-7 col-val" min="0" style="width: 246px;">
                                                                            <div id="amount_demo"></div>
                                                                        </div>
                                                                    </div>
                                                                    </div>
                
                
                ';



                }

            }
            return response()->json(['disease_plan'=>$disease_plan[0],'pesticide_id'=>$pesticide_id]);


        } catch (Exception $ex) {
            DB::rollBack();
        }
    }

    public function showLoosesDisease_reason(Request $req){
        try {

            DB::beginTransaction();
            $looses_reason = diseasePalmTree::where('id',$req->id)->select('losses_reason')->first();
            return response()->json(['looses_reason'=>$looses_reason]);


        } catch (Exception $ex) {
            DB::rollBack();
        }
    }


    public function updateDiseasePlan(Request $req,$id){
        $rule=[
            'pesticide'=>'required',
            'amount'=>'required',
            'used_way'=>'required',
            'repeat'=>'required|numeric',
        ];

        $validation = $this->validation($rule, $req, true);
        if($validation===true) {
            try {

                DB::beginTransaction();
                $Item = DiseaseCombatPlan::where('id',$id)->first();
                $Item->used_way = $req->used_way;
                $Item->repeat = $req->repeat;
                $Item->date = $req->date;

                if ($Item->save()) {

                    $data=[];
                    for($i=0;$i<count($req->pesticide);$i++){
                        $data[]=[
                            'disease_combact_plan_id'=>$Item->id,
                            'pesticide'=>$req->pesticide[$i],
                            'amount'=>$req->amount[$i]
                        ];
                    }
                    DiseasePlanMaterial::where('disease_combact_plan_id',$id)->delete();
                    DB::table('disease_plan_materials')->insert($data);
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
        }

        else {
            return $this->json('warning', $validation);
        }

    }

    public function addDiseaseFollow(Request $req){
        $rule=[
            'note'=>'required',
            'note_date'=>'required',
        ];

        $validation = $this->validation($rule, $req, true);
        if($validation===true) {
            try {
                $code = diseaseFollow::orderBy('id', 'desc')->first();
                if (!$code) {
                    $code = 1000;
                } else {
                    $code = $code->code + 1;
                }
                DB::beginTransaction();
                $Item = new diseaseFollow();
                $Item->code = $code;
                $Item->disease_code = $req->disease_code;
                $Item->note = $req->note;
                $Item->note_date = $req->note_date;
                $Item->writen_by = 1;
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
        }

        else {
            return $this->json('warning', $validation);
        }
    }

    //datatable for diseaseRecord
    public function dataTable_disease_record(){

        $data = diseasePalmTree::select('code')
            ->groupBy('code')
            ->get();

        $table = diseasePalmTree::transformCollection($data,'Table');

        return \Datatables::of($table)
            ->addColumn('option', function ($item) {
                if($this->_checkPermission(43,4)) {
                    $back = $this->_editButn($item, 'Disease/diseases/', ['record' => 1
                    ]);
                }else{
                    $back='';
                }
                return $back;
            })
            ->rawColumns(['option'])
            ->make(true);
    }


//dataTable_disease_looses
    public function dataTable_disease_looses(){
        $data = diseasePalmTree::select('code')->where('status',0)
            ->groupBy('code')
            ->get();

        $table = diseasePalmTree::transformCollection($data,'Table');

        return \Datatables::of($table)
            ->addColumn('option', function ($item) {
                if($this->_checkPermission(44,4)) {
                    $back = ' <i class="fas fa-eye view-row"  data-toggle="modal" data-target="#lose-reas" title="View" onclick="showLoosesReason(' . $item->disease_id . ')"></i>';
                }else{
                    $back='';
                }
                return $back;
            })
            ->rawColumns(['option'])
            ->make(true);
    }





}

