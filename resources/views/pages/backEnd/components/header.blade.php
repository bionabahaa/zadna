@inject('healper', 'App\Http\Controllers\BladeController')
<div class="top row">
        <div class="col-lg-6 col-sm-6 col-6 ">
          <a class="navbar-brand" href="{{url('/main')}}"><img src="{{ asset('public/styles/backEnd') }}/dist/imgs/logo.png" style="width: 60px;background-color:white;"></a>
        </div>
        <div class="col-lg-6 col-sm-6 col-6 icons-div">
          <div class="icons">
              <div class="dropdown float-right mr-4">

                  <i class="fas fa-user dropdown-toggle icons-item text-white " role="button" id="dropdownMenuLink" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                      <span style="color: white;font-weight: bolder">{{Auth()->user()->username}}</span>
                  </i>
                  <div class="dropdown-menu mt-2 " aria-labelledby="dropdownMenuLink">
                    <a href="{{ url('main/tasks') }}"><i class="fas fa-tasks mr-2 ml-2"></i> المهام</a>
                    <div class="clearfix"></div>
                    <hr>
                    <a href="{{ url('main/profile') }}"><i class="fas fa-user-circle ml-2"></i> الصفحة الشخصية</a>
                    <div class="clearfix"></div>
                    <hr>
                    <a href="{{ url('logout') }}"> <i class="fas fa-sign-out-alt mr-2 ml-2"></i>تسجيل الخروج</a>
                  </div>
                </div>
            <div class="dropdown float-right mr-4" onclick="updateNotiSeen()">
              <span class="badge badge-success notifi-bagde" id="show_noti_count"> 0 </span>
              <i class="fas fa-bell icons-item  bell"  role="button" id="notifi" data-toggle="dropdown"aria-haspopup="true" aria-expanded="false">
              </i>
    
              <div class="dropdown-menu mt-2 " id="show_noti" aria-labelledby="notifi" style="width:250px">
              </div>
            </div>
          </div>
        </div>
      </div>
 {{--check if url has key show_report if it has and hide navbar--}}
{{--@if( strpos($_SERVER['REQUEST_URI'], 'show_report') != true )--}}
    <nav class="navbar navbar-expand-lg navbar-light bg-light bg-color ">

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">

               <li class="nav-item ">
                <a class="nav-link" href="{{ url('main/') }}">الرئيسية
                    <span class="sr-only">(current)</span>
                </a>
               </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('setting/') }}">اعدادات عامة</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ url('operation/boxes/') }}">عمليات زراعية</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{route('crews.index')}}">طاقم العمل</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ url('stores/') }}">المخزن</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('experiments.index')}}">تجارب</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{route('faults.index')}}">الاعطال</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ url('missions/tasks') }}">تعين مهمة</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('costs/') }}">تكاليف</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{route('seasons.index')}}">مواسم</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{url('Disease/diseases/')}}">الامراض</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{url('reports/')}}">التقارير</a>
            </li>
        </ul>
    </div>
</nav>
{{--@endif--}}
<!--بدايه اصناف المحصول-->