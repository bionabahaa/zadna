@extends('layouts.backEnd')
@section('page_css')
<link rel="stylesheet" href="{{ asset('public/styles/backEnd') }}/dist/css/side-menu.css">
@endsection
@section('page_script')
<script>
    var operation_page=1;
    var report={{ $report }};
  </script>
<script src="{{ asset('public') }}/js/backEnd/jura.js"></script>

@endsection
@section('page_header')
@endsection
@section('page_content')
@include('pages.backEnd.AllModuels')
@inject('healper', 'App\Http\Controllers\BladeController')

@if($healper->check_permission(15,1))
<section class="content cropType">
    <div class="top-bar">

            <h6> عمليات زراعية > شبكة الري > نوع الخط </h6>
    </div>


    <div class="row m-0">
        @include('pages.backEnd.Operations.rightLink')
        <div class="col-sm-10 col-10 p-0">
                <div class="Tparent">
                    @if($healper->check_permission(15,2))
                    <div class="row ml-3 mr-3 mt-3 p-3 filter-search-box ">
                        <div class="col-lg-10">
                            <div class="row filter-res">
                                <div class="col-lg-3 col-sm-12 col-md-12 col-12">
                                    <div>
                                        <label>الحاله:</label>
                                    </div>
                                    <select id="status" class="form-control filter-form filter1">
                                        <option value="all">الكل </option>
                                        <option value=1> لم يتم</option>
                                        <option value=2> تم</option>
                                    </select>
                                </div>
                                <div class="col-lg-8 col-sm-12 col-md-12 col-12">
                                    <div>
                                        <label> تاريخ البداية :</label>
                                    </div>
                                    من <input  name="from" id="from" type="date" class="type-date">
                                    الى <input name="to" id="to"  type="date" class="type-date">
                                </div>
                            </div>
                        </div>
                        <span class="btn btn-dark filter_but" style="height: 45px;border-radius: 21%;" onclick="filter('JuraDataTable')" >بحث</span>
                        {{--<div class="col-lg-2 mt-3 col-sm-4 col-md-4 col-12 search-div"></div>--}}
                        </div>
                    @endif
                    </div>
                    <div class="row m-3 justify-content-center ">
                        @if($healper->check_permission(15,3))
                            @if($report!==true)
                                <a class="btn add-crepto addation" onclick="window.location.href='{{ url('operation/jura/create/') }}'" style="margin-left: 20px;">اضافة</a>
                            @endif
                        @endif
                        @if($healper->check_permission(15,4))
                          <a href="{{ URL::to('downloadExcel/xls/Jura/?arr[]='.$arr.'') }}"><button class="btn btn-success export-excel mr-2 mb-2">اخراج كملف اكسيل</button></a>
                        @endif
                        <div class="col-12">
                        <div class=" Tparent">

                            <table class="table zadnatable" id="JuraDataTable">
                                <thead>
                                    <tr>
                                        <th>الكود</th>
                                        <th>كود المربع</th>
                                        <th>تاريخ البداية</th>
                                        <th>تاريخ النهاية</th>
                                        <th>التنفيذ</th>
                                        @if($report!==true)
                                            <th class="actions">
                                                <i class="fas fa-bars"></i>
                                            </th>
                                        @endif
                                        
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
    </div>
</section>
    @else
    <h1 style="text-align: center;color: #28a745; margin-top: 150px">ليس لديك صلاحيه للدخول لصفحه تجهيز الجوره</h1>
    @endif
@endsection
