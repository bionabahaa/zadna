@extends('layouts.backEnd')
@section('page_css')
@endsection
@section('page_script')
<script src="{{ asset('public') }}/js/backEnd/fixedasset.js"></script>
@endsection
@section('page_header')
@endsection
@section('page_content')
@inject('healper', 'App\Http\Controllers\BladeController')
    <section class="content cropType">
        <div class="top-bar">
           
            <h6><a href="{{url('setting/')}}">اعدادات عامه</a> > <a href="{{route('fixedasset.index')}}">اصول ثابتة</a> </h6>
        </div>
        <div class="Tparent">

            @if($healper->check_permission(5,2))
            <div class="row ml-3 mr-3 mt-3 p-3 filter-search-box">
                <div class="col-lg-10">
                    <div class="row filter-res">

                        <div class="col-lg-2 col-sm-12 col-md-12 col-12">
                            <div >
                                <label>النوع :</label>
                            </div>
                            <select class="form-control filter-form type filter1" id="filter_data" >
                                <option value="all" >الكل</option>
                                @foreach($fixedasset_types as $fixedasset_type)
                                    <option value="{{$fixedasset_type->id }}">{{$fixedasset_type->title}}</option>
                                @endforeach

                            </select>
                        </div>

                        
            </div>
            <span class="btn btn-dark filter_but"  onclick="filter('FixedAssetDataTable')" >بحث</span>
            </div>

                    </div>

                </div>
@endif





  
 








































            <div class="row m-4">


                <div class="float-left ">

                    @if($healper->check_permission(5,3))
                        <button class="add-crepto mr-2 mb-2  " onclick="window.location.href='{{route('fixedasset.create')}}'">أضافة أصل</button>
                    @endif
                    {{--<button class="upload-excel mr-2 mb-2 ">أدخال عن طريق ملف</button>--}}
                        @if($healper->check_permission(5,4))
                                <a href="{{ URL::to('downloadExcel/xls/FixedAssets/?arr[]='.$arr.'') }}"><button class="btn btn-success export-excel mr-2 mb-2">أخراج كاملف اكسيل</button></a>
                        @endif

                </div>

            </div>
                <div class="row m-3 justify-content-center ">
                <div class="col-lg-10 ">

                    <table class="table zadnatable " id="FixedAssetDataTable">
                        <thead >
                        <tr >
                            <th>الكود</th>
                            <th>النوع</th>
                            <th>الاسم</th>
                            <th>القيمه الشرائيه</th>
                            <th>القيمه السوقيه</th>
                            <th class="actions">العمليات</th>

                        </tr>
                        </thead>
                       

                    </table></div>




            </div>
        </div>

    </section>

@endsection