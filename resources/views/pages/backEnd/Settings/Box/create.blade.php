@extends('layouts.backEnd')
@section('page_css')
    <link rel="stylesheet" href="{{ asset('public/styles/backEnd') }}/dist/css/box.css">
@endsection
@section('page_script')
    <script>
        var operation_page=1;
        var report=false;
        $(function () {
            $(".select2").select2();
        });
    </script>
    <script src="{{ asset('public') }}/js/backEnd/box.js"></script>
    <script>
        var add = function () {
            var CopyTR = '<div class="col-md-12">' + $(".tr-rep").html() + '</div>';
            $(".Ttyps").append(CopyTR);
    
        }
    </script>
@endsection
@php
$rows=[['row'=>'','column'=>'','crops'=>0]];
$inputs=[
        [
            'type'=>2,
            'class'=>'col-md-3',
            'name'=>'row_count',
            'id'=>'row_count',
            'value'=>'',
            'title'=>'عدد الصفوف',
            'placeholder'=>'',
        ],
        [
            'type'=>2,
            'class'=>'col-md-3',
            'name'=>'column_count',
            'id'=>'column_count',
            'value'=>'',
            'title'=>'عدد الاعمده',
            'placeholder'=>'',
        ],

        [
            'type'=>12,
            'class'=>'col-md-3',
            'name'=>'users[]',
            'id'=>'users',
            'value'=>[],
            'title'=>'العمال المسئولين',
            'placeholder'=>'',
            'selector'=>'username',
            'options'=>$Users 
        ],

         
        
        [
            'type'=>15,
            'class'=>'col-md-3',
            'name'=>'Workers',
            'id'=>'',
            'value'=>'',
            'title'=>'عمال ',
            'placeholder'=>'',
        ],

        [
            'type'=>15,
            'class'=>'col-md-3',
            'name'=>'Supervisors',
            'id'=>'',
            'value'=>'',
            'title'=>'مشرفين ',
            'placeholder'=>'',
        ],

        [
            'type'=>2,
            'class'=>'col-md-3',
            'name'=>'size',
            'id'=>'size',
            'value'=>'',
            'title'=>'مساحه المربع',
            'placeholder'=>'',
        ],
       
        [
        'type'=>10,
        'class'=>'col-md-3',
        'name'=>'point1',
        'id'=>'point1',
        'value'=>[
            'point'=>'',
            'north'=>['','','',''],
            'east'=>['','','','']
            ],
        'title'=>'نقطه1',
        'placeholder'=>'نقطه1',
    ],
    [
        'type'=>10,
        'class'=>'col-md-3',
        'name'=>'point2',
        'id'=>'point2',
        'value'=>[
            'point'=>'',
            'north'=>['','','',''],
            'east'=>['','','','']
        ],
        'title'=>'نقطه2',
        'placeholder'=>'نقطه2',
    ],
    [
        'type'=>10,
        'class'=>'col-md-3',
        'name'=>'point3',
        'id'=>'point3',
        'value'=>[
            'point'=>'',
            'north'=>['','','',''],
            'east'=>['','','','']
        ],
        'title'=>'نقطه3',
        'placeholder'=>'نقطه3',
    ],
    [
        'type'=>10,
        'class'=>'col-md-3',
        'name'=>'point4',
        'id'=>'point4',
        'value'=>[
            'point'=>'',
            'north'=>['','','',''],
            'east'=>['','','','']
        ],
        'title'=>'نقطه4',
        'placeholder'=>'نقطه4',
    ],
    [
        'type'=>8,
        'class'=>'col-md-12',
        'name'=>['row','column','crops'],
        'id'=>['row','column',''],
        'value'=>['','',$rows],
        'title'=>['الصف','العمود','الصنف'],
        'placeholder'=>['','',''],
        'mainClass'=>'col-md-4',
        'types'=>[2,2,11],
        'container'=>'Ttyps',
        'buckup'=>'tr-rep',
        'selector'=>['','','title'],
        'options'=>['','',$Crops],
        'countRow'=>count($rows)
    ],
    [
        'type'=>4,
        'class'=>'col-md-6',
        'name'=>'id',
        'id'=>'id',
        'value'=>'',
        'title'=>'',
        'placeholder'=>'',
    ],
    
];
$links=[
    [
        'title'=> 'الاعدادات العامه',
        'url'=> url('/setting'),
    ],
    [
        'title'=> 'المربعات',
        'url'=> url('/setting/boxes'),
    ]
];
$mainLink='إضافه مربع جديد';
@endphp
@section('page_header')
@endsection
@section('page_content')
<div class="container-fluid">
    @component('pages.backEnd.components.breadcarms',['links'=>$links,'main_page'=>$mainLink])
    @endcomponent
    <br>
    <br>
    <form id="AddBoxForm" method="POST">
        @foreach (array_chunk($inputs, 4) as $inputs_row)
            <div class="row">
                  @foreach ($inputs_row as $input)
                    @component('pages.backEnd.components.inputs',['input'=>$input])
                    @endcomponent
                   @endforeach
            </div>
            <hr style="border-top-width: 3px;border-color: #58b82a;">
        @endforeach
    </form>
    <div class="row">
        <div class="col-md-12" style="text-align: center">
            @component('pages.backEnd.components.buttons',['type'=>2,'id'=>'','title'=>'إضافه صنف جديد' ,'onclick'=>'add()','class'=>'btn-success'])
            @endcomponent
            @component('pages.backEnd.components.buttons',['type'=>1])
            @endcomponent
        </div>
    </div>
    
</div>
@endsection