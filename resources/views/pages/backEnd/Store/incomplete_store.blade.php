@extends('layouts.backEnd')
@section('page_css') 
@endsection 
@section('page_script')
<script src="{{ asset('public') }}/js/backEnd/store.js"></script>
@endsection
@section('page_header')
@endsection
@section('page_content')
    @inject('healper', 'App\Http\Controllers\BladeController')
    @if($healper->check_permission(29,1))
<section class="content cropType">
    <div class="top-bar">
        <h6>
            <img src="../dist/imgs/المواسم.png" width=25px height=25px/> المخزن > الناقص من المخزن </h6>
    </div>
    <div class="Tparent">
        @if($healper->check_permission(30,2))
        <div class="row ml-3 mr-3 mt-3 p-3 filter-search-box">
            <div class="col-lg-10">

                <div class="row filter-res">

                    <div class="col-lg-2 col-sm-12 col-md-12 col-12">
                        <div>
                            <label>النوع :</label>
                        </div>
                        <select id="status" class="form-control filter-form filter2 box1" filtercol="1">
                            <option selected value="all">الكل</option>
                            <option value="1"> خامه اساسيه </option>
                            <option value="2"> خامه مساعده</option>
                        </select>
                    </div>

                    <div class="col-lg-8 col-sm-12 col-md-12 col-12">
                        <div>
                            <label> تاريخ :</label>
                        </div>
                        من
                        <input id="from" type="date" class="type-date">
                    </div>
                </div>
            </div>
            <span class="btn btn-dark filter_but" style="height: 45px;border-radius: 21%;" onclick="filter('RequestDataTable','stores/data_requests')" >بحث</span>
            <div class="col-lg-2 mt-3 col-sm-4 col-md-4 col-12 search-div">
            </div>
        </div>
        @endif
        <br>
            {{--<a href="{{ URL::to('downloadExcel/xls/StoreRequest/?arr[]='.$arr.'') }}"><button class="btn btn-success export-excel mr-2 mb-2">أخراج كاملف اكسيل</button></a>--}}
        <div class="row m-3 justify-content-center ">
            <div class="col-lg-10 ">
                <table class="table zadnatable">
                    <thead>
                        <tr>
                            <th>الخامه</th>
                            <th>النوع </th>
                            <th>الكمية المطلوبة</th>
                            <th>الكمية المرسله</th>
                            <th>الكمية المراد اضافتها الى المخزن</th>
                            {{--<th class="actions">--}}
                                {{--<i class="fas fa-bars"></i>--}}
                            {{--</th>--}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($materials as $material)
                            <tr>
                                <td>{{$material->name}}</td>
                                <td>{{$material->type}}</td>
                                <td>{{$material->qyt}}</td>
                                <td>{{$material->sent_qyt}}</td>
                                <td style="color:red;">{{$material->sent_qyt - $material->qyt}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@else
        <h1 style="    text-align: center;color: #28a745;">ليس لديك صلاحيه للدخول لهذه الصفحه</h1>
    @endif

@endsection