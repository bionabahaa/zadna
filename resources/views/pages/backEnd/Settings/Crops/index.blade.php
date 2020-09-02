@extends('layouts.backEnd')
@section('page_css')
@endsection
@section('page_script')
<script src="{{ asset('public') }}/js/backEnd/crop.js"></script>
@endsection
@section('page_header')
@endsection
@section('page_content')
@inject('healper', 'App\Http\Controllers\BladeController')
@php

$links=[
    [
        'title'=> 'الاعدادات العامه',
        'url'=> url('/setting'),
    ],
];
$mainLink='المحصول';
@endphp

@if (Session::has('message'))
   <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

@if($healper->check_permission(3,1))
<section class="content cropType">
    @component('pages.backEnd.components.breadcarms',['links'=>$links,'main_page'=>$mainLink])
    @endcomponent
    <div class="Tparent" >

       {{--
        @if($healper->check_permission(3,2))
        <div class="row ml-3 mr-3 mt-3 p-3 filter-search-box" style="height: 100px;">
            <div class="col-lg-2 col-sm-12 col-md-12 col-12">
                <div>
                    <label>نوع المحصول :</label>
                </div>
                <select name="type" id="type" class="form-control filter-form filter1">
                    <option value="0">الكل</option>
                    @foreach($crops as $crop)
                        <option value="{{$crop->id}}">{{$crop->title}}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-lg-8 col-sm-12 col-md-12 col-12">
                <div>
                    <label>فترة زراعه المحصول:</label>
                </div>
                من <input  name="from" id="from" type="date" class="type-date">
                الى <input name="to" id="to"  type="date" class="type-date">
            </div>
         {{--   <span class="btn btn-dark filter_but" style="height: 45px;border-radius: 21%;" onclick="filter('CropsDataTable')" >بحث</span>  
        </div>
        @endif
    
            <div class="col-lg-2 mt-3 col-sm-4 col-md-4 col-12 search-div">
            </div>
        </div>
        --}}
        <div class="row m-4">
            <div class="float-left ">
                @if($healper->check_permission(3,3))
                <button class="add-crepto mr-2 mb-2  "  onclick="window.location.href='{{route('crops.create')}}' ">أضافة صنف</button>

                
                {{--<button class="upload-excel mr-2 mb-2 ">أدخال عن طريق ملف</button>--}}
                @endif
                @if($healper->check_permission(3,4))
                      <a href="{{ URL::to('downloadExcel/xls/Crops/'.'/?arr[]='.$arr) }}"><button class="btn btn-success export-excel mr-2 mb-2">أخراج كاملف اكسيل</button></a>
                @endif
                    {{--  <a target="_blank" href="{{ URL::to('pdf/Crops/crop') }}"><button class="btn btn-danger export-excel mr-2 mb-2">طباعه PDF</button></a>  --}}
</div></div>



    
<div class="row m-3 justify-content-center">
            <div class="col-lg-10 ">
                <table class="table zadnatable diff-table" >
                    <thead>
                    <tr>
                        <th> كود المحصول </th>
                        <th>اسم المحصول</th>
                        <th> كود الصنف </th>
                        <th>  الصنف </th>
                        <th>تاريخ الزراعه </th>
                        <th class="actions">البيانات </th>
                    </tr>
                    </thead>
                 
                    <tbody>
            @foreach ($crops as $crops)
                <tr>
                    <td>{{$crops->code}}</td>
                    <td>{{$crops->title}}</td>
                    <td>{{$crops->code}}-{{$crops->type_id}}</td>
                    <td>{{$crops->notes}}</td>
                   <td>{{$crops->date}}  </td>
                 
                  <td>
                   
                  <a href="{{route('crops.edit',$crops->id)}}"><i class="fas fa-pencil-alt"></i></a>


                
{!! Form::open(['method'=>'DELETE', 'class' => 'del_button', 'route'=>['crops.destroy',$crops->id]]) !!}

<button  style="color :#007bff; background-color: white; border-color:white;" data-toggle="tooltip" data-placement="top" title="Delete" type="submit"   class="btn btn-danger btn-xs" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fas fa-trash-alt"></i></button>
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
    @else
    <h1 style="    text-align: center;color: #28a745;">ليس لديك صلاحيه للتحكم فى صفحات الاعدادات العامه</h1>
    @endif
@endsection










    


