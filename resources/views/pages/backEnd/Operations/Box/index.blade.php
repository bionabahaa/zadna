@extends('layouts.backEnd')
@section('page_css')
<link rel="stylesheet" href="{{ asset('public/styles/backEnd') }}/dist/css/side-menu.css">
@endsection
@section('page_script')
<script>
var operation_page=1;
var report={{$report }};
</script>
<script src="{{ asset('public') }}/js/backEnd/box.js"></script>

@endsection
@section('page_header')
@endsection
@section('page_content')
    @inject('healper', 'App\Http\Controllers\BladeController')

<section class="content cropType">
    <div class="top-bar">

            <h6> عمليات زراعية > المربعات </h6>
    </div>
    <div class="row m-0">
        @include('pages.backEnd.Operations.rightLink')
        <div class="col-sm-10 col-10 p-0">
            <div class="Tparent">
                <div class="row ml-3 mr-3 mt-3 p-3 filter-search-box ">
                    <div class="col-lg-10">
                    </div>
                    <div class="col-lg-2 mt-3 col-sm-4 col-md-4 col-12 search-div"></div>
                    </div>
                </div>
                {{--
                <div class="row m-3 justify-content-center ">
                        <a href="{{ URL::to('downloadExcel/xls/Boxes/?arr[]='.$arr.'') }}"><button class="btn btn-success export-excel mr-2 mb-2">أخراج كاملف اكسيل</button></a>
                        {{--  <a target="_blank" href="{{ URL::to('pdf/Boxes/box') }}"><button class="btn btn-danger export-excel mr-2 mb-2">طباعه PDF</button></a> 

                        --}}
                    <div class="col-lg-12 ">
                        <table class="table zadnatable" >


                       

                        <!-- id="BoxDataTable" -->
                            <thead>
                                <tr>
                                    <th>الكود</th>
                                    <th>عدد الاعمدة</th>
                                    <th>عدد الصفوف</th>
                                    <th> التوقيع</th>
                                    @if($report!==true)
                                        <th class="actions">
                                            <i class="fas fa-bars"></i>
                                        </th>
                                    @endif
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection