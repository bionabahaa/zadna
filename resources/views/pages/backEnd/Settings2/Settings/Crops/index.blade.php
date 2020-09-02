@extends('layouts.backEnd')
@section('page_css')
@endsection
@section('page_script')
<script src="{{ asset('public') }}/js/backEnd/crop.js"></script>
@endsection
@section('page_header')
@endsection
@section('page_content')
<section class="content cropType">
    <div class="top-bar">
        <h6>اعدادات عامه > اصناف المحصول</h6>
    </div>
    <div class="Tparent" >

        <div class="row ml-3 mr-3 mt-3 p-3 filter-search-box" style="height: 100px;">
     
            <div class="col-lg-2 mt-3 col-sm-4 col-md-4 col-12 search-div">
                {{-- <label class="search-icon">  <input type="text" class="search" id="myInput"></label> --}}
            </div>
        </div>
        <div class="row m-4">
            <div class="float-left ">
                <button class="add-crepto mr-2 mb-2  "  onclick="window.location.href='{{ url('setting/crops/create/') }}'">أضافة صنف</button>
                <button class="upload-excel mr-2 mb-2 ">أدخال عن طريق ملف</button>
                <button class="export-excel mr-2 mb-2">أخراج كملف اكسيل</button>
            </div>
        </div>
        <div class="row m-3 justify-content-center ">
            <div class="col-lg-10 ">
                <table class="table zadnatable diff-table" id="CropsDataTable">
                    <thead>
                    <tr>
                        <th>الكود</th>
                        <th>نوع المحصول</th>
                        <th>الاصناف</th>
                        <th class="actions">العمليات</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection



