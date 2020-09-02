@extends('layouts.backEnd')
@section('page_css')
<link rel="stylesheet" href="{{ asset('public/styles/backEnd') }}/dist/css/side-menu.css">
@endsection
@section('page_script')
<script>
        var report={{ $report }};
        var get_crop = function(id) {
            var url_ajax = urls.base_url + "/operation/planting"  + '/get_crops?box_id=' + id;
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var inputs = $(".mySelectCrop");
                    for (var i = 0; i < inputs.length; i++) {
                        $(inputs[i]).html(this.responseText);
                    }
                    get_user(id);
                }
            };
            xhttp.open("GET", url_ajax, true);
            xhttp.send();
        }
  </script>
<script src="{{ asset('public') }}/js/backEnd/harvest.js"></script>

@endsection
@section('page_header')
@endsection
@section('page_content')
    @inject('healper', 'App\Http\Controllers\BladeController')
{{-- @include('pages.backEnd.AllModuels') --}}
    @if($healper->check_permission(22,1))
<section class="content cropType">
    <div class="top-bar">

            <h6> عمليات زراعية > الحصاد</h6>
    </div>

    <div class="top-links">
        <div class="row">
                {{-- @if($report!==true)
                    <div class="col-6">
                        <img src="#" alt="image">
                        <a src="#" class="ml-4" style="text-decoration: underline;cursor: pointer"> توقيع الابار</a>
                    </div>
                @endif --}}
        </div>
    </div>
    <div class="row m-0">
        @include('pages.backEnd.Operations.rightLink')
        <div class="col-sm-10 col-10 p-0">
            <div class="Mparent">
                <div class="Tparent">
                    @if($healper->check_permission(22,2))
                        <div class="row ml-3 mr-3 mt-3 p-3 filter-search-box ">
                                <div class="col-lg-10">
    
                                    <div class="row filter-res">

                                        <div class="col-lg-8 col-sm-12 col-md-12 col-12">
                                            <div>
                                                <label>تاريخ البداية (من):</label>
                                            </div>
                                            من
                                            <input id="from" type="date" class="type-date"> الى
                                            <input id="to" type="date" class="type-date">
                                        </div>
                                    </div>
                                </div>
                            <span class="btn btn-dark filter_but" style="height: 45px;border-radius: 21%;" onclick="filter('HarvestDataTable','operation/data_harvest')" >بحث</span>


                                {{--<div class="col-lg-2 mt-3 col-sm-4 col-md-4 col-12 search-div">--}}
                                    {{-- <label class="search-icon">
                                        <input type="text" class="search" id="myInput2">
                                    </label> --}}
                                </div>
                            </div>
                    @endif
                    <div class="row m-4">
                        <div class=" col-lg-6  col-12 offset-lg-6 mt-3 float-left text-right ">
                            @if($healper->check_permission(22,3))
                                @if($report!==true)
                                    <button class="add-crepto mr-2 mb-2 addNewRow " data-target="#addHarvest" data-toggle="modal">أضافة </button>
                                @endif
                          @endif
                                @if($healper->check_permission(22,4))
                                    <a href="{{ URL::to('downloadExcel/xls/Harvests/?arr[]='.$arr.'') }}"><button class="btn btn-success export-excel mr-2 mb-2">اخراج كملف اكسيل</button></a>
                                @endif
                        </div>
                    </div>
                    <div class="row m-3 justify-content-center ">
                        <div class="col-lg-12 ">
                            <table class="table zadnatable" id="HarvestDataTable">
                                <thead>
                                    <tr>
                                        <th>الكود</th>
                                        <th>كود المربع</th>
                                        <th>الصف</th>
                                        <th>العمود</th>
                                        <th>الصنف</th>
                                        <th>الكميه التى تم حصدها</th>
                                        <th>التاريخ</th>
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

<div id="addHarvest" class="modal fade " role="dialog" currtable page-link="harvest-tabs.html">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content modalbg-add">
            <div class="modal-header d-flex flex-row-reverse">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h5 class="modal-title ">اضافه</h5>
            </div>
            <div class="modal-body">
                <form action="POST" id="AddHarvestForm">
                    <input type="hidden" name="id" id="id" value="">
                        <div class="col-12">
                            <label class="col-4" for="type">كود المربع:</label>
                            <div class=" col-5 float-right m-0 p-0 " style="    margin-left: 3rem!important;">
                                <select onchange="get_crop(this.value)" class="form-control filter-form filter1" name="box_id">
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
                                <label class="col-5" for="row">الصنف</label>
                                <select class="form-control filter-form filter1 mySelectCrop"  name="crop_id">
                                    <option value="">أختار الصنف </option>
                                </select>
                            </div>
                            <div id="crop_id_demo"></div>
                        </div>
        

                    <div class="row m-4">
                        <div class="col-12">
                            <label class="col-5" for="row">الصف</label>
                            <input type="number" name="row" id="row" class="border-style col-6 col-val">
                        </div>
                        <div id="row_demo"></div>
                    </div>
                    <div class="row m-4">
                        <div class="col-12">
                            <label class="col-5" for="column">العمود</label>
                            <input type="number" name="column" id="column" class="border-style col-6 col-val">
                        </div>
                        <div id="column_demo"></div>
                    </div>

                    <div class="row m-4">
                        <div class="col-12">
                            <label class="col-5" for="qyt">كميات تم حصدها</label>
                            <input type="number" name="qyt" id="date" class="border-style col-6 col-val"><span>شوال</span>
                        </div>
                        <div id="qyt_demo"></div>
                    </div>

                    <div class="row m-4">
                        <div class="col-12">
                            <label class="col-5" for="date">التاريخ </label>
                            <input type="date" name="date" id="date" class="border-style col-6 col-val">
                        </div>
                        <div id="date_demo"></div>
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
        <h1 style="text-align: center;color: #28a745; margin-top: 150px">ليس لديك صلاحيه للدخول لصفحه الحصاد</h1>
  @endif
@endsection