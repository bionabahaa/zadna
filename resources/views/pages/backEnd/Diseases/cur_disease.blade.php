@extends('layouts.backEnd')
@section('page_css')
@endsection
@section('page_script')
    <script src="{{ asset('public') }}/js/backEnd/disease.js"></script>
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

<section class="content cropType">
    <div class="top-bar">
        <h6> الأمراض > الأمراض الحالية</h6>
    </div>

    @if($healper->check_permission(42,2))
        <div class="col-sm-12 col-12 p-0">

                    <div class="row ml-3 mr-3 mt-3 p-3 filter-search-box ">
                        <div class="col-lg-10">

                            <div class="row filter-res">

                                <div class="col-lg-2 col-sm-12 col-md-12 col-12">
                                    <div>
                                        <label>حالة المرض:</label>
                                    </div>
                                    <select name="type" id="type" class="form-control filter-form filter1">
                                        <option value="all">الكل</option>
                                        <option value="1"> تم شفائه </option>
                                        <option value="2"> تم فقده</option>
                                    </select>
                                </div>

                                <div class="col-lg-8 col-sm-12 col-md-12 col-12">
                                    <div>
                                        <label>فترة الاصابه :</label>
                                    </div>
                                    من <input  name="from" id="from" type="date" class="type-date">
                                    الى <input name="to" id="to"  type="date" class="type-date">
                                </div>
                            </div>
                        </div>
                        <span class="btn btn-dark filter_but" style="height: 45px;border-radius: 21%;" onclick="filter('DATATABLE_current_disease')" >بحث</span>
                        </div>
                        <div class="col-lg-2 mt-3 col-sm-4 col-md-4 col-12 search-div">

                        </div>
                    </div>
    @endif
                    <div class="row m-4">
                        <div class="float-left ">
                            @if($healper->check_permission(42,3))
                                <button class="add-crepto mr-2 mb-2  addNewRow " data-toggle="modal" data-target="#addOp">أضافة </button>
                            @endif
                            @if($healper->check_permission(42,10))
                                    <a href="{{ URL::to('downloadExcel/xls/diseasePalmTree/cur_disease') }}"><button class="btn btn-success export-excel mr-2 mb-2">أخراج كاملف اكسيل</button></a>
`                           @endif
                        </div>
                    </div>

                    <div class="row m-3 justify-content-center ">
                        <div class="col-lg-12 ">

                            <table id="DATATABLE_current_disease" class="table zadnatable mainTable" tableId="11">
                                <thead>
                                <tr>
                                    <th style=" width: 6%;">الكود</th>
                                    <th>اسم المرض</th>
                                    <th>وصف المرض</th>
                                    <th>النخل المصاب</th>
                                    <th>تاريخ الإصابة</th>
                                    <th class="actions">
                                        <i class="fas fa-bars"></i>
                                    </th>
                                </thead>
                               </table>
                        </div>




                    </div>


                    <div id="addOp" class="modal fade less-culs" role="dialog" currtable page-link="diseases-tabs.html">

                        <div class="modal-dialog">
<form id="form_add_diseaseDetail" method="post">
    <input type="hidden" id="id" value="">
                            <!-- Modal content-->
                            <div class="modal-content modalbg-add">
                                <div class="modal-header d-flex flex-row-reverse">
                                    <button type="button" class="close" data-dismiss="modal">×</button>
                                    <h5 class="modal-title ">اضافه</h5>
                                </div>
                                <div class="modal-body">
                                    <div class="row m-4">
                                        <div class="col">
                                            <label class="col-5" for="state">اسم المرض:</label>
                                            <select name="disease_id" class=" numric select2 typescrop col-val col-6"  style="width: 50%;" >
                                                <option selected disabled>اختر المرض</option>
                                                @foreach($diseases as $disease)
                                                    <option value="{{$disease->id}}">{{$disease->title}}</option>
                                                @endforeach
                                            </select>
                                            <div id="disease_id_demo"></div>
                                        </div>

                                    </div>
                                    <div class="row m-4">
                                        <div class="col">
                                            <label class="col-5" for="state">اختر المربع:</label>
                                            <select name="box_id" id="choose_box"  class="numric select2 typescrop col-val col-6"  style="width: 50%;" >
                                                <option selected disabled>اختر المربع</option>
                                                @foreach($boxes as $box)
                                                    <option value="{{$box->id}}">{{$box->code}}</option>
                                                @endforeach
                                            </select>
                                            <div id="box_id_demo"></div>
                                        </div>

                                    </div>

                                    <div class="row m-4">
                                        <div class="col">
                                            <label class="col-5" for="state">كود النخله</label>
                                            <select name="palms[]" class=" numric select2 typescrop col-val col-6" id="plam_tree_code" style="width: 50%;" multiple>
                                            </select>
                                            <div id="palms_demo"></div>
                                        </div>
                                    </div>

                                    <div class="row m-4">
                                        <div class="col-12">
                                            <label class="col-5" for="ExCost">تاريخ الإصابة</label>
                                            <input name="date" type="date" id="ExCost" class="border-style col-6 col-val">
                                        </div>
                                        <div id="date_demo"></div>
                                    </div>
                                    <div class="row m-4">
                                        <div class="col-12">
                                            <label class="col-5" for="ExCost">المكافحه بواسطة</label>
                                            <select name="user_id" class=" numric select2 typescrop col-val col-6"  style="width: 50%;" >
                                                <option selected disabled>اختر المستخدم</option>
                                                @foreach($users as $user)
                                                    <option value="{{$user->id}}">{{$user->username}}</option>
                                                @endforeach
                                            </select>
                                            <div id="user_id_demo"></div>
                                        </div>
                                    </div>

                                </div>

                                <div class="modal-footer">
                                    <a href="#" id="SubmitButton" data-dismiss="modal" class="danger btn btn-primary Saverecom">حفظ</a>
                                    <a href="#" data-dismiss="modal" aria-hidden="true" class="btn btn-danger ">الغاء</a>
                                </div>
                            </div>
</form>
                    </div>





                    <div id="sendRepModal" class="modal fade " role="dialog" currtable="">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content modalbg-add">
                                <div class="modal-header d-flex flex-row-reverse">
                                    <button type="button" class="close" data-dismiss="modal">×</button>
                                    <h5 class="modal-title text-center ">الحاله بعد المكافحه</h5>
                                </div>
                                <form class="modal-body">


                                    <div class="lost-reson">
                                        <h5 class="mx-auto text-center" style="border-bottom: 1px solid; width: 38%;">اسباب الفقد</h5>
                                        <div class="row mt-4">
                                            <div class="col-7">
                                                <ol class="list-group reas-list ml-2">
                                                    <li>
                                                        <input type="text" class="form-control border-style" value="السبب الاول" style="margin-top: -24px">
                                                    </li>

                                                </ol>
                                            </div>
                                            <div class="col-3 offset-2">
                                                <i class="far fa-plus-square add-item"></i>


                                            </div>
                                        </div>
                                    </div>
                                    <div class="cure-rate">
                                        <h5 class="mx-auto text-center" style="border-bottom: 1px solid; width: 38%;">نسبه الشفاء</h5>
                                        <div class="mx-auto" style=" width: 38% ">
                                            <input type="text" class="form-control border-style text-center mt-4" value="40%">

                                        </div>

                                    </div>



                                    <br>
                                </form>
                                </div>
                                <div class="modal-footer">
                                    <a href="#" id="saveDate" class="danger btn btn-primary Send ">حفظ</a>
                                    <a href="#" data-dismiss="modal" aria-hidden="true" class="btn btn-danger ">الغاء</a>
                                </div>
                            </div>

                        </div>



                </div>
            </div>
        </div>
    </div>
</section>

@endsection