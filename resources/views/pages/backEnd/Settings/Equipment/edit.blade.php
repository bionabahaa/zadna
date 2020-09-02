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
<form id="EditEquipmentsForm" method="POST">
    <input type="hidden" name="id" id="id" value="{{ $info->id }}">
  <!--بدايه اصناف المحصول-->
      <div class="top-bar">
          <h6>اعدادات عامه > معدات > اضافه / تعديل معده </h6>
      </div>
     
      <div class="content p-5">
        <div class="table-responsive">
            <table class="table tableborder">
                <thead>
                <tr>
                    <th scope="col">الكود</th>
                    <th scope="col">النوع</th>
                    <th scope="col">اسم المُعَدَّة</th>
                    <th scope="col">السعر</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td  class="InputNum" ><div class="form-group InputGroup">
                        <input type="number" name="code" readonly value="{{ $info->code }}" class="form-control numric" min="0">

                    </div>
                    <div id="code_demo"></div></td>
                    <td class="InputNum">
                      <div id="accordion">
                        <div class="card cards">
                            <div class="card-header cardPadding" id="headingOne">
                                <h5 class="mb-0">
                                    <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <i class="fas fa-angle-down arrow"></i>
                                    </button><label class="selected-value inputType" id="type_title">{{ $info->type_title }}</label>
                                    <input type="hidden" name="type" value="{{ $info->type_id }}" id="type_title_hidden">
                                </h5>
                            </div>
                            
                              <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                  <div class="card-body cb0dy">
                                      <ul id="myUL" class="itemGroup ">
                                          @foreach ($EquipmentType as $value)
                                          <li class="item typeLI" data-id="{{ $value->id }}" data-title="{{ $value->title }}">{{ $value->title }} <span style="float: right;padding-right: 20px;color: red;" id="DeleteTypeBtn" data-id="{{ $value->id }}"> X </span></li>
                                          @endforeach
                                              @if($healper->check_permission(4,2))
                                          <li> <a  href="#" data-toggle="modal" data-target="#exampleModalLong2" >اضافة نوع +</a></li>
                                             @endif
                                      </ul>
                                  </div>
                              </div>
                           
                            
                        </div>
                    </div>
                    <div id="type_demo"></div>
                </td>
                    <td  class="InputNum"><div class="form-group InputGroup">
                        <input type="text" name="title" value="{{ $info->title }}" class="form-control numric name" min="0">

                    </div>
                    <div id="title_demo"></div>
                </td>
                    <td  class="InputNum"><div class="form-group InputGroup">
                        <input type="number" name="price" value="{{ $info->price }}" class="form-control numric price" min="0">

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
                        <input type="number" name="QYT" value="{{ $info->QYT }}" class="form-control numric" min="0">

                    </div>
                    <div id="QYT_demo"></div>
                </td>
                    <td  class="InputNum" ><div class="form-group InputGroup">
                        <input type="date" name="config[date_of_purchase]" value="{{ $info->date_of_purchase }}" class="form-control numric buy-date" >

                    </div>
                    </td>
                    <td class="InputNum">
                        <select class="form-control numric select2 typeCrop"  name="matriels[]" multiple="multiple" style="width: 100%;">
                          @foreach ($Matriels as $value)
                             @if(in_array($value->id,$info->Matrials_id))
                             <option value="{{ $value->id }}" selected>{{ $value->title }}</option>
                             @else
                             <option value="{{ $value->id }}">{{ $value->title }}</option>
                             @endif
                          @endforeach
                        </select>
                        <div id="matriels_demo"></div>
                      </td>
                          <td  class="InputNum"><div class="form-group InputGroup">
                                  <input type="text" name="config[power]" value="{{$info->power}}" class="form-control numric" min="0">
                            {{--<select name="config[power]" class="form-control numric" >--}}
                                {{--<option value="1" @if($info->power==1) selected="" @endif>22 حصان </option>--}}
                                {{--<option value="2" @if($info->power==2) selected="" @endif>55 حصان </option>--}}
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
                        <input type="number" value="{{ $info->consumption_rate }}" name="config[consumption_rate]" class="form-control numric" min="0">

                    </div></td>
                    <td class="InputNum"><div class="form-group InputGroup2">
                        <input type="number" value="{{ $info->production_rate }}" name="config[production_rate]" class="form-control numric" min="0">

                    </div></td>
                      <td class="InputNum"><div class="form-group InputGroup2">
                        <input type="number" value="{{ $info->depreciation_rate }}" name="config[depreciation_rate]" class="form-control numric" min="0">

                    </div></td>
                    
                      <td class="InputNum" ><div class="form-group InputGroup">
                        <input type="text" value="{{ $info->model }}" name="config[model]" class="form-control numric" min="0">

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
                            <textarea  class="form-control numric" min="0" id="E-consumption" name="config[note]">{{ $info->note }}</textarea>

                        </div></td>
                  
                </tr>

                </tbody>
            </table>
        </div>
      </div>
      </form>

    @if($healper->check_permission(7,6))
      <button type="button" id="SubmitButton" class="btn save-btn">حفظ</button>
      @endif

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


    <div class="Tparent">
        @if($healper->check_permission(7,8))
      <div class=" row m-4">
         <h5 class="col-md-5">الصيانة الدورية</h5>
         <div class="col-md-2 offset-4">
             <button class="add-crepto addNewDate  " data-toggle="modal" data-target="#addDateModal" >أضافة </button>
         </div>
         <hr>
     </div>
        @endif
            @if($healper->check_permission(7,7))
     <div class="row m-4">
         <div class="col-lg-12 col-sm-12 col-12 ">

             <div >
                 <table class="table  table-bordered table2 mainTable" tableId="0">
                     <thead style="text-align: center;background: #fff;">
                     <tr>
                         <th scope="col">الكود</th>
                         <th scope="col">الوصف</th>
                         <th scope="col">التاريخ</th>
                         <th scope="col">التكرار</th>
                         <th scope="col">المده</th>
                         <th scope="col"> <i class="fas fa-bars"></i>  </th>
                     </tr>
                     </thead>

                     <tbody style="background: #fff;">
                       @foreach ($EquipmentTest as $value )
                          <tr>
                              <td>{{ $value->code }}</td>
                              <td >
                                  {{--  <div class="form-group InputGroup">
                                      <input type="text" class="form-control td-input" disabled>
    
                                  </div>  --}}
                                  {{ $value->title }}
                              </td>
                              <td >
                                  {{ $value->datetime }}
                                  {{--  <div class="form-group InputGroup">
                                      <input type="text" class="form-control  td-input" disabled >
                                  </div>  --}}
                              </td>
                              <td >
                                  {{ $value->test_num }}
                                  {{--  <div class="form-group InputGroup">
                                      <input type="text" class="form-control td-input" disabled>
    
                                  </div>  --}}
                              </td>
                              <td >
                                  {{ $value->test_duration }}
                                  {{--  <div class="form-group InputGroup">
                                      <input type="text" class="form-control td-input" disabled>
    
                                  </div>  --}}
                              </td>
    
                              <td>
                                  @if($healper->check_permission(7,9))
                                 <button class="delete_test"  data-id="{{ $value->id }}" ><i class="fas fa-trash-alt "title="Delete"></i></button>
                                  @endif
    
                                  {{--  <i  class="fas fa-edit edit-row" title="View" ></i>
                                  <i class="fas fa-check-square save-edit" hidden></i>  --}}
    
                              </td>
                          </tr>
                       @endforeach
                     
                     </tbody>
                 </table>
             </div>
         </div>
     </div>
        @endif
 </div>

 <div id="addDateModal" class="modal fade" role="dialog" currTable>
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content modalbg-add">
            <div class="modal-header d-flex flex-row-reverse">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h5 class="modal-title text-center ">اضافه موعد صيانه</h5>
            </div>
            <div class="modal-body">
              <form action="POST" id="EquipmentTestAdd">

                  <div class="row mb-4" >

                      <div class="col-12">
                          <label class="col-4" for="descrep">الوصف:</label>
                          <input type="hidden" name="equipment_id" value="{{ $info->id }}" id="descrep" class="col-val border-style col-6 ">
                          <input type="text" name="title_main" id="descrep" class="col-val border-style col-6 ">
                          <div id="title_maintitle_demo"></div>
  
                      </div>
                  </div>
                  <div class="row mb-4">
  
                      <div class="col-12">
                          <label class="col-4" for="date">التاريخ:</label>
                          <input type="date" name="datetime" id="date" class="col-val border-style col-6 ">
                          <div id="datetime_demo"></div>
                      </div>
                  </div>
  
                  <div class="row mb-4">
  
                      <div class="col-12">
                          التكرار:
                          <label class="span col-2 offset-1" for="every">كل</label>
                          <input type="text" name="test_num" id="every" class=" col-val border-style col-2">
                          <div id="test_num_demo"></div>
                          <label class="span col-2" for="time">لمده</label>
                          <input type="text" name="test_duration" id="time" class=" col-val border-style col-2">
                          <div id="test_duration_demo"></div>
  
                      </div>
  
                  </div>

              </form>
                

                <br>

            </div>
            <div class="modal-footer">
                <button id="saveDateTest" class="danger btn btn-primary btnSave ">حفظ</button>
                <a href="#" data-dismiss="modal" aria-hidden="true" class="btn btn-danger ">الغاء</a>
            </div>
        </div>

    </div>
</div>
@endsection