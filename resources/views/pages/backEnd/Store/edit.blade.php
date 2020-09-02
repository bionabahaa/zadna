@extends('layouts.backEnd')
@section('page_css')
@endsection
@section('page_script')
<script src="{{ asset('public') }}/js/backEnd/store.js"></script>
@endsection
@section('page_header')
@endsection
@section('page_content')
<section class="content cropType">
    <div class="top-bar">
        <h6> <img src="../dist/imgs/المواسم.png" width=25px height=25px/> المخزن >رصيد المخزن </h6>
    </div>
    <div class="Mparent">
        <!--table1    -->
        <div class="Tparent">
            <div class="row m-4 ">
                <div class="col-lg-12 col-sm-12 col-12 ">
                    <div class="col-6" style="margin-right: 3% ; margin-top: 2% ;cursor: pointer" data-toggle="collapse" href="#collapseExample4" aria-expanded="true">
                        <a class="fas fa-caret-left " style="color:green"></a>
                        <span class="faults-types1"> العمليات: </span>

                    </div>
                    <hr style="border:solid 1.5px #fc782e; width: 95%;">
                    <div class="table-responsive collapse show" id="collapseExample4" style="padding-bottom: 5rem;">
                        <table class="table  table-bordered table2 mainTable" tableid="6">
                            <thead style="text-align: center">
                                <tr>
                                    <th scope="col">العمليه</th>
                                    <th scope="col"> كود العمليه</th>
                                    <th scope="col"> كود المربع</th>
                                    <th scope="col"> الكمية المستخدمة</th>
                                    <th scope="col"> التاريخ</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $value)
                                    <tr>
                                        <td>{{ $value->moduel_title }}</td>
                                        <td>{{ $value->code }}</td>
                                        <td>{{ $value->box_code }}</td>
                                        <td>{{ $value->qyt }}</td>
                                        <td>{{ $value->created_at }}</td>
                                    </tr>
                                @endforeach

                            </tbody>

                        </table>
                    </div>
                </div>
            </div>

            <!--  add modal for  table1  -->

        </div>
    </div>
</section>
@endsection