@extends('layouts.backEnd')
@section('page_css')
@endsection
@section('page_script')
<script src="{{ asset('public') }}/js/backEnd/role.js"></script>
@endsection
@section('page_header')
@endsection
@section('page_content')
@inject('healper', 'App\Http\Controllers\BladeController')
<section class="content cropType">
    <div class="top-bar">
        <h6>اعدادات عامه > المستخدمين</h6>
    </div>
    <!-- Custom Tabs -->
    <div class="nav-tabs-custom">
        <div class="row m-3">
            <ul class="nav nav-tabs">
                <li class="user-tab active"><a href="#tab_1" data-toggle="tab"> المستخدمين</a></li>
                @if($healper->check_permission(10,6))
                 <li class="user-tab  "><a href="#tab_2" data-toggle="tab">مجموعة الصلاحيات</a></li>
                @endif
                <li class="user-tab tab2 "></li>
            </ul>
        </div>
        <div class="tab-content ">
            <div class="tab-pane Tparent active " id="tab_1">
                <div>
                    <div class="row ml-3 mr-3 mt-3 p-3 filter-search-box">
                        <div class="col-lg-10">
                            <div class="row filter-res">
                                {{-- <div class="col-lg-2 col-sm-12 col-md-12 col-12">
                                    <div >
                                        <label>الوظيفة :</label>
                                    </div>
                                    <select class="form-control filter-form">
                                        <option>الكل</option>
                                        <option>مزارع</option>
                                        <option> نوع2</option>
                                    </select>
                                </div> --}}
                            </div>
                        </div>
                          <div class="col-lg-2 mt-3 col-sm-4 col-md-4 col-12 search-div"></div>

                    </div>
                    <div class="row m-4">
                        <div class="float-left ">
                                @if($healper->check_permission(10,2))
                                    <button class="add-crepto mr-2 mb-2  " onclick="window.location.href='{{route('users.create')}}'">أضافة مستخدم</button>
                                @endif
                            {{--<button class="upload-excel mr-2 mb-2 ">أدخال عن طريق ملف</button>--}}
                            @if($healper->check_permission(10,3))
                            <a href="{{ URL::to('downloadExcel/xls/Users/?arr[]='.$arr.'') }}"><button class="btn btn-success export-excel mr-2 mb-2">أخراج كاملف اكسيل</button></a>
                          @endif

                        </div>
                    </div>
                    <div class="row m-3 justify-content-center ">
                        <div class="col-lg-10 ">
                            <table class="table   zadnatable ">
                                <thead >
                                <tr >
                                    <th>الاسم</th>
                                    <th>الوظيفه</th>
                                    <th>تاريخ التعين</th>
                                    <th class="actions">العمليات</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($Users as $value)
                                        <tr rowId="1">
                                            <td>{{ $value->username }}</td>
                                            <td>{{ $value->title }}</td>
                                            <td>{{ date('Y-m-d',strtotime($value->hiring_date)) }}</td>
                                            <td class="query-td">
                                                <i class="fas fa-eye view-row" title="View" onclick="window.location.href='{{url('setting/users/')}}/{{ $value->id }}/edit'"></i>
                                            </td>
                                        </tr>
                                    @endforeach
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane Tparent" id="tab_2">
                <div >

                    <div class="row ml-3 mr-3 mt-3 p-3 filter-search-box">
                        <div class="col-lg-10">
                            <div class="row filter-res">

                                


                            </div>

                        </div>
                        <div class="col-lg-2 mt-3 col-sm-4 col-md-4 col-12">
                        </div>
                    </div>
                    <div class="row m-4">
                        <div class="float-left ">
                            {{--@if($healper->check_permission(2,1))--}}
                                <a  onclick="window.location.href='{{route('role.create')}}' ">
                                    <button class="add-crepto mr-2 mb-2  ">أضافة مجموعة</button>
                                </a>
                            {{--@endif--}}
                                {{--<button class="upload-excel mr-2 mb-2 ">أدخال عن طريق ملف</button>--}}
                        </div>
                    </div>
                    <div class="row m-3 justify-content-center ">
                        <div class="col-lg-10 ">
                            <table class="table   zadnatable ">
                                <thead >
                                <tr>
                                    <th>الكود</th>
                                    <th>اسم المجموعة</th>
                                    <th>العمليات</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($Roles as $value)
                                         <tr>
                                            <th>{{ $value->code }}</th>
                                            <th>{{ $value->title }}</th>
                                            <th>
                                                @if($healper->check_permission(10,4))
                                                <i class="fas fa-eye view-row" title="View" onclick="window.location.href='{{url('setting/role/')}}/{{ $value->id }}/edit'"></i>
                                                @endif
                                            </th>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>




                    </div>


                </div>

            </div>
            <!-- /.tab-pane -->

        </div>
        <!-- /.tab-pane -->
    </div>



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


</section>
@endsection



