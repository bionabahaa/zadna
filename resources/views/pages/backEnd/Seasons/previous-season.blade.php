@extends('layouts.backEnd')
@section('page_css')
@endsection
@section('page_script')
    <script src="{{ asset('public') }}/js/backEnd/season.js"></script>
@endsection
@section('page_header')
@endsection
@section('page_content')
    @inject('healper', 'App\Http\Controllers\BladeController')
    <section class="content cropType">
        <div class="top-bar">
            <h6> المواسم >  المواسم السابقة   </h6>
           <input type="hidden" id="view_name" value="{{$view_name}}">
        </div>
        <div class="Tparent" >

            <div class="row ml-3 mr-3 mt-3 p-3 filter-search-box">
                <div class="col-lg-10">

                    <div class="row filter-res">
                        <div class="col-lg-8 col-sm-12 col-md-12 col-12">
                            <div >
                                <label> تاريخ البداية :</label>
                            </div>
                            من <input id="from" type="date" class="type-date">
                            الى <input id="to" type="date" class="type-date">
                        </div>
                    </div>
                </div>
                <span class="btn btn-dark filter_but" style="height: 45px;border-radius: 21%;" onclick="filter('SeasonDataTable','setting/data_seasons/previous-season')" >بحث</span>
            </div>
            <div class="row m-4">
                <div class="float-left " style="text-align: left" >
                    {{--<button class="upload-excel mr-2 mb-2 ">أدخال عن طريق ملف</button>--}}
                </div>

            </div>

            <div class="row m-3 justify-content-center ">
                <div class="col-lg-10 ">

                    <table class="table zadnatable" id="SeasonDataTable">
                        <thead >
                        <tr >
                            <th>الكود</th>
                            <th>الاسم</th>
                            <th>تاريخ البدايه</th>
                            <th>تاريخ النهاية</th>
                            <th ><i class="fas fa-bars"></i></th>

                        </tr>
                        </thead>

                    </table></div>
            </div>


        </div>

    </section>





@endsection