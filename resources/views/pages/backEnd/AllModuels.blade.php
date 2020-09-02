{{--  QuantityWaterModel  --}}

<div id="QuantityWaterModel" class="modal fade" role="dialog" currTable>
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content modalbg-add">
            <div class="modal-header d-flex flex-row-reverse">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h5 class="modal-title text-center ">اضافة</h5>
            </div>
            <div class="modal-body">
                <form id="WellQuantityWaterAdd">
                    <input type="hidden" name="statistics_type" value="1">
                    <input type="hidden" name="well_id" value="{{ @$info->id }}">
                    <div class="row mb-4">
                        <div class="col-12">
                            <label class="col-4" for="type1">الكميه:</label>
                            <input type="text" name="qyt" id="type1" class="border-style col-6">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-12">
                            <label class="col-4" for="Diameter">التاريخ:</label>
                            <input type="date" name="date" id="Diameter" class="border-style col-6">
                        </div>
                    </div>
                    <br>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="saveDateQuantityWater" class="danger btn btn-primary btnSave ">حفظ</button>
                <a href="#" data-dismiss="modal" aria-hidden="true" class="btn btn-danger ">الغاء</a>
            </div>
        </div>
    </div>
</div>
{{-- QuantityWaterModel   --}}

{{--  AnalysisWaterModel  --}}

<div id="AnalysisWaterModel" class="modal fade" role="dialog" currTable>
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content modalbg-add">
            <div class="modal-header d-flex flex-row-reverse">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h5 class="modal-title text-center ">اضافة</h5>
            </div>
            <div class="modal-body">
                <form id="WellAnalysisWaterAdd">
                    <input type="hidden" name="statistics_type" value="2">
                    <input type="hidden" name="well_id" value="{{ @$info->id }}">
                    <div class="row mb-4">
                            <div class="col-12">
                                <label class="col-4" for="type1">الملف:</label>
                                <input type="file" name="file" id="type1" class="border-style col-6">
                                <div id="file_demo"></div>
                            </div>
                        </div>
                    <div class="row mb-4">
                        <div class="col-12">
                            <label class="col-4" for="Diameter">التاريخ:</label>
                            <input type="date" name="date" id="Diameter" class="border-style col-6">
                        </div>
                    </div>
                    <br>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="saveDateAnalysisWater" class="danger btn btn-primary btnSave ">حفظ</button>
                <a href="#" data-dismiss="modal" aria-hidden="true" class="btn btn-danger ">الغاء</a>
            </div>
        </div>
    </div>
</div>
{{-- AnalysisWaterModel   --}}

{{--  SoilanalysisModel  --}}

<div id="SoilanalysisModel" class="modal fade" role="dialog" currTable>
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content modalbg-add">
            <div class="modal-header d-flex flex-row-reverse">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h5 class="modal-title text-center ">اضافة</h5>
            </div>
            <div class="modal-body">
                <form id="SoilanalysisAdd">
                    <input type="hidden" name="box_id" value="{{ @$info->id }}">
                    <div class="row mb-4">
                        <div class="col-12">
                            <label class="col-4" for="type1">الملف:</label>
                            <input type="file" name="fileSoil" id="type1" class="border-style col-6">
                            <div id="fileSoil_demo"></div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-12">
                            <label class="col-4" for="Diameter">التاريخ:</label>
                            <input type="date" name="date" id="Diameter" class="border-style col-6">
                            <div id="date_demo"></div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-12">
                            <label class="col-4" for="note">الملاحظات:</label>
                            <textarea id="note" name="note" class="border-style col-6"></textarea>
                            <div id="note_demo"></div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-12">
                            <label class="col-4" for="Diameter">توصيات:</label>
                            <textarea name="recommendation" class="border-style col-6"></textarea>
                        </div>
                    </div>
                    <br>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="saveDateSoilanalysis" class="danger btn btn-primary btnSave ">حفظ</button>
                <a href="#" data-dismiss="modal" aria-hidden="true" class="btn btn-danger ">الغاء</a>
            </div>
        </div>
    </div>
</div>
{{-- SoilanalysisModel   --}}

{{--  JuraModel  --}}

<div id="JuraModel" class="modal fade less-culs" role="dialog" currtable page-link="jura-proc-tabs.html">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content modalbg-add">
            <div class="modal-header d-flex flex-row-reverse">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h5 class="modal-title ">اضافه</h5>
            </div>
            <div class="modal-body">
                <form action="POST" id="AddJuraForm">
                    <input type="hidden" name="id" id="jura_id">
                    <div class="row m-4">
                        <div class="col-12">
                            <label class="col-4" for="type">كود المربع:</label>
                            <div class=" col-3 float-right m-0 p-0 " style="    margin-left: 5rem!important;">
                                <select class="form-control col-val" name="box_id" id="type" value="1">
                                        <option value="">أختار كود المريع</option>
                                    @if(isset($Boxes))
                                    @foreach (@$Boxes as $value)
                                        <option value="{{ $value->id }}">{{ $value->code }}</option>
                                    @endforeach
                                    @endif
                                </select>
                                <div id="box_id_demo"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row m-4">
                        <div class="col-12">
                            <label class="col-5" for="ExCost">تاريخ البدايه :</label>
                            <input type="date" id="ExCost" name="start_date" class="border-style col-6 col-val">
                        </div>
                        <div id="start_date_demo"></div>
                    </div>
                    <div class="row m-4">
                        <div class="col-12">
                            <label class="col-5" for="date">تاريخ النهاية</label>
                            <input type="date" name="end_date" id="date" class="border-style col-6 col-val">
                        </div>
                        <div id="end_date_demo"></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="saveDateJura" class="danger btn btn-primary Saverecom">حفظ</button>
                <a href="#" data-dismiss="modal" aria-hidden="true" class="btn btn-danger ">الغاء</a>
            </div>
        </div>
    </div>
</div>

{{--  JuraModel  --}}
