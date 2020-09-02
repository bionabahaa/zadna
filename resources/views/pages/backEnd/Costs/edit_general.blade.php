@extends('layouts.backEnd')
@section('page_css')
@endsection
@section('page_script')
<script src="{{ asset('public') }}/js/backEnd/mission.js"></script>
@endsection
@section('page_header')
@endsection
@section('page_content')

<section class="content cropType">
    <div class="top-bar">

        <h6> <img src="../dist/imgs/tkalef.png" width=25px height=25px /> التكاليف > التكاليف العامة >
            العمليه </h6>
    </div>
    <div class="Tparent">

        <div class="row m-4 ">
            <div class="col-lg-12 col-sm-12 col-12 ">
                <div class="col-6 collapsed" style="margin-right: 6% ; margin-top: 2% ;cursor: pointer" data-toggle="collapse"
                    href="#cost1" aria-expanded="false">
                    <a class="fas fa-caret-left " style="color:green"></a>
                    <span class="faults-types1"> التكاليف: </span>

                </div>
                <hr class="light-hr1">

                <div class="collapse table-responsive" id="cost1" style="padding-bottom: 5rem;">
                    <table class="table  table-bordered table2 mainTable">
                        <thead style="text-align: center">
                            <tr>
                                <th scope="col">الكود</th>
                                <th scope="col">البيان</th>
                                <th scope="col"> تكلفه فعلية</th>
                                <th scope="col"> تاريخ الدفع</th>

                            </tr>
                        </thead>

                        <tbody class="paginate paginate-0">
                            @foreach ($OperationResources as $value)
                                @if($value->opertion_type_id==1)
                                    <tr>
                                        <td>{{ $value->code }}</td>
                                        <td>{{ $value->title }}</td>
                                        <td>{{ $value->cost }}</td>
                                        <td>{{ date('Y-m-d',strtotime($value->date)) }}</td>
                                        
                                    </tr>
                                @endif
                            @endforeach

                        </tbody>

                    </table>
                </div>
            </div>
        </div>

        <div class="row m-4">
            <div class="col-lg-12 col-sm-12 col-12 collapsed  ">
                <div data-toggle="collapse" href="#emp1" style="margin-right: 6% ; margin-top: 2% ;cursor: pointer"
                    aria-expanded="false">
                    <a class="fas fa-caret-left " style="color:green"></a>
                    <span class="faults-types1"> العمالة: </span>

                </div>
                <hr class="light-hr1">
                <div class="collapse table-responsive" id="emp1">
                    <table class="table  table-bordered table2 mainTable" tableid="7">
                        <thead style="text-align: center">
                            <tr>
                                <th scope="col">الكود</th>
                                <th scope="col">النوع</th>
                                <th scope="col">العدد</th>
                                <th scope="col"> عدد ساعات العمل باليوم</th>
                                <th scope="col"> عدد ايام الاستخدام</th>
                                <th scope="col"> التكلفه</th>
                                <th scope="col">التاريخ</th>

                            </tr>
                        </thead>

                        <tbody class="paginate paginate-1">
                            @foreach ($OperationResources as $value)
                                @if($value->opertion_type_id==2)
                                    <tr>
                                        <td>{{ $value->code }}</td>
                                        <td>{{ $value->title }}</td>
                                        <td>{{ $value->workers_count }}</td>
                                        <td>{{ $value->working_number_hours_per_day }}</td>
                                        <td>{{ $value->working_number_days }}</td>
                                        <td>{{ $value->cost }}</td>
                                        <td>{{ date('Y-m-d',strtotime($value->date)) }}</td>
                                       
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection