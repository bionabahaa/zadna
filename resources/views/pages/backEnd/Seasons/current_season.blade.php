
@extends('layouts.backEnd')
@section('page_css')
<link href="{{ asset('public/styles/backEnd') }}/dist/css/seasons.css" rel="stylesheet">
<link href="{{ asset('public/styles/backEnd') }}/dist/css/c3.css" rel="stylesheet">
@endsection
@section('page_script')

    <script src="{{ asset('public/styles/backEnd') }}/dist/js/d3.min.js" charset="utf-8"></script>
    <script src="{{ asset('public/styles/backEnd') }}/dist/js/c3.min.js"></script>
    <script src="{{ asset('public/styles/backEnd') }}/dist/js/chart-custom.js"></script>
    <script src="{{ asset('public') }}/js/backEnd/season.js"></script>
@endsection
@section('page_header')
@endsection
@section('page_content')
<section class="content cropType">
        <div class="top-bar">
            <h6> المواسم </h6>
        </div>
        <div class="Tparent">
            <form id="SearsonFilter">
            <div class="row ml-3 mr-3 mt-3 p-3 filter-search-box">
                <div class="col-lg-5">
                    <label> تاريخ البداية :</label>
                    <input name="start_date" id="start_date" type="date" class="type-date">
                </div>
                <div class="col-lg-5">
                    <label> تاريخ النهاية :</label>
                    <input name="end_date" id="end_date" type="date" class="type-date">
                </div>
                <div class="col-lg-2">
                    <input type="button" value="بحث" id="SubmitButtonFilter" class="type-date export-excel">
                </div>

            </div>
        </form>
            <section class="generalSet">
                <!-- start row -->
                <!-- العمليات -->
                <div class="row m-0  mt-4">

                    <div class="col-lg-2 col-sm-4 col-12">
                        <div class="mx-auto text-center main-card">
                            <div class="main-card-title">
                                <h6 class="lh-1">عمليات الغرس</h6>
                            </div>
                            <div class="row">

                                <div class="col-6 mt-4">
                                    <span class="main-card-num">{{ $reports['operation_planting'] }}</span>
                                </div>

                                <div class="col-6">
                                    <img src="{{ asset('public/styles/backEnd') }}/dist/imgs/radm l goura.png" class="mx-auto img-fluid">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-4 col-12">
                        <div class="mx-auto text-center main-card">
                            <div class="main-card-title">
                                <h6 class="lh-1">عمليات الري</h6>
                            </div>
                            <div class="row">

                                <div class="col-6 mt-4">
                                    <span class="main-card-num">{{ $reports['operation_cleaning'] }}</span>
                                </div>

                                <div class="col-6">
                                    <img src="{{ asset('public/styles/backEnd') }}/dist/imgs/8asel.png" class="mx-auto img-fluid">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-4 col-12">
                        <div class="mx-auto text-center main-card">
                            <div class="main-card-title">
                                <h6 class="lh-1">عمليات التسميد</h6>
                            </div>
                            <div class="row">

                                <div class="col-6 mt-4">
                                    <span class="main-card-num">{{ $reports['operation_fertilizings'] }}</span>
                                </div>

                                <div class="col-6">
                                    <img src="{{ asset('public/styles/backEnd') }}/dist/imgs/5edma.png" class="mx-auto img-fluid">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-4 col-12">
                        <div class="mx-auto text-center main-card">
                            <div class="main-card-title">
                                <h6 class="lh-1">عمليات الوقاية</h6>
                            </div>
                            <div class="row">

                                <div class="col-6 mt-4">
                                    <span class="main-card-num">{{ $reports['operation_protections'] }}</span>
                                </div>

                                <div class="col-6">
                                    <img src="{{ asset('public/styles/backEnd') }}/dist/imgs/tat7er.png" class="mx-auto img-fluid">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-4 col-12">
                        <div class="mx-auto text-center main-card">
                            <div class="main-card-title">
                                <h6 class="lh-1">عمليات مستديمة</h6>
                            </div>
                            <div class="row">

                                <div class="col-6 mt-4">
                                    <span class="main-card-num">{{ $reports['operation_sunstainable_operations'] }}</span>
                                </div>

                                <div class="col-6">
                                    <img src="{{ asset('public/styles/backEnd') }}/dist/imgs/3mlyat zra3ya.png" class="mx-auto img-fluid">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-4 col-12">
                        <div class="mx-auto text-center main-card">
                            <div class="main-card-title">
                                <h6 class="lh-1">عمليات الحصاد</h6>
                            </div>
                            <div class="row">

                                <div class="col-6 mt-4">
                                    <span class="main-card-num">{{ $reports['operation_harvests'] }}</span>
                                </div>

                                <div class="col-6">
                                    <img src="{{ asset('public/styles/backEnd') }}/dist/imgs/icons/takem l 3amal.png" class="mx-auto img-fluid">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <!-- start row -->
                <div class="row m-0  mt-4">
                    <!-- start card -->
                    <!-- المهام -->
                    <div class="col-lg-6 col-sm-8 col-12  ">
                        <div class="mx-auto text-center main-card wide-card heigher-card">
                            <div class="main-card-title">
                                <h6 class="lh-1">
                                    المهام
                                </h6>
                                <hr>
                            </div>

                            <div class="row">
                                <div class="col-6 mt-5">
                                    <div class="avg-block text-left">
                                        <h6 class="avg-title">عدد المهام <span class="main-card-num ml-4">{{ $reports['task_all'] }}</span></h6>
                                        <div class="row ">
                                            <div class="col-6">
                                                <span class="avg-label"> <i class="far fa-circle mr-2 text-success"></i>
                                                    تم</span>
                                            </div>
                                            <div class="col-6">
                                                <h6 class="avg-label"> {{ $reports['task_done'] }} </h6>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <span class="avg-label"> <i class="far fa-circle mr-2 text-danger"></i>
                                                    لم يتم</span>
                                            </div>
                                            <div class="col-6">
                                                <h6 class="avg-label"> {{ $reports['task_not_done'] }} </h6>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <span class="avg-label"> <i class="far fa-circle mr-2 text-warning"></i>
                                                    متأخر</span>
                                            </div>
                                            <div class="col-6">
                                                <h6 class="avg-label"> {{ $reports['task_waiting'] }} </h6>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-6">
                                    <div id="season_mission"></div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- start card -->
                    <!-- المخزن -->
                    <div class="col-lg-6 col-sm-8 col-12 ">
                        <div class="mx-auto text-center main-card wide-card heigher-card">
                            <div class="main-card-title">
                                <h6>المخزن</h6>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-5 mt-5">
                                    <div class="avg-block text-left">
                                        <h5 class="avg-title">الرصيد</h5>
                                        <div class="row ">
                                            <div class="col-6">
                                                <span class="avg-label"> <i class="fas fa-circle fa-xs mr-2 "></i>
                                                    حفار</span>
                                            </div>
                                            <div class="col-6">
                                                <h6 class="avg-label"> {{ $reports['store_one'] }} </h6>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <span class="avg-label"> <i class="fas fa-circle fa-xs mr-2"></i>
                                                    سماد</span>
                                            </div>
                                            <div class="col-6">
                                                <h6 class="avg-label"> {{ $reports['store_two'] }} </h6>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <span class="avg-label"> <i class="fas fa-circle fa-xs mr-2"></i>
                                                    محصول</span>
                                            </div>
                                            <div class="col-6">
                                                <h6 class="avg-label"> {{ $reports['store_three'] }} </h6>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-7">
                                    <div class="avg-block text-left">
                                        <div id="store-chart"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <!-- start row -->
                <div class="row m-0  mt-4">
                    <!-- start card -->
                    <!-- طاقم العمل -->
                    <div class="col-lg-2 col-sm-4 col-12  pr-5  ">
                        <div class="mx-auto text-center main-card thin-card">
                            <div class="main-card-title">
                                <h6 class="lh-1">طاقم العمل</h6>
                                <hr>
                            </div>
                            <div class="avg-block">
                                <h3 class="avg-total">{{ $reports['users_permanent'] }}</h3>
                                <h6 class="avg-label"> دائم</h6>
                            </div>
                            <div class="avg-block">
                                <h3 class="avg-total">{{ $reports['users_temporar'] }}</h3>
                                <h6 class="avg-label"> مؤقت</h6>
                            </div>
                        </div>
                    </div>

                    <!-- start card -->
                    @php
                    if($reports['disease_all']==0){
                        $done=0;
                        $notDone=0;
                    }else{
                        $done=$reports['disease_done']/$reports['disease_all'];
                        $notDone=$reports['disease_not_done']/$reports['disease_all'];
                    }
                    @endphp
                    <!-- الامراض -->
                    <div class="col-lg-4 col-sm-8 col-12 ">
                        <div class="mx-auto text-center main-card wide-card" style="height: 286px;">
                            <div class="main-card-title">
                                <h6 class="lh-1">
                                    الامراض
                                </h6>
                                <hr>
                            </div>
                            <div class="dis-prec">
                                <div class="row mb-5">
                                    <div class="col-8">
                                        <div class="progress">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: {{ $done }}%"
                                                aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">{{ $done }}%</div>
                                        </div>
                                    </div>
                                    <div class="col-4 avg-block">
                                        <h6 class="avg-label">
                                            تم الشفاء</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="dis-prec">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="progress">
                                          
                                            <div class="progress-bar bg-success " role="progressbar" style="width: {{ $notDone }}%"
                                                aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">{{ $notDone }}%</div>
                                        </div>
                                    </div>
                                    <div class="col-4 avg-block">
                                        <h6 class="avg-label"> تم الفقد</h6>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-12 text-left">
                                    <h6> عدد الامراض :
                                        <span class="main-card-num ml-2 text-right">{{ $reports['disease_all'] }}</span>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- start card -->
                    <!-- التكاليف -->
                    <div class="col-lg-2 col-sm-4 col-12  pr-5  ">
                        <div class="mx-auto text-center main-card thin-card">
                            <div class="main-card-title">
                                <h6 class="lh-1"> التكاليف</h6>
                                <hr>
                            </div>
                            <div class="avg-block">
                                <h3 class="avg-total">{{ $reports['costs_box'] }} <span style="font-size:15px;">EGP</span></h3>
                                <h6 class="avg-label"> التكاليف الزراعيه</h6>
                            </div>
                            <div class="avg-block">
                                <h3 class="avg-total">{{ $reports['costs_all'] }} <span style="font-size:15px;">EGP</span></h3>
                                <h6 class="avg-label"> التكاليف العامه</h6>
                            </div>
                        </div>
                    </div>

                    <!-- start card -->
                    <!-- التجارب -->
                    <div class="col-lg-4 col-sm-8 col-12 " style="display:none;">
                        <div class="mx-auto text-center main-card wide-card " style="height:auto;">
                            <div class="main-card-title">
                                <h6 class="lh-1">
                                    التجارب
                                </h6>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th scope="col">التجربة</th>
                                                <th scope="col">نسبة النجاح</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td scope="row">1</td>
                                                <td>
                                                    <span class="main-card-num  ">20 %</span>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td scope="row">2</td>
                                                <td>
                                                    <span class="main-card-num  ">80 %</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td scope="row">2</td>
                                                <td>
                                                    <span class="main-card-num  ">40 %</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td scope="row">2</td>
                                                <td>
                                                    <span class="main-card-num  ">80 %</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td scope="row">2</td>
                                                <td>
                                                    <span class="main-card-num  ">30 %</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td scope="row">2</td>
                                                <td>
                                                    <span class="main-card-num  ">80 %</span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-12 text-left">
                                    <h6> عدد التجارب :
                                        <span class="main-card-num ml-2 text-right">500</span>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
        </div>
        <!-- end row -->
    </section>


@endsection