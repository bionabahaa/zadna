@extends('layouts.backEnd')
@section('page_css')

@endsection
@section('page_script')
<script src="{{ asset('public') }}/js/backEnd/elequent.js"></script>
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
<form id="AddEquipmentsForm" method="POST">
    <input type="hidden" name="id" id="id" value="">
  <!--بدايه اصناف المحصول-->
      <div class="top-bar">
          <h6>اعدادات عامه > معدات > اضافه / تعديل معده </h6>
      </div>
     
      <div class="content p-5">
        <div class="table-responsive">
            <table class="table tableborder">
                <thead>
                <tr>
                    {{--<th scope="col">الكود</th>--}}
                    <th scope="col">النوع</th>
                    <th scope="col">اسم المُعَدَّة</th>
                    <th scope="col">السعر</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    {{--<td  class="InputNum" ><div class="form-group InputGroup">--}}
                        {{--<input type="number" name="code" readonly value="{{ $code }}" class="form-control numric" min="0">--}}

                    {{--</div></td>--}}
                    <td class="InputNum">
                      <div id="accordion">
                        <div class="card cards">
                            <div class="card-header cardPadding" id="headingOne">
                                <h5 class="mb-0">
                                    <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <i class="fas fa-angle-down arrow"></i>
                                    </button><label class="selected-value inputType" id="type_title">None</label>
                                    <input type="hidden" name="type" id="type_title_hidden">
                                </h5>
                            </div>
                            
                              <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                  <div class="card-body cb0dy">
                                      <ul id="myUL" class="itemGroup ">
                                          @foreach ($EquipmentType as $value)
                                          <li class="item typeLI" data-id="{{ $value->id }}" data-title="{{ $value->title }}">{{ $value->title }} <span style="float: right;padding-right: 20px;color: red;" id="DeleteTypeBtn" data-id="{{ $value->id }}"> X </span></li>
                                          @endforeach
                                              @if($healper->check_permission(4,1))
                                          <li> <a  href="#" data-toggle="modal" data-target="#exampleModalLong2" >اضافة نوع +</a></li>
                                            @endif
                                      </ul>
                                  </div>
                              </div>
                           
                            
                        </div>
                    </div>
                    <div id="type_demo"></div>
                </td>
                    <td  class="InputNum">
                        <div class="form-group InputGroup">
                        <input type="text" name="title" class="form-control numric name" min="0">
                        </div>
                        <div id="title_demo"></div>
                    </td>
                    <td  class="InputNum"><div class="form-group InputGroup">
                        <input type="number" name="price" class="form-control numric price" min="0">

                    </div>
                    <div id="price_demo"></div>
                </td>
                </tr>

                </tbody>
            </table>
            <table class="table tableborder">

                <thead>
                <tr>

                    <th scope="col">الكمية</th>
                    <th scope="col">تاريخ الشراء</th>
                    <th scope="col">خامات التشغيل</th>
                    <th scope="col">القوة</th>
                    
                      
                </tr>
                </thead>
                <tbody>
                <tr>

                    <td  class="InputNum"><div class="form-group InputGroup">
                        <input type="number" name="QYT" class="form-control numric" min="0">

                    </div>
                    <div id="QYT_demo"></div>
                </td>
                    <td  class="InputNum" ><div class="form-group InputGroup">
                        <input type="date" name="config[date_of_purchase]" class="form-control numric buy-date" >

                    </div>
                    </td>
                    <td class="InputNum">
                        <select class="form-control numric select2 typeCrop"  name="matriels[]" multiple="multiple" style="width: 100%;">
                          @foreach ($Matriels as $value)
                             <option value="{{ $value->id }}">{{ $value->title }}</option>
                          @endforeach
                        </select>
                        <div id="matriels_demo"></div>
                      </td>
                          <td  class="InputNum"><div class="form-group InputGroup">
                                  <input type="text" name="config[power]" class="form-control numric" min="0">
                            {{--<select name="config[power]" class="form-control numric" >--}}
                                {{--<option value="1">22 حصان </option>--}}
                                {{--<option value="2">55 حصان </option>--}}
                            {{--</select>--}}

                              </div></td>
                    
                </tr>

                </tbody>
            </table>
            <table class="table tableborder">

                <thead>
                <tr>
                    
                      <th scope="col">معدل الاستهلاك/ساعة</th>
                    <th scope="col">معدل الانتاج/ساعة</th>
                    <th scope="col">معدل الاهلاك/سنة</th>
                    <th scope="col">الموديل</th> 
                    
                </tr>
                </thead>
                <tbody>
                <tr>

                    <td class="InputNum" ><div class="form-group InputGroup">
                        <input type="number" name="config[consumption_rate]" class="form-control numric" min="0">

                    </div>
                    
                </td>
                    <td class="InputNum"><div class="form-group InputGroup2">
                        <input type="number" name="config[production_rate]" class="form-control numric" min="0">

                    </div></td>
                      <td class="InputNum"><div class="form-group InputGroup2">
                        <input type="number" name="config[depreciation_rate]" class="form-control numric" min="0">

                    </div></td>
                    
                      <td class="InputNum" ><div class="form-group InputGroup">
                        <input type="text" name="config[model]" class="form-control numric" min="0">

                    </div></td>
                    
                </tr>

                </tbody>
            </table>
            
            <table class="table tableborder">

                <thead>
                <tr>

                    <th scope="col">مواصفات</th>
                    
                </tr>
                </thead>
                <tbody>
                <tr>



                    <td class="InputNum" ><div class="form-group InputGroup">
                            <textarea  class="form-control numric" min="0" id="E-consumption" name="config[note]"></textarea>

                        </div></td>
                  
                </tr>

                </tbody>
            </table>
        </div>
      </form>
      <button type="button" id="SubmitButton" class="btn save-btn">حفظ</button>
  
    </div>

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
                  <form action="POST" id="TypeEquipment">
                    <div class="form-group center">
                        <input type="text"  name="title_type" class="textStyle">
                        <div id="title_type_demo"></div>
                    </div>
                  </form>
                </div>
                <div class="modal-footer footer-border">
                    <button type="button" class="btn add-btn" data-dismiss="modal" id="AddNewType" aria-label="Close" value="اضافه" id="addgroup">اضافة</button>
                </div>
            </div>
        </div>
    </div>
@endsection