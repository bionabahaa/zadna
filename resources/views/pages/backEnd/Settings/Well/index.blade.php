@extends('layouts.backEnd')
@section('page_css')
@endsection
@section('page_script')
<script>
    var operation_page=0;
    var report={{$report }};
</script>
<script src="{{ asset('public') }}/js/backEnd/well.js"></script>
@endsection
@section('page_header')
@endsection
@section('page_content')
@inject('healper', 'App\Http\Controllers\BladeController')
<section class="content cropType">
    <div class="top-bar">
        <h6>اعدادات عامه >الابار</h6>
    </div>
    @if($healper->check_permission(8,10))
    <div class="row m-4">
        <div class="col-lg-2 mt-2">
            <label>توقيع الابار</label>
        </div>

        <div col-lg-3>
            <!--        <input type="file" class="upload-excel mr-2 mb-2 " >-->
            <div class="button-cont">
                <form id="form_upload" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="name" value="signature_wells" />
                    <input type="file" name="signature_wells" data-id="form_upload" id="file-1" class="inputfile inputfile-1 upload" />
                    <label for="file-1"> <span>تحميل ملف&hellip;</span></label>
                    <a target="_blank" href="" id="uploaded_file">الملف</a>
                    <div id="signature_wells_demo"></div>
                </form>
            </div>


        </div>
    </div>
@endif
    {{--<div class="row m-4">--}}
        {{--<div class="col-lg-2 mt-2">--}}
            {{--<label>خريطة الارض</label>--}}
        {{--</div>--}}

        {{--<div col-lg-3>--}}
            {{--<!--        <input type="file" class="upload-excel mr-2 mb-2 " >-->--}}
            {{--<div class="button-cont">--}}
                {{--<form id="form_upload2" method="post" enctype="multipart/form-data">--}}
                    {{--<input type="hidden" name="name" value="map_earth2" />--}}
                    {{--<input type="file" name="file" data-id="form_upload2" class="inputfile-1 upload" />--}}
                    {{--<label for="file-1"> <span>تحميل ملف&hellip;</span></label>--}}
                    {{--<a target="_blank" href="" id="uploaded_file">الملف</a>--}}
                {{--</form>--}}
            {{--</div>--}}


        {{--</div>--}}
    {{--</div>--}}

    <div class="Tparent">
        @if($healper->check_permission(8,2))
        <div class="row ml-3 mr-3 mt-3 p-3 filter-search-box">
            <div class="col-lg-10">
                <div class="row filter-res">

                    <div class="col-lg-2 col-sm-12 col-md-12 col-12">
                        <div>
                            <label>الحالة :</label>
                        </div>
                        <select name="type" id="type" class="form-control filter-form filter1">
                            <option value="all">الكل</option>
                            <option value="1"> تحت الدراسة</option>
                            <option value="2">تحت التنفيذ</option>
                            <option value="3">تم التنفيذ</option>
                        </select>
                    </div>

                    <div class="col-lg-8 col-sm-12 col-md-12 col-12">
                        <div>
                            <label>فترة الحفر :</label>
                        </div>
                        من <input  name="from" id="from" type="date" class="type-date">
                        الى <input name="to" id="to"  type="date" class="type-date">
                    </div>
                </div>
            </div>
            <span class="btn btn-dark filter_but" style="height: 45px;border-radius: 21%;" onclick="filter('WellDataTable')" >بحث</span>
            <div class="col-lg-2 mt-3 col-sm-4 col-md-4 col-12 search-div"></div>

        </div>
@endif
        <div class="row m-4">
            <div class="float-left ">
                @if($healper->check_permission(8,3))
                          <a href="{{route('wells.create')}}"><button class="add-crepto mr-2 mb-2  ">أضافة بئر</button> </a>
                @endif
                {{--<button class="upload-excel mr-2 mb-2 ">أدخال عن طريق ملف</button>--}}
                    @if($healper->check_permission(8,4))
                       <!--<a href="{{ URL::to('downloadExcel/xls/Wells/?arr[]='.$arr.'') }}"><button class="btn btn-success export-excel mr-2 mb-2">أخراج كاملف اكسيل</button></a>-->
                       <a href="{{ route('well.excel') }}" class="btn btn-success">Export to Excel</a>

                   @endif

            </div>

        </div>
        <div class="row m-3 justify-content-center ">
            <div class="col-lg-10 ">

                <table class="table   zadnatable " id="WellDataTable">
                    <thead>
                        <tr>
                            <th>الكود</th>
                            <th>الاسم</th>
                            <th>الحالة</th>
                            <th>تاريخ الحفر</th>
                            <th>التوقيع</th>
                            <th>العمليات</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection