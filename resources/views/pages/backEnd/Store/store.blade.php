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

@if($healper->check_permission(27,1))
<section class="generalSet">
    <div class="row  m-0 p-lr-7 " style="margin-top: 10% !important">
            @php $count=0; @endphp
            @if($healper->check_permission(28,1))
            @php $count=1; @endphp
                <div class="col-lg-2 offset-lg-2 col-sm-4 col-12">
                    <a href="{{ url('stores/stores') }}">
                        <div class="settings mx-auto text-center">
                            <img src="{{ asset('public/styles/backEnd') }}/dist/imgs/%D9%85%D8%AE%D8%B2%D9%86-%D8%A3%D8%B6%D8%A7%D9%81%D8%A9%20%D9%83%D9%85%D9%8A%D8%A9.png" class="mx-auto img-fluid">
                            <h6 style="font-size:14px!important">رصيد المخزن</h6>
                        </div>
                    </a>
                </div>
            @endif
        
        @if($healper->check_permission(29,1))
        @php $count=1; @endphp
            <div class="col-lg-2 col-sm-4 col-12">
                <a href="{{ url('stores/orders') }}">
                    <div class="settings mx-auto text-center">
                        <img src="{{ asset('public/styles/backEnd') }}/dist/imgs/%D8%A7%D9%84%D9%85%D8%AE%D8%B2%D9%86-%D8%A7%D9%84%D9%85%D8%B7%D9%84%D9%88%D8%A8%20%D9%85%D9%86%20%D8%A7%D9%84%D9%85%D8%AE%D8%B2%D9%86.png" class="mx-auto img-fluid">
                        <h6 style="font-size:14px!important"> المطلوب من المخزن </h6>

                    </div>
                </a>
            </div>
        @endif
        @if($healper->check_permission(30,1))
            @php $count=1; @endphp
         <div class="col-lg-2 col-sm-4 col-12">
            <a href="{{ url('stores/requests') }}">
                <div class="settings mx-auto text-center">
                    <img src="{{ asset('public/styles/backEnd') }}/dist/imgs/%D8%A7%D9%84%D9%85%D8%AE%D8%B2%D9%86-%D8%A7%D9%84%D9%85%D8%B7%D9%84%D9%88%D8%A8%20%D9%85%D9%86%20%D8%A7%D9%84%D9%85%D8%AE%D8%B2%D9%86.png" class="mx-auto img-fluid">
                    <h6 style="font-size:14px!important"> اوامر التوريد </h6>

                </div>
            </a>
        </div>
            @endif


        @if($healper->check_permission(30,1))
            @php $count=1; @endphp
            <div class="col-lg-2 col-sm-4 col-12">
                <a href="{{ url('stores/incomplete') }}">
                    <div class="settings mx-auto text-center">
                        <img src="{{ asset('public/styles/backEnd') }}/dist/imgs/%D8%A7%D9%84%D9%85%D8%AE%D8%B2%D9%86-%D8%A7%D9%84%D9%85%D8%B7%D9%84%D9%88%D8%A8%20%D9%85%D9%86%20%D8%A7%D9%84%D9%85%D8%AE%D8%B2%D9%86.png" class="mx-auto img-fluid">
                        <h6 style="font-size:14px!important">  الناقص من المخزن </h6>

                    </div>
                </a>
            </div>
        @endif


    </div>
    @if($count==0)
        <h1 style="    text-align: center;color: #28a745;">ليس لديك صلاحيه للتحكم فى صفحات  المخازن</h1>
    @endif
</section>

@else
    <h1 style="text-align: center;color: #28a745; margin-top: 150px">ليس لديك صلاحيه للدخول لصفحه المخزن</h1>
    @endif
@endsection