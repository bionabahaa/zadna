@extends('layouts.backEnd')
@section('page_css')
@endsection
@section('page_script')
    <script src="{{ asset('public') }}/js/backEnd/crew.js"></script>
@endsection
@section('page_header')
@endsection
@section('page_content')
@inject('healper', 'App\Http\Controllers\BladeController')

@if($healper->check_permission(24,1))
    <section class="generalSet">
        <div class="row  m-0 p-lr-7 " style="margin-top: 10% !important">
                @php $count=0; @endphp
                @if($healper->check_permission(25,1))
                    @php $count=1; @endphp
                    <div class="col-lg-2 offset-lg-4 col-sm-4 col-12">
                        <a href="{{url('setting/crew/temporary_crew')}}">
                            <div class="settings mx-auto text-center" >
                                <img src="{{asset('public/styles/backEnd/dist/imgs/icons/mo2akt-takem%20l%203amal.png')}}" class="mx-auto img-fluid">
                                <h6> مؤقت</h6>
        
                            </div>
                        </a>
                    </div>
                @endif


                @if($healper->check_permission(26,1))
                    @php $count=1; @endphp
                    <div class="col-lg-2 col-sm-4 col-12">
                        <a href="{{url('setting/crew/permanent_crew')}}">
                            <div class="settings mx-auto text-center" >
                                <img src="{{asset('public/styles/backEnd/dist/imgs/icons/da2m-takem%20l%203amal.png')}}" class="mx-auto img-fluid">
                                <h6>دائم </h6>
        
                            </div>
                        </a>
                    </div>
                @endif
        </div>
        @if($count==0)
            <h1 style="text-align: center;color: #28a745;">ليس لديك صلاحيه للتحكم فى صفحات طاقم العمل</h1>
        @endif
    </section>
@else
    <h1 style="text-align: center;color: #28a745; margin-top: 150px">ليس لديك صلاحيه للدخول لصفحه طاقم العمل</h1>
    @endif
@endsection