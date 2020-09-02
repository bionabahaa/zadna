<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Farm;
use DB;
use App\Http\Controllers\Controller;

class FarmController extends AdminController
{
    private  $rules=[
        'title'=>'required',
        'location'=>'required',
        'area'=>'required|numeric',
        'creation_date'=>'required',
    ];

    public function index()
    {
         //$farm=Farm::all();
         $farm = DB::table('farms')->get();
        $this->passing_data['farm']=$farm;
        $this->passing_data['map_earth']=DB::table('config')->select('value')->where('name','map_earth')->first();
        $this->passing_data['bath']=url('public/images/Uploads/config');
        return $this->_view('Settings/Farm', 'index');
    }


    public function create()
    {
        return $this->_view('Settings.Farm', 'create');
    }


    public function store(Request $req)
    {
        $validation = $this->validation($this->rules, $req, true);
        if ($validation === true) {
            try {
                DB::beginTransaction();
                $Item = new Farm();
                $Item->title =strip_tags($req->title);
                $Item->location =strip_tags($req->location);
                $Item->area =strip_tags($req->area);
                $Item->creation_date = $req->creation_date;
                $Item->save();
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

    public function edit($id)
    {
        $farm=Farm::find($id);
        $this->passing_data['farm']=$farm;
        return $this->_view('Settings.Farm', 'edit');

    }

    public function update(Request $req, $id)
    {
        $validation = $this->validation($this->rules, $req, true);
        if ($validation === true) {
            try {
                DB::beginTransaction();
                $Item =Farm::find($id);
                $Item->title =strip_tags($req->title);
                $Item->location =strip_tags($req->location);
                $Item->area =strip_tags($req->area);
                $Item->creation_date = $req->creation_date;
                $Item->save();
                if ($Item->save()) {
                    DB::commit();
                    $massage = 'تمت عمليه التعديل بنجاح';
                    return $this->json('success', $massage, 200);
                } else {
                    $massage = 'لم تتم عمليه التعديل';
                    return $this->json('warning', $massage);
                }
            } catch (Exception $ex) {
                DB::rollBack();
            }

        } else {
            return $this->json('warning', $validation);
        }


    }

    public function upload(Request $req){

        $rules = [
            'map_earth' => 'file|mimes:pdf',
        ];
        $validation = $this->validation($rules, $req, true);
        if ($validation === true) {
            $file = $req->file($req->name);
            $extension=$file->getClientOriginalExtension();
            $file = DB::table('config')->select('value')->where('name', $req->name)->first();
            if ($file) {
                $filename = $this->uploadFile($req->name, 'config');
                DB::table('config')->where('name', $req->name)->update(['value' => $filename]);
            } else {
                $filename = $this->uploadFile($req->name, 'config');
                if($filename===false){
                    $errors['Files']='يوجد مشكله فى الملف المرفوع';
                    return response()->json([
                        'type' => 'error',
                        'errors' => $errors
                    ]);
                }
                DB::table('config')->insert(['name' => $req->name, 'value' => $filename]);
            }
            $massage = "Successfuly";
            return $this->json('success', $massage, 200);
        }else{
            return $this->json('warning', $validation);
        }

    }


    public function destroy($id)
    {
         $farm = Farm::find($id);
         
         $farm->delete();
         return back();
        }
}
