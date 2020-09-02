@extends('layouts.backEnd')
@section('page_css')
<link rel="stylesheet" href="{{ asset('public/styles/backEnd') }}/dist/css/side-menu.css">

@endsection
@section('page_script')
<script>
    var operation_page=1;
    var report={{ $report }};
  </script>
<script src="{{ asset('public') }}/js/backEnd/planting.js"></script>

@endsection
@section('page_header')
@endsection
@section('page_content')
@inject('healper', 'App\Http\Controllers\BladeController')
{{-- @include('pages.backEnd.AllModuels') --}}
@if($healper->check_permission(16,1))
<section class="content cropType">
    <div class="top-bar">

            <h6>  عمليات زراعية > غرس </h6>
    </div>

    {{--<div class="top-links">--}}
        {{--<div class="row">--}}
            {{--@if($report!==true)--}}
                {{--<div class="col-6">--}}
                    {{--<a src="{{ url('public/') }}" class="ml-4" style="text-decoration: underline;cursor: pointer"> توقيع الابار</a>--}}
                {{--</div>--}}
            {{--@endif--}}
        {{--</div>--}}
    {{--</div>--}}
    <div class="row m-0">
        @include('pages.backEnd.Operations.rightLink')
        <div class="col-sm-10 col-10 p-0">
            <div class="Mparent">
                <div class="Tparent">
                    @if($healper->check_permission(16,2))
                    <div class="row ml-3 mr-3 mt-3 p-3 filter-search-box ">
                        <div class="col-lg-10">
                            <div class="row filter-res">
                                <div class="col-lg-3 col-sm-12 col-md-12 col-12">
                                    <div>
                                        <label>نوع الغرس:</label>
                                    </div>
                                    <select id="status" class="form-control filter-form filter1">
                                        <option value="all">الكل </option>
                                        <option value="1"> فسيلة</option>
                                        <option value="2">نسيج</option>
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
                        <span class="btn btn-dark filter_but" style="height: 45px;border-radius: 21%;" onclick="filter('PlantingDataTable')" >بحث</span>
                        {{--<div class="col-lg-2 mt-3 col-sm-4 col-md-4 col-12 search-div"></div>--}}
                    </div>
                    @endif
                    </div>
                    <div class="row m-4">
                            @if($healper->check_permission(16,3))
                                @if($report!==true)
                                    <div class=" col-lg-6  col-12 offset-lg-6 mt-3 float-left text-right ">
                                        <button class="add-crepto mr-2 mb-2 addNewRow " onclick="window.location.href='{{ url('operation/planting/create/') }}'">أضافة </button>
                                    </div>
                                @endif
                            @endif
                    </div>
                    <div class="row m-3 justify-content-center ">
                        @if($healper->check_permission(16,4))
                            <a href="{{ URL::to('downloadExcel/xls/Planting/?arr[]='.$arr.'') }}"><button class="btn btn-success export-excel mr-2 mb-2">اخراج كملف اكسيل</button></a>
                        @endif
                        <div class="col-lg-12 ">
                            <table class="table zadnatable" id="PlantingDataTable">
                                <thead>
                                    <tr>
                                        <th>الكود</th>
                                        <th>المربع</th>
                                        <th>نوع الغرس</th>
                                        <th>تاريخ البدايه</th>
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

<div id="addplant" class="modal fade" role="dialog" currtable page-link="planting-tabs.html">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content modalbg-add">
            <div class="modal-header d-flex flex-row-reverse">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h5 class="modal-title ">اضافه</h5>
            </div>
            <div class="modal-body">
                <form action="POST" id="AddPlantingForm">
                    <input type="hidden" name="id" id="id">
                    <div class="row m-4">
                        <div class="col">
                            <label class="col-5" for="state">المربع:</label>
                            <select name="box_id" class="form-control filter-form filter1">
                                <option value="">أختار المربع </option>
                                @foreach ($Boxes as $value)
                                    <option value="{{ $value->id }}"> {{ $value->code }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div id="box_id_demo"></div>
                    </div>
                    <div class="row m-4">
                        <div class="col-12">
                            <label class="col-5" for="RlCost">نوع الغرس:</label>
                            <select name="type_id" class="form-control filter-form filter1">
                                <option value="">أختار النوع </option>
                                <option value="1"> فسيلة</option>
                                <option value="2">نسيج</option>
                            </select>
                        </div>
                        <div id="type_id_demo"></div>
                    </div>
                    <div class="row m-4">
                        <div class="col-12">
                            <label class="col-5" for="date">تاريخ البدايه:</label>
                            <input type="date" name="start_date" id="date" class="border-style col-6 col-val">
                        </div>
                        <div id="start_date_demo"></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="SubmitButton" class="danger btn btn-primary Saverecom">حفظ</button>
                <a href="#" data-dismiss="modal" aria-hidden="true" class="btn btn-danger ">الغاء</a>
            </div>
        </div>
    </div>
</div>

    @else
    <h1 style="text-align: center;color: #28a745; margin-top: 150px">ليس لديك صلاحيه للدخول لصفحه عمليات الغرس</h1>
    @endif
@endsection