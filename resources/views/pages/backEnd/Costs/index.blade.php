@extends('layouts.backEnd')
@section('page_css')
@endsection
@section('page_script')
<script src="{{ asset('public') }}/js/backEnd/costs.js"></script>
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
<section class="content cropType">
        <div class="top-bar">

            <h6>
                <img src="../dist/imgs/5AMAT.png" width=25px height=25px /> تكاليف > تكلفة المربعات </h6>
        </div>
        <div class="Tparent">
            <div class="row ml-3 mr-3 mt-3 p-3 filter-search-box">
                <div class="col-lg-10">
                </div>
                <div class="col-lg-2 mt-3 col-sm-4 col-md-4 col-12 search-div">
                </div>
            </div>
            <div class="row m-4">
                <div class="float-left ">
                    @if($healper->check_permission(35,2))
                    <button class="btn add-crepto" data-toggle="modal" data-target="#palm_tree_costs">تكاليف النخله الواحده</button>
                    @endif
                        <a href="{{ URL::to('downloadExcel/xls/OperationResources/boxCost') }}"><button class="btn btn-success export-excel mr-2 mb-2">أخراج كاملف اكسيل</button></a>
                    {{--<button class="upload-excel mr-2 mb-2 ">أدخال عن طريق ملف</button>--}}
                </div>
            </div>
            
            <div class="row m-3 justify-content-center ">
                <div class="col-lg-10 ">
                    <div class="responsive">
                        <table class="table zadnatable " id="CostsDataTable">
                            <thead>
                                <tr>
                                    <th>كود المربع </th>
                                    <th> عدد النخل </th>
                                    <th>التكلفة العامة</th>
                                    <th scope="col" class="actions">
                                        <i class="fas fa-bars"></i>
                                    </th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <div id="palm_tree_costs" class="modal fade less-culs" role="dialog" currtable="12" view-chat="view-req">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content modalbg-add">
                <div class="modal-header d-flex flex-row-reverse">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h5 class="modal-title text-center ">تكلفه النخله</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group InputGroup">
                                <select class="form-control select2 col-val" id="palm_tree_code" style="width:290px">
                                    @php
                                        $return='';
                                    @endphp
                                    @foreach ($PalmTree as $value)
                                        <option value="{{ $value->Box->code.'_'.$value->row.'_'.$value->column.'_'.$value->Crop->code }}">{{ $value->Box->code.'_'.$value->row.'_'.$value->column.'_'.$value->Crop->code }}</option>
                                    @endforeach
                                    {{ $return }}
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                                <button type="button" class="btn save-btn ml-5 save-edit-tabs " id="search_cost_palm_tree">بحث</button>
                        </div>
                    </div><br><br>
                    <div class="row">
                        <div class="col-4"></div>
                        <div class="col-4">
                                <span id="CostPlamTree">0</span> EGP
                        </div>
                        <div class="col-4"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <form id="EditMissionForm">
                        <input type="hidden" value="" name="id" id="cancelled_id">
                    </form>
                    <a href="#" data-dismiss="modal" aria-hidden="true" class="btn btn-danger ">الغاء</a>
                </div>
            </div>

        </div>
    </div>
@endsection