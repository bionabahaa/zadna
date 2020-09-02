@extends('layouts.backEnd')
@section('page_css')
@endsection
@section('page_script')
<script>
    $(function () {
      $(".select2").select2();
    });
  </script>
<script src="{{ asset('public') }}/js/backEnd/material.js"></script>

@endsection
@section('page_header')
@endsection
@section('page_content')
    @inject('healper', 'App\Http\Controllers\BladeController')
    <form id="AddMaterialForm" method="POST">
        <input type="hidden" name="id" id="id" value="">
    <section class="content cropType">
        <div class="top-bar">
            <h6>اعدادات عامه > خامات </h6>
        </div>

        <div class="table-responsive p-5">

            <table class="table tableborder ">

                <thead>
                <tr>

                    <th scope="col">النوع</th>
                    <th scope="col">المجموعه الرئيسيه</th>
                    <th scope="col">الاسم</th>
                    <th scope="col"  >وحدة القياس</th>
                </thead>
                <tbody>
                <tr>
                    <td class="InputNum"><div id="accordion">
                            <div class="card">
                                <div class="card-header cardPadding" >
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
                                            @foreach ($materials_type as $value)
                                                <li class="item typeLI " data-id="{{ $value->id }}" data-title="{{ $value->title }}">{{ $value->title }} @if(in_array(!$value->id,[1,2])) <span style="float: right;padding-right: 20px;margin-left: 10px; color: red;" class="DeleteTypeBtn" data-id="{{ $value->id }}">  X </span>@endif </li>
                                            @endforeach
                                                @if($healper->check_permission(7,1))
                                            <li> <a  href="#" data-toggle="modal" data-target="#exampleModalLong2" >اضافة نوع +</a></li>
                                               @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                                <div id="type_demo"></div>
                        </div>
                    </td>

                    <td class="InputNum" >
                        <select name="main_groub" id="line_type" class="form-control filter-form inputType col-val" >
                            <option selected disabled>اختر</option>
                            @foreach($main_groub as $key=>$value)
                                <option value="{{$key}}">{{$value}}</option>
                            @endforeach
                        </select>
                        <div id="main_groub_demo"></div>
                    </td>
 
                    <td class="InputNum"><div class="form-group InputGroup">
                            <input type="text" name="price" class="form-control numric price" min="0">
                        </div>
                        <div id="price_demo"></div>
                    </td> 
                <td class="InputNum" ><div id="accordiony">
                            <div class="card">
                                <div class="card-header cardPadding" id="headingOne">

                                    <h5 class="mb-0">
                                        <a class="btn btn-link" data-toggle="collapse" data-target="#collapseOney" aria-expanded="true" aria-controls="collapseOne">
                                            <i class="fas fa-angle-down arrow"></i>
                                        </a><label class="selected-value inputType" id="unit_title">None</label>
                                        <input type="hidden" name="material_unit" id="unit_title_hidden">
                                    </h5>
                                </div>

                                <div id="collapseOney" class="collapse" aria-labelledby="headingOne" data-parent="#accordiony">
                                    <div class="card-body cb0dy">
                                        <ul id="myUL" class="itemGroup ">
                                            @foreach ($materials_unit as $value)
                                                <li class="item unitLI " data-id="{{ $value->id }}" data-title="{{ $value->title }}">{{ $value->title }} <span style="float: right;padding-right: 20px;margin-left: 10px; color: red;" class="DeleteUnitBtn" data-id="{{ $value->id }}"> X </span></li>
                                            @endforeach
                                                @if($healper->check_permission(7,1))
                                            <li> <a  href="#" data-toggle="modal" data-target="#exampleModalLong3" >اضافة وحده +</a></li>
                                                 @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
`                               <div id="material_unit_demo"></div>
                        </div></td> 
                  
                </tr>

                </tbody>
            </table>

            <table class="table tableborder">

                <thead>
                <tr>

                    <th scope="col">الكمية</th>
                    <th scope="col">سعر الوحدة</th>
                    <!-- <th scope="col"  >وحدة القياس</th> -->
                    <th scope="col">تفاصيل الخامة</th>
                </tr>
                </thead>
                <tbody>
                <tr>

                    <td class="InputNum"><div class="form-group InputGroup">
                            <input type="number" name="qyt" class="form-control numric" min="0">
                        </div>
                    <div id="qyt_demo"></div>
                    </td>

                    <!-- <td class="InputNum" ><div id="accordiony">
                            <div class="card">
                                <div class="card-header cardPadding" id="headingOne">

                                    <h5 class="mb-0">
                                        <a class="btn btn-link" data-toggle="collapse" data-target="#collapseOney" aria-expanded="true" aria-controls="collapseOne">
                                            <i class="fas fa-angle-down arrow"></i>
                                        </a><label class="selected-value inputType" id="unit_title">None</label>
                                        <input type="hidden" name="material_unit" id="unit_title_hidden">
                                    </h5>
                                </div>

                                <div id="collapseOney" class="collapse" aria-labelledby="headingOne" data-parent="#accordiony">
                                    <div class="card-body cb0dy">
                                        <ul id="myUL" class="itemGroup ">
                                            @foreach ($materials_unit as $value)
                                                <li class="item unitLI " data-id="{{ $value->id }}" data-title="{{ $value->title }}">{{ $value->title }} <span style="float: right;padding-right: 20px;margin-left: 10px; color: red;" class="DeleteUnitBtn" data-id="{{ $value->id }}"> X </span></li>
                                            @endforeach
                                                @if($healper->check_permission(7,1))
                                            <li> <a  href="#" data-toggle="modal" data-target="#exampleModalLong3" >اضافة وحده +</a></li>
                                                 @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
`                               <div id="material_unit_demo"></div>
                        </div></td> -->

                        <td class="InputNum">
                        <div class="form-group InputGroup">
                            <input type="text" name="title" class="form-control numric name" >
                        </div>
                        <div id="title_demo"></div>
                    </td>
                    <td class="InputNum"><div class="form-group InputGroup" >
                            <textarea name="note" style=" max-height: 100px;max-width: 100%;min-height: 100px;min-width: 100%;"></textarea>
                        </div>
                    </td>

                </tr>

                </tbody>
            </table>

            <button type="button"  class="btn save-btn" id="SubmitButton">حفظ</button>


        </div>
    </section>
    </form>
    <!--نهايه اصناف المحصول-->

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

                    <form action="POST" id="TypeMaterial">
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


    <!-- model for add mesure type -->
    <div class="modal fade" id="exampleModalLong3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content modalbg-add">
                <div class="modal-header header-border">
                    <h5 class="modal-title" id="exampleModalLongTitle">اضافة وحدة قياس</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body ">

                    <form action="POST" id="UnitMaterial">
                        <div class="form-group center">
                            <input type="text" name="unit_title" class="textStyle">
                        </div>
                        <div id="unit_title_demo"></div>
                    </form>
                </div>
                <div class="modal-footer footer-border">
                    <button type="button" class="btn add-btn" data-dismiss="modal" id="AddNewUnit" aria-label="Close" value="اضافه" id="addgroup">اضافة</button>
                </div>
            </div>
        </div>
    </div>


@endsection