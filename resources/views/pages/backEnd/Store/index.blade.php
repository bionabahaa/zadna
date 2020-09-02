@extends('layouts.backEnd')
@section('page_css')
@endsection
@section('page_script')
<script src="{{ asset('public') }}/js/backEnd/store.js"></script>
@endsection
@section('page_header')
@endsection
@section('page_content')
    @inject('healper', 'App\Http\Controllers\BladeController')
    @if($healper->check_permission(28,1))
<section class="content cropType">
        <div class="top-bar">
            <h6> <img src="../dist/imgs/المواسم.png" width=25px height=25px/> المخزن >رصيد المخزن </h6>
        </div>
        <div class="Tparent">
            @if($healper->check_permission(28,2))
            <div class="row ml-3 mr-3 mt-3 p-3 filter-search-box">
                <div class="col-lg-10">

                    <div class="row filter-res">


                        <div class="col-lg-2 col-sm-12 col-md-12 col-12">
                            <div>
                                <label>النوع :</label>
                            </div>
                            <select id="type" class="form-control filter-form">
                                <option value="all">الكل</option>
                                @foreach($types as $type)
                                    <option value="{{$type->id}}">{{$type->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-2"></div>

                        <div class="col-lg-8 col-sm-12 col-md-12 col-12">
                            <div>
                                <label> تاريخ اخر اضافة :</label>
                            </div>
                            من <input id="from" type="date" class="type-date"> الى <input id="to" type="date" class="type-date">
                            <span class="btn btn-dark filter_but" style="height: 45px;border-radius: 21%;" onclick="filter('StoreDataTable')" >بحث</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 mt-3 col-sm-4 col-md-4 col-12 search-div">
                    {{-- <label class="search-icon">  <input type="text" class="search" id="myInput"></label> --}}
                </div>
            </div>
            @endif

            <div class="row m-4 center ">
                <div class="col-md-4 offset-md-4">
                    <a href="{{ URL::to('downloadExcel/xls/store_balance/?arr[]='.$arr.'') }}"><button class="btn btn-success export-excel mr-2 mb-2">أخراج كاملف اكسيل</button></a>
                </div>
            </div>
            <div class="row m-3 justify-content-center">
                <div class="col-lg-10 ">
                    <div class="responsive">
                        <table class="table zadnatable " id="StoreDataTable">
                            <thead>
                                <tr>
                                    <th>الكود</th>
                                    <th> النوع </th>
                                    <th>الاسم</th>
                                    <th> الكمية الحالية </th>
                                    <th> تاريخ اخر اضافة</th>
                                    <th scope="col" class="actions"><i class="fas fa-bars"></i></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="Edit-add-kind" viewrow="" tabindex="-1" role="dialog" aria-labelledby="EidtTypeModalTitle2" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content modalbg-add">
                <div class="modal-header header-border">
                    <h5 class="modal-title" id="EidtTypeModalTitle2">الكمية المضافة</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body ">
                    <div class="row">
                        <div class="col-12">
                            <label> الكمية:
                                <input type="number" class="textStyle Quantity" id="quantum" ><span>كجم</span>
                            </label>
                        </div>
                    </div>
                    <div class="row"></div>
                    <br>
                    <br>
                    <br>
                </div>
                <div class="modal-footer footer-border">

                    <button type="button" class="btn sum" id="save-edit2" data-dismiss="modal" aria-label="Close" value="اضافه" id="EditModal-add-item">اضافة</button>
                </div>
            </div>
        </div>
    </div>


<div class="modal" id="modal_material" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">الخامه </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">الكميه الكليه</th>
                        <th scope="col">الكميه المطلوبه</th>
                        <th scope="col">الكميه المرسله</th>
                        <th scope="col">الكميه المتبقيه من الطلب</th>
                    </tr>
                    </thead>
                    <tbody id="material_store">
                    
                    </tbody>
                </table>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



        @else
        <h1 style="    text-align: center;color: #28a745;">ليس لديك صلاحيه للدخول لصفحه رصيد المخزن</h1>
@endif
@endsection