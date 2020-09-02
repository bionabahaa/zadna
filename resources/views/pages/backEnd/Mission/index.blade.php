@extends('layouts.backEnd')
@section('page_css')
@endsection
@section('page_script')
<script src="{{ asset('public') }}/js/backEnd/mission.js"></script>
@endsection
@section('page_header')
@endsection
@section('page_content')
@inject('healper', 'App\Http\Controllers\BladeController')
@if($healper->check_permission(30,1))
    <section class="content cropType">
    <div class="top-bar">

        <h6> مهام اضافية </h6>
    </div>
    <div class="Tparent">
        @if($healper->check_permission(33,2))
                <div class="row ml-3 mr-3 mt-3 p-3 filter-search-box filter-form">
                    <div class="col-lg-10">
                        <div class="row filter-res">
                            <div class="col-lg-2 col-sm-12 col-md-12 col-12">
                                <div>
                                    <label>النوع :</label>
                                </div>
                                <select id="status" class="form-control   filter1">
                                    <option value="all">الكل</option>
                                    <option value="1"> ادارية</option>
                                    <option value="2"> زراعية</option>
                                    <option value="3">تسويق</option>
                                </select>
                            </div>

                            <div class="col-lg-8 col-sm-12 col-md-12 col-12">
                                <div>
                                    <label>تاريخ البدايه :</label>
                                </div>
                                <input  name="from" id="from" type="date" class="type-date">
                                <input name="to" id="to"  type="date" class="type-date">
                            </div>
                        </div>
                    </div>
                    <span class="btn btn-dark filter_but" style="height: 45px;border-radius: 21%;" onclick="filter('MissonDataTable','missions/data_tasks')" >بحث</span>



                    {{--<div class="col-lg-2 mt-3 col-sm-4 col-md-4 col-12 search-div">--}}
                    </div>
                </div>
        @endif
        <div class="row m-4">
            <div class="float-left ">
                @if($healper->check_permission(33,3))
                <button class="add-crepto mr-2 mb-2 addNewRow" data-toggle="modal" data-target="#ViewModal">تعيين
                    مهمة </button>
               @endif
            </div>
        </div>
        <div class="row m-3 justify-content-center ">
            <div class="col-lg-10 ">

                <table class="table zadnatable mainTable" id="MissonDataTable">
                    <thead>
                        <tr>
                            <th>كود المربع</th>
                            <th>النوع </th> 
                            <th>المهمة</th>
                            <th>المسؤل</th>
                            <th>تاريخ التنفيذ</th>
                            <th>الحالة</th>
                            <th><i class="fas fa-bars"></i></th>

                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <!-- add  Modal -->
        <div class="modal fade" id="ViewModal" role="dialog" aria-labelledby="ViewModalTitle" aria-hidden="true"
            currtable viewrow page-link="mission-view.html">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content modalbg">
                    <div class="modal-header modal-border">
                        <h5 class="modal-title" id="ViewModalTitle" >تعيين مهمة </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body modal-space">
                        <form id="AddMissionForm">
                            <input type="hidden" id="id" value="" name="id">
                            <div class="table-responsive">
                                <table class="table tableborder">
                                    <thead>
                                        <tr>
                                            <th scope="col">كود المربع</th>
                                            <th scope="col">النوع</th>
                                            <th scope="col">المهمة</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="InputNum">
                                                <select onchange="get_user(this.value)" class="form-control col-val" name="box_id" id="type">
                                                    <option value="">أختار كود المريع</option>
                                                @foreach (@$Boxes as $value)
                                                    <option value="{{ $value->id }}">{{ $value->code }}</option>
                                                @endforeach
                                            </select>
                                            <div id="box_id_demo"></div>
                                            </td>
                                            <td class="InputNum">
                                                <select class="form-control col-val" name="task_type_id" id="type">
                                                    <option value="">أختار النوع</option>
                                                @foreach (@$Types as $key=>$value)
                                                    <option value="{{ $key}}">{{ $value }}</option>
                                                @endforeach
                                            </select>
                                            <div id="task_type_id_demo"></div>
                                            </td>

                                            <td class="InputNum">
                                                <input type="text" name="task" class="form-control numric " style="width: 70%;">
                                                <div id="task_demo"></div>
                                            </td>


                                        </tr>

                                    </tbody>
                                </table>
                                <br> <br>
                                <table class="table tableborder">
                                    <thead>
                                        <tr>
                                            <th scope="col">المسؤل </th>
                                            <th scope="col">تاريخ التنفيذ </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="InputNum">
                                                <select class="form-control select2 col-val mySelectUser" name="to_id" style="width:70%;">

                                                </select>
                                                <div id="to_id_demo"></div>
                                            </td>
                                            <td class="InputNum">
                                                <div class="form-group InputGroup">
                                                    <input type="date" class="form-control numric " name="implementation_at" style="width: 70%;">
                                                    <div id="implementation_at_demo"></div>
                                                </div>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>

                                <table class="table tableborder">

                                    <thead>
                                        <tr>
                                            <th scope="col">الملاحظات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="form-group">
                                                    <textarea class="form-control" name="note"></textarea>
                                                </div>
                                                <div id="note_demo"></div>
                                            </td>

                                        </tr>

                                    </tbody>
                                </table>

                            </div>
                        </form>
                    </div>
                    <div class="modal-footer footer-border">
                        <button type="button" class="btn save-btn Saverecom" id="SubmitButton">حفظ</button>
                        <button type="button" class="btn close-btn" data-dismiss="modal">غلق</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- confirmation modal -->
        <div id="mission-conf" class="modal fade less-culs" role="dialog" currtable="12" view-chat="view-req">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content modalbg-add">
                    <div class="modal-header d-flex flex-row-reverse">
                        <button type="button" class="close" data-dismiss="modal">×</button>
                        <h5 class="modal-title text-center ">ايقاف مهمة</h5>
                    </div>
                    <div class="modal-body">

                        هل انت متاكد من ايقاف المهمة ؟؟


                    </div>
                    <div class="modal-footer">
                        <form id="EditMissionForm">
                            <input type="hidden" value="" name="id" id="cancelled_id">
                        </form>
                        <button type="button" id="SubmitButtonEdit" class="danger btn btn-primary SaveNote ">تأكيد</button>
                        <a href="#" data-dismiss="modal" aria-hidden="true" class="btn btn-danger ">الغاء</a>
                    </div>
                </div>

            </div>
        </div>
    </div>

</section>

<div class="modal fade" id="exampleModalLong2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content modalbg-add">
            <div class="modal-header header-border">
                <h5 class="modal-title" id="exampleModalLongTitle">اضافة نوع</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body ">

                <div class="form-group center">

                    <input type="text" id="name-text" class="textStyle name-text">
                </div>

            </div>
            <div class="modal-footer footer-border">

                <button type="button" class="btn add-btn" data-dismiss="modal" aria-label="Close" value="اضافه" id="addgroup">اضافة</button>
            </div>
        </div>
    </div>
</div>

@else
    <h1 style="text-align: center;color: #28a745; margin-top: 150px">ليس لديك صلاحيه للتحكم فى صفحات تعيين مهمات</h1>
    @endif
@endsection