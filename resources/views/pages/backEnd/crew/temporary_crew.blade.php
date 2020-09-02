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

            <h6> طاقم العمل > مؤقت </h6>
        </div>
        <div class="Mparent">
            <div class="Tparent">
                @if($healper->check_permission(25,2))
                    <div class="row ml-3 mr-3 mt-3 p-3 filter-search-box filter2">
                    <div class="col-lg-10">

                        <div class="row filter-res">

                            <div class="col-lg-2 col-sm-12 col-md-12 col-12">
                                <div>
                                    <label>الوظيفة :</label>
                                </div>
                                <select id="status" class="form-control filter-form  job-filt" filtercol="1">
                                    <option value="all">الكل</option>
                                    @foreach($roles as $role)
                                        <option value="{{$role->id}}">{{$role->title}}</option>
                                    @endforeach

                                </select>
                            </div>
                            {{--<div class="col-lg-2 col-sm-12 col-md-12 col-12">--}}
                                {{--<div>--}}
                                    {{--<label>العملية :</label>--}}
                                {{--</div>--}}
                                {{--<select class="form-control filter-form operate-filt" filtercol="2">--}}

                                    {{--<option>الكل</option>--}}
                                    {{--<option>محاسب</option>--}}
                                    {{--<option> دكتور</option>--}}
                                    {{--<option> مولد</option>--}}
                                    {{--<option> معدات</option>--}}
                                    {{--<option> شبكه الري</option>--}}
                                {{--</select>--}}
                            {{--</div>--}}

                            <div class="col-lg-8 col-sm-12 col-md-12 col-12">
                                <div>
                                    <label>فترة الاستخدام :</label>
                                </div>
                                من <input  name="from" id="from" type="date" class="type-date">
                                الى <input name="to" id="to"  type="date" class="type-date">
                            </div>
                        </div>
                    </div>
                        <span class="btn btn-dark filter_but" style="height: 45px;border-radius: 21%;" onclick="filter('DataTable_temporary_user','setting/dataTableTemporery')" >بحث</span>

                    {{--<div class="col-lg-2 mt-3 col-sm-4 col-md-4 col-12">--}}


                    </div>


                </div>

                @endif
                <div class="row m-4">


                    <div class="float-left ">
                        @if($healper->check_permission(25,3))
                        <button class="add-crepto mr-2 mb-2 addNewRow " id="add_user_permanent" data-toggle="modal" data-target="#ViewModal" >أضافة </button>
                        @endif
                            @if($healper->check_permission(26,6))
                                <a href="{{ URL::to('downloadExcel/xls/Crew/temporary_crew/?arr[]='.$arr.'') }}"><button class="btn btn-success export-excel mr-2 mb-2">أخراج كاملف اكسيل</button></a>
                            @endif
                    </div>

                </div>
                <div class="row m-3 justify-content-center ">
                    <div class="col-lg-10 ">
                        <table class="table zadnatable mainTable" tableId="11" id="DataTable_temporary_user">
                            <thead>
                            <tr>

                                <th>الاسم </th>
                                <th>البريد الالكترونى</th>
                                <th>الوظيفه </th>
                                <th class="actions">العمليات</th>

                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>

                <!-- add  Modal -->

            <!--  form add temporary user -->
                <form id="form_add_tempory_user" method="post">
                    <input type="hidden" name="id" id="temporary_user_id" value="{{@$user->id}}">
                    <input type="hidden" name="temporary_user">

                   <div class="modal fade model-lg" id="ViewModal" role="dialog" aria-labelledby="ViewModalTitle" aria-hidden="true" currtable viewrow>
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content modalbg">
                            <div class="modal-header modal-border">
                                <h5 class="modal-title" id="ViewModalTitle">اضافة </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body modal-space">
                                <div class="table-responsive">


                                    <table class="table tableborder">

                                        <thead>
                                        <tr>

                                            <th scope="col">الاسم </th>
                                            <th scope="col"> الرقم القومي </th>
                                            <th scope="col"> الجنس </th>
                                            <th scope="col"> الجنسية </th>


                                        </tr>

                                        </thead>
                                        <tbody>
                                        <tr>

                                            <td class="InputNum">
                                                <div class="form-group InputGroup">
                                                    <input type="text" name="username"   class="form-control numric" min="0">
                                                </div>
                                                <div id="username_demo"></div>
                                            </td>

                                            <td class="InputNum">
                                                <div class="form-group InputGroup">
                                                    <input type="text" name="national_id"  class="form-control numric" min="0">
                                                </div>
                                                <div id="national_id_demo"></div>
                                            </td>



                                            <td class="InputNum" style="width: 20%;">
                                                <select name="gender" class="form-control  test" style="width: 100%;">
                                                    <option selected disabled>النوع</option>
                                                    <option value="1"   >ذكر</option>
                                                    <option value="2" > انثى</option>
                                                </select>
                                                <div id="gender_demo"></div>
                                            </td>

                                            <td class="InputNum" style="width: 20%;">
                                                <select name="nationality" class="form-control  test" style="width: 100%;">
                                                    <<option selected disabled >اختر الجنسيه</option>
                                                    @foreach($nationality as $key=>$nationality)
                                                        <option value="{{$key}}"> {{$nationality}}</option>
                                                    @endforeach
                                                    
                                                </select>
                                                <div id="nationality_demo"></div>
                                            </td>

                                        </tr>

                                        </tbody>
                                    </table>

                                    <table class="table tableborder">

                                        <thead>
                                        <tr>

                                            <th scope="col">الوظيفة</th>
                                            <th scope="col">العملية</th>
                                            {{--<th scope="col">المربعات</th>--}}
                                            <th scope="col">التليفون </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>

                                            <td class="InputNum" style="width: 20%;">
                                                <select name="role" class="form-control select2 col-val tt" style="width: 100%; height: 20%">
                                                    <option selected disabled>اختر الوظيفه</option>
                                                    @foreach($roles as $role)
                                                        <option value="{{$role->id}}" >{{$role->title}}</option>
                                                    @endforeach
                                                </select>
                                                <div id="role_demo"></div>
                                            </td>
                                            <td class="InputNum" style="width: 20%;">
                                                {{--<select name="process" class="form-control select2 col-val test" style="width: 100%;">--}}
                                                    {{--<option selected disabled>اختر</option>--}}
                                                    {{--<option value="1" >شبكه الرى</option>--}}
                                                    {{--<option value="2">مربعات</option>--}}
                                                {{--</select>--}}
                                                <input type="text" name="process"  class="form-control numric" min="0">
                                                <div id="process_demo"></div>
                                            </td>


                                            {{--<td class="InputNum">--}}
                                                {{--<select name="boxes[]" class="form-control select2 " multiple="multiple" style="width: 100%;">--}}
                                                    {{--@foreach($boxes as $box)--}}
                                                       {{--<option value="{{$box->id}}">{{$box->code}}</option>--}}
                                                    {{--@endforeach--}}

                                                {{--</select>--}}
                                            {{--</td>--}}
                                            <td class="InputNum">
                                                <div class="form-group InputGroup">
                                                    <input type="tel" name="phone" class="form-control numric loc" min="0">
                                                </div>
                                                <div id="phone_demo"></div>
                                            </td>

                                        </tr>

                                        </tbody>
                                    </table>


                                    <table class="table tableborder">

                                        <thead>
                                        <tr>

                                            <th scope="col">عدد ايام العمل </th>
                                            <th scope="col">التكلفة باليوم </th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>

                                            <td class="InputNum">
                                                <div class="form-group InputGroup">
                                                    <input type="number" name="day_work_num" class="form-control numric col-val" min="0">
                                                </div>
                                                <div id="day_work_num_demo"></div>
                                            </td>
                                            <td class="InputNum">
                                                <div class="form-group InputGroup">
                                                    <input type="number" name="cost_by_day"  class="form-control numric">
                                                </div>
                                                <div id="cost_by_day_demo"></div>
                                            </td>
                                        </tr>

                                        </tbody>
                                    </table>


                                    <table class="table tableborder">

                                        <thead>
                                        <tr>

                                            <th scope="col">تاريخ التعين </th>
                                            <th scope="col">تاريخ الميلاد </th>
                                            <th scope="col"> المهام</th>


                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td class="InputNum">
                                                <div class="form-group InputGroup">
                                                    <input type="date" name="hire_date"  class="form-control numric col-val ">
                                                </div>
                                                <div id="hire_date_demo"></div>
                                            </td>
                                            <td class="InputNum">
                                                <div class="form-group InputGroup">
                                                    <input type="date" name="birthdate"  class="form-control numric">
                                                </div>
                                            </td>
                                            <td class="InputNum">
                                                <div class="form-group InputGroup">
                                                    <select id="tags" name="responsible_for[]" class="form-control select2" multiple="multiple" data-placeholder="Select a State" style="width: 100%;">
                                                        @foreach($crews as $crew)
                                                            <option value="{{$crew->user->id}}" >{{@$crew->user->username}}</option>
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
                                                    <input type="email" name="email"  class="form-control numric col-val ">
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


                                </div>
                            </div>
                            <div class="modal-footer footer-border">
                                <button type="button" class="btn save-btn hide btnSave" id="SubmitButton_temporary_user">حفظ</button>
                                <button type="button" class="btn close-btn" data-dismiss="modal">غلق</button>
                            </div>
                        </div>
                    </div>
                </div>
                </form>

            </div>
        </div>

        </div>

    </section>



@endsection