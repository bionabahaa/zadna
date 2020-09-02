@extends('layouts.backEnd')
@section('page_css')
@endsection
@section('page_script')
    <script src="{{ asset('public') }}/js/backEnd/season.js"></script>
@endsection
@section('page_header')
@endsection
@section('page_content')
    @inject('healper', 'App\Http\Controllers\BladeController')
    @if($healper->check_permission(37,1))
    <section class="generalSet">
        <div class="row  m-0 p-lr-7 " style="margin-top: 10% !important">

            @php $count=0; @endphp
            @if($healper->check_permission(40,1))
                @php $count=1; @endphp
            <div class="col-lg-2 offset-lg-3 col-sm-4 col-12">
                <a href="{{url('setting/season/previous-season')}}">
                    <div class="settings mx-auto text-center" >
                        <img src="{{asset('public/styles/backEnd/dist/imgs/icons/%D8%A7%D9%84%D9%85%D8%A7%D8%B3%D9%85%20%D8%A7%D9%84%D8%B3%D8%A7%D8%A8%D9%82%D8%A9.png')}}" class="mx-auto img-fluid">
                        <h6> الموسم السابق</h6>

                    </div>
                </a>
            </div>
            @endif

            @php $count=0; @endphp
            @if($healper->check_permission(39,1))
                @php $count=1; @endphp
            <div class="col-lg-2 col-sm-4 col-12">
                <a href="{{url('setting/season/current_season')}}">
                    <div class="settings mx-auto text-center" >
                        <img src="{{asset('public/styles/backEnd/dist/imgs/icons/%D8%A7%D9%84%D9%85%D9%88%D8%B3%D9%85%20%D8%A7%D9%84%D8%AD%D8%A7%D9%84%D9%8A.png')}}" class="mx-auto img-fluid">
                        <h6> الموسم الحالي</h6>

                    </div>
                </a>
            </div>
                @endif

            @php $count=0; @endphp
                @if($healper->check_permission(38,1))
                @php $count=1; @endphp
            <div class="col-lg-2 col-sm-4 col-12">
                <a href="{{url('setting/season/next_season')}}">
                    <div class="settings mx-auto text-center" >
                        <img src="{{asset('public/styles/backEnd/dist/imgs/icons/%D8%A7%D9%84%D9%85%D9%88%D8%B3%D9%85%20%D8%A7%D9%84%D9%82%D8%A7%D8%AF%D9%85.png')}}" class="mx-auto img-fluid">
                        <h6> الموسم القادم</h6>

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
        <h1 style="text-align: center;color: #28a745; margin-top: 150px">ليس لديك صلاحيه للتحكم فى صفحات المواسم</h1>
    @endif


@endsection