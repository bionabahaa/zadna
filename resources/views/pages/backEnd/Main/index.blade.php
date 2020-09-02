@extends('layouts.backEnd')
@section('page_css')
<link rel="stylesheet" href="{{ asset('public/styles/backEnd') }}/dist/css/generalSet.css">
<link href="{{ asset('public/styles/backEnd') }}/dist/css/c3.css" rel="stylesheet">
<link href="{{ asset('public/styles/backEnd') }}/dist/css/dashboard.css" rel="stylesheet">
@endsection
@section('page_script')
<script>
    var task_done={{ $count_tasks_Done }};
    var task_not_done={{ $count_tasks_Notdone }};
    var task_wait={{ $count_tasks_Wateing }};
    var worker_permanent={{ $count_worker_Permanent }};
    var worker_temporary={{ $count_worker_Temporary }};
</script>
<script src="{{ asset('public/styles/backEnd') }}/dist/js/d3.min.js" charset="utf-8"></script>
<script src="{{ asset('public/styles/backEnd') }}/dist/js/c3.min.js"></script>
<script src="{{ asset('public/styles/backEnd') }}/dist/js/dashboard-chart.js"></script>
@endsection
@section('page_header')
@endsection
@section('page_content')
    <div class="dashboard-bar row ">
        <div class="col-lg-5 col-md-3"><span>الملاحظات</span></div>
        <div class="col-lg-2 col-md-3"><span>رد على ملاحظة</span>

        </div>

        <div class="w3-container col-md-2">

            <p class="w3-dropdown-hover note-cicle"><span class="note-text">7</span>
                <span class="w3-dropdown-content w3-green w3-padding" style="color: black!important;"><span class="row">

                        <span class="line "><a href="#" class="first col-md-8">كود الجورة</a><span class="secound col-md-4">12-45-77</span></span>
                    </span>
                    <span class="row">

                        <span class="line "><a href="#" class="first col-md-8">كود الجورة</a><span class="secound col-md-4">12-45-77</span></span>
                    </span>

                    <span class="row">

                        <span class="line "><a href="#" class="first col-md-8">كود الجورة</a><span class="secound col-md-4">12-45-77</span></span>
                    </span>




                </span>


            </p>
        </div>

        <div class="col-lg-2 col-md-3"><span>ملاحظة جديدة</span>

        </div>

        <div class="w3-container col-md-1">

            <p class="w3-dropdown-hover new-note"><span class="note-text">{{ $count_replay_recommendation }}</span>
                <span class="w3-dropdown-content w3-green w3-padding" style="color: black!important;"><span class="row">

                        <span class="line "><a href="#" class="first col-md-8">ملاحظة1</a><span class="secound col-md-4">12-45-77</span></span>
                    </span>
                    <span class="row">

                        <span class="line "><a href="#" class="first col-md-8">ملاحظه2</a><span class="secound col-md-4">12-45-77</span></span>
                    </span>

                    <span class="row">

                        <span class="line "><a href="#" class="first col-md-8">ملاحظة3</a><span class="secound col-md-4">12-45-77</span></span>
                    </span>
                </span>


            </p>
        </div>

    </div>



    <div class=" row mainn">
        <div class=" col-lg-8 col-md-12  pl-4">
            <div class="dashboard-main">
                <nav>
                    <div class="nav nav-tabb " id="nav-tab" role="tablist">
                        <a class="nav-item nav-link tab-nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home"
                           role="tab" aria-controls="nav-home" aria-selected="true"> المهام</a>
                        <a class="nav-item nav-link tab-nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile"
                           role="tab" aria-controls="nav-profile" aria-selected="false">طاقم العمل</a>

                    </div>
                </nav>
                <div class="tab-content dashboard-tab" id="nav-tabContent">
                    <div class="tab-pane fade show active " id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="chart-details">

                                    <div class="row">
                                        <span class="done col-md-6">تم</span>
                                        <span class=" col-md-6 mission">مهمة {{ $count_tasks_Done }}  </span></div>
                                    <div class="row
                                   "><span class="col-md-6 not-done">متاخر</span>
                                        <span class=" col-md-6 mission">مهمة {{ $count_tasks_Wateing }}</span></div>
                                    <div class="row"><span class="col-md-6 late">لم يتم</span>
                                        <span class=" col-md-6 mission">مهمة {{ $count_tasks_Notdone }}</span></div>
                                </div>
                            </div>
                            <div class="col-md-2"></div>
                            <div class="col-md-5">
                                <div id="mission_chart"></div>
                            </div>
                        </div>



                    </div>
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">

                        <div class="row">
                            <div class="col-md-5 ">
                                <div class="chart-details">

                                    <div class="row">
                                        <span class="moa2t col-md-6">دائم</span>
                                        <span class=" col-md-6 mission">عامل {{ $count_worker_Permanent }}</span></div>
                                    <div class="row
           "><span class="col-md-6 da2m">مؤقت</span>
                                        <span class=" col-md-6 mission">عامل {{ $count_worker_Temporary }}</span></div>

                                </div>
                            </div>
                            <div class="col-md-2"></div>
                            <div class="col-md-5">
                                <div id="crew_chart"></div>
                            </div>
                        </div>

                    </div>

                </div>
                <div>



                    <div class=" nav bbbtn " id="nav-tab" role="tablist">
                        <div class="  filters-btn col-md-3 active" id="nav-home-tab" data-toggle="tab" href="#" role="tab"
                             aria-controls="nav-home" aria-selected="true"> يومى</div>
                        <div class="filters-btn col-md-3" id="nav-profile-tab" data-toggle="tab" href="#" role="tab"
                             aria-controls="nav-profile" aria-selected="false">إسبوعى</div>

                        <div class=" filters-btn col-md-3" id="nav-home-tab" data-toggle="tab" href="#" role="tab"
                             aria-controls="nav-home" aria-selected="true"> شهرى</div>
                        <div class=" filters-btn col-md-3" id="nav-profile-tab" data-toggle="tab" href="#" role="tab"
                             aria-controls="nav-profile" aria-selected="false">الموسم</div>

                    </div>
                </div>

            </div>
        </div>

        <div class=" col-lg-4 col-md-12  pl-4">
            <div class="dashboard-side ">
                <div class="title">

                    <h7 class="text-center">المهام</h7>
                </div>
                <div class="content">
                    <ul class="task-list">
                        <li class="list">
                            <i class="fas fa-hourglass-start"></i>
                            <div class="task-details">
                                <a href="" class="title text-left">
                                    <h5 class="text-secondary">اسم المهمه</h5>
                                </a>
                                <small>تم التعيين بتاريخ <b>24/8/2017</b> </small>
                            </div>
                        </li>
                        <li class="list">
                            <i class="fas fa-hourglass-start"></i>
                            <div class="task-details">
                                <a href="" class="title text-left">
                                    <h5 class="text-secondary">اسم المهمه</h5>
                                </a>
                                <small>يتم التنفيذ بتاريخ <b>24/8/2017</b> </small>
                            </div>
                        </li>
                        <li class="list">
                            <i class="fas fa-hourglass-start"></i>
                            <div class="task-details">
                                <a href="" class="title text-left">
                                    <h5 class="text-secondary">اسم المهمه</h5>
                                </a>
                                <small>يتم التنفيذ بتاريخ <b>24/8/2017</b> </small>
                            </div>
                        </li>

                    </ul>

                </div>

            </div>
        </div>
    </div>

    <div class="row  mainn mt-5">
        <div class="col-lg-7 col-md-12">
            <div class="dashboard-side">
                <div class="title">

                    <h7 class="text-center">الصادرات</h7>
                </div>
                <div class="content mt-4">
                    <table class="table table-borderd">
                        <thead class="thead-light">
                        <th>الكود</th>
                        <th>النوع</th>
                        <th>الاسم</th>
                        <th>الكميه المطلوبه</th>
                        <th>الكميه المرسله</th>
                        <th>التاريخ</th>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td>{{$order->code}}</td>
                                    <td>{{$order->type}}</td>
                                    <td>{{$order->name}}</td>
                                    <td>{{$order->qyt}}</td>
                                    <td>{{$order->sent_qyt}}</td>
                                    <td>{{$order->datetime}}</td>
                                </tr>

                            @endforeach
                        </tbody>
                    </table>

                </div>

            </div>

        </div>
        <div class="col-lg-5 col-md-12">
            <div class="dashboard-side">
                <div class="title">

                    <h7 class="text-center">الامراض</h7>
                </div>
                <div class="content mt-4">
                    <table class="table table-borderd">
                        <thead class="thead-light">
                        <th>اسم المرض</th>
                        <th>النخل</th>
                        <th>اخر ملاحظه</th>
                        </thead>
                        <tbody>
                        @foreach($diseases as $disease)
                            <tr>
                                <td>
                                    <a href="{{url('Disease/diseases/'.$disease->code.'/edit')}}">
                                        {{$disease->disease_name}}
                                    </a>
                                </td>
                                <td>{{$disease->tree}}</td>
                                @if($disease->disease_follow['note'])
                                    <td> {{$disease->disease_follow['note']}} </td>
                                @else
                                    <td><b>لا يوجد</b></td>
                                @endif
                            </tr>

                        @endforeach

                        </tbody>
                    </table>

                </div>

            </div>

        </div>
    </div>

    <div class="row  mainn mt-5">

        <div class="col-lg-5 col-md-12">
            <div class="dashboard-side">
                <div class="title">

                    <h7 class="text-center">الاعطال الحالية</h7>
                </div>
                <div class="content mt-4">
                    <table class="table table-borderd">
                        <thead class="thead-light">
                        <th>الكود</th>
                        <th>النوع</th>
                        <th>الوصف</th>
                        <th>التاريخ</th>
                        </thead>
                        <tbody>
                            @foreach($faults as $fault)
                                <tr>
                                    <td>
                                        {{$fault->fault_code}}
                                    </td>
                                    <td>{{$fault->type}}</td>
                                    <td>{{$fault->desc}}</td>
                                    <td>{{$fault->date}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>

            </div>

        </div>
        <div class="col-lg-7 col-md-12">
            <div class="dashboard-side">
                <div class="title">

                    <h7 class="text-center">الواردات</h7>
                </div>
                <div class="content mt-4">
                    <table class="table table-borderd">
                        <thead class="thead-light">
                        <th>الكود</th>
                        <th>النوع</th>
                        <th>الاسم</th>
                        <th>الكميه</th>
                        </thead>
                        <tbody>
                            @foreach($exports as $export)
                                <tr>
                                    <td>
                                    <a href="{{route('requests.edit',$export->id)}}">{{$export->code}}</a>
                                    </td>
                                    <td>{{$export->type_title}}</td>
                                    <td>{{$export->title}}</td>
                                    <td>{{$export->QYT}}</td>

                                </tr>

                            @endforeach
                        </tbody>
                    </table>

                </div>

            </div>

        </div>
    </div>





@endsection