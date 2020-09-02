@extends('layouts.backEnd')
@section('page_css')
@endsection
@section('page_script')
@endsection
@section('page_header')
@endsection
@section('page_content')
@inject('healper', 'App\Http\Controllers\BladeController')

@if($healper->check_permission(2,1))
<section class="generalSet">
    <div class="row mt-5 m-0 p-lr-7">
        @php $count=0; @endphp

        @if($healper->check_permission(3,1))
            @php $count=1+$count; @endphp
            <div class="col-lg-2 col-sm-4 col-12  ">
                <a href="{{route('farm.index')}}">
                    <div class="settings mx-auto text-center">
                        <img src="{{ url('public/styles/backEnd') }}//dist/imgs/icons/anwa3 l ma7sol.png" class="mx-auto img-fluid">
                        <h6> المزرعه</h6>

                    </div>
                </a>
            </div>
        @endif

           

        @if($healper->check_permission(8,1))
        @php $count=1+$count; @endphp
            <div class=" col-lg-2 col-sm-4 col-12">
                <a href="{{route('wells.index')}}">
                    <div class="settings mx-auto text-center">
                        <img src="{{ url('public/styles/backEnd') }}//dist/imgs/icons/2bar.png" class="mx-auto img-fluid">
                        <h6>ابار</h6>

                    </div>
                </a>
            </div>
        @endif











        @if($healper->check_permission(3,1))
            @php $count=1+$count; @endphp
            <div class="col-lg-2 col-sm-4 col-12  ">
                <a href="{{route('crops.index')}}">
                    <div class="settings mx-auto text-center">
                        <img src="{{ url('public/styles/backEnd') }}//dist/imgs/icons/anwa3 l ma7sol.png" class="mx-auto img-fluid">
                        <h6> المحصول</h6>

                    </div>
                </a>
            </div>
        @endif


        @if($healper->check_permission(4,1))
        @php $count=1+$count; @endphp
            <div class="col-lg-2 col-sm-4 col-12">
                <a href="{{url('setting/boxes')}}">
                    <div class="settings mx-auto text-center">
                        <img src="{{ url('public/styles/backEnd') }}/dist/imgs/icons/morb3at.png" class="mx-auto img-fluid">
                        <h6>مربعات</h6>

                    </div>
                </a>
            </div>
        @endif

        @if($healper->check_permission(5,1))
        @php $count=1+$count; @endphp
            <div class=" col-lg-2 col-sm-4 col-12">
                <a href="{{route('fixedasset.index')}}">
                    <div class="settings mx-auto text-center">
                        <img src="{{ url('public/styles/backEnd') }}//dist/imgs/icons/2sol thabta.png" class="mx-auto img-fluid">
                        <h6>اصول ثابته</h6>

                    </div>
                </a>
            </div>
        @endif

        @if($healper->check_permission(6,1))
            @php $count=1+$count; @endphp
            <div class="col-lg-2 col-sm-4 col-12">
                <a href="{{route('material.index')}}">
                    <div class="settings mx-auto text-center ">
                        <img src="{{ url('public/styles/backEnd') }}//dist/imgs/icons/noun_298179_cc-1.png" class="mx-auto img-fluid">
                        <h6>خامات</h6>
                    </div>
                </a>
            </div>
        @endif

        @if($healper->check_permission(7,1))
        @php $count=1+$count; @endphp
            <div class="col-lg-2 col-sm-4 col-12">
                <a href="{{route('equipments.index')}}">
                    <div class="settings mx-auto text-center">
                        <img src="{{ url('public/styles/backEnd') }}//dist/imgs/icons/mo3dat.png" class="mx-auto img-fluid">
                        <h6>معدات</h6>
                    </div>
                </a>
            </div>
        @endif



       




        @if($healper->check_permission(9,1))
        @php $count=1+$count; @endphp
            <div class=" col-lg-2 col-sm-4 col-12">
                <a href="{{route('irrigation.index')}}">
                    <div class="settings mx-auto text-center">
                        <img src="{{ url('public/styles/backEnd') }}//dist/imgs/icons/shabket l ray.png" class="mx-auto img-fluid">
                        <h6>شبكة الري</h6>

                    </div>
                </a>
            </div>
        @endif


        @if($healper->check_permission(10,1))
        @php $count=1+$count; @endphp
            <div class=" col-lg-2 col-sm-4 col-12 ">
                <a href="{{route('role.index')}}">
                    <div class="settings mx-auto text-center">
                        <img src="{{ url('public/styles/backEnd') }}//dist/imgs/icons/noun_157533_cc.png" class="mx-auto img-fluid">
                        <h6>المستخدمين</h6>
                    </div>
                </a>
            </div>
        @endif

    </div>
    @if($count==0)
        <h1 style="    text-align: center;color: #28a745;">ليس لديك صلاحيه للتحكم فى صفحات الاعدادات العامه</h1>
    @endif
</section>
    @else
    <h1 style="    text-align: center;color: #28a745;">ليس لديك صلاحيه للتحكم فى صفحات الاعدادات العامه</h1>
   @endif

@endsection