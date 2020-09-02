
@inject('healper', 'App\Http\Controllers\BladeController')
<div class="col-sm-2 col-12  p-0" style="background-color: #f3f3f3; border-left: 1px solid rgb(0, 0, 0);margin-top: 3.3rem">
    <div id="sidebar">

        <div class="list-group panel">
            @php
                if($report === true){
                    $example="?reports=1";
                }else{
                    $example="";
                }
            @endphp
            
            <a href="#menu1" class="list-group-item collapsed" data-toggle="collapse" data-parent="#sidebar" aria-expanded="false">
                {{-- <span class="hidden-sm-down">تجهيزات ماقبل الزراعه</span> --}}
                تجهيزات ماقبل الزراعه <i class="fas fa-caret-right"></i>


            </a>
            <div class="collapse show" id="menu1">
                    {{--@php $count=0; @endphp--}}
                {{--@if($healper->check_permission(13,1))--}}
                    {{--@php $count=1; @endphp--}}
                    <a href="{{ url('operation/boxes') }}{{ $example }}" class="list-group-item" data-parent="#menu1">توقيع مربعات</a>
                {{--@endif--}}
                {{--//    @if($healper->check_permission(12,1))--}}
                        {{--@php $count=1; @endphp--}}
                        <a href="{{ url('operation/wells') }}{{ $example }}" class="list-group-item " data-parent="#menu1"> عمليات علي  الابار</a>
                    {{--@endif--}}

                
                {{--@if($healper->check_permission(14,1))--}}
                {{--@php $count=1; @endphp--}}
                <a href="{{ url('operation/irrigation') }}{{ $example }}" class="list-group-item" data-parent="#menu1"> شبكة الري</a>
                {{--@endif--}}
                
                {{--@if($healper->check_permission(15,1))--}}
                {{--@php $count=1; @endphp--}}
                    <a href="{{ url('operation/jura') }}{{ $example }}" class="list-group-item" data-parent="#menu1">تجهيز الجوره</a>
                {{--@endif--}}
                
            </div>
            {{--@if($healper->check_permission(16,1))--}}
            {{--@php $count=1; @endphp--}}
                <a href="{{ url('operation/planting') }}{{ $example }}" class="list-group-item">عمليات الغرس</a>
            {{--@endif--}}
           
            {{--@if($healper->check_permission(17,1))--}}
            {{--@php $count=1; @endphp--}}
                <a href="{{ url('operation/nutria') }}{{ $example }}" class="list-group-item" >الكيب</a>
            {{--@endif--}}

            <a href="#menu4" class="list-group-item collapsed" data-toggle="collapse" data-parent="#sidebar" aria-expanded="false">
                    عمليات الانتاج   <i class="fas fa-caret-right"></i>
            </a>
            <div class="collapse" id="menu4">
                    {{--@if($healper->check_permission(18,1))--}}
                    {{--@php $count=1; @endphp--}}
                        <a href="{{ url('operation/clean') }}{{ $example }}" class="list-group-item" data-parent="#menu4">ري </a>
                    {{--@endif--}}

                {{--@if($healper->check_permission(19,1))--}}
                {{--@php $count=1; @endphp--}}
                    <a href="{{ url('operation/fertilizing') }}{{ $example }}" class="list-group-item" data-parent="#menu4">تسميد</a>
                {{--@endif--}}
                
                {{--@if($healper->check_permission(20,1))--}}
                {{--@php $count=1; @endphp--}}
                    <a href="{{ url('operation/protection') }}{{ $example }}" class="list-group-item" data-parent="#menu4">الوقاية</a>
                {{--@endif--}}
               
                {{--@if($healper->check_permission(21,1))--}}
                {{--@php $count=1; @endphp--}}
                    <a href="{{ url('operation/separation') }}{{ $example }}" class="list-group-item" data-parent="#menu4">فصل فسائل</a>
                {{--@endif--}}
             
               
            </div>
            {{--@if($healper->check_permission(22,1))--}}
            {{--@php $count=1; @endphp--}}
                <a href="{{ url('operation/harvest') }}{{ $example }}" class="list-group-item">الحصاد</a>
            {{--@endif--}}
            
            {{-- @if($healper->check_permission(24,4))
            @php $count=1; @endphp
                <a href="{{ url('operation/sunstainable_operations') }}{{ $example }}" class="list-group-item">عمليات مستديمه</a>
            @endif --}}
            

        </div>
    </div>
</div>
