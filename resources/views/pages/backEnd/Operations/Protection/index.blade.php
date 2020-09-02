@extends('layouts.backEnd')
@section('page_css')
<link rel="stylesheet" href="{{ asset('public/styles/backEnd') }}/dist/css/side-menu.css">
@endsection
@section('page_script')
<script>
    var level_id;
    var report={{ $report }};
  </script>
<script src="{{ asset('public') }}/js/backEnd/protection.js"></script>

@endsection
@section('page_header')
@endsection
@section('page_content')
    @inject('healper', 'App\Http\Controllers\BladeController')
{{-- @include('pages.backEnd.AllModuels') --}}
  @if($healper->check_permission(20,1))
<section class="content cropType">
    <div class="top-bar">

        <h6> عمليات زراعية > عمليات مابعد الانتاج > الوقاية</h6>
    </div>

    {{--<div class="top-links">--}}
        {{--<div class="row">--}}
                {{--@if($report!==true)--}}
                    {{--<div class="col-6">--}}
                        {{--<img src="#" alt="image">--}}
                        {{--<a src="#" class="ml-4" style="text-decoration: underline;cursor: pointer"> توقيع الابار</a>--}}
                    {{--</div>--}}
                {{--@endif--}}
            {{----}}
        {{--</div>--}}
    {{--</div>--}}
    <div class="row m-0">
        @include('pages.backEnd.Operations.rightLink')
        <div class="col-sm-10 col-10 p-0">
            <div class="Mparent">
                <div class="Tparent">
                    @if($healper->check_permission(20,2))
                    <div class="row ml-3 mr-3 mt-3 p-3 filter-search-box ">
                        <div class="col-lg-10">
                        </div>
                        <div class="col-lg-2 mt-3 col-sm-4 col-md-4 col-12 search-div"></div>
                        </div>
                    @endif
                    </div>
                    <div class="row m-4">
                        <div class=" col-lg-6  col-12 offset-lg-6 mt-3 float-left text-right ">
                            @if($healper->check_permission(20,3))
                            @if($report!==true)
                                <button class="add-crepto mr-2 mb-2 addNewRow " data-target="#addProtection" data-toggle="modal">أضافة </button>
                            @endif
                         @endif
                            
                        </div>
                    </div>
                    <div class="row m-3 justify-content-center ">
                        @if($healper->check_permission(20,4))
                            <a href="{{ URL::to('downloadExcel/xls/Protections/?arr[]='.$arr.'') }}"><button class="btn btn-success export-excel mr-2 mb-2">اخراج كملف اكسيل</button></a>
                        @endif
                        <div class="col-lg-12 ">
                            <table class="table zadnatable" id="ProtectionDataTable">
                                <thead>
                                    <tr>
                                        <th>الكود</th>
                                        <th>كود المربع</th>
                                        <th>اسم المبيد</th>
                                        <th>تاريخ البداية</th>
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

<div id="addProtection" class="modal fade less-culs" role="dialog" currtable page-link="protection-tabs.html">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content modalbg-add">
            <div class="modal-header d-flex flex-row-reverse">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h5 class="modal-title ">اضافه</h5>
            </div>
            <div class="modal-body">
                <form action="POST" id="AddProtectionForm">
                    <input type="hidden" name="id" id="id" value="">
                    <input type="hidden" name="level_id" id="id" value="{{ $level_id }}">
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
                            <label class="col-5" for="date"> المبيد</label>
                            <select class="form-control filter-form filter1" name="matrial_id">
                                    <option value="">أختار المبيد </option>
                                    @foreach ($Matriels as $value)
                                        <option value="{{ $value->id }}"> {{ $value->title }}</option>
                                    @endforeach
                                </select>
                        </div>
                        <div id="matrial_id_demo"></div>
                    </div>
                    <div class="row m-4">
                        <div class="col-12">
                            <label class="col-5" for="date">تاريخ البدايه</label>
                            <input type="date" name="start_date" id="start_date" class="border-style col-6 col-val">
                        </div>
                        <div id="start_date_demo"></div>
                    </div>
                    <div class="row m-4">
                            <div class="col-12">
                                <label class="col-5" for="date">الكميه الكليه</label>
                                <input type="number" name="qyt" id="start_date" class="border-style col-6 col-val"><span>لتر</span>
                            </div>
                            <div id="start_date_demo"></div>
                        </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="SubmitButton" class="danger btn btn-primary Saverecom">حفظ</button>
                <a href="#" data-dismiss="modal" aria-hidden="true" class="btn btn-danger ">الغاء</a>
            </div>
        </div>

    </div>
</div>

    @else
      <h1 style="text-align: center;color: #28a745; margin-top: 150px">ليس لديك صلاحيه للدخول لصفحه الوقايه</h1>
    @endif
@endsection