@extends('layouts.backEnd')
@section('page_css')
@endsection
@section('page_script')
<script src="{{ asset('public') }}/js/backEnd/fixedasset.js"></script>
@endsection
@section('page_header')
@endsection
@section('page_content')
    <section class="content cropType">
        <div class="top-bar">
            <h6>اعدادات عامه > اصول ثابتة</h6>
        </div>
        <div class="Tparent">

            <div class="row ml-3 mr-3 mt-3 p-3 filter-search-box">
                <div class="col-lg-10">
                    <div class="row filter-res">

                        <div class="col-lg-2 col-sm-12 col-md-12 col-12">
                            <div >
                                <label>النوع :</label>
                            </div>
                            <select class="form-control filter-form type filter1" id="filter_data" >
                                @foreach($fixedasset_types as $fixedasset_type)
                                    <option value="{{$fixedasset_type->id }}">{{$fixedasset_type->title}}</option>
                                @endforeach

                            </select>
                        </div>


                    </div>

                </div>

            </div>

            <div class="row m-4">


                <div class="float-left ">


                    <button class="add-crepto mr-2 mb-2  " onclick="window.location.href='{{route('fixedasset.create')}}'">أضافة أصل</button>



                    <button class="upload-excel mr-2 mb-2 ">أدخال عن طريق ملف</button>





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