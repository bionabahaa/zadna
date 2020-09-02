@extends('layouts.backEnd')
@section('page_css')
@endsection
@section('page_script')
<script src="{{ asset('public') }}/js/backEnd/mission.js"></script>
@endsection
@section('page_header')
@endsection
@section('page_content')
@inject('healper', 'App\Http\Controllers\BladeController')
<!--بدايه اعدادت عامه -->
@if($healper->check_permission(34,1))
<section class="generalSet">
    <div class="row  m-0 p-lr-7 " style="margin-top: 10% !important">

            @php $count=0; @endphp
            @if($healper->check_permission(35,1))
            @php $count=1; @endphp
                <div class="col-lg-2 offset-lg-4 col-sm-4 col-12 offset-2">
                    <a href="{{ url('costs/boxes') }}">
                        <div class="settings mx-auto text-center">
                            <img src="{{ asset('public/styles/backEnd') }}/dist/imgs/takleftlmorb3at.png" class="mx-auto img-fluid">
                            <h6> تكلفة المربعات</h6>
                        </div>
                    </a>
                </div>
            @endif


        {{--  <div class="col-lg-2  col-sm-4 col-12">
            <a href="{{ url('costs/plamtree') }}">
                <div class="settings mx-auto text-center">
                    <img src="{{ asset('public/styles/backEnd') }}/dist/imgs/takleftlmorb3at.png" class="mx-auto img-fluid">
                    <h6> تكلفة النخلة</h6>
                </div>
            </a>
        </div>  --}}

        @php $count=0; @endphp
        @if($healper->check_permission(36,1))
        @php $count=1; @endphp
            <div class="col-lg-2 col-sm-4 col-12">
                <a href="{{ url('costs/boxes?generall=1') }}">
                    <div class="settings mx-auto text-center">
                        <img src="{{ asset('public/styles/backEnd') }}/dist/imgs/taklefa3ama.png" class="mx-auto img-fluid">
                        <h6>التكلفة العامة </h6>
                    </div>
                </a>
            </div>
        @endif

    </div>
    @if($count==0)
        <h1 style="text-align: center;color: #28a745;">ليس لديك صلاحيه للتحكم فى صفحات  التكاليف</h1>
    @endif
</section>
@else
    <h1 style="text-align: center;color: #28a745; margin-top: 150px">ليس لديك صلاحيه للتحكم فى صفحات  التكاليف</h1>
    @endif
<!--نهايه اعدادت عامه -->
@endsection