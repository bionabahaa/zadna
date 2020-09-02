@extends('layouts.backEnd')
@section('page_css')
@endsection
@section('page_script')
<script src="{{ asset('public') }}/js/backEnd/request.js"></script>
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
<form id="EditRequestForm" method="post">
    <input name="id" type="hidden" id="id" value="{{$order->id}}">
    <div class="row m-4 main tab-top">
        <div class="col-lg-12 col-sm-12 col-12 ">
            <table class="table borderless table1">
                <thead>
                    <tr>
                        <th scope="col">الكود</th>
                        <th scope="col">النوع</th>
                        <th scope="col">الاسم</th>
                        <th scope="col">الكمية المطلوبة </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th class="InputNum">{{$order->code}}</th>
                        <td class="InputNum">
                            <div class="form-group InputGroup">
                                    <select name="type_id" class="form-control filter-form filter2 box2 numric loc">
                                        @foreach ($Types as $key=>$value)
                                            <option value="{{ $key }}"   @if($key==$order->type_id) selected @endif>{{$value}} </option>
                                        @endforeach
                                    </select>
                            </div>
                            <div id="type_id_demo"></div>
                        </td>
                        <td class="InputNum">
                            <div class="form-group InputGroup">
                                <input name="title" type="text"  class=" editt form-control" value="{{$order->title}}">
                            </div>
                            <div id="title_demo"></div>
                        </td>
                        <td class="InputNum">
                            <div class="form-group InputGroup">
                                <input  name="qyt" type="number"  class=" editt form-control" value="{{$order->qyt}}">طن
                            </div>
                            <div id="qyt_demo"></div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>


        <div class="col-lg-12 col-sm-12 col-12 ">
            <table class="table borderless table1 " style="margin-top: 7%">
                <thead>
                    <tr>
                        <th scope="col">الجهة المطلوب منها</th>
                        <th scope="col">المسؤل عن الطلب </th>
                        <th scope="col">الحالة</th>
                        <th scope="col">السعر</th>

                    </tr>
                </thead>
                <tbody>
                    <tr class="border_bottom">
                        <td class="InputNum">
                            <div class="form-group InputGroup">
                                <input name="order_from" type="text" class="form-control editt" value="{{$order->ordered_from}}">
                            </div>
                            <div id="order_from_demo"></div>
                        </td>
                        <td class="InputNum">
                            <div class="form-group InputGroup">
                                <select name="user_id" class="select2">
                                    <option selected disabled>اختر المستخدم</option>
                                    @foreach($users as $user)
                                        <option value="{{$user->id}}" @if($user->id==$order->user_id) selected @endif >{{$user->username}}</option>
                                    @endforeach
                                </select>
                           </div>
                            <div id="user_id_demo"></div>
                        </td>

                        <td class="InputNum">
                            <div class="form-group row">
                                <label for="date" class="col-sm-4 col-form-label">حالة العطل</label>
                                <div class="col-sm-8">
                                    <div class="custom-control custom-radio ">
                                        <input type="radio" name="status" value="2"  @if($order->status_id==2) checked @endif id="done" class="custom-control-input refuse">
                                        <label class="custom-control-label" for="done">رفض</label>
                                    </div>
                                    <div class="custom-control custom-radio ">
                                        <input type="radio" id="canceld" name="status" value="3" @if($order->status_id==3) checked @endif class="custom-control-input accept">
                                        <label class="custom-control-label" for="canceld">قبول</label>
                                    </div>
                                    <div class="custom-control custom-radio ">
                                        <input type="radio" id="wait"   name="status" value="1" @if($order->status_id==1) checked @endif name="customRadioInline1" class="custom-control-input waiting">
                                        <label class="custom-control-label" for="wait">في الانتظار</label>
                                    </div>
                                </div>
                            </div>
                            <div id="status_demo"></div>

                        </td>

                        <td class="InputNum">
                            <div class="form-group InputGroup">
                                <input name="cost" type="number" class="form-control editt" value="{{$order->cost}}">
                            </div>
                            <div id="cost_demo"></div>
                        </td>

                    </tr>
                </tbody>
            </table>
        </div>

        <div class="col-lg-12 col-sm-12 col-12 ">
            <table class="table borderless table1 " style="margin-top: 7%">
                <thead>
                    <tr>
                        <th scope="col">تاريخ الطلب</th>
                        <th scope="col">تاريخ التوريد المطلوب</th>
                        <th scope="col">تاريخ التوريد الفعلي</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border_bottom">
                        <td class="InputNum">
                            <div class="form-group InputGroup">
                                <input name="order_date" type="date" class="form-control editt" value="{{$order->order_date}}">
                            </div>
                            <div id="order_date_demo"></div>
                        </td>
                        <td class="InputNum">
                            <div class="form-group InputGroup">
                                <input name="order_date_required" type="date" class="form-control editt"  value="{{$order->order_date_required}}">
                            </div>
                            <div id="order_date_required_demo"></div>
                        </td>

                        <td class="InputNum">
                            <div class="form-group InputGroup">
                                <input name="order_date_actaual" type="date" class=" form-control editt " value="{{$order->order_date_actaual}}" >
                            </div>
                            <div id="order_date_actaual_demo"></div>
                        </td>
                    </tr>
                </tbody>

            </table>
        </div>
        <div class="row m-4">
            <div class="col pl-5">
                @if($healper->check_permission(30,5))
                <button id="SubmitButton" type="button" class="btn edit-btn ml-5 " id="edit" style="float:left">تعديل</button>
                    @endif
                <button type="button" class="btn save-btn ml-5 " id="save-edit" style="float:left" hidden>حفظ</button>
            </div>
        </div>
    </div>
    </form>
@endsection