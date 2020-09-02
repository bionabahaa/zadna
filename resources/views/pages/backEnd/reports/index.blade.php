@extends('layouts.backEnd')
@section('page_css')
@endsection
@section('page_script')
<script src="{{ asset('public') }}/js/backEnd/allReports.js"></script>
@endsection
@section('page_header')
@endsection
@section('page_content')
@inject('healper', 'App\Http\Controllers\BladeController')
@inject('irrigation_model','App\Models\Helper')
    <section class="content cropType">
        <div class="top-bar">
            <h6>التقارير عن {{$model_attr['modelname_ar']}}</h6>
        </div>
        <div class="Tparent">
            <div class="row ml-3 mr-3 mt-3 p-3 filter-search-box">
                <div class="col-lg-10">
                    {{--<div class="row filter-res">--}}
                        {{--<div class="col-lg-2 col-sm-12 col-md-12 col-12">--}}
                            {{--<div >--}}
                                {{--<label>النوع :</label>--}}
                            {{--</div>--}}
                            {{--<select class="form-control filter-form type filter1" id="filter_data" >--}}
                            {{--</select>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                </div>
               <div class="col-lg-2 mt-3 col-sm-4 col-md-4 col-12 search-div"></div>
            </div>
            <div class="row m-4">
                <div class="float-left ">
                       {{--<a href="{{ URL::to('downloadExcel/xls/FixedAssets/?arr[]='.$arr.'') }}"><button class="btn btn-success export-excel mr-2 mb-2">أخراج كاملف اكسيل</button></a>--}}
                </div>

            </div>

            <?php
            $res=$irrigation_model->general_report($modelName,$model_attr['cost'],$model_attr['file_name'],$model_attr['modelname_ar']);
            ?>
            <p><?php echo $res['html']; ?></p>

                <input type="hidden" id="modelName" value="{{$modelName}}">
                <div class="row m-3 justify-content-center ">
                <div class="col-lg-10 ">
                    <table class="table zadnatable " id="reportDatatable">
                        <thead >
                        <tr >
                           @foreach($columns_name as $column_name)
                               <td>{{$column_name}}</td>
                           @endforeach
                        </tr>
                        </thead>
                    </table></div>
            </div>
        </div>

    </section>
    @include ('pages/backEnd/reports/reports_model')

@endsection