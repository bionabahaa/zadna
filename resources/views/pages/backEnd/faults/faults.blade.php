@extends('layouts.backEnd')
@section('page_css')
@endsection
@section('page_script')
    <script src="{{ asset('public') }}/js/backEnd/faults.js"></script>
    <script>
        $(function () {
            $(".select2").select2();
        });
    </script>

@endsection
@section('page_header')
@endsection
@section('page_content')
@inject('healper', 'App\Http\Controllers\BladeController')
@if($healper->check_permission(32,1))
    <section class="content cropType">
        <div class="top-bar">

            <h6> <img src="../dist/imgs/icons/syana.png" style="width: 30px;"> الاعطال </h6>
        </div>
        <div class="Tparent">
            @if($healper->check_permission(32,2))
                <div class="row ml-3 mr-3 mt-3 p-3 filter-search-box">
                <div class="col-lg-10">
                    <div class="row filter-res">
                        <div class="col-lg-2 col-sm-12 col-md-12 col-12">
                            <div>
                                <label>النوع :</label>
                            </div>
                            <select id="type" class="form-control filter-form filter2 box2" filtercol="4">
                                <option value="all">الكل</option>
                                <option value='1'> ابار</option>
                                <option value="2">  معدات</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-sm-12 col-md-12 col-12">
                            <div>
                                <label>الحالة :</label>
                            </div>
                            <select id="status" class="form-control filter-form filter2 box2" filtercol="4">
                                <option value="all_status">الكل</option>
                                <option value="2"> رفض</option>
                                <option value="3"> قبول</option>
                                <option value="1"> في الانتظار</option>
                            </select>
                        </div>


                        <div class="col-lg-8 col-sm-12 col-md-12 col-12">
                            <div>
                                <label>التاريخ :</label>
                            </div>
                            من <input  name="from" id="from" type="date" class="type-date">
                            الى <input name="to" id="to"  type="date" class="type-date">
                        </div>
                    </div>
                </div>
                    <span class="btn btn-dark filter_but" style="height: 45px;border-radius: 21%;" onclick="filter('DataTableFaults','Faults/data_faults')" >بحث</span>
                {{--<div class="col-lg-2 mt-3 col-sm-4 col-md-4 col-12 search-div">--}}

                </div>

            </div>
            @endif
            <div class="row m-4">

                <div class="float-left ">
                    @if($healper->check_permission(32,3))
                    <button id="add_fault" class="add-crepto mr-2 mb-2  " data-toggle="modal" data-target="#add-falut">أضافة عطل</button>
                    @endif
                        @if($healper->check_permission(32,7))
                              <a href="{{ URL::to('downloadExcel/xls/Fault/?arr[]='.$arr.'') }}"><button class="btn btn-success export-excel mr-2 mb-2">أخراج كاملف اكسيل</button></a>
                        @endif
                </div>

            </div>

            <div class="row m-3 justify-content-center ">
                <div class="col-lg-10 ">
                    <table id="DataTableFaults" class="table zadnatable">
                        <thead>
                        <tr>
                            <th>الكود</th>
                            <th>النوع</th>
                            <th>الوصف </th>
                            <th>تاريخ الظهور</th>
                            <th>الحاله</th>
                            <th class="actions">العمليات</th>

                        </tr>
                        </thead>
                         </table>
                </div>
            </div>
        </div>
    </section>

    <!-- اضافة عطل  -->
    <div id="add-falut" class="modal fade " role="dialog" currtable="11" view-chat="view-notes">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content modalbg-add">
                <div class="modal-header d-flex flex-row-reverse">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h5 class="modal-title text-center "> عطل</h5>
                </div>
                <!--  form add fault-->
                <form id="form_add_fault" method="post">
                    <input type="hidden" id="id" value="">
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="type" class="col-sm-4 col-form-label">النوع</label>
                        <div class="col-sm-8">
                            <select id="type" name="type"  class="form-control type_change">
                                <option selected disabled>اختر</option>
                                <option  id="beer" value="1"  >ابار</option>
                                <option id="eqi" value="2">معدات</option>
                                <option id="irrig" value="3">شبكه رى</option>
                            </select>
                            <div id="type_demo"></div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="type" class="col-sm-4 col-form-label">الكود</label>
                        <div class="col-sm-8">
                            <select  id="fault_code" name="fault_code" class="form-control ">
                            </select>
                            <div id="fault_code_demo"></div>
                        </div>
                    </div>

                        <div class="form-group row">
                            <label for="desc" class="col-sm-4 col-form-label">الوصف</label>
                            <div class="col-sm-8">
                                <textarea id="desc" name="desc" class="form-control" ></textarea>
                            </div>

                        </div>
                        <div class="form-group row">
                            <label for="date" class="col-sm-4 col-form-label">تاريخ الظهور</label>
                            <div class="col-sm-8">
                                <input id="date" name="date" type="date" class="form-control">
                                <div id="date_demo"></div>
                            </div>

                        </div>

                    @if($healper->check_permission(32,6))
                    <div class="stauts-change mt-4">
                        <div class="form-group row">
                            <label for="date" class="col-sm-4 col-form-label">حالة العطل</label>
                            <div class="col-sm-8">

                                <div class="custom-control custom-radio ">
                                    <input type="radio" name="fault_status" value="2"  id="done" class="custom-control-input refuse">
                                    <label class="custom-control-label" for="done">رفض</label>
                                </div>
                                <div class="custom-control custom-radio ">
                                    <input type="radio" id="canceld" name="fault_status" value="3" class="custom-control-input accept">
                                    <label class="custom-control-label" for="canceld">قبول</label>
                                </div>
                                <div class="custom-control custom-radio ">
                                    <input type="radio" id="wait" checked  name="fault_status" value="1" name="customRadioInline1" class="custom-control-input waiting">
                                    <label class="custom-control-label" for="wait">في الانتظار</label>
                                </div>

                            </div>
                        </div>
                    </div>
                    @endif

                </div>
                </form>
                <div class="modal-footer">
                    @if($healper->check_permission(32,5))
                    <a href="#" id="SubmitButton" class="danger btn btn-primary SaveNote ">حفظ</a>
                    @endif
                    <a href="#" data-dismiss="modal" aria-hidden="true" class="btn btn-danger ">الغاء</a>
                </div>
            </div>

        </div>
    </div>
    </section>
@else
    <h1 style="text-align: center;color: #28a745; margin-top: 150px"> ليس لديك صلاحيه للتحكم فى صفحات الاعطال</h1>
@endif

@endsection