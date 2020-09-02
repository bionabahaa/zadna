@extends('layouts.backEnd')
@section('page_css')
<link rel="stylesheet" href="{{ asset('public/styles/backEnd') }}/dist/css/side-menu.css">
@endsection
@section('page_script')
<script>
        var level_id;
        var report={{ $report }};
  </script>
<script src="{{ asset('public') }}/js/backEnd/cleaning.js"></script>

@endsection
@section('page_header')
@endsection
@section('page_content')
 @inject('healper', 'App\Http\Controllers\BladeController')
 @if($healper->check_permission(18,1))
<section class="content cropType">
    <div class="top-bar">

            <h6> عمليات زراعية > عمليات الغرس > الغسيل </h6>
    </div>

    {{--  <div class="top-links">
        <div class="row">
            <div class="col-6">
                <img src="#" alt="image">
                <a src="#" class="ml-4" style="text-decoration: underline;cursor: pointer"> توقيع الابار</a>

            </div>
        </div>
    </div>  --}}
    <div class="row m-0">
        @include('pages.backEnd.Operations.rightLink')
        <div class="col-sm-10 col-10 p-0">
                <div class="Tparent">
                    @if($healper->check_permission(18,2))
                    <div class="row ml-3 mr-3 mt-3 p-3 filter-search-box ">
                        <div class="col-lg-10">
                            <div class="row filter-res">
                                <div class="col-lg-8 col-sm-12 col-md-12 col-12">
                                    <div>
                                        <label> تاريخ البداية :</label>
                                    </div>
                                    من <input  name="from" id="from" type="date" class="type-date">
                                    الى <input name="to" id="to"  type="date" class="type-date">
                                </div>
                            </div>
                        </div>
                        <span class="btn btn-dark filter_but" style="height: 45px;border-radius: 21%;" onclick="filter('CleaningDataTable')" >بحث</span>
                        {{--<div class="col-lg-2 mt-3 col-sm-4 col-md-4 col-12 search-div"></div>--}}
                        </div>
                    @endif
                    </div>
            <br>

            <div class="row m-3 justify-content-center ">
                        <div class="col-md-10">
                            <div class=" Tparent">
                                @if($healper->check_permission(18,3))
                                @if($report!==true)
                                    <button class="btn add-crepto addation addNewRow" data-toggle="modal" data-target="#AddNewClean">اضافة</button>
                                @endif
                                @endif
                                    @if($healper->check_permission(14,4))
                                        <a href="{{ URL::to('downloadExcel/xls/Cleaning/?arr[]='.$arr.'') }}" ><button  class="btn btn-success export-excel mr-2 mb-2">اخراج كملف اكسيل</button></a>
                                    @endif
                                <table class="table zadnatable" id="CleaningDataTable">
                                    <thead>
                                        <tr>
                                            <th>الكود</th>
                                            <th>كود المربع</th>
                                            <th>تاريخ البداية</th>
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


    <div id="AddNewClean" class="modal fade less-culs" role="dialog" currtable page-link="washing-tabs.html">
        
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content modalbg-add">
                <div class="modal-header d-flex flex-row-reverse">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h5 class="modal-title ">اضافه</h5>
                </div>
                <div class="modal-body">
                    <form id="AddCleaningForm">
                        <input type="hidden" name="id" id="id" value="">
                        <input type="hidden" value="{{ $level_id }}" name="level_id" id="level_id">
                    <div class="row m-4">
                        <div class="col">
                            <label class="col-5" for="state">كود المربع :</label>
                            <select class="form-control filter-form filter1" name="box_id">
                                    <option value="">أختار المربع </option>
                                    @foreach ($Boxes as $value)
                                        <option value="{{ $value->id }}"> {{ $value->code }}</option>
                                    @endforeach
                            </select>
                            <div id="box_id_demo"></div>
                        </div>
                        
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


</section>
    @else
         <h1 style="text-align: center;color: #28a745; margin-top: 150px">ليس لديك صلاحيه للدخول لصفحه الرى</h1>
    @endif
@endsection