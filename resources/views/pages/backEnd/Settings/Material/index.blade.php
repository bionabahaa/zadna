@extends('layouts.backEnd')
@section('page_css')
@endsection
@section('page_script')
<script src="{{ asset('public') }}/js/backEnd/material.js"></script>
@endsection
@section('page_header')
@endsection
@section('page_content')
@inject('healper', 'App\Http\Controllers\BladeController')
<section class="content cropType">
    <div class="top-bar">
        <h6>اعدادات عامه > خامات</h6>
    </div>
    <div class="Tparent">
        @if($healper->check_permission(6,2))
        <div class="row ml-3 mr-3 mt-3 p-3 filter-search-box">
            <div class="col-lg-10">
                <div class="row filter-res">

                    <div class="col-lg-2 col-sm-12 col-md-12 col-12">
                        <div>
                            <label>الخامه :</label>
                        </div>
                        <select name="type" id="type" class="form-control filter-form filter1">
                            <option value="all" >الكل</option>
                            @foreach($materials_type as $materials_type)
                                <option value="{{$materials_type->id}}">{{$materials_type->title}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-lg-8 col-sm-12 col-md-12 col-12">
                        <div>
                            <label>فترة الاستخدام :</label>
                        </div>
                        من <input  name="from" id="from" type="date" class="type-date">
                        الى <input name="to" id="to"  type="date" class="type-date">
                    </div>
                </div>
            </div>
            <span class="btn btn-dark filter_but" style="height: 45px;border-radius: 21%;" onclick="filter('MaterialDataTable')" >بحث</span>
            </div>
            @endif
            

        </div>

        <div class="row m-4">


            <div class="float-left ">

                    @if($healper->check_permission(6,3))
                          <button class="add-crepto mr-2 mb-2  " onclick="window.location.href='{{route('material.create')}}' ">أضافة
                             خامة</button>
                    @endif

                {{--<button class="upload-excel mr-2 mb-2 ">أدخال عن طريق ملف</button>--}}

                        @if($healper->check_permission(6,4))
                            <a href="{{ URL::to('downloadExcel/xls/Matriels/?arr[]='.$arr.'') }}"><button class="btn btn-success export-excel mr-2 mb-2">أخراج كاملف اكسيل</button></a>
                       @endif
                      <a target="_blank" href="{{ URL::to('pdf/Matriels/material') }}"><button class="btn btn-danger export-excel mr-2 mb-2">طباعه PDF</button></a>





            </div>

        </div>
        <div class="row m-3 justify-content-center ">
            <div class="col-lg-10 ">

                <table class="table zadnatable " id="MaterialDataTable">
                    <thead>
                        <tr>
                            <th>الكود</th>
                            <th>النوع</th>
                            <th>الاسم</th>
                            <th>سعر الوحدة</th>
                            <th class="actions">العمليات</th>
                        </tr>
                    </thead>
                </table>
            </div>

        </div>

    </div>

</section>

@endsection