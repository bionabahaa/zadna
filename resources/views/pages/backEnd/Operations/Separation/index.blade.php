@extends('layouts.backEnd')
@section('page_css')
<link rel="stylesheet" href="{{ asset('public/styles/backEnd') }}/dist/css/side-menu.css">
@endsection
@section('page_script')
<script>
    function GetPalmTree(box_id){
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("PalmTreeCode").innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", urls.base_url + "/operation/get_palm_tree/" + box_id, true);
        xhttp.send();
    }
    var report={{ $report }};
  </script>
<script src="{{ asset('public') }}/js/backEnd/separation.js"></script>

@endsection
@section('page_header')
@endsection
@section('page_content')
    @inject('healper', 'App\Http\Controllers\BladeController')

@if($healper->check_permission(21,1))
<section class="content cropType">
    <div class="top-bar">
        <h6> عمليات زراعية > عمليات مابعد الانتاج > فصل الفسائل</h6>
    </div>
</section>
    
<div class="row m-0">

    @include('pages.backEnd.Operations.rightLink')

    <div class="col-sm-10 col-10 p-0">
        <div class="Mparent">
            <div class="Tparent">
                @if($healper->check_permission(21,2))
                <div class="row ml-3 mr-3 mt-3 p-3 filter-search-box ">
                    <div class="col-lg-10">

                        <div class="row filter-res">

                            <div class="col-lg-3  col-6">
                                <div>
                                    <label>تاريخ:</label>
                                </div>
                                <select id="status" class="form-control filter-form filter1">
                                        <option value="all">الكل</option>
                                        <option value="1">زرعت</option>
                                        <option value="2"> بيعت</option>
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
                    <span class="btn btn-dark filter_but" style="height: 45px;border-radius: 21%;" onclick="filter('SeparationDataTable')" >بحث</span>
                    {{--<div class="col-lg-2 mt-3 col-sm-4 col-md-4 col-12 search-div">--}}
                    </div>
                </div>
                @endif
                <div class="row m-4">
                    <div class=" col-lg-6  col-12 offset-lg-6 mt-3 float-left text-right ">
                        @if($healper->check_permission(21,3))
                        @if($report!==true)
                            <button type="button" class="add-crepto mr-2 mb-2 addNewRow " data-target="#addOp" data-toggle="modal">أضافة </button>
                        @endif
                        @endif
                    </div>
                </div>
                <div class="row m-3 justify-content-center ">
                    @if($healper->check_permission(21,4))
                        <a href="{{ URL::to('downloadExcel/xls/Separation/?arr[]='.$arr.'') }}"><button class="btn btn-success export-excel mr-2 mb-2">اخراج كملف اكسيل</button></a>
                    @endif
                    <div class="col-lg-12 ">
                        <table class="table zadnatable mainTable" id="SeparationDataTable">
                            <thead>
                                <tr>
                                    <th>الكود</th>
                                    <th>كود المربع</th>
                                    <th>كود النخلة</th>
                                    <th>عدد الفسائل</th>
                                    <th>تاريخ الفصل</th>
                                    <th>الحاله</th>
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

                <div id="addOp" class="modal fade " role="dialog" currtable page-link="separation-tabs.html">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content modalbg-add">
                           
                            <div class="modal-header d-flex flex-row-reverse">
                                <button type="button" class="close" data-dismiss="modal">×</button>
                                <h5 class="modal-title ">اضافه</h5>
                            </div>
                            <div class="modal-body">
                                <form action="" id="AddSeparationForm">
                                    <input type="hidden" value="" id="id">

                                    <div class="row m-4">
                                        <div class="col-12">
                                            <label class="col-4" for="type">كود المربع:</label>
                                            <div class=" col-5 float-right m-0 p-0 " style="    margin-left: 3rem!important;">
                                                <select class="form-control filter-form filter1" onchange="GetPalmTree(this.value)" name="box_id">
                                                    <option value="">أختار المربع </option>
                                                    @foreach ($Boxes as $value)
                                                        <option value="{{ $value->id }}"> {{ $value->code }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="box_id_demo"></div>
                                    <div class="row m-4">
                                        <div class="col-12">
                                            <label class="col-4" for="type">كود النخلة:</label>
                                            <div class=" col-5 float-right m-0 p-0 " style="    margin-left: 3rem!important;">
                                                <select class="form-control col-val" name="plam_tree" id="PalmTreeCode">
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="PalmTreeCode_demo"></div>
                                
                                    <div class="row m-4">
                                        <div class="col-12">
                                            <label class="col-5" for="date">عدد الفسائل</label>
                                            <input type="number" name="number_of_separation" id="date" class="border-style col-6 col-val">
                                        </div>
                                        <div id="number_of_separation_demo"></div>
                                    </div>
                                    <div class="row m-4">
                                        <div class="col-12">
                                            <label class="col-5" for="date">تاريخ الفصل</label>
                                            <input type="date" name="start_date" id="date" class="border-style col-6 col-val">
                                        </div>
                                    </div>
                                    <div id="start_date_demo"></div>
                                    <div class="row m-4">
                                        <div class="col-12">
                                            <label class="col-4" for="type">الحالة :</label>
                                            <div class=" col-5 float-right m-0 p-0 " style="    margin-left: 3rem!important;">
                                                <select class="form-control col-val" name="case" id="type">
                                                    <option value="1">زرعت</option>
                                                    <option value="2">بيعت</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="case_demo"></div>
                                </form>
                            </div>
                            <div class="modal-footer">

                                <button id="SubmitButton"  class="danger btn btn-primary Saverecom">حفظ</button>

                                <a href="#" data-dismiss="modal" aria-hidden="true" class="btn btn-danger ">الغاء</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    @else
    <h1 style="text-align: center;color: #28a745; margin-top: 150px">ليس لديك صلاحيه للدخول لصفحه فصل الفسائل</h1>
    @endif

@endsection