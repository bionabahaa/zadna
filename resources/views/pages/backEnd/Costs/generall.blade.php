@extends('layouts.backEnd')
@section('page_css')
@endsection
@section('page_script')
<script src="{{ asset('public') }}/js/backEnd/costs.js"></script>
@endsection
@section('page_header')
@endsection
@section('page_content')
    @inject('healper', 'App\Http\Controllers\BladeController')
<section class="content cropType">
    <div class="top-bar">

        <h6> <img src="../dist/imgs/tkalef.png" width=25px height=25px /> تكاليف > التكلفة العامة  </h6>
    </div>
    <div class="Tparent">
        @if($healper->check_permission(36,2))
            <div class="row ml-3 mr-3 mt-3 p-3 filter-search-box mb-5">
            <div class="col-lg-10">

                <div class="row filter-res">
                    <div class="col-lg-2 col-sm-12 col-md-12 col-12">
                        <div>
                            <label>العملية :</label>
                        </div>
                        <select id="type"  class="form-control filter-form filter1">
                            <option value="all" >الكل</option>
                                @foreach($operation_type as $key=>$value)
                                    <option value="{{$key}}">{{$value}}</option>
                                @endforeach

                        </select>

                    </div>
                    <div class="col-lg-2"></div>

                    <div class="col-lg-8 col-sm-12 col-md-12 col-12">
                        <div>
                            <label> تاريخ :</label>
                        </div>
                        من <input id="from" type="date" class="type-date">
                        الى <input id="to"  type="date" class="type-date">
                        <span class="btn btn-dark filter_but" style="height: 45px;border-radius: 21%;" onclick="filter()" >بحث</span>
                    </div>
                </div>

            </div>

            <div class="col-lg-2 mt-3 col-sm-4 col-md-4 col-12 search-div">

            </div>
        </div>
        @endif
            <a href="{{ URL::to('downloadExcel/xls/OperationResources/generalCost') }}"><button class="btn btn-success export-excel mr-2 mb-2">أخراج كاملف اكسيل</button></a>
        <div class="row m-3 justify-content-center ">
            <div class="col-lg-10 ">
                <table class="table zadnatable mainTable" tableId="11">
                    <thead>
                        <tr>
                            <th>العملية </th>
                            <th> التكلفة </th>
                            <th class="actions"><i class="fas fa-bars"></i></th>
                        </tr>
                    </thead>
                    <tbody id="body">
                    @foreach ($data as $value)
                        <tr>
                                <td>{{ $operation_type[$value->id] }}</td>
                                <td>
                                   @if($value->total)
                                       {{$value->total}}
                                       @else
                                       0
                                    @endif
                                </td>
                                <td class="query-td">
                                    <a href="{{ url('costs/boxes/') }}/{{ $value->id }}/edit?generall=1" class="text-dark">
                                        <i class="fas fa-eye view-row"></i>
                                    </a>
                                </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                
            </div>
        </div>
    </div>
</section>






@endsection