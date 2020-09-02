@extends('layouts.backEnd')
@section('page_css')
@endsection
@section('page_script')
<script>
    var operation_page=0;
</script>
<script src="{{ asset('public') }}/js/backEnd/well.js"></script>
@endsection
@section('page_header')
@endsection
@section('page_content')
<section class="content cropType">
        <div class="top-bar">
            <h6>اعدادات عامه >الابار</h6>
        </div>
            <div class="row m-4">
                <div class="col-lg-2 mt-2">
                  <label>توقيع الابار</label>
                </div>
          
                <div col-lg-3>
        <!--        <input type="file" class="upload-excel mr-2 mb-2 " >-->
                      <div class="button-cont">
                          <form id="form_upload" method="post" enctype="multipart/form-data">
                              <input type="hidden" name="name" value="signature_wells" />
                              <input type="file" name="file" data-id="form_upload" id="file-1" class="inputfile inputfile-1 upload"  />
                              <label for="file-1"> <span>تحميل ملف&hellip;</span></label>
                              <a target="_blank" href="" id="uploaded_file">الملف</a>
                          </form>
                      </div>


                </div>
            </div>
            
             <div class="row m-4">
                <div class="col-lg-2 mt-2">
                    <label>خريطة الارض</label>
                </div>

                 <div col-lg-3>
                     <!--        <input type="file" class="upload-excel mr-2 mb-2 " >-->
                     <div class="button-cont">
                         <form id="form_upload2" method="post" enctype="multipart/form-data">
                             <input type="hidden" name="name" value="map_earth2" />
                             <input type="file" name="file" data-id="form_upload2" class="inputfile-1 upload" />
                             {{--<label for="file-1"> <span>تحميل ملف&hellip;</span></label>--}}
                             <a target="_blank" href="" id="uploaded_file">الملف</a>
                         </form>
                     </div>


                 </div>
            </div>
            
           <div class="Tparent" >
           
               <div class="row ml-3 mr-3 mt-3 p-3 filter-search-box">
                   <div class="col-lg-10">
        <!--
                    <div class="row">
                     <div class="col-lg-2">
                       <label>النوع :</label> 
                     </div>
                         <div class="col-lg-3">
                       <label>فترة الشراء :</label> 
                     </div> 
                    </div>
        -->
                        <div class="row filter-res">
                            
                     <div class="col-lg-2 col-sm-12 col-md-12 col-12">
                         <div >
                       <label>الحالة :</label> 
                     </div>
                    <select class="form-control filter-form filter1" >
                            
                              <option>الكل</option>
                            <option value="1"> تحت الدراسة</option>
                            <option value="2"> تم الحفر</option>
                          </select>
                     </div> 
                        
                              <div class="col-lg-8 col-sm-12 col-md-12 col-12">
                                       <div >
                       <label>فترة الحفر :</label> 
                     </div> 
                  من <input type="date" class="type-date">
                                   الى <input type="date" class="type-date">
                     </div> 
                    </div>
                   </div>
                  <div class="col-lg-2 mt-3 col-sm-4 col-md-4 col-12">
                
                     </div> 
              
               </div>
                
        <div class="row m-4">
            <div class="float-left ">
                <a href="{{route('wells.create')}}"><button class="add-crepto mr-2 mb-2  " >أضافة بئر</button> </a>
                <button class="upload-excel mr-2 mb-2 ">أدخال عن طريق ملف</button> 
                <button class="export-excel mr-2 mb-2">أخراج كاملف اكسيل</button>  
            </div>
                 
        </div> 
               
        <div class="row m-3 justify-content-center ">
            <div class="col-lg-10 ">
            
                <table class="table   zadnatable " id="WellDataTable">
                    <thead>
                        <tr>
                            <th>الكود</th>
                            <th>الاسم</th>
                            <th>الحالة</th>
                            <th>تاريخ الحفر</th>
                            <th>العمليات</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection



