@extends('layouts.backEnd')
@section('page_css')
@endsection
@section('page_script')
    <script>
        var operation_page=1;
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

            <h6> طاقم العمل >  دائم   </h6>
        </div>
        <div class="Tparent" >
            @if($healper->check_permission(26,2))
            <div class="row ml-3 mr-3 mt-3 p-3 filter-search-box filter-form">
                <div class="col-lg-10">

                    <div class="row filter-res">

                        <div class="col-lg-2 col-sm-12 col-md-12 col-12">
                            <div >
                                <label>الوظيفة :</label>
                            </div>
                            <select id="status" class="form-control filter1" >
                                <option value="all">الكل</option>
                                @foreach($roles as $role)
                                    <option value="{{$role->id}}">{{$role->title}}</option>
                              @endforeach
                            </select>
                        </div>


                        {{--<div class="col-lg-8 col-sm-12 col-md-12 col-12">--}}
                            {{--<div >--}}
                                {{--<label> تاريخ :</label>--}}
                            {{--</div>--}}
                            {{--من <input type="date" class="type-date">--}}
                            {{--الى <input type="date" class="type-date">--}}
                        {{--</div>--}}

                    </div>
                </div>
                <span class="btn btn-dark filter_but" style="height: 45px;border-radius: 21%;" onclick="filter('CrewDataTable','setting/data_crews')" >بحث</span>
            </div>
            @endif
            <div class="row m-4">


                <div class="float-left " >

                    @if($healper->check_permission(26,3))
                    <button class="add-crepto mr-2 mb-2 addNewRow  " data-toggle="modal" data-target="#exampleModalLong">أضافة </button>
                    @endif

                    {{--<button class="upload-excel mr-2 mb-2 ">أدخال عن طريق ملف</button>--}}
                        @if($healper->check_permission(26,6))
                                <a href="{{ URL::to('downloadExcel/xls/Crew/permanent_crew/?arr[]='.$arr.'') }}"><button class="btn btn-success export-excel mr-2 mb-2">أخراج كاملف اكسيل</button></a>
                         @endif
                </div>

            </div>

            <div class="row m-3 justify-content-center ">
                <div class="col-lg-10 ">

                    <table class="table zadnatable mainTable" tableId="11" id="CrewDataTable">
                        <thead >
                        <tr >
                            <th>الاسم </th>
                            <th>الوظيفة</th>

                            <th>البريد الالكترونى</th>

                            <th class="actions">  <i class="fas fa-bars"></i></th>

                        </tr>
                        </thead>

                            <td class="query-td">
                                <img src="{{asset('public/styles/backEnd/dist/imgs/user-deactivate.png')}}" id="disactive" class="imgActive">
                            </td>

                        </tr>
                    </table></div>

            </div>


        </div>

    </section>
    <!-- add  Modal -->

    <form id="form_add_crew" method="post">
        <input type="hidden" name="id" id="id" value="">
    <div class="modal fade" id="exampleModalLong"  role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true" currtable>
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content modalbg">
                <div class="modal-header modal-border">
                    <h5 class="modal-title" id="exampleModalLongTitle">اضافة </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body modal-space">
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


                                <td class="InputNum"><div class="form-group InputGroup">
                                        <input type="text" name="username" class="form-control numric col-val">

                                    </div>
                                    <div id="username_demo"></div>
                                </td>
                                <td class="InputNum">
                                    <select name="role" class="form-control select2 col-val" style="width: 100%;">
                                        <option selected disabled>اختر الوظيفه</option>
                                        @foreach($roles as $role)
                                            <option value="{{$role->id}}">{{$role->title}}</option>
                                        @endforeach
                                    </select>
                                    <div id="role_demo"></div>
                                </td>
                                <td class="InputNum">
                                    <select name="gender" class="form-control" style="width: 100%; height: 20%">
                                        <option selected disabled>النوع</option>
                                        <option value=1>ذكر</option>
                                        <option value=2>انثى</option>
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
                                    <select name="nationality" class="form-control select2" style="width: 100%;">
                                        <option selected disabled >اختر الجنسيه</option>
                                        @foreach($nationality as $key=>$nationality)
                                            <option value="{{$key}}">{{$nationality}}</option>
                                        @endforeach
                                    </select>
                                    <div id="nationality_demo"></div>
                                </td>
                                <td class="InputNum"><div class="form-group InputGroup">
                                        <input type="number" name="national_id" class="form-control numric"  >
                                    </div>
                                    <div id="national_id_demo"></div>
                                </td>
                                <td class="InputNum"><div class="form-group InputGroup">
                                        <input type="number" name="cost_by_day" class="form-control numric" min="0" >
                                    </div>
                                    <div id="cost_by_day_demo"></div>
                                </td>
                                <td class="InputNum"><div class="form-group InputGroup">
                                        <input type="number" name="cost_by_month" class="form-control numric" min="0" >
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
                                <th scope="col">  مسئول عن</th>


                            </tr>
                            </thead>
                            <tbody>
                            <tr>

                                <td class="InputNum"><div class="form-group InputGroup">
                                        <input type="date" name="hire_date" class="form-control numric col-val"  >
                                    </div>
                                    <div id="hire_date_demo"></div>
                                </td>
                                <td class="InputNum"><div class="form-group InputGroup">
                                        <input type="date" name="birthdate" class="form-control numric"  >

                                    </div>
                                </td>
                                <td class="InputNum"><div class="form-group InputGroup">
                                        <select id="tags" name="responsible_for[]" class="form-control select2" multiple="multiple" data-placeholder="Select a State" style="width: 100%;">
                                            @foreach($crews as $crew)
                                                <option value="{{$crew->user->id}}">{{$crew->user->username}}</option>
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
                                        <input type="email" name="email" class="form-control numric col-val ">
                                    </div>
                                    <div id="email_demo"></div>
                                </td>
                                <td class="InputNum">
                                    <div class="form-group InputGroup">
                                        <input type="text" name="password" class="form-control numric">
                                    </div>
                                    <div id="password_demo"></div>
                                </td>
                            </tr>
                            </tbody>
                        </table>


                    </div>
                </div>
                <div class="modal-footer footer-border">
                    <button type="button" class="btn close-btn" data-dismiss="modal">غلق</button>
                    <button type="button" class="btn save-btn btnSave" id="SubmitButton">حفظ</button>
                </div>
            </div>
        </div>
    </div>
    </form>


    <!-- delete  Modal -->

    <div id="deletemodal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content modalbg-add">
                <div class="modal-header d-flex flex-row-reverse">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title ">حذف</h4>
                </div>
                <div class="modal-body">
                    <p>حذف نوع محصول؟</p>
                </div>
                <div class="modal-footer">
                    <a href="#" id="btnYes" class="danger btn btn-primary ">نعم</a>
                    <a href="#" data-dismiss="modal" aria-hidden="true" class="btn btn-danger ">لا</a>
                </div>
            </div>

        </div>
    </div>



@endsection