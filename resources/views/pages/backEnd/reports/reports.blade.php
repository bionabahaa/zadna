@extends('layouts.backEnd')
@section('page_css')
@endsection
@section('page_script')
@endsection
@section('page_header')
@endsection
@section('page_content')

@inject('healper', 'App\Http\Controllers\BladeController')
@inject('report_columns', 'App\Models\Helper')


@php $count=0; @endphp

@if($healper->check_permission(45,1))

@php

$reports=[
     'Farm'=>[
        'modelname_ar'=>'المزرعه',
        'cost'=>'false',
        'file_name'=>'map_earth',
        'name'=>'المزرعه ',
        'url'=>'',
        'class'=>'col-lg-2 col-sm-4 col-12',
    ],
   'Matriels'=>[
        'modelname_ar'=>'الخامات',
        'cost'=>'true',
        'file_name'=>'',
        'name'=>'الخامات',
        'url'=>'',
        'class'=>'col-lg-2 col-sm-4 col-12',
    ],
    'StoreRequest'=>[
        'modelname_ar'=>'المخزن',
        'cost'=>'false',
        'file_name'=>'',
        'name'=>'المخزن',
        'url'=>'',
        'class'=>'col-lg-2 col-sm-4 col-12',
    ],
    'Crops'=>[
        'modelname_ar'=>'المحاصيل',
        'cost'=>'false',
        'file_name'=>'',
        'name'=>'أصناف المحصول',
        'url'=>'',
        'class'=>'col-lg-2 col-sm-4 col-12',
    ],
    'Wells'=>[
        'file_name'=>'signature_wells',
        'cost'=>'true',
        'modelname_ar'=>'الابار',
        'name'=>' الابار',
        'url'=>'',
        'class'=>'col-lg-2 col-sm-4 col-12',
    ],
     'Irrigation'=>[
        'file_name'=>'irrigation_files',
        'cost'=>'true',
        'modelname_ar'=>'الشبكات',
        'name'=>' شبكة الرى',
        'url'=>'',
        'class'=>'col-lg-2 col-sm-4 col-12',
    ],
    'diseasePalmTree'=>[
        'modelname_ar'=>'النخل المصاب',
        'cost'=>'false',
        'file_name'=>'',
        'name'=>' النخل المصاب ',
        'url'=>'',
        'class'=>'col-lg-2 col-sm-4 col-12 offset-md-4',
    ],
    'Boxes'=>[
        'modelname_ar'=>'المربعات',
        'cost'=>'false',
        'file_name'=>'map_earth',
        'name'=>'المربعات',
        'url'=>'',
        'class'=>'col-lg-2 col-sm-4 col-12',
    ],
];

@endphp



@php
    $columns= serialize($report_columns::$report_columns_name); //serialize array to sent in url para
@endphp

<section class="generalSet">
    <div class="row  m-0 p-lr-7 " style="margin-top: 5% !important">
        @foreach ($reports as $key=>$value)
            <div class="{{$value['class']}}">
                <a href="{{ url('reports/show')}}?type={{ $key }}&file_name={{$value['file_name']}}&modelname_ar={{$value['modelname_ar']}}&cost={{$value['cost']}}">
                    <div class="settings reports-box mx-auto text-center" >
                        <h6>{{ $value['name']}}</h6>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</section>
    @else
    <h1 style="text-align: center;color: #28a745; margin-top: 150px">ليس لديك صلاحيه للتحكم فى صفحات التقارير</h1>
@endif
@endsection