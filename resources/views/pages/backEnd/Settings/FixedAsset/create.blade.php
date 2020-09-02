@extends('layouts.backEnd')
@section('page_css')
@endsection
@section('page_script')
<script>
    $(function () {
      $(".select2").select2();
    });
  </script>
<script src="{{ asset('public') }}/js/backEnd/fixedasset.js"></script>

@endsection
@section('page_header')
@endsection
@section('page_content')
@inject('healper', 'App\Http\Controllers\BladeController')

    <form id="AddFixedAssetForm" method="POST">
        <input type="hidden" name="id" id="id" value="">
        <!--بدايه اصناف المحصول-->
        <section class="content cropType">
            <div class="top-bar">
                <h6><a href="{{url('setting/')}}">اعدادات عامه</a> > <a href="{{route('fixedasset.index')}}">اصول ثابتة</a> <a href="{{route('fixedasset.create')}}"> > اضافة</a> </h6>
            </div>

            <div class="content p-5">
                <div class="table-responsive">
                    <table class="table tableborder">

                        <thead>
                        <tr>

                            <th scope="col">النوع</th>
                            <th scope="col">الاسم</th>
                            <th scope="col">القيمة الشرائية</th>
                            <th scope="col">القيمة السوقية</th>

                        </tr>
                        </thead>
                        <tbody>
                        <tr>


                            <td class="InputNum"><div id="accordion">
                                    <div class="card">
                                        <div class="card-header cardPadding" id="headingOne">

                                            <h5 class="mb-0">
                                                <a class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                    <i class="fas fa-angle-down arrow"></i>
                                                </a><label class="selected-value inputType" id="type_title">None</label>
                                                <input type="hidden" name="type" id="type_title_hidden">
                                            </h5>
                                        </div>


                                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                            <div class="card-body cb0dy">
                                                <ul id="myUL" class="itemGroup ">
                                                    @foreach ($FixedAssets_type as $fixedasset)
                                                        <li class="item typeLI " data-id="{{ $fixedasset->id }}" data-title="{{ $fixedasset->title }}">{{ $fixedasset->title }} <span style="float: right;padding-right: 20px;margin-left: 10px; color: red;" class="DeleteTypeBtn" data-id="{{ $fixedasset->id }} ">    X </span></li>
                                                    @endforeach
                                                        @if($healper->check_permission(5,1))
                                                    <li> <a  href="#" data-toggle="modal" data-target="#exampleModalLong2" >اضافة نوع +</a></li>
                                                       @endif
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="type_demo"></div>
                                </div></td>
                            <td class="InputNum"><div class="form-group InputGroup">
                                    <input type="text" class="form-control numric name" name="title">
                                </div>
                                <div id="title_demo"></div>
                            </td>
                            <td class="InputNum"><div class="form-group InputGroup">
                                    <input type="number" class="form-control numric buyVlaue" min="0" name="Purchasing_value">
                                </div>
                                <div id="Purchasing_value_demo"></div>
                            </td>
                            <td class="InputNum">
                                <div class="form-group InputGroup">
                                    <input type="number" class="form-control numric marektValue" min="0" name="Market_value">
                                </div>
                                <div id="Market_value_demo"></div>
                            </td>
                        </tr>

                        </tbody>
                    </table>
                    <table class="table tableborder">

                        <thead>
                        <tr>

                            <th scope="col">المواصفات</th>
                            <th scope="col">الملاحظات</th>

                        </tr>
                        </thead>
                        <tbody>
                        <tr>


                            <td class="InputNum"><div id="accordion">
                                    <textarea  class="form-control numric " name="desc" ></textarea>

                                </div></td>
                            <td class="InputNum"><div class="form-group InputGroup">
                                    <textarea  class="form-control numric " name="note" ></textarea>
                                </div></td>

                        </tr>

                        </tbody>
                    </table>


                    <button type="button"  class="btn save-btn" id="SubmitButton">حفظ</button>
                </div>
            </div>

        </section>
    </form>
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
                        <form action="POST" id="TypeAsset">
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