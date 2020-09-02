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
<section class="content cropType">
    <div class="top-bar">
        <h6>
            <img src="../dist/imgs/tkalef.png" width=25px height=25px /> تكاليف > نكلفة النخلة</h6>
    </div>
    <div class="row ml-3 mr-3 mt-3 p-3 ">
        <div class="col-lg-10">
            <div class="row">
                <div class="col-2">
                    كود النخلة :
                </div>
                <div class="col-2">
                    <div class="form-group InputGroup">
                        <select class="form-control select2 col-val" id="palm_tree_code">
                            <option>Test </option>
                            <option>Test </option>
                            <option>Test </option>
                            <option>Test </option>
                            <option>Test </option>
                        </select>
                    </div>
                </div>
                <div class="col-2">
                    <button type="button" class="btn save-btn ml-5 save-edit-tabs " id="search_cost_palm_tree">بحث</button>
                </div>
            </div><br><br>
            <div class="row" style="margin-top: 146px;">
                <div class="col-5">
                </div>
                <div class="col-4">
                    <div id="total_cost" style="text-align: center;font-size: -webkit-xxx-large;">
                         <span>Egy</span> 25
                    </div>
                </div>
                <div class="col-4">
                </div>
            </div>
        </div>
    </div>


</section>
@endsection