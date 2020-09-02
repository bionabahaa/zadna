

@extends('layouts.backEnd')
@section('page_css')
@endsection
@section('page_script')
    {{--  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDWYbhmg32SNq225SO1jRHA2Bj6ukgAQtA&libraries=places&language=en&callback=initMap"></script>  --}}
    {{--  <script src="{{ asset('public/') }}/js/gmaps.js"></script>  --}}
    <script>
      /*  var map=new GMaps({
            div: '#map',
            lat: -12.043333,
            lng: -77.028333
        });*/
    </script>
    <script src="{{ asset('public') }}/js/backEnd/farm.js"></script>
    <script>
        $(function () {
            $(".select2").select2();
        });
    </script>
@endsection
@section('page_header')
@endsection
@section('page_content')
@php
$inputs=[
    
    [
        'type'=>1,
        'class'=>'col-md-4',
        'name'=>'title',
        'id'=>'titlee',
        'value'=>$farm->title,
        'title'=>'الاسم',
        'placeholder'=>'',
    ],
    [
        'type'=>1,
        'class'=>'col-md-4',
        'name'=>'location',
        'id'=>'location',
        'value'=>$farm->location,
        'title'=>'المكان',
        'placeholder'=>'',
    ],
    [
        'type'=>2,
        'class'=>'col-md-4',
        'name'=>'area',
        'id'=>'area',
        'value'=>$farm->area,
        'title'=>'المساحة',
        'placeholder'=>'فدان',
    ],
    [
        'type'=>6,
        'class'=>'col-md-4',
        'name'=>'creation_date',
        'id'=>'creation_date',
        'value'=>$farm->creation_date,
        'title'=>'تاريخ الانشاء',
        'placeholder'=>'',
    ],
    [
        'type'=>4,
        'class'=>'col-md-4',
        'name'=>'id',
        'id'=>'id',
        'value'=>$farm->id,
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
        'title'=> 'المزارع',
        'url'=> url('/setting/farm'),
    ]
];
$mainLink='تعديل المزرعه';
@endphp
   
    <div class="container-fluid">
            @component('pages.backEnd.components.breadcarms',['links'=>$links,'main_page'=>$mainLink])
            @endcomponent
            <br>
            <br>
            <form id="EditFarmForm" method="POST">
                @foreach (array_chunk($inputs, 3) as $inputs_row)
                
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
                        @component('pages.backEnd.components.buttons',['type'=>1])
                        @endcomponent
                </div>
            </div>
    </div>
   


@endsection

