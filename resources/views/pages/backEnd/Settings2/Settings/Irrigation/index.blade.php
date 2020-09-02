@extends('layouts.backEnd')
@section('page_css')
@endsection
@section('page_script')
<script>
    var operation_page=0;
</script>
<script src="{{ asset('public') }}/js/backEnd/irrigation.js"></script>

@endsection
@section('page_header')
@endsection
@section('page_content')
<section class="content cropType">
    <div class="top-bar">
        <h6>اعدادات عامه >شبكة الرى</h6>
    </div>
    <div class="row m-4">
        <div class="col-lg-2 mt-2">
            <label>توقيع شبكة الرى</label>
        </div>

        <div col-lg-3>
            <!--        <input type="file" class="upload-excel mr-2 mb-2 " >-->
            <div class="button-cont">
                <form id="form_upload" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="name" value="irrigation_files" />
                    <input type="file" name="file" id="file-1" class="inputfile inputfile-1 upload"
                        data-multiple-caption="{count} files selected" />

                    <label for="file-1">
                        <span>تحميل ملف&hellip;</span>
                    </label>
                    <label id="uploaded_file-name"></label>
                    <a target="_blank" href="{{ $bath.'/'.@$irrigation_file->value }}" id="uploaded_file">الملف</a>
                </form>

            </div>

        </div>
    </div>
    <div class="Mparent">
        <div class="Tparent">

            <div class="row ml-3 mr-3 mt-3 p-3 filter-search-box">
                <div class="col-lg-10">
                    <div class="row filter-res">
                        <div class="col-lg-2 col-sm-12 col-md-12 col-12">
                            <div>
                                <label>نوع الخط :</label>
                            </div>
                            <select class="form-control filter-form filter1" id="filter_data">
                                <option selected disabled>اختر نوع الخط</option>
                                @foreach($line_types as $key=>$line_type)
                                <option value="{{$key}}">{{$line_type}}</option>
                                @endforeach
                            </select>
                        </div>



                    </div>



                </div>
                <div class="col-lg-2 mt-3 col-sm-4 col-md-4 col-12 search-div"></div>



            </div>

            <div class="row m-4">


                <div class="float-left ">


                    <button class="add-crepto mr-2 mb-2 addNewRow " onclick="window.location.href='{{route('irrigation.create')}}'">أضافة
                        خط</button>

                    <button class="upload-excel mr-2 mb-2 ">أدخال عن طريق ملف</button>


                    <button class="export-excel mr-2 mb-2">أخراج كاملف اكسيل</button>



                </div>

            </div>

            <div class="row m-3 justify-content-center ">
                <div class="col-lg-10 ">

                    <table class="table zadnatable" id="IrrigationlDataTable">

                        <thead>
                            <tr>
                                <th style="width:6%">الكود</th>
                                <th>الاسم</th>
                                <th>نوع الخط</th>
                                <th>كمية المياه</th>
                                <th>الطول</th>
                                <th>الاحداثيات</th>
                                <th>المربعات التى يمر بها</th>
                                <th>العمليات</th>
                            </tr>
                        </thead>


                    </table>
                </div>




            </div>


        </div>
    </div>

</section>
<script>

</script>
@endsection