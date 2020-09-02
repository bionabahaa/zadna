@extends('layouts.backEnd')
@section('page_css')
<link rel="stylesheet" href="{{ asset('public/styles/backEnd') }}/dist/css/side-menu.css">
@endsection
@section('page_script')
<script>
    var operation_page=1;
    var report={{ $report  }};
  </script>
<script src="{{ asset('public') }}/js/backEnd/well.js"></script>

@endsection
@section('page_header')
@endsection
@section('page_content')
@inject('healper', 'App\Http\Controllers\BladeController')

@if($healper->check_permission(12,1))
<section class="content cropType">
    <div class="top-bar">

        <h6> عمليات زراعية > الأبار </h6>
    </div>

    {{--<div class="top-links">--}}
        {{--<div class="row">--}}
            {{--<div class="col-6">--}}
                    {{--<a href="{{ $bath }}" class="ml-4" style="text-decoration: underline;cursor: pointer"> توقيع الابار</a>--}}

            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
    <div class="row m-0">
        @include('pages.backEnd.Operations.rightLink')

        <div class="col-sm-10 col-10 p-0"    >
            <div class="Tparent">
                <div class="row ml-3 mr-3 mt-3 p-3 filter-search-box ">
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
                    {{--<div class="col-lg-2 mt-3 col-sm-4 col-md-4 col-12 search-div"></div>--}}
                
                    </div>


                </div>

                <div class="row m-3 justify-content-center ">
                    <a href="{{ URL::to('downloadExcel/xls/Wells/?arr[]='.$arr.'') }}"><button class="btn btn-success export-excel mr-2 mb-2">أخراج كاملف اكسيل</button></a>
                    @if(Request('reports')==1)
                        {{--@if($healper->check_permission(8,4))--}}
                        {{--@endif--}}
                    @endif
                    <div class="col-lg-12 ">
                        <table class="table zadnatable" id="WellDataTable">
                            <thead>
                                <tr>
                                    <th>الكود</th>
                                    <th>الاسم</th>
                                    <th>الحاله</th>
                                    <th>تاريخ الحفر</th>
                                    <th>التوقيع</th>
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
</section>
    @else
    <h1 style="text-align: center;color: #28a745; margin-top: 150px">ليس لديك صلاحيه للدخول لصفحه الابار</h1>
    @endif

@endsection