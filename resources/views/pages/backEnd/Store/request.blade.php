@extends('layouts.backEnd')
@section('page_css') 
@endsection 
@section('page_script')
<script src="{{ asset('public') }}/js/backEnd/request.js"></script>
@endsection
@section('page_header')
@endsection
@section('page_content')
    @inject('healper', 'App\Http\Controllers\BladeController')
    @if($healper->check_permission(29,1))
<section class="content cropType">
    <div class="top-bar">
        <h6>
            <img src="../dist/imgs/المواسم.png" width=25px height=25px/> المخزن > اوامر التوريد </h6>
    </div>
    <div class="Tparent">
        @if($healper->check_permission(30,2))
        <div class="row ml-3 mr-3 mt-3 p-3 filter-search-box">
            <div class="col-lg-10">

                <div class="row filter-res">

                    <div class="col-lg-2 col-sm-12 col-md-12 col-12">
                        <div>
                            <label>النوع :</label>
                        </div>
                        <select id="status" class="form-control filter-form filter2 box1" filtercol="1">
                            <option selected value="all">الكل</option>
                            <option value="1"> مبيد</option>
                            <option value="2"> سماد</option>
                            <option value="3"> محصول</option>
                        </select>
                    </div>
                    <div class="col-lg-2 col-sm-12 col-md-12 col-12">
                        <div>
                            <label>الحالة :</label>
                        </div>
                        <select id="type" class="form-control filter-form filter2 box2" filtercol="4">
                            <option selected value="all"> الكل</option>
                            <option value="1">جارى التنفيذ</option>
                            <option value="3">تم</option>
                            <option value="2"> لم يتم</option>

                        </select>
                    </div>
                    <div class="col-lg-8 col-sm-12 col-md-12 col-12">
                        <div>
                            <label> تاريخ :</label>
                        </div>
                        من
                        <input id="from" type="date" class="type-date"> الى
                        <input id="to" type="date" class="type-date">
                    </div>
                </div>
            </div>
            <span class="btn btn-dark filter_but" style="height: 45px;border-radius: 21%;" onclick="filter('RequestDataTable','stores/data_requests')" >بحث</span>
            <div class="col-lg-2 mt-3 col-sm-4 col-md-4 col-12 search-div">
                {{--  <label class="search-icon">
                    <input type="text" class="search" id="myInput">
                </label>  --}}
            </div>
        </div>
        @endif
        <br>
        <div class="row m-4 center ">
            <div class="col-md-4 offset-md-4">
                <a href="{{ URL::to('downloadExcel/xls/StoreRequest/?arr[]='.$arr.'') }}"><button class="btn btn-success export-excel mr-2 mb-2">أخراج كاملف اكسيل</button></a>
            </div>
        </div>
            
        <div class="row m-4">
            <div class="float-left ">
                @if($healper->check_permission(30,3))
                <button class="add-crepto mr-2 mb-2" data-target="#addRequest" data-toggle="modal" style="float: left; margin-left: 9% !important;">أضافة </button>
                @endif
            </div>
        </div>
        <div class="row m-3 justify-content-center ">
            <div class="col-lg-10 ">
                <table class="table zadnatable" id="RequestDataTable">
                    <thead>
                        <tr>
                            <th>الكود</th>
                            <th>النوع </th>
                            <th>الاسم</th>
                            <th>الكمية المطلوبة</th>
                            <th>الحاله</th>
                            <th>الجهة المطلوبة منها</th>
                            <th>تاريخ الطلب</th>
                            <th>تاريخ التوريد الفعلي</th>
                            <th class="actions">
                                <i class="fas fa-bars"></i>
                            </th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

</section>
<!-- basic Modal -->
<div class="modal fade" id="addRequest" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modalbg">
            <div class="modal-header modal-border">
                <h5 class="modal-title" id="exampleModalLongTitle">اضافة</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body modal-space">
                <form action="" id="AddRequestForm">
                    <input type="hidden" name="id" value="" id="id">
                    <div class="table-responsive">
                        <table class="table tableborder">
                            <thead>
                                <tr>
                                    <th scope="col">النوع</th>
                                    <th scope="col">الاسم</th>
                                    <th scope="col">السعر</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="InputNum">
                                        <div class="form-group InputGroup">
                                            <select name="type_id" class="form-control filter-form filter2 box2 numric loc">
                                                @foreach ($Types as $key=>$value)
                                                    <option value="{{ $key }}">{{ $value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </td>
                                    <td class="InputNum">
                                        <div class="form-group InputGroup">
                                            <input name="title" id="" type="text" class="form-control numric date">
                                        </div>
                                        <div id="title_demo"></div>
                                    </td>

                                    <td class="InputNum">
                                        <div class="form-group InputGroup">
                                            <input name="cost"  type="text" class="form-control numric date">
                                        </div>
                                        <div id="cost_demo"></div>
                                    </td>

                                </tr>
                            </tbody>
                        </table>
                        <table class="table tableborder">
                            <thead>
                                <th scope="col">الجهه المطلوبة منها</th>
                                <th scope="col">الكميه المطلوبه</th>
                                <th></th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="InputNum">
                                        <div class="form-group InputGroup">
                                            <input name="order_from" type="text" class="form-control numric ">
                                        </div>
                                    <div id="order_from_demo"></div>
                                    </td>
                                    <td class="InputNum">
                                        <div class="form-group InputGroup">
                                            <input name="qyt" type="number" class="form-control numric ">
                                        </div>
                                    <div id="qyt_demo"></div>
                                    </td>
                                    <td>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
            <div class="modal-footer footer-border">
                <button type="button" class="btn close-btn" data-dismiss="modal">غلق</button>
                <button type="button"  class="btn save-btn" id="SubmitButton">حفظ</button>
            </div>
        </div>
    </div>
</div>

<!-- model for add type -->
<div class="modal fade" id="exampleModalLong2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
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
        <h1 style="    text-align: center;color: #28a745;">ليس لديك صلاحيه للدخول لهذه الصفحه</h1>
    @endif

@endsection