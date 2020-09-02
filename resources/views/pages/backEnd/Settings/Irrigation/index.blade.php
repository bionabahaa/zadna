@extends('layouts.backEnd')
@section('page_css')
@endsection
@section('page_script')
<script>
    var operation_page=0;
    var report=false;
</script>
<script src="{{ asset('public') }}/js/backEnd/irrigation.js"></script>

@endsection
@section('page_header')
@endsection
@section('page_content')
@inject('healper', 'App\Http\Controllers\BladeController')
<section class="content cropType">
    <div class="top-bar">
        <h6>اعدادات عامه >شبكة الرى</h6>
    </div>
    @if($healper->check_permission(9,10))
    <div class="row m-4">
        <div class="col-lg-2 mt-2">
            <label>توقيع شبكة الرى</label>
        </div>

        <div col-lg-3>
            <!--        <input type="file" class="upload-excel mr-2 mb-2 " >-->

            <div class="button-cont">
                <form id="form_upload" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="name" value="irrigation_files" />
                    <input type="file" name="irrigation_files" id="file-1" class="inputfile inputfile-1 upload"
                        data-multiple-caption="{count} files selected" />

                    <label for="file-1">
                        <span>تحميل ملف&hellip;</span>
                    </label>
                    <label id="uploaded_file-name"></label>
                    <a target="_blank" href="{{ $bath.'/'.@$irrigation_file->value }}" id="uploaded_file">الملف</a>
                    <div id="irrigation_files_demo"></div>
                </form>
            </div>

        </div>
    </div>
    @endif
    <div class="Mparent">
        <div class="Tparent">

            @if($healper->check_permission(9,2))
            <div class="row ml-3 mr-3 mt-3 p-3 filter-search-box">
                <div class="col-lg-10">
                    <div class="row filter-res">
                        <div class="col-lg-2 col-sm-12 col-md-12 col-12">
                            <div>
                                <label>نوع الخط :</label>
                            </div>
                            <select id="type" class="form-control filter-form filter1" >
                                <option value="all">الكل</option>
                                @foreach($line_types as $key=>$line_type)
                                <option value="{{$key}}">{{$line_type}}</option>
                                @endforeach
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
                <span class="btn btn-dark filter_but" style="height: 45px;border-radius: 21%;" onclick="filter('IrrigationlDataTable')" >بحث</span>
                    </div>
                @endif
                </div>
                <div class="col-lg-2 mt-3 col-sm-4 col-md-4 col-12 search-div"></div>
            </div>
            <div class="row m-4">


                <div class="float-left ">

                        @if($healper->check_permission(9,3))
                             <button class="add-crepto mr-2 mb-2 addNewRow " onclick="window.location.href='{{route('irrigation.create')}}'">أضافة
                        خط</button>
                        @endif
                    {{--<button class="upload-excel mr-2 mb-2 ">أدخال عن طريق ملف</button>--}}

                            @if($healper->check_permission(9,4))
                                  <a href="{{ URL::to('downloadExcel/xls/Irrigation/?arr[]='.$arr.'') }}"><button class="btn btn-success export-excel mr-2 mb-2">أخراج كاملف اكسيل</button></a>
                            @endif




                </div>

            </div>

            <div class="row m-3 justify-content-center ">
                <div class="col-lg-10 ">

                    <table class="table zadnatable" id="IrrigationlDataTable" >

                        <thead>
                            <tr>
                                <th style="width:6%">الكود</th>
                                <th>الاسم</th>
                                <th>نوع الخط</th>
                                <th>كمية المياه</th>
                                <th>الطول</th>
                                {{--<th>الاحداثيات</th>--}}
                                <th>المربعات التى يمر بها</th>
                                <th>التوقيع</th>
                                <th>العمليات</th>
                            </tr>
                        </thead>


                    </table>
                </div>
            </div>
        </div>
    </div>

</section>
<script>

</script>
@endsection