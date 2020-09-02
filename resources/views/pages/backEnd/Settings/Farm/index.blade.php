@extends('layouts.backEnd')
@section('page_css')
@endsection
@section('page_script')
<script src="{{ asset('public') }}/js/backEnd/farm.js"></script>
@endsection
@section('page_header')
@endsection
@section('page_content')
@php
$inputs=[
  [
      'type'=>7,
      'class'=>'col-md-4',
      'name'=>'map_earth',
      'id'=>'map_earth',
      'value'=>$bath.'/'.@$map_earth->value,
      'title'=>'خريطة الارض',
      'placeholder'=>'',
  ],
];
$links=[
    [
        'title'=> 'الاعدادات العامه',
        'url'=> url('/setting'),
    ],
];
$mainLink='المزارع';

@endphp
@inject('healper', 'App\Http\Controllers\BladeController')
<section class="content cropType">
    @component('pages.backEnd.components.breadcarms',['links'=>$links,'main_page'=>$mainLink])
    @endcomponent
    <br>
    <br>

    {{-- كود خريطه الارض + الملف  --}}
  {{--<div class="container-fluid">
    @foreach (array_chunk($inputs, 3) as $inputs_row)
      <div class="row">
          @foreach ($inputs_row as $input)
              @component('pages.backEnd.components.inputs',['input'=>$input])
              @endcomponent
          @endforeach
      </div>
      <hr style="border-top-width: 3px;border-color: #58b82a;">
    @endforeach
  </div>--}}
  
    <button class="add-crepto mr-2 mb-2  " onclick="window.location.href='{{route('farm.create')}}' ">أضافة
مزرعه</button>
                

    {{--check if farm exists to show details--}}
    
   
    <div class="row m-3 justify-content-center ">
        <div class="col-lg-10 ">

          <table class="table zadnatable">
            <thead>
              <tr>
                <th>الاسم</th>
                <th>المكان</th>
                <th>المساحة</th>
                <th>تاريخ الانشاء</th>
                <th>العمليات</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($farm as $farm)
                <tr>
                    <td>{{$farm->title}}</td>
                    <td>{{$farm->location}}</td>
                   <td>{{$farm->area}} فدان </td>
                  <td>{{$farm->creation_date}}</td>
                  <td>
                   


                  <a href="{{route('farm.edit',$farm->id)}}"><i class="fa fa-eye"></i></a>


                {!! Form::open(['method'=>'DELETE', 'route'=>['farm.destroy',$farm->id]]) !!}

                    <button data-toggle="tooltip" data-placement="top" title="Delete" type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure you want to delete this item?');"><span class="glyphicon glyphicon-remove"></span>delete</button>
                {!! Form::close() !!}







                  </td>
                </tr>
            </tbody>
            @endforeach
          </table>
        </div>
      </div>
  


  </div>

</section>
@endsection