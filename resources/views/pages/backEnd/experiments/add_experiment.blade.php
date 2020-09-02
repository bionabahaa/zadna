@extends('layouts.backEnd')
@section('page_css')
@endsection
@section('page_script')
    <script src="{{ asset('public') }}/js/backEnd/experiment.js"></script>
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
            <h6>التجارب > إضافة تجربة</h6>
        </div>

    </section>

    <div class="row m-4">
        <ul class="nav nav-tabs tabrow" id="myTab" role="tablist" style="margin-top: 0%;border-right: 1.5px solid #dee2e6; margin-bottom: 0px">

            <li class="nav-item selected">
                <a class="nav-link active linkColor " id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">التفاصيل</a>
            </li>
            @if(isset($info))
                @if($healper->check_permission(31,6))
                <li class="nav-item ">
                    <a class="nav-link  linkColor " id="steps-tab" data-toggle="tab" href="#steps" role="tab" aria-controls="steps" aria-selected="false">خطوات التنفيذ</a>
                </li>
               @endif


                <li class="nav-item ">
                    <a class="nav-link linkColor " id="resource-tab" data-toggle="tab" href="#resource" role="tab" aria-controls="resource" aria-selected="false"
                       style="border: none;
        padding: 4px;
        font-size: 22px;">موارد عملية</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link linkColor  " id="notes-tab" data-toggle="tab" href="#notes" role="tab" aria-controls="notes" aria-selected="true"
                       style="border: none;
        padding: 4px;
        font-size: 22px;">الملاحظات</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link linkColor" id="requests-tab" data-toggle="tab" href="#requests" role="tab" aria-controls="requests" aria-selected="false"
                       style="border: none;
        padding: 4px;
        font-size: 22px;">توصيات</a>
                </li>
            @endif


            </ul>


            <div class="tab-content" id="myTabContent">

                <!-- content for tab-التفاصيل-->
                <div class="tab-pane fade show active tab-content-detail" id="home" role="tabpanel" aria-labelledby="home-tab">
    <form id="form_add_experiment" method="post">
        <input type="hidden"  id="id" value="{{@$info->id}}">
                    <div class="row m-4 tab-top">
                        <div class="col-lg-12 col-sm-12 col-12 ">
                            <table class="table borderless table1">
                                <thead>
                                <tr>
                                    <th scope="col"> اسم التجربة</th>
                                    <th scope="col"> نوع التجربة</th>
                                    <th scope="col"> تاريخ الانشاء</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr class="border_bottom">

                                    <td class="InputNum">
                                        <div class="form-group InputGroup">
                                            <input type="text" name="name" class="form-control" value="{{@$info->name}}">
                                        </div>
                                        <div id="name_demo"></div>
                                    </td>
                                    <td class="InputNum">
                                        <div class="form-group InputGroup">
                                            <input type="text" name="experiment_type" class="form-control " value="{{@$info->experiment_type}}">
                                        </div>
                                        <div id="experiment_type_demo"></div>
                                    </td>
                                    <td class="InputNum">
                                        <div class="form-group InputGroup">
                                            <input type="date" name="create_date" class="form-control " value="{{@$info->create_date}}">
                                        </div>
                                        <div id="create_date_demo"></div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>


                        <div class="col-lg-12 col-sm-12 col-12 ">
                            <table class="table borderless table1 " style="margin-top: 7%">
                                <thead>
                                <tr>

                                    <th scope="col"> موعد التنفيذ</th>
                                    <th scope="col"> نسبة نجاح التجربة</th>
                                    <th scope="col"> المربع</th>


                                </tr>
                                </thead>
                                <tbody>
                                <tr class="border_bottom">
                                    <td class="InputNum">
                                        <div class="form-group InputGroup">
                                            <input type="time" name="execution_appointment" class="form-control" value="{{@$info->execution_appointment}}">
                                        </div>
                                        <div id="execution_appointment_demo"></div>
                                    </td>

                                    <td class="InputNum">
                                        <div class="form-group InputGroup">
                                            <input type="text" name="success_percent" class="form-control " value="{{@$info->success_percent}}">
                                        </div>
                                        <div id="success_percent_demo"></div>
                                    </td>
                                    <td class="InputNum">
                                        <select name="box" id="choose_box" class="form-control select2 tags" >
                                           <option selected disabled>اختر المربع</option>
                                            @foreach($boxes as $box)
                                                <option value="{{$box->id}}" @if(isset($info)&& $box->id==$info->box_id)selected @endif>{{$box->code}}</option>
                                            @endforeach()
                                        </select>
                                        <div id="box_demo"></div>
                                    </td>

                                </tr>
                                </tbody>
                            </table>
                        </div>


                        <div class="col-lg-12 col-sm-12 col-12 ">
                            <table class="table borderless table1 " style="margin-top: 7%">
                                <thead>
                                <tr>
                                    <th scope="col"> النخل</th>
                                    <th scope="col"> المسؤل عن التجربة</th>
                                    <th scope="col">تاريخ التنفيذ</th>
                                    <th scope="col"> التنبيه قبل التنفيذ</th>

                                </tr>
                                </thead>
                                <tbody>
                                <tr class="border_bottom">

                                    <td class="InputNum">
                                        <select name="palms[]" id="plam_tree_code" class="form-control select2 tags" multiple="multiple">
                                            @if(isset($info))
                                                @foreach($palms as $palm)
                                                    <option value="{{@$palm}}" selected >{{$palm}}</option>
                                                @endforeach
                                           @endif
                                        </select>
                                        <div id="palms_demo"></div>
                                    </td>

                                    <td class="InputNum">
                                        <select name="users[]" class="form-control select2 tags" multiple="multiple">
                                            <option  disabled>اختر المشرف</option>
                                            @foreach($users as $user)
                                                <option value="{{$user->id}}" @if(isset($info)&& in_array($user->id,$selected_user))selected @endif >{{$user->username}}</option>
                                            @endforeach()
                                        </select>
                                        <div id="users_demo"></div>
                                    </td>

                                    <td class="InputNum">
                                        <div class="form-group InputGroup">
                                            <input type="date" name="execution_date" class="form-control" value="{{@$info->execution_date}}">
                                        </div>
                                        <div id="execution_date_demo"></div>
                                    </td>

                                    <td class="InputNum">
                                        <div class="form-group InputGroup">
                                            <input type="number" name="alert_before_execution" class="form-control " value="{{@$info->alert_before_execution}}">

                                            <select name="alert_measure" class="form-control select2" style="
                                                padding-bottom: 31px;
                                            ">
                                                <option selected disabled>select</option>
                                                <option value=1 @if(isset($info)&& $info->alert_measure==1)selected @endif>يوم</option>
                                                <option value=2 @if(isset($info)&& $info->alert_measure==2)selected @endif>اسبوع</option>
                                                <option value=3 @if(isset($info)&& $info->alert_measure==3)selected @endif>شهر</option>
                                            </select>
                                        </div>
                                        <div id="alert_before_execution_demo"></div>
                                        <div id="alert_measure_demo"></div>
                                    </td>

                                </tr>
                                </tbody>
                            </table>
                        </div>


                        <div class="col-lg-12 col-sm-12 col-12 ">
                            <table class="table borderless table1 " style="margin-top: 7%">
                                <thead>
                                <tr>
                                    <th scope="col"> سبب التجربة</th>
                                    <th scope="col"> وصف</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr class="border_bottom">
                                    <td class="InputNum">
                                        <div class="form-group InputGroup">
                                            <textarea name="experiment_reason" class="form-control text_area ">{{@$info->experiment_reason}}</textarea>
                                        </div>
                                        <div id="experiment_reason_demo"></div>
                                    </td>
                                    <td class="InputNum">
                                        <textarea name="description" class="text_area">{{@$info->description}}</textarea>
                                        <div id="description_demo"></div>
                                    </td>

                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="modal-footer footer-border">
                        @if(isset($info))
                            @if($healper->check_permission(31,5))
                        <button type="button"  class="btn save-btn" id="SubmitButton">تعديل</button>
                                @endif
                        @else
                        <button type="button"  class="btn save-btn" id="SubmitButton"> حفظ</button>
                       @endif
                    </div>

    </form>
                </div>

                <!-- content for tab-خطوات التنفيذ-->
                <div class="tab-pane fade tab-content-detail" id="steps" role="tabpanel" aria-labelledby="steps-tab">
                    <div class="Mparent">
                        <div class="Tparent">
                            <div class="row m-4 tab-top">
                                <div class=" col-lg-8  col-12 offset-lg-4 mt-3 float-left text-right ">
                                    @if($healper->check_permission(31,7))
                                    <button id="add-disease_step" class="add-crepto  mr-2 mb-2 addNewRow  " data-target="#addStepsModal" data-toggle="modal">أضافة </button>
                                    @endif
                                </div>

                            </div>

                            <div class="row m-3 justify-content-center ">
                                <div class="col-lg-12 ">

                                    <table id="DataTable_experiment_step" class="table zadnatable mainTable" tableid="14">
                                        <thead>
                                        <tr>
                                            <th>الكود</th>
                                            <th style="width: 30%;">الوصف</th>
                                            <th>التوصية</th>
                                            <th>التاريخ</th>
                                            <th class="actions">
                                                <i class="fas fa-bars"></i>
                                            </th>

                                        </tr>
                                        </thead>
                                         </table>
                                </div>
                            </div>

    <form id="form_add_experimentStep" method="post">
        <input type="hidden" id="experiment_id" name="experiment_id">
        <input type="hidden" id="step_id" name="step_id">
                            <div id="addStepsModal" class="modal fade" role="dialog" currTable>
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content modalbg-add">
                                        <div class="modal-header d-flex flex-row-reverse">
                                            <button type="button" class="close" data-dismiss="modal">×</button>
                                            <h5 class="modal-title text-center " id="title">اضافه خطوه</h5>
                                        </div>
                                        <div class="modal-body">


                                            <div class="row mb-4">

                                                <div class="col-12">
                                                    <label class="col-4">الوصف:</label>

                                                    <textarea name="description_step" id="description" class="border-style col-6 col-val"></textarea>
                                                    <div id="descriptionStep_demo"></div>

                                                </div>
                                            </div>


                                            <div class="row mb-4">

                                                <div class="col-12">
                                                    <label class="col-4">التوصية:</label>
                                                    <textarea name="recommendation" id="recommendation" class="border-style col-6 col-val"></textarea>
                                                    <div id="recommendation_demo"></div>

                                                </div>
                                            </div>




                                            <div class="row mb-4">

                                                <div class="col-12">
                                                    <label class="col-4" for="date">التاريخ:</label>
                                                    <input type="date" name="date" id="date" class="border-style col-6 col-val">
                                                    <div id="date_demo"></div>
                                                </div>
                                            </div>
                                            <br>
                                        </div>
                                        @if($healper->check_permission(31,7))
                                        <div class="modal-footer">
                                            <a href="#" id="SubmitButton_experiment_step" class="danger btn btn-primary btnSave ">حفظ</a>
                                            <a href="#" data-dismiss="modal" aria-hidden="true" class="btn btn-danger ">الغاء</a>
                                        </div>
                                       @endif
                                    </div>
                                </div>
                            </div>
    </form>
                        </div>
                    </div>
                </div>

                @php
                    $process_array=[
                        'moduel_id'=>29,
                        'box_id'=>''
                    ];
                @endphp
                @if(isset($info))
                     @include('pages.backEnd.Operations.process',$process_array)
               @endif
            </div>
        </div>




    @endsection