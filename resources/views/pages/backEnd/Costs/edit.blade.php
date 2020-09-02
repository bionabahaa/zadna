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
            <h6>التكاليف > تكلفة المربعات > تكلفه المربع </h6>
        </div>

        <div class="row m-4">
            <ul class="nav nav-tabs tabrow active show" id="myTab" role="tablist" style="margin-top: 0%;border-right: 1.5px solid #dee2e6; margin-bottom: 0px">


                @foreach ($operation_type as $key=>$value)
                    <li class="nav-item @if($key==1) active  @endif">
                        <a class="nav-link  linkColor @if($key==1) active show @endif " id="tab{{ $key }}-tab" data-toggle="tab" href="#tab{{ $key }}" role="tab" aria-controls="Gdetails" aria-selected="true" style="border: none;padding: 4px;font-size: 22px;">{{ $value }}</a>
                    </li>
                @endforeach
                
            </ul>

            <div class="tab-content" id="myTabContent">
                @foreach ($operation_type as $key=>$value)
                    <div class="tab-pane fade @if($key==1) active show @endif  " id="tab{{ $key }}" role="tabpanel" aria-labelledby="tab{{ $key }}-tab" style="border-right: 1px solid #dee2e6;border-left: 1px solid #dee2e6;">
                        <div class="Tparent">
                            <div class="top-bar">
                                <h6> تكاليف {{ $value }} بالمربع </h6>
                            </div>
                            <div class="row m-4 ">
                                <div class="col-lg-12 col-sm-12 col-12 ">
                                    <div class="col-6" style="margin-right: 6% ; margin-top: 2% ;cursor: pointer" data-toggle="collapse" href="#cost1" aria-expanded="true">
                                        <a class="fas fa-caret-left " style="color:green"></a>
                                        <span class="faults-types1"> التكاليف: </span>
                                    </div>
                                    <hr class="light-hr1">
                                    <div class="collapse table-responsive collapse show" id="cost1" style="padding-bottom: 5rem;">
                                        <table class="table  table-bordered table2 mainTable">
                                            <thead style="text-align: center">
                                                <tr>
                                                    <th scope="col">الكود</th>
                                                    <th scope="col">البيان</th>
                                                    <th scope="col"> تكلفه فعلية</th>
                                                    <th scope="col"> تاريخ الدفع</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(array_key_exists($key,$OperationResources))
                                                    @foreach ($OperationResources[$key] as $value)
                                                    {{-- @php dd($OperationResources[$key]); @endphp --}}
                                                        @if($value['opertion_type_id']==1)
                                                            <tr>
                                                                <td>{{ $value['code'] }}</td>
                                                                <td>{{ $value['title'] }}</td>
                                                                <td>{{ $value['cost'] }}</td>
                                                                <td>{{ date('Y-m-d',strtotime($value['datetime'])) }}</td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </tbody>
    
                                        </table>
                                    </div>
                                </div>
                            </div>
    
                            <div class="row m-4">
                                <div class="col-lg-12 col-sm-12 col-12 collapsed  ">
                                    <div class="col-6" data-toggle="collapse" href="#emp1" style="margin-right: 6% ; margin-top: 2% ;cursor: pointer" aria-expanded="false">
                                        <a class="fas fa-caret-left " style="color:green"></a>
                                        <span class="faults-types1"> العمالة: </span>
    
                                    </div>
                                    <hr class="light-hr1">
                                    <div class="collapse table-responsive collapse show" id="emp1">
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
    
                                            <tbody>
                                                @if(array_key_exists($key,$OperationResources))
                                                    @foreach ($OperationResources[$key] as $value)
                                                        @if($value['opertion_type_id']==2)
                                                            <tr>
                                                                <td>{{ $value['code'] }}</td>
                                                                <td>{{ $value['title'] }}</td>
                                                                <td>{{ $value['workers_count'] }}</td>
                                                                <td>{{ $value['working_number_hours_per_day'] }}</td>
                                                                <td>{{ $value['working_number_days'] }}</td>
                                                                <td>{{ $value['cost'] }}</td>
                                                                <td>{{ date('Y-m-d',strtotime($value['datetime'])) }}</td>
                                                                
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </tbody>
    
                                        </table>
                                    </div>
                                </div>
                            </div>
    
                        </div>
                    </div>
                @endforeach
                
            </div>
    </section>

@endsection