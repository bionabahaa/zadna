

var controlTitle = "diseases";
var AddformTitle = "form_add_diseaseDetail";
var EditformTitle = "form_edit_disease";
var tableTitle = "DATATABLE_current_disease";
var url = urls.base_url + "/Disease/" + controlTitle;

var url_data = urls.base_url + "/Disease/data_" + controlTitle;

var ruels = {};




var tableColumn= [
    { data: 'code', name: 'code' },
    { data: 'disease_name', name: 'disease_name' },
    { data: 'desc', name: 'desc' },
    { data: 'tree', name: 'tree' },
    { data: 'date', name: 'date' },
    { data: 'option', name: 'option' },
];


var disease_plan_column= [
    { data: 'code', name: 'code' },
    { data: 'pesticide', name: 'pesticide' },

    { data: 'used_way', name: 'used_way' },
    { data: 'repeat', name: 'repeat' },
    { data: 'date', name: 'date' },
    { data: 'option', name: 'option' },
];

var disease_follow_column= [
    { data: 'note', name: 'note' },
    { data: 'note_date', name: 'note_date' },
    { data: 'writen_by', name: 'writen_by' },

];

var disease_record_column= [
    { data: 'code', name: 'code' },
    { data: 'disease_name', name: 'disease_name' },
    { data: 'desc', name: 'desc' },
    { data: 'option', name: 'option' },

];

var disease_looses_column= [
    { data: 'disease_name', name: 'disease_name' },
    { data: 'box_id', name: 'box_id' },
    { data: 'tree', name: 'tree' },
    { data: 'date', name: 'date' },
    { data: 'option', name: 'option' },

];



function filter(table){
    var status=$('#type').val();
    var from=$('#from').val();
    var to=$('#to').val();
    var url=urls.base_url+'/Disease/data_diseases/curr_disease?status='+status+'&date_from='+from+'&date_to='+to;
    dataTable_search(table,url,tableColumn);
}

function filter_diseaseRecord(table){
    var status=$('#type').val();
    var from=$('#from').val();
    var to=$('#to').val();
    var url=urls.base_url+'/Disease/data_diseases/disease_record?status='+status+'&date_from='+from+'&date_to='+to;
    dataTable_search(table,url,disease_record_column);
}


function filter_looses(table){
    // var status=$('#type').val();filter-search-box
    var from=$('#from').val();
    var to=$('#to').val();

    var url=urls.base_url+'/Disease/data_diseases/disease_looses?date_from='+from+'&date_to='+to;

    dataTable_search(table,url,disease_looses_column);
}
function showInput(name){
    if(name=='looses_reason'){
        $('#looses_reason').show();
        $('#recovery_percent').hide();
    }
    else{
        $('#looses_reason').hide();
        $('#recovery_percent').show();
    }
}


$(document).ready(function() {
   dataTable(tableTitle, url_data, tableColumn);
});

// $(document).ready(function() {
//     dataTable("dataTableDiseasePlan", url_data+'/plan/'+$('#disease_id').val(), disease_plan_column);
//
// });

$('#dise-trace-tab').on('click',function () {
    var datatable_disease_follow=urls.base_url+'/Disease/diseaseFollow/';
    dataTable_ajax("DataTable_DiseaseFollow", datatable_disease_follow+$('#disease_code').val(), disease_follow_column);
});

$('#plane-tab').on('click',function () {
    var datatable_disease_plan=urls.base_url+'/Disease/diseasePlan/'+$('#id').val();
    dataTable_ajax("dataTableDiseasePlan", datatable_disease_plan, disease_plan_column);
});


$(document).ready(function () {

    var datatable_diseaseRecord=urls.base_url+'/Disease/diseaseRecord/';
    dataTable("DataTable_DiseaseRecord", datatable_diseaseRecord, disease_record_column);

});

$(document).ready(function () {
    var datatable_loosesDisease=urls.base_url+'/Disease/loosesDisease/';
    dataTable("DataTable_DiseaseLooses", datatable_loosesDisease, disease_looses_column);
});

$('#addDiseasePlan').on('click',function () {
   $('#form_add_plan_disease')[0].reset();
    $('#pesticide').prop('selectedIndex',-1);
});



function disease_plan_view($id){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type:'GET',
        url:urls.base_url+'/Disease/diseasePlan/'+$id+'/edit',
         dataType:'json',
        success:function(data){
            $('#plan_disease_id').val(data.disease_plan.id);
             $('#pesticide').html(data.pesticide_id);
            $('#used_way').html(data.disease_plan.used_way);
            $('#repeat').val(data.disease_plan.repeat);
            $('#date').val(data.disease_plan.date);
        } ,
        error:function(error){
             alert('error');
        }

    });
}

function showLoosesReason($id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type:'GET',
        url:urls.base_url+'/Disease/loosesDisease_reason/',
        data:{'id':$id},
        dataType:'json',
        success:function(data){
            if(data.looses_reason.losses_reason==null){
                $('#disease_looses_reason').text('No Reason Until Now ');
            }
            else {
                $('#disease_looses_reason').text(data.looses_reason.losses_reason);
            }
        } ,
        error:function(error){
            alert('error');
        }

    });
}



$(document).on("click", "#plane-back", function () {
    $(".tab-pane").removeClass("active show");
    $("#plane").addClass("active show");
});


$('#SubmitButton').click(function() {

    if (valdition(ruels)) {
        var id = document.getElementById('id').value;
        if (id == '') {
            var data = getData(AddformTitle);
            sendPost('POST', url, data);
        } else {
            var data = getData(EditformTitle);
            data.append('_method', 'PATCH');
            sendPost('POST', url + '/' + id, data);
        }

    }
});

//add new disease
$('#SubmitButton_add_disease').click(function() {


    if (valdition(ruels)) {
            var url=urls.base_url +'/Disease/addNewDisease';
             var data = getData('form_add_disease');
            sendPost('POST', url, data);

    }
});


$('#choose_box').on('change',function () {
    var id=$(this).val();
    var url=urls.base_url+'/operation/get_palm_tree/'+id;

    $.ajax({
       type:'get',
       url:url,
        dataType:'html',
        success:function (data) {
           palmst=data;

            $("#plam_tree_code").html(data);
        },
        error:function () {
            alert('error');
        }


    });

})

$('#SubmitButton_plan_disease').click(function() {
    if (valdition(ruels)) {
        var id = document.getElementById('plan_disease_id').value;
        if (id == '') {
            var url_disease_plan=urls.base_url+'/Disease/diseasePlan';
            var data=getData('form_add_plan_disease');
           data.append('disease_id',$('#id').val());
            sendPost('POST', url_disease_plan, data);
        } else {
            var data = getData('form_add_plan_disease');
            var url_disease_plan_update=urls.base_url+'/Disease/diseasePlan/'+id+'/store';
            sendPost('POST', url_disease_plan_update, data);
        }

    }
});


$('#submitButton_editPlan').on('click',function () {
    var disease_plan_id=$('#plan_id').val();
    var url_disease_plan_edit=urls.base_url+'/Disease/diseasePlan/'+disease_plan_id+'/edit';
    var data = getData('form_disease_plan_detail');
    sendPost('POST', url_disease_plan_edit, data);


});


$('#submutButton_addDisease_follow').click(function() {

    if (valdition(ruels)) {
            var url_disease_follow=urls.base_url+'/Disease/diseaseFollow';
            var data = getData('form_addDisease_follow');
             data.append('disease_code',$('#disease_code').val());
            sendPost('POST', url_disease_follow, data);
        }
});


function icon_clicked(id){
    var disease_id=id;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type:'get',
        url:urls.base_url+'/Disease/disease/curr_diseases/',
        data:{disease_id:disease_id},
        dataType:'json',
        success:function(data){
            if(data.disease_detail.looses_reason){
                $('.looses_reason').text(data.disease_detail.looses_reason);
            }
           if(data.disease_detail.recover_percent) {
               $('.recover_perecnt').text(data.disease_detail.recover_percent);
           }
        } ,
        error:function(error){
            // alert('eero');
        }

    });
}


