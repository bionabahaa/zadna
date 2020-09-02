@extends('layouts.backEnd')
@section('page_css')
@endsection
@section('page_script')
<script src="{{ asset('public') }}/js/backEnd/comment.js"></script>
@endsection
@section('page_header')
@endsection
@section('page_content')
<section class="generalSet">
    <div class="row mt-5 m-0 p-lr-7">
        <div class=" col-lg-2 col-sm-4 col-12 offset-lg-1">
            <a href="{{route('farms.index')}}">
                <div class="settings mx-auto text-center">
                    <img src="{{ url('public/styles/backEnd') }}//dist/imgs/icons/mzare3.png" class="mx-auto img-fluid">
                    <h6>مزارع</h6>

                </div>
            </a>
        </div>
        <div class="col-lg-2 col-sm-4 col-12">
            <a href="{{route('boxes.index')}}">
                <div class="settings mx-auto text-center">
                    <img src="{{ url('public/styles/backEnd') }}/dist/imgs/icons/morb3at.png" class="mx-auto img-fluid">
                    <h6>مربعات</h6>

                </div>
            </a>
        </div>
        <div class=" col-lg-2 col-sm-4 col-12">
            <a href="{{route('fixedasset.index')}}">
                <div class="settings mx-auto text-center">
                    <img src="{{ url('public/styles/backEnd') }}//dist/imgs/icons/2sol thabta.png" class="mx-auto img-fluid">
                    <h6>اصول ثابته</h6>

                </div>
            </a>
        </div>
        <div class="col-lg-2 col-sm-4 col-12">
            <a href="{{route('equipments.index')}}">
                <div class="settings mx-auto text-center">
                    <img src="{{ url('public/styles/backEnd') }}//dist/imgs/icons/mo3dat.png" class="mx-auto img-fluid">
                    <h6>معدات</h6>
                </div>
            </a>
        </div>


        <div class="col-lg-2 col-sm-4 col-12">
            <a href="{{route('material.index')}}">
                <div class="settings mx-auto text-center ">
                    <img src="{{ url('public/styles/backEnd') }}//dist/imgs/icons/noun_298179_cc-1.png" class="mx-auto img-fluid">
                    <h6>خامات</h6>
                </div>
            </a>
        </div>
        <div class=" col-lg-2 col-sm-4 col-12 offset-lg-2">
            <a href="{{route('wells.index')}}">
                <div class="settings mx-auto text-center">
                    <img src="{{ url('public/styles/backEnd') }}//dist/imgs/icons/2bar.png" class="mx-auto img-fluid">
                    <h6>ابار</h6>

                </div>
            </a>
        </div>

        <div class=" col-lg-2 col-sm-4 col-12">
            <a href="{{route('irrigation.index')}}">
                <div class="settings mx-auto text-center">
                    <img src="{{ url('public/styles/backEnd') }}//dist/imgs/icons/shabket l ray.png" class="mx-auto img-fluid">
                    <h6>شبكة الري</h6>

                </div>
            </a>
        </div>
        <div class="col-lg-2 col-sm-4 col-12">
            <a href="{{route('crops.index')}}">
                <div class="settings mx-auto text-center">
                    <img src="{{ url('public/styles/backEnd') }}//dist/imgs/icons/anwa3 l ma7sol.png" class="mx-auto img-fluid">
                    <h6> المحصول</h6>

                </div>
            </a>
        </div>

        <div class=" col-lg-2 col-sm-4 col-12 ">
            <a href="{{route('role.index')}}">
                <div class="settings mx-auto text-center">
                    <img src="{{ url('public/styles/backEnd') }}//dist/imgs/icons/noun_157533_cc.png" class="mx-auto img-fluid">
                    <h6>المستخدمين</h6>
                </div>
            </a>
        </div>









    </div>
</section>

@endsection