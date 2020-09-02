@extends('layouts.backEnd')
@section('page_css')
@endsection
@section('page_script')
    <script>

        $(function () {
            $(".select2").select2();
        });
    </script>
    <script src="{{ asset('public') }}/js/backEnd/crew.js"></script>
@endsection
@section('page_header')
@endsection
@section('page_content')
    @inject('healper', 'App\Http\Controllers\BladeController')

    <section class="content cropType">
        <div class="top-bar">

            <h6> طاقم العمل  >   دائم   </h6>
        </div>

    </section>
    <div>
        <div class="row m-4">
            <ul class="nav nav-tabs tabrow crew_edit_list" id="myTab" role="tablist" style="margin-top: 0%;border-right: 1.5px solid #dee2e6; margin-bottom: 0px">
                <li class="nav-item selected " data-id="myTabContent">
                    <a class="nav-link active linkColor" id="details-tab" data-toggle="tab" href="#details" role="tab" aria-controls="details" aria-selected="true" style="border: none;
    padding: 4px;
    font-size: 22px;"> المعلومات الشخصية</a>
                </li>


                @if($healper->check_permission(26,7))
                <li class="nav-item " id="myn" data-id="notes">
                    <a class="nav-link linkColor " id="notes-tab" data-toggle="tab"  href="#notes" role="tab" aria-controls="notes" aria-selected="true" style="border: none;
            padding: 4px;
            font-size: 22px;">الملاحظات</a>
                </li>
@endif
                @if($healper->check_permission(26,8))
                <li class="nav-item " data-id="resource">
                    <a class="nav-link linkColor " id="resource-tab" data-toggle="tab"  href="#resource" role="tab" aria-controls="analyse" aria-selected="false" style="border: none;
            padding: 4px;
            font-size: 22px;">العمليات السابقة</a>
                </li>
                    @endif
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade active show" id="details" role="tabpanel" aria-labelledby="details-tab" style="border-right: 1px solid #dee2e6;border-left: 1px solid #dee2e6;">

                <form id="EditCrewForm" method="post">
                    <input type="hidden" name="id" id="id" value="{{$user->id}}">
                    <div class="row m-4 tab-top" >
                        <div class="col-lg-12 col-sm-12 col-12 ">

                            <div class="table-responsive">

                                <table class="table tableborder">

                                    <thead>
                                    <tr>
                                        <th scope="col">الاسم</th>
                                        <th scope="col">الوظيفة</th>
                                        <th scope="col">الجنس</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="InputNum">
                                            <div class="form-group InputGroup">
                                                <input type="text" name="username" class="form-control numric loc td-edit" value="{{$user->username}}" >
                                            </div>
                                            <div id="username_demo"></div>
                                        </td>
                                        <td class="InputNum">
                                            <select name="role" class="form-control select2 td-edit numric" style="width: 100%;"  >
                                                <option selected disabled>اختر الوظيفه</option>
                                                @foreach($roles as $role)
                                                    <option value="{{$role->id}}" @if($user->role_id == $role->id) selected @endif >{{$role->title}}</option>
                                                @endforeach
                                            </select>
                                            <div id="role_demo"></div>
                                        </td>

                                        <td class="InputNum">
                                            <select name="gender" class="form-control numric td-edit" style="width: 100%; height: 20%"  >
                                                <option selected disabled>النوع</option>
                                                <option value="1" @if((!empty($crew)) && ($crew->gender==1)) selected @endif >ذكر</option>
                                                <option value="2" @if((!empty($crew)) && ($crew->gender==2)) selected @endif> انثى</option>
                                            </select>
                                            <div id="gender_demo"></div>
                                        </td>

                                    </tr>

                                    </tbody>
                                </table>


                                <table class="table tableborder">

                                    <thead>
                                    <tr>


                                        <th scope="col">الجنسية </th>
                                        <th scope="col">الرقم القومي</th>
                                        <th scope="col">التكلفة باليوم </th>
                                        <th scope="col">المرتب الشهري </th>


                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>

                                        <td class="InputNum">
                                            <select name="nationality" class="form-control select2 numric td-edit" style="width: 100%;" >
                                                <option selected disabled >اختر الجنسيه</option>
                                                @foreach($nationality as $key=>$nationality)
                                                    <option value="{{$key}}" @if((!empty($crew)) && ($crew->nationality==$key)) selected @endif > {{$nationality}}</option>
                                                @endforeach
                                            </select>
                                            <div id="nationality_demo"></div>
                                        </td>
                                        <td class="InputNum">
                                            <div class="form-group InputGroup td-edit">
                                                <input type="number" name="national_id" class="form-control numric td-edit"  value="{{ @$crew->national_id}}" >
                                            </div>
                                            <div id="national_id_demo"></div>
                                        </td>
                                        <td class="InputNum">
                                            <div class="form-group InputGroup td-edit">
                                                <input type="number" name="cost_by_day" class="form-control numric td-edit" min="0" value="{{ @$crew->cost_by_day}}" >
                                            </div>
                                            <div id="cost_by_day_demo"></div>
                                        </td>
                                        <td class="InputNum">
                                            <div class="form-group InputGroup td-edit">
                                                <input type="number" name="cost_by_month" class="form-control numric td-edit" min="0"  value="{{ @$crew->cost_by_month}}" >
                                            </div>
                                            <div id="cost_by_month_demo"></div>
                                        </td>


                                    </tr>

                                    </tbody>
                                </table>

                                <table class="table tableborder">

                                    <thead>
                                    <tr>

                                        <th scope="col">تاريخ التعين </th>
                                        <th scope="col">تاريخ الميلاد </th>
                                        <th scope="col">مسئول عن</th>


                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>

                                        <td class="InputNum">
                                            <div class="form-group InputGroup">
                                                <input type="date" name="hire_date" class="form-control numric td-edit" value="{{ @$user->hiring_date}}"  >
                                            </div>
                                            <div id="hire_date_demo"></div>
                                        </td>
                                        <td class="InputNum">
                                            <div class="form-group InputGroup">
                                                <input type="date" name="birthdate" class="form-control numric td-edit" value="{{ @$crew->birthdate}}">
                                            </div>
                                        </td>
                                        <td class="InputNum">
                                            <div class="form-group InputGroup">
                                                <select id="tags" name="responsible_for[]" class="form-control select2 numric td-edit" multiple="multiple"  style="width: 100%;"  >
                                                    @foreach($crews as $crew)
                                                        <option value="{{$crew->user->id}}" @if(in_array($crew->user->id,$selected_user)) selected @endif>{{$crew->user->username}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </td>



                                    </tr>

                                    </tbody>
                                </table>

                                <table class="table tableborder">

                                    <thead>
                                    <tr>

                                        <th scope="col"> البريد الكترونى </th>
                                        <th scope="col"> الرقم السرى</th>


                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>

                                        <td class="InputNum">
                                            <div class="form-group InputGroup">
                                                <input type="email" name="email" class="form-control numric col-val " value="{{$user->email}}">
                                            </div>
                                            <div id="email_demo"></div>
                                        </td>
                                        <td class="InputNum">
                                            <div class="form-group InputGroup">
                                                <input type="text" name="password"  class="form-control numric">
                                            </div>
                                            <div id="password_demo"></div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>

                                <table class="table tableborder">

                                    <thead>
                                    <tr>
                                        <th scope="col">التقييم</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>

                                        <td class="InputNum">
                                            <div class="form-group InputGroup">
                                                <textarea name="note" class="form-control numric td-edit"   style="width:50%">{{ @$crew->note }}</textarea>
                                            </div>
                                        </td>

                                    </tr>

                                    </tbody>
                                </table>



                            </div>

                            @if($healper->check_permission(26,9))
                                @if($user->blocked==0)
                                     <button type="button" class="btn dist-btn" onclick=" remove_user({{$user->id}}) ">فصل</button>
                                @else
                                    <button type="button" style="background: green;" class="btn dist-btn" onclick=" remove_user({{$user->id}}) ">تعيين مره اخرى</button>
                                @endif
                           @endif

                            @if($healper->check_permission(26,5))
                                <button type="button" class="btn edit-btn" style=" background-color:#d8d612;" id="SubmitButton">تعديل</button>
                            @endif
                            <button type="button" class="btn save-btn save-edit-tabs  " hidden >حفظ</button>

                        </div>




                    </div>
                </form>
                </div>

                <div class="tab-pane fade" id="notes" role="tabpanel" aria-labelledby="notes-tab" style="border-right: 1px solid #dee2e6;border-left: 1px solid #dee2e6;">
                    <div class="col-12">
                    <div class="row m-4 tab-top" >


                        <div class="Tparent" style="width: 100%;">



                            <div class="row m-4">

                                <div class="col-lg-2  col-6">
                                    <div>
                                        <label>النوع :</label>
                                    </div>
                                    <select class="form-control filter-form filter1">

                                        <option>الكل</option>
                                        <option>مرسله</option>
                                        <option> مستقبله</option>

                                    </select>
                                </div>

                                <div class=" col-lg-6  col-12 offset-lg-4 mt-3 float-left text-right ">

                                    <button class="add-crepto mr-2 mb-2 addNewRow " id="button_addNote" data-target="#addNotesModal" data-toggle="modal">أضافة ملاحظة </button>

                                </div>

                            </div>

                            <div class="row m-3 justify-content-center ">
                                <div class="col-lg-12 ">

                                    <table class="table zadnatable mainTable notesTable" tableId="11" id="Crew_noteDataTable" width="100%">
                                        <thead>
                                        <tr>
                                            <th>الكود</th>
                                            <th style="width: 30%;">الملاحظة</th>
                                            <th>من</th>
                                            <th>الوظيفة</th>
                                            <th>العملية</th>
                                            <th>التاريخ</th>
                                            <th class="actions">
                                                <i class="fas fa-bars"></i>
                                            </th>

                                        </tr>
                                        </thead>

                                    </table>
                                </div>
                            </div>
<form id="form_add_note" method="post">
    <input type="hidden" name="id" id="note_id" value="">
    <input type="hidden" name="user_id" value="{{$user->id}}">
                            <div id="addNotesModal" class="modal fade" role="dialog" currTable view-chat="view-notes">
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content modalbg-add">
                                        <div class="modal-header d-flex flex-row-reverse">
                                            <button type="button" class="close" data-dismiss="modal">×</button>
                                            <h5 class="modal-title text-center ">اضافه ملاحظة</h5>
                                        </div>
                                        <div class="modal-body">


                                            <div class="row mb-4">

                                                <div class="col-12">
                                                    <label class="col-4" for="descrep">الملاحظة:</label>
                                                    <textarea type="text" id="note" name="note" class="border-style col-6 col-val"></textarea>
                                                </div>
                                                <div id="note_demo"></div>
                                            </div>


                                            <div class="row mb-4">

                                                <div class="col-12">
                                                    <label class="col-4" for="descrep">من:</label>
                                                    <input type="text" id="descrep" disabled value="{{auth()->user()->username}}" name="added_from" class="border-style col-6 col-val">

                                                </div>
                                            </div>


                                            <div class="row mb-4">

                                                <div class="col-12">
                                                    <label class="col-4" for="descrep">الوظيفة:</label>
                                                    <input type="text" id="job" name="job" class="border-style col-6 col-val">
                                                </div>
                                                <div id="job_demo"></div>
                                            </div>


                                            <div class="row mb-4">

                                                <div class="col-12">
                                                    <label class="col-4" for="descrep">العملية:</label>
                                                    <input type="text" id="process" name="process" class="border-style col-6 col-val">
                                                </div>
                                                <div id="process_demo"></div>
                                            </div>


                                            <div class="row mb-4">

                                                <div class="col-12">
                                                    <label class="col-4" for="date">التاريخ:</label>
                                                    <input type="date" name="date" id="date" class="border-style col-6 col-val">
                                                </div>
                                                <div id="date_demo"></div>
                                            </div>

                                            <br>

                                        </div>
                                        <div class="modal-footer">
                                            <a href="#"  class="danger btn btn-primary SaveNote" id="SubmitButton_addnote">حفظ</a>
                                            <a href="#" data-dismiss="modal" aria-hidden="true" class="btn btn-danger ">الغاء</a>
                                        </div>
                                    </div>

                                </div>
                            </div>
</form>





                        </div>


                    </div>
                    </div>
                    </div>





                <div class="tab-pane fade" id="notes-chat" role="tabpanel" aria-labelledby="notes-tab" style="border-right: 1px solid #dee2e6;border-left: 1px solid #dee2e6;">

                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 p-0">
                                <div class="panel panel-primary">

                                    <div class="panel-body">
                                        <ul class="chat p-2">

                                            <li class=" clearfix rec">

                                                <div class="chat-body clearfix">
                                                    <div class="header">
                                                        <small class=" text-muted float-right">
                                                            <span class="glyphicon glyphicon-time"></span>13 mins ago</small>
                                                        <strong class="primary-font">Bhaumik Patel</strong>
                                                    </div>
                                                    <p>
                                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.
                                                    </p>
                                                </div>
                                            </li>

                                            <li class=" clearfix sent">

                                                <div class="chat-body clearfix">
                                                    <div class="header">
                                                        <strong class="primary-font float-right">Jack Sparrow</strong>
                                                        <small class="text-muted">
                                                            <span class="glyphicon glyphicon-time"></span>12 mins ago</small>
                                                    </div>
                                                    <p class="float-right">
                                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.
                                                    </p>
                                                </div>
                                            </li>


                                            <li class="clearfix rec">

                                                <div class="chat-body clearfix">
                                                    <div class="header">
                                                        <small class=" text-muted float-right">
                                                            <span class="glyphicon glyphicon-time"></span>13 mins ago</small>
                                                        <strong class="primary-font">Bhaumik Patel</strong>
                                                    </div>
                                                    <p>
                                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.
                                                    </p>
                                                </div>
                                            </li>
                                            <li class="clearfix sent">

                                                <div class="chat-body clearfix">
                                                    <div class="header">
                                                        <strong class="primary-font float-right">Jack Sparrow</strong>
                                                        <small class="text-muted">
                                                            <span class="glyphicon glyphicon-time"></span>12 mins ago</small>
                                                    </div>
                                                    <p class="float-right">
                                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.
                                                    </p>
                                                </div>
                                            </li>


                                        </ul>
                                    </div>
                                    <div class="panel-footer">
                                        <div class="input-group mt-2">
                                                    <span class="input-group-btn">

                                                        <button class="btn btn-warning btn-md " id="btn-chat">
                                                            إرسال</button>

                                                    </span>
                                            <input id="btn-input" type="text" class="form-control input-sm" placeholder="ادخل رسالتك هنا.." />

                                            <button class="btn btn-danger btn-md " id="notes-back">
                                                رجوع</button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>




                <div class="tab-pane fade " id="resource" role="tabpanel" aria-labelledby="resource-tab" style="border-right: 1px solid #dee2e6;border-left: 1px solid #dee2e6;">
                    <div class="Mparent">
                        <!--table1    -->
                        <div class="Tparent">
                            <div class="row m-4 mt-3 tab-top">



                                <table class="table  table-bordered table2 mainTable" tableid="6">
                                    <thead style="text-align: center">
                                    <tr >
                                        <th scope="col">نوع العملية</th>
                                        <th scope="col"> العملية</th>
                                        <th scope="col"> التاريخ</th>
                                        <th scope="col"> الملاحظات</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                @foreach($tasks as $task)
                                    <tr rowid="13">

                                        <td>
                                            @if($task->task_type_id==1)
                                                ادارية
                                                @elseif($task->task_type_id==2)
                                                زراعية
                                                @else
                                                تسويق
                                                @endif
                                        </td>
                                        <td>
                                            {{$task->task}}
                                        </td>
                                        <td>
                                            {{$task->created_at}}
                                        </td>


                                        <td>
                                            {{$task->note}}
                                        </td>

                                    </tr>
                                @endforeach
                                    </tbody>
                                </table>


                            </div>
                        </div>
                    </div>



                </div>

            </div>



        </div>
    </div>

 @endsection