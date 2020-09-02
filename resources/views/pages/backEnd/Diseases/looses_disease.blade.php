@extends('layouts.backEnd')
@section('page_css')
@endsection
@section('page_script')
    <script src="{{ asset('public') }}/js/backEnd/disease.js"></script>
    <script>
        $(function () {
            $(".select2").select2();
        });
    </script>

@endsection
@section('page_header')
@endsection
@section('page_content')
    @inject('healper', 'App\Http\Controllers\BladeController')

    <section class="content cropType">
        <div class="top-bar">

            <h6> الامراض  >  سجل الفقد   </h6>
        </div>
        <div class="Tparent" >
            @if($healper->check_permission(44,2))
                <div class="row ml-3 mr-3 mt-3 p-3 filter-search-box">
                <div class="col-lg-10">

                    <div class="row filter-res">



                        <div class="col-lg-8 col-sm-12 col-md-12 col-12">
                            <div >
                                <label> تاريخ :</label>
                            </div>
                            من <input id="from" type="date" class="type-date">
                            الى <input id="to" type="date" class="type-date">
                            <span class="btn btn-dark filter_but" style="height: 45px;border-radius: 21%;" onclick="filter_looses('DataTable_DiseaseLooses')" >بحث</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 mt-3 col-sm-4 col-md-4 col-12 search-div">
                </div>
            </div>
            @endif
            <div class="row m-4">

                @if($healper->check_permission(44,3))
                    <div class="float-left " >
                        <a href="{{ URL::to('downloadExcel/xls/diseasePalmTree/loose_disease') }}"><button class="btn btn-success export-excel mr-2 mb-2">أخراج كاملف اكسيل</button></a>
                    </div>
                @endif
            </div>

            <div class="row m-3  justify-content-center ">
                <div class="col-lg-10 ">

                    <table id="DataTable_DiseaseLooses" class="table zadnatable">
                        <thead >
                        <tr >
                            <th>اسم المرض </th>
                            <th> كود المربع</th>
                            <th> كود النخلة</th>
                            <th>تاريخ الفقد</th>
                            <th>اسباب الفقد</th>

                        </tr>
                        </thead>
                        </table></div>
            </div>


        </div>

    </section>
    <!-- view  Modal -->
    <div id="lose-reas" class="modal fade " role="dialog"  >
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content modalbg-add">
                <div class="modal-header d-flex flex-row-reverse">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h5 class="modal-title text-center ">اسباب الفقد</h5>
                </div>
                <div class="modal-body">


                    <div class="row mb-4 justify-content-center">

                        <div style="color: red;font-weight: bolder;text-align: center" id="disease_looses_reason" class="col-8">

                        </div>


                    </div>


                </div>
                <div class="modal-footer">
                    <a href="#" data-dismiss="modal" aria-hidden="true" class="btn btn-danger ">غلق</a>
                </div>
            </div>

        </div>
    </div>

@endsection