@extends('layouts.backEnd')
@section('page_css')
@endsection
@section('page_script')
<script src="{{ asset('public') }}/js/backEnd/store_order.js"></script>
@endsection
@section('page_header')
@endsection
@section('page_content')
    @inject('healper', 'App\Http\Controllers\BladeController')
    @if($healper->check_permission(30,1))
<section class="content cropType">
        <div class="top-bar">
           
          <h6>  <img src="../dist/imgs/المخزن.png" width=25px height=25px/>   المخزن >  المطلوب من المخزن </h6>
        </div>
        <div class="Tparent" >
          @if($healper->check_permission(30,2))
           <div class="row ml-3 mr-3 mt-3 p-3 filter-search-box">
               <div class="col-lg-10">
                    <div class="row filter-res">
                            <div class="col-lg-2 col-sm-12 col-md-12 col-12">
                     <div >
                   <label>النوع :</label> 
                 </div>
                <select id="status" class="form-control filter-form" >
                    <option value="all">الكل</option>
                    <option value="2">معدات</option>
                    <option value="1">خامات</option>}
                      </select>
                 </div> 
                        <div class="col-lg-2"></div>
                          <div class="col-lg-8 col-sm-12 col-md-12 col-12">
                    <div >
                   <label> تاريخ :</label> 
                 </div> 
              من <input id="from" type="date" class="type-date">الى
               <input id="to" type="date" class="type-date">
                <span class="btn btn-dark filter_but" style="height: 45px;border-radius: 21%;" onclick="filter('StoreOrderDataTable','stores/data_orders')" >بحث</span>
                 </div> 
                </div>
               </div>
             {{--<div class="col-lg-2 mt-3 col-sm-4 col-md-4 col-12 search-div">--}}
                    {{-- <label class="search-icon">  <input type="text" class="search" id="myInput"></label> --}}
                 {{--</div>--}}
           </div>
           @endif
            <br>
              
            <div class="row m-4 center ">
                <div class="col-md-4 offset-md-4">
                    <a href="{{ URL::to('downloadExcel/xls/store_orders/?arr[]='.$arr.'') }}"><button class="btn btn-success export-excel mr-2 mb-2">أخراج كاملف اكسيل</button></a>
                </div>
            </div>
            <div class="row m-3 justify-content-center ">
                <div class="col-lg-10 ">
                    <table class="table zadnatable" id="StoreOrderDataTable">
                        <thead>
                            <tr>
                                <th>الكود</th>
                                <th>النوع </th>
                                <th> الاسم </th>
                                <th>الكمية الكليه</th>
                                <th>الكمية المطلوبة</th>
                                <th>الكمية المتبقيه</th>
                                <th>الكمية المرسله</th>
                                {{--<th>الكمية المتبقيه</th>--}}
                                <th> تاريخ الطلب</th>
                                <th class="actions"><i class="fas fa-bars"></i></th>
                            </tr>
                        </thead>
                    </table>
            </div>
        </div>
    </div>




    <div class="modal" id="order_model" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">الكميه التى سوف يتم ارسالها من المخزن</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" id="formOrder">
                        <div class="table-responsive">
                            <table class="table tableborder">
                                <thead>
                                <tr>
                                    <th scope="col">الكميه الكليه</th>
                                    <th scope="col">الكميه المطلوبه</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="InputNum">
                                        <div class="form-group InputGroup">
                                            <input type="hidden" id="order_id">
                                            <input name="total_qyt" readonly id="total_amount" type="text" class="form-control numric ">
                                        </div>

                                    </td>
                                    <td class="InputNum">
                                        <div class="form-group InputGroup">
                                            <input name="requested_qyt" readonly id="requested_amount" type="text" class="form-control numric ">
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>

                            <table class="table tableborder">
                                <thead>
                                <tr>
                                    <th scope="col">الكميه التى سوف يتم ارسالها</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="InputNum">
                                        <div class="form-group InputGroup">
                                            <input  name="sent_qyt" required type="number" class="form-control numric ">
                                        </div>
                                        <div id="sent_qyt_demo"></div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>


                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" id="save_order" class="btn ">موافقه</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                </div>
            </div>
        </div>
    </div>





</section>
@else
        <h1 style="    text-align: center;color: #28a745;">ليس لديك صلاحيه للدخول الى أوامر التوريد </h1>
    @endif

@endsection