@extends('layouts.backEnd')
@section('page_css')
@endsection
@section('page_script')
<script src="{{ asset('public') }}/js/backEnd/mission.js"></script>
@endsection
@section('page_header')
@endsection
@section('page_content')
<section class="content cropType">
        <div class="top-bar">
    
            <h6> المهام > التفاصيل</h6>
        </div>
    
    </section>
    
    <div class="row m-0">
        <div class="col-sm-12 col-12 p-0">
            <div>
                <div class="row  mt-0 mr-4 ml-4 mb-4">
                    <ul class="nav nav-tabs tabrow" id="myTab" role="tablist" style="margin-top: 5%;border-right: 1.5px solid #dee2e6; margin-bottom: 0px">
                        <li class="nav-item selected ">
                            <a class="nav-link linkColor active " id="Gdetails-tab" data-toggle="tab" href="#Gdetails"
                                role="tab" aria-controls="Gdetails" aria-selected="false" style="border: none;
                    padding: 4px;
                    font-size: 22px;">المواصفات
                                العامة</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link linkColor " id="resource-tab" data-toggle="tab" href="#resource" role="tab"
                                aria-controls="analyse" aria-selected="true" style="border: none;
                padding: 4px;
                font-size: 22px;">موارد
                                العمليات</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link linkColor  " id="notes-tab" data-toggle="tab" href="#notes" role="tab"
                                aria-controls="notes" aria-selected="true" style="border: none;
            padding: 4px;
            font-size: 22px;">الملاحظات</a>
                        </li> -->
                        <!-- <li class="nav-item ">
                            <a class="nav-link linkColor" id="requests-tab" data-toggle="tab" href="#requests" role="tab"
                                aria-controls="requests" aria-selected="false" style="border: none;
            padding: 4px;
            font-size: 22px;">توصيات</a>
                        </li> -->
                    </ul>
                    <div class="tab-content pb-5 " id="myTabContent" style="width: 100%;overflow: hidden;">
                        <div class="tab-pane fade  show active  " id="Gdetails" role="tabpanel" aria-labelledby="Gdetails-tab"
                            style="border-right: 1px solid #dee2e6;border-left: 1px solid #dee2e6;">
                            <div class="row m-4 tab-top">
                                <div class="col-lg-12 col-sm-12 col-12 ">
                                    <table class="table borderless table1">
                                        <thead>
                                            <tr>
                                                <th scope="col">وصف المهمة</th>
    
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="border_bottom">
    
                                                <td>
                                                    <div class="form-group InputGroup">
                                                        <textarea type="text" class="form-control numric td-edit "
                                                            disabled=""></textarea>
    
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-lg-12 col-sm-12 col-12 ">
                                    <table class="table borderless table1 " style="margin-top: 7%">
                                        <thead>
                                            <tr>
                                                <th scope="col">الحاله </th>
                                                <th scope="col">الملاحظات</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="border_bottom">
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input">
                                                        <label class="custom-control-label" for="customRadio1">تم
                                                            التنفيذ</label>
                                                    </div>
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input">
                                                        <label class="custom-control-label" for="customRadio2">لم يتم
                                                            التنفيذ</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group InputGroup">
                                                        <textarea type="text" class="form-control numric td-edit "
                                                            disabled=""></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col pl-5">
                                <button type="button" class="btn edit-btn ml-5" style="background-color:green">تعديل</button>
                                <button type="button" class="btn save-btn ml-5 save-edit-tabs " hidden="">حفظ</button>
                            </div>
    
                        </div>
    
    
                        <div class="tab-pane fade " id="resource" role="tabpanel" aria-labelledby="resource-tab" style="border-right: 1px solid #dee2e6;border-left: 1px solid #dee2e6;">
    
                            <div class="Mparent">
                                <!--table1    -->
                                <div class="Tparent">
                                    <div class="row m-4 ">
                                        <div class="col-lg-12 col-sm-12 col-12 ">
                                            <div class="col-6 collapsed" style="margin-right: 6% ; margin-top: 2% ;cursor: pointer"
                                                data-toggle="collapse" href="#collapseExample4" aria-expanded="false">
                                                <a class="fas fa-caret-left " style="color:green"></a>
                                                <span class="faults-types1"> التكاليف: </span>
    
                                            </div>
                                            <hr class="light-hr1">
    
                                            <div class="collapse   table-responsive" id="collapseExample4" style="padding-bottom: 5rem;">
                                                <button class="addNewRow add-crepto mr-2 mb-2 sssss " data-toggle="modal"
                                                    data-target="#addmodal1" style="margin-right: 80%;">أضافة </button>
    
                                                <table class="table  table-bordered table2 mainTable" tableid="6">
                                                    <thead style="text-align: center">
                                                        <tr>
                                                            <th scope="col">الكود</th>
                                                            <th scope="col">البيان</th>
                                                            <th scope="col"> تكلفه متوقعة</th>
                                                            <th scope="col"> تكلفه فعلية</th>
                                                            <th scope="col"> تاريخ الدفع</th>
                                                            <th scope="col">
                                                                <i class="fas fa-bars"></i>
                                                            </th>
                                                        </tr>
                                                    </thead>
    
                                                    <tbody>
    
                                                        <tr rowid="13">
                                                            <td>
                                                                <div class="form-group InputGroup">
                                                                    <input type="text" class="form-control td-input addon"
                                                                        value="11" disabled="">
    
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group InputGroup">
                                                                    <input type="text" class="form-control td-input addon"
                                                                        value="البيان" disabled="">
    
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group InputGroup">
                                                                    <input type="text" class="form-control td-input addon"
                                                                        value="88" disabled="">
    
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group InputGroup">
                                                                    <input type="text" class="form-control td-input addon"
                                                                        value="9" disabled="">
    
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group InputGroup">
                                                                    <input type="text" class="form-control td-input addon"
                                                                        value="2018-05-16" disabled="">
    
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <i class="fas fa-eye view-row" title="View" data-toggle="modal"
                                                                    data-target="#addmodal1"></i>
                                                                <i class="fas fa-check-square save-edit" hidden=""></i>
                                                            </td>
                                                        </tr>
    
                                                    </tbody>
    
                                                </table>
                                            </div>
                                        </div>
                                    </div>
    
                                    <!--  add modal for  table1  -->
    
                                    <div id="addmodal1" class="modal fade " role="dialog" currtable>
                                        <div class="modal-dialog">
    
                                            <!-- Modal content-->
                                            <div class="modal-content modalbg-add">
                                                <div class="modal-header d-flex flex-row-reverse">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h5 class="modal-title ">اضافة</h5>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row m-4">
    
    
                                                        <div class="col">
                                                            <label class="col-5" for="state">البيان:</label>
                                                            <input type="text" id="state" class="border-style col-6 col-val">
    
                                                        </div>
                                                    </div>
    
                                                    <div class="row m-4">
                                                        <div class="col-12">
                                                            <label class="col-5" for="ExCost">تكلفه متوقعة:</label>
                                                            <input type="text" id="ExCost" class="border-style col-6 col-val">
                                                        </div>
                                                    </div>
                                                    <div class="row m-4">
    
                                                        <div class="col-12">
                                                            <label class="col-5" for="RlCost">تكلفه فعلية:</label>
                                                            <input type="text" id="RlCost" class="border-style col-6 col-val">
    
                                                        </div>
                                                    </div>
    
    
                                                    <div class="row m-4">
    
    
                                                        <div class="col-12">
                                                            <label class="col-5" for="date">التاريخ:</label>
                                                            <input type="date" id="date" class="border-style col-6 col-val">
    
                                                        </div>
                                                    </div>
    
    
    
    
    
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="#" id="addrow" data-dismiss="modal" class="danger btn btn-primary btnSave">حفظ</a>
                                                    <a href="#" data-dismiss="modal" aria-hidden="true" class="btn btn-danger ">الغاء</a>
                                                </div>
                                            </div>
    
                                        </div>
                                    </div>
                                </div>
                            </div>
    
                            <div class="Mparent">
                                <!--table2    -->
                                <div class="Tparent">
    
                                    <div class="row m-4">
                                        <div class="col-lg-12 col-sm-12 col-12 collapsed  ">
                                            <div data-toggle="collapse" href="#collapseExample5" style="margin-right: 6% ; margin-top: 2% ;cursor: pointer"
                                                aria-expanded="false">
                                                <a class="fas fa-caret-left " style="color:green"></a>
                                                <span class="faults-types1"> العمالة: </span>
    
                                            </div>
                                            <hr class="light-hr1">
                                            <div class="collapse table-responsive" id="collapseExample5">
                                                <button class=" addNewRow add-crepto mr-2 mb-2 sssss " data-toggle="modal"
                                                    data-target="#addmodal22" style="margin-right: 80%;">أضافة </button>
    
                                                <table class="table  table-bordered table2 mainTable" tableid="7">
                                                    <thead style="text-align: center">
                                                        <tr>
                                                            <th scope="col">الكود</th>
                                                            <th scope="col">النوع</th>
                                                            <th scope="col">العدد</th>
                                                            <th scope="col"> عدد ساعات العمل باليوم</th>
                                                            <th scope="col"> عدد ايام الاستخدام</th>
                                                            <th scope="col"> التكلفه</th>
                                                            <th scope="col">التاريخ</th>
                                                            <th scope="col">
                                                                <i class="fas fa-bars"></i>
                                                            </th>
                                                        </tr>
                                                    </thead>
    
                                                    <tbody>
    
    
    
    
                                                        <tr rowid="10">
                                                            <td>
                                                                <div class="form-group InputGroup">
                                                                    <input type="text" class="form-control td-input addon"
                                                                        value="11" disabled="">
    
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group InputGroup">
                                                                    <input type="text" class="form-control td-input addon"
                                                                        value="2" disabled="">
    
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group InputGroup">
                                                                    <input type="text" class="form-control td-input addon"
                                                                        value="5" disabled="">
    
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group InputGroup">
                                                                    <input type="text" class="form-control td-input addon"
                                                                        value="7" disabled="">
    
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group InputGroup">
                                                                    <input type="text" class="form-control td-input addon"
                                                                        value="8" disabled="">
    
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group InputGroup">
                                                                    <input type="text" class="form-control td-input addon"
                                                                        value="88" disabled="">
    
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group InputGroup">
                                                                    <input type="text" class="form-control td-input addon"
                                                                        value="2018-05-10" disabled="">
    
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <i class="fas fa-eye view-row" title="View" data-toggle="modal"
                                                                    data-target="#addmodal22"></i>
                                                                <i class="fas fa-check-square save-edit" hidden=""></i>
                                                            </td>
                                                        </tr>
                                                    </tbody>
    
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <!--  add modal for  table2  -->
    
                                    <div id="addmodal22" class="modal fade" role="dialog" currtable>
                                        <div class="modal-dialog">
    
                                            <!-- Modal content-->
                                            <div class="modal-content modalbg-add">
                                                <div class="modal-header d-flex flex-row-reverse">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h5 class="modal-title ">اضافة</h5>
                                                </div>
                                                <div class="modal-body">
    
                                                    <div class="row ">
                                                        <div class="col-12">
                                                            <label class="col-4" for="type">النوع:</label>
                                                            <div class=" col-3 float-right m-0 p-0 " style="    margin-left: 5rem!important;">
                                                                <select class="form-control col-val  " id="type" value="1">
                                                                    <option>1</option>
                                                                    <option>2</option>
                                                                    <option>3</option>
                                                                    <option>4</option>
                                                                </select>
                                                            </div>
    
    
                                                        </div>
                                                    </div>
    
    
                                                    <div class="row m-4">
    
    
                                                        <div class="col-12">
                                                            <label class="col-7" for="material1">العدد:</label>
                                                            <input type="number" id="material1" class="col-4 border-style col-val">
                                                        </div>
    
                                                    </div>
    
    
                                                    <div class="row m-4">
                                                        <div class="col-12">
                                                            <label class="col-7" for="whours">عدد ساعات العمل باليوم:</label>
                                                            <input type="number" id="whours" class="col-4  border-style col-val">
    
                                                        </div>
                                                    </div>
    
                                                    <div class="row m-4">
                                                        <div class="col-12">
                                                            <label class="col-7" for="days1">عدد ايام: العمل</label>
                                                            <input type="number" id="days1" class="col-4 border-style col-val">
    
                                                        </div>
                                                    </div>
    
                                                    <div class="row m-4">
                                                        <div class="col-12">
                                                            <label class="col-7" for="quantm1">التكلفه:</label>
                                                            <input type="text" id="quantm1" class="col-4 border-style col-val">
    
                                                        </div>
                                                    </div>
    
    
                                                    <div class="row m-4">
                                                        <div class="col-12">
                                                            <label class="col-5" for="date1">التاريخ:</label>
                                                            <input type="date" id="date1" class="col-6 border-style col-val">
    
                                                        </div>
                                                    </div>
    
    
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="#" id="save" class="danger btn btn-primary btnSave">حفظ</a>
                                                    <a href="#" data-dismiss="modal" aria-hidden="true" class="btn btn-danger ">الغاء</a>
                                                </div>
                                            </div>
    
                                        </div>
                                    </div>
                                </div>
                            </div>
    
    
                            <div class="Mparent">
                                <!--table3    -->
                                <div class="Tparent">
    
                                    <div class="row m-4">
                                        <div class="col-lg-12 col-sm-12 col-12 collapsed">
                                            <div data-toggle="collapse" href="#collapseExample6" style="margin-right: 6% ; margin-top: 2% ;cursor: pointer"
                                                aria-expanded="false">
                                                <a class="fas fa-caret-left " style="color:green"></a>
                                                <span class="faults-types1"> المعدات: </span>
    
                                            </div>
                                            <hr class="light-hr1">
                                            <div class="collapse  table-responsive" id="collapseExample6">
                                                <button class="add-crepto mr-2 mb-2 sssss  addNewRow" data-toggle="modal"
                                                    data-target="#addmodal3" style="margin-right: 80%;">أضافة </button>
    
                                                <table class="table  table-bordered table2 mainTable" tableid="8">
                                                    <thead style="text-align: center">
                                                        <tr>
                                                            <th scope="col">الكود</th>
                                                            <th scope="col">المعده</th>
                                                            <th scope="col"> عدد ساعات الاستخدام</th>
                                                            <th scope="col"> التاريخ</th>
                                                            <th scope="col">
                                                                <i class="fas fa-bars"></i>
                                                            </th>
    
    
                                                        </tr>
                                                    </thead>
    
                                                    <tbody>
    
                                                        <tr rowid="11">
                                                            <td>
                                                                <div class="form-group InputGroup">
                                                                    <input type="text" class="form-control td-input addon"
                                                                        value="11" disabled="">
    
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group InputGroup">
                                                                    <input type="text" class="form-control td-input addon"
                                                                        value="غ" disabled="">
    
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group InputGroup">
                                                                    <input type="text" class="form-control td-input addon"
                                                                        value="6" disabled="">
    
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group InputGroup">
                                                                    <input type="text" class="form-control td-input addon"
                                                                        value="2018-05-03" disabled="">
    
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <i class="fas fa-eye view-row" title="View" data-toggle="modal"
                                                                    data-target="#addmodal3"></i>
                                                                <i class="fas fa-check-square save-edit" hidden=""></i>
                                                            </td>
                                                        </tr>
                                                    </tbody>
    
                                                </table>
                                            </div>
                                        </div>
                                    </div>
    
    
    
                                    <!--  add modal for  table3  -->
    
                                    <div id="addmodal3" class="modal fade" role="dialog" currtable>
                                        <div class="modal-dialog">
    
                                            <!-- Modal content-->
                                            <div class="modal-content modalbg-add">
                                                <div class="modal-header d-flex flex-row-reverse">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h5 class="modal-title ">اضافة</h5>
                                                </div>
                                                <div class="modal-body">
    
                                                    <div class="row m-4">
    
                                                        <div class="col-12">
                                                            <label class="col-6" for="type3">المعدة:</label>
                                                            <input type="text" id="type3" class="col-4 border-style col-val">
                                                        </div>
    
    
                                                    </div>
    
    
                                                    <div class="row m-4">
                                                        <div class="col-12">
                                                            <label class="col-6" for="material3">عدد ساعات الاستخدام:</label>
                                                            <input type="number" id="material3" class="col-4 border-style col-val">
                                                        </div>
    
                                                    </div>
    
                                                    <div class="row m-4">
                                                        <div class="col-12">
                                                            <label class="col-4" for="quantm3">التاريخ:</label>
                                                            <input type="date" id="quantm3" class="col-6 border-style col-val">
                                                        </div>
    
                                                    </div>
    
    
    
    
    
    
    
    
    
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="#" id="save3" class="danger btn btn-primary btnSave">حفظ</a>
                                                    <a href="#" data-dismiss="modal" aria-hidden="true" class="btn btn-danger ">الغاء</a>
                                                </div>
                                            </div>
    
                                        </div>
                                    </div>
    
                                </div>
                            </div>
    
                            <div class="Mparent">
                                <!--table4    -->
                                <div class="Tparent">
    
                                    <div class="row m-4">
                                        <div class="col-lg-12 col-sm-12 col-12 collapsed">
                                            <div data-toggle="collapse" href="#collapseExample7" style="margin-right: 6% ; margin-top: 2%;cursor: pointer"
                                                aria-expanded="false">
                                                <a class="fas fa-caret-left " style="color:green"></a>
                                                <span class="faults-types1"> الخامات: </span>
    
                                            </div>
                                            <hr class="light-hr1">
                                            <div class="collapse  table-responsive" id="collapseExample7">
                                                <button class="add-crepto mr-2 mb-2 sssss  addNewRow" data-toggle="modal"
                                                    data-target="#addmodal4" style="margin-right: 80%;">أضافة </button>
    
                                                <table class="table  table-bordered table2 mainTable" tableid="9">
                                                    <thead style="text-align: center">
                                                        <tr>
                                                            <th scope="col">الكود</th>
                                                            <th scope="col">النوع</th>
                                                            <th scope="col"> الخامه</th>
                                                            <th scope="col"> الكميه</th>
                                                            <th scope="col"> وحده القياس</th>
                                                            <th scope="col"> التاريخ</th>
                                                            <th scope="col">
                                                                <i class="fas fa-bars"></i>
                                                            </th>
                                                        </tr>
                                                    </thead>
    
                                                    <tbody>
    
                                                        <tr rowid="12">
                                                            <td>
    
                                                                <div class="form-group InputGroup">
                                                                    <input type="text" class="form-control td-input addon"
                                                                        value="11" disabled="">
    
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group InputGroup">
                                                                    <input type="text" class="form-control td-input addon"
                                                                        value="نوع1" disabled="">
    
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group InputGroup">
                                                                    <input type="text" class="form-control td-input addon"
                                                                        value="خامه1" disabled="">
    
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group InputGroup">
                                                                    <input type="text" class="form-control td-input addon"
                                                                        value="مم" disabled="">
    
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group InputGroup">
                                                                    <input type="text" class="form-control td-input addon"
                                                                        value="152" disabled="">
    
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group InputGroup">
                                                                    <input type="text" class="form-control td-input addon"
                                                                        value="2018-05-17" disabled="">
    
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <i class="fas fa-eye view-row" title="View" data-toggle="modal"
                                                                    data-target="#addmodal4"></i>
                                                                <i class="fas fa-check-square save-edit" hidden=""></i>
                                                            </td>
                                                        </tr>
    
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
    
                                    <!--  add modal for  table4  -->
    
                                    <div id="addmodal4" class="modal fade" role="dialog" currtable>
                                        <div class="modal-dialog">
    
                                            <!-- Modal content-->
                                            <div class="modal-content modalbg-add">
                                                <div class="modal-header d-flex flex-row-reverse">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h5 class="modal-title ">اضافة</h5>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row m-4">
    
                                                        <div class="col-12">
                                                            <label class="col-4" for="type">النوع:</label>
                                                            <div class=" col-3 float-right m-0 p-0 " style="    margin-left: 5rem!important;">
                                                                <select class="form-control   " id="type" value="1">
                                                                    <option>1</option>
                                                                    <option>2</option>
                                                                    <option>3</option>
                                                                    <option>4</option>
                                                                </select>
                                                            </div>
    
    
    
                                                        </div>
                                                    </div>
    
                                                    <div class="row m-4">
                                                        <div class="col-12">
                                                            <label class="col-4" for="type">الاسم:</label>
                                                            <div class=" col-3 float-right m-0 p-0 " style="    margin-left: 5rem!important;">
                                                                <select class="form-control col-val  " id="type" value="1">
                                                                    <option>1</option>
                                                                    <option>2</option>
                                                                    <option>3</option>
                                                                    <option>4</option>
                                                                </select>
                                                            </div>
    
    
                                                        </div>
                                                    </div>
    
                                                    <div class="row m-4">
    
                                                        <div class="col-12">
                                                            <label class="col-4" for="material">الخامة:</label>
                                                            <input type="text" id="material" class="col-6 border-style col-val ">
                                                        </div>
    
                                                    </div>
    
    
                                                    <div class="row m-4">
    
                                                        <div class="col-12">
                                                            <label class="col-4" for="mesure">وحده القياس:</label>
                                                            <input type="text" id="mesure" class="col-6 border-style col-val ">
                                                        </div>
                                                    </div>
                                                    <div class="row m-4">
    
                                                        <div class="col-12">
                                                            <label class="col-4" for="quantm">الكمية:</label>
                                                            <input type="text" id="quantm" class="col-6 border-style  col-val">
    
                                                        </div>
                                                    </div>
    
    
                                                    <br>
                                                    <div class="row m-4">
    
    
                                                        <div class="col-12">
                                                            <label class="col-4" for="data">التاريخ:</label>
                                                            <input type="date" id="data" class="col-6 border-style col-val">
    
                                                        </div>
                                                    </div>
    
    
    
    
    
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="#" id="sav4" class="danger btn btn-primary btnSave">حفظ</a>
                                                    <a href="#" data-dismiss="modal" aria-hidden="true" class="btn btn-danger ">الغاء</a>
                                                </div>
                                            </div>
    
                                        </div>
                                    </div>
    
                                </div>
    
                            </div>
    
    
    
    
                        </div>
    
    
    
    
    
    
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

