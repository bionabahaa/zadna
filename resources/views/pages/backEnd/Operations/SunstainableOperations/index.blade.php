@extends('layouts.backEnd')
@section('page_css')
<link rel="stylesheet" href="{{ asset('public/styles/backEnd') }}/dist/css/side-menu.css">
@endsection
@section('page_script')
<script>
    var level_id;
    var report={{ $report }};
  </script>
<script src="{{ asset('public') }}/js/backEnd/sunstainable_operations.js"></script>

@endsection
@section('page_header')
@endsection
@section('page_content')
    @inject('healper', 'App\Http\Controllers\BladeController')
{{-- @include('pages.backEnd.AllModuels') --}}
<section class="content cropType">
    <div class="top-bar">

        <h6> عمليات زراعية > عمليات مابعد الانتاج > عمليات مستديمة</h6>
    </div>

    <div class="top-links">
        <div class="row">
                @if($report!==true)
                    <div class="col-6">
                        <img src="#" alt="image">
                        <a src="#" class="ml-4" style="text-decoration: underline;cursor: pointer"> توقيع الابار</a>
                    </div>
                @endif
        </div>
    </div>
    <div class="row m-0">
        @include('pages.backEnd.Operations.rightLink')
        <div class="col-sm-10 col-10 p-0">
            <div class="Mparent">
                <div class="Tparent">
                    <div class="row ml-3 mr-3 mt-3 p-3 filter-search-box ">
                        <div class="col-lg-10">
                            <div class="row filter-res">
                                <div class="col-lg-3  col-6">
                                    <div>
                                        <label>نوع العملية</label>
                                    </div>
                                    <select class="form-control filter-form filter1">
                                            <option>الكل</option>
                                            <option>مرسله</option>
                                            <option> مستقبله</option>
                                        </select>
                                </div>
                                <div class="col-lg-8 col-sm-12 col-md-12 col-12">
                                    <div>
                                        <label>التاريخ</label>
                                    </div>
                                    من
                                    <input type="date" class="type-date"> الى
                                    <input type="date" class="type-date">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 mt-3 col-sm-4 col-md-4 col-12 search-div">
                            {{-- <label class="search-icon">
                                <input type="text" class="search" id="myInput2">
                            </label> --}}
                        </div>
                    </div>
                    <div class="row m-4">
                        <div class=" col-lg-6  col-12 offset-lg-6 mt-3 float-left text-right ">
                            @if($healper->check_permission(24,1))
                            @if($report!==true)
                                <button class="add-crepto mr-2 mb-2 addNewRow " data-target="#addSunstainableOperations" data-toggle="modal">أضافة </button>
                            @endif
                            @endif
                            
                        </div>
                    </div>
                    <div class="row m-3 justify-content-center ">
                        <div class="col-lg-12 ">
                            <table class="table zadnatable" id="SunstainableOperationsDataTable">
                                <thead>
                                    <tr>
                                        <th>الكود</th>
                                        <th>كود المربع</th>
                                        <th>نوع العملية</th>
                                        <th>طريقه التنفيذ</th>
                                        <th>تاريخ التنفيذ</th>
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



<div id="addSunstainableOperations" class="modal fade " role="dialog" currtable page-link="Sustainable-tabs.html">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content modalbg-add">
            <div class="modal-header d-flex flex-row-reverse">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h5 class="modal-title ">اضافه</h5>
            </div>
            <div class="modal-body">
                <form action="POST" id="AddSunstainableOperationsForm">
                    <input type="hidden" value="" name="id" id="id">
                    <div class="row m-4">
                        <div class="col-12">
                            <label class="col-4" for="type">كود المربع:</label>
                            <div class=" col-5 float-right m-0 p-0 " style="    margin-left: 3rem!important;">
                                <select class="form-control filter-form filter1" name="box_id">
                                    <option value="">أختار المربع </option>
                                    @foreach ($Boxes as $value)
                                        <option value="{{ $value->id }}"> {{ $value->code }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div id="box_id_demo"></div>
                        </div>
                    </div>
                    <div class="row m-4">
                        <div class="col-12">
                            <label class="col-5" for="ExCost">نوع العملية</label>
                            <select class="form-control filter-form filter1" name="operation_type_id">
                                <option value="">أختار العمليه </option>
                                @foreach ($operation_type as $key=>$value)
                                    <option value="{{ $key }}"> {{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div id="operation_type_id_demo"></div>
                    </div>


                    <div class="row m-4">
                        <div class="col-12">
                            <label class="col-5" for="date">طريقة التنفبذ:</label>
                            <select class="form-control filter-form filter1" name="used_type_id">
                                <option value="">أختار الطريقه </option>
                                @foreach ($used_type as $key=>$value)
                                    <option value="{{ $key }}"> {{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div id="used_type_id_demo"></div>
                    </div>

                    <div class="row m-4">

                        <div class="col-12">
                            <label class="col-4" for="type">تاريخ التنفيذ:</label>
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

@endsection