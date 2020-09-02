<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;
use App\Models\Countries;
use App\Models\Configs;
use App\Models\CountriesLang;
use DB;

class CountriesController extends AdminController
{
    private $rules=[
        "order"=>'required',
    ];
    public function __construct(){
        parent::__construct();
    }
    public function index(Request $req){
        if($req->country_id){
            $this->passing_data['country_id']=$req->country_id;
        }else{
            $this->passing_data['country_id']=null;
        }
        if($req->city_id){
            $this->passing_data['city_id']=$req->city_id;
        }else{
            $this->passing_data['city_id']=null;
        }
        // $data=Countries::orderBy('this_order')->get();
        // $table=Countries::transformCollection($data);
        // dd($table);
        return $this->_view('country','index');
    }
    public function create(Request $req){
        $config=Configs::where('sys_type','admin')->get();
        if($config){
            $config=Configs::transform($config);
        }
        $this->passing_data['ConfigAdmin']=$config;
        if($req->country_id){
            $this->passing_data['country_id']=$req->country_id;
        }else{
            $this->passing_data['country_id']=null;
        }
        if($req->city_id){
            $this->passing_data['city_id']=$req->city_id;
        }else{
            $this->passing_data['city_id']=null;
        }
        return $this->_view('country','create');
    }
    public function store(Request $req){
        // dd($req->title);
        $validation=$this->validation($this->rules,$req,true);
        if($validation===true){
            try{
                DB::beginTransaction();
                $Item=new Countries;
                $Item->lat=$req->location['lat'];
                $Item->lng=$req->location['lng'];
                if($req->country_id){
                    if($req->city_id){
                        $Item->type='state';
                        $Item->city_id=$req->city_id;
                    }else{
                        $Item->type='city';
                    }
                    $Item->country_id=$req->country_id;
                }else{
                    $Item->type='country';
                }
                $Item->this_order=$req->order;
                if($req->file('icone')){
                    $Item->icon=$this->uploadImage($req,'icone','countries');
                }
                if($Item->save()){
                    $config=Configs::where('sys_type','cpanel')->where('name','language')->first()->value;
                    if($config){
                        $lang=(array)json_decode($config);
                    }else{
                        $lang=['en'];
                    }
                    $rows=[];
                    foreach($lang as $value){
                        $row=[
                            'country_id'=>$Item->id,
                            'lang'=>$value,
                            'title'=>$req->title[$value],
                            'note'=>$req->note[$value],
                            'address'=>$this->Get_Address_From_Google_Maps($req->location['lat'],$req->location['lng'],$value),
                        ];
                        $rows[]=$row;
                    }
                    if(!empty($rows)){
                        CountriesLang::insert($rows);
                    }
                    DB::commit();
                    $massage="Added Successfuly";
                    return $this->json('success',$massage,200);
                }else{
                    $massage="Data Not Added";
                    return $this->json('warning',$massage);
                }
            }catch(Exception $ex){
                DB::rollBack();
            }
        }else{
            return $this->json('warning',$validation);
        }
    }
    public function edit($id){
        try {
            $Item=Countries::find($id);
            if($Item){
                $result=Countries::transform($Item);
                $this->passing_data['info']=$result;
                // dd($result);
                return $this->_view('country','edit');
            }else{
                return abort(404);
            }
        }catch(Exception $ex){
            return abort(500);
        }
    }
    public function update(Request $req){
        $validation=$this->validation($this->rules,$req,true);
        if($validation===true){
            try{
                DB::beginTransaction();
                $Item=Countries::where('id',$req->id)->first();
                $Item->lat=$req->location['lat'];
                $Item->lng=$req->location['lng'];
                $Item->this_order=$req->order;
                $Item->active=$req->active;
                if($req->file('icone')){
                    $url_image=url('public//images/Uploads/countries/').'/'.$Item->icon;
                    $this->deleteImage($url_image);
                    $url_image=url('public//images/Uploads/countries/Small/').'/'.$Item->icon;
                    $this->deleteImage($url_image);
                    $Item->icon=$this->uploadImage($req,'icone','countries');
                }
                if($Item->save()){
                    $config=Configs::where('sys_type','cpanel')->where('name','language')->first()->value;
                    if($config){
                        $lang=(array)json_decode($config);
                    }else{
                        $lang=['en'];
                    }
                    CountriesLang::where('country_id',$req->id)->delete();
                    $rows=[];
                    foreach($lang as $value){
                        $row=[
                            'country_id'=>$Item->id,
                            'lang'=>$value,
                            'title'=>$req->title[$value],
                            'note'=>$req->note[$value],
                            'address'=>$this->Get_Address_From_Google_Maps($req->location['lat'],$req->location['lng'],$value),
                        ];
                        $rows[]=$row;
                    }
                    if(!empty($rows)){
                        CountriesLang::insert($rows);
                    }
                }
                DB::commit();
                $massage="Updated Successfuly";
                return $this->json('success',$massage,200);
            }catch(Exception $ex){
                DB::rollBack();
            }
        }else{
            return $this->json('warning',$validation);
        }
    }
    public function destroy($id){
        try{
            $Item=Countries::find($id);
            if($Item->delete()){
                $massage="Deleted Successfuly";
                return $this->json('success',$massage);
            }else{
                $massage="Deleted Field";
                return $this->json('warning',$massage);
            }
        }catch(Exception $ex){
            $massage="Deleted Field";
                return $this->json('error',$massage);
        }
    }
    public function dataTable(Request $req){
        $data=Countries::orderBy('this_order');
        if($req->country_id && !$req->city_id){
            $data=$data->where('country_id',$req->country_id)->whereNull('city_id');
        }
        if($req->country_id && $req->city_id){
            $data=$data->where('city_id',$req->city_id);
        }
        if(!$req->country_id && !$req->city_id){
            $data=$data->whereNull('city_id')->whereNull('country_id');
        }
        $data=$data->get();
        $table=Countries::transformCollection($data);
        return \Datatables::of($table)
        ->addColumn('icone', function ($item){
            $back='<img href="'.$item->icone.'" />';
            return $back;
        })
        ->addColumn('is_active', function ($item){
            if ($item->active == 1) {
                $message="No";
                $class = 'label-danger';
            } else {
                $message="Yes";
                $class = 'label-success';
            }
            $back = '<h3><span class="label ' . $class . '">' . $message . '</span></h3>';
            return $back;
        })
        ->addColumn('country', function ($item){
            $Url="countries/".$item->country_id."/edit";
            $back = '<a href="'.$Url.'" >
                    '.$item->country_title.'
                 </a>';
            return $back;
        })
        ->addColumn('city', function ($item){
            $Url="countries/".$item->city_id."/edit";
            $back = '<a href="'.$Url.'" >
                    '.$item->city_title.'
                 </a>';
            return $back;
        })
        ->addColumn('option', function ($item){
            $back = $this->_editButn($item,'admin/countries/');
            $back .= $this->_deleteBtn($item);
            if($item->type!='state'){
                if($item->country_id){
                    $back .= $this->_LinkBtn(url('admin/countries?country_id='.$item->country_id.'&city_id='.$item->id),'State');
                }else{
                    $back .= $this->_LinkBtn(url('admin/countries?country_id='.$item->id),'City');
                }
            }
            return $back;
        })
        ->addColumn('created_at', function ($item){
            $back=date('Y-m-d',strtotime($item->created_at));
            return $back;
        })
        ->rawColumns(['icone', 'country','city','is_active', 'option', 'created_at'])
        ->make(true);
    }
}
