

var ruels = {};
var controlTitle = "Experiments";
var AddformTitle = "form_add_experiment";
var EditformTitle = "EditCrewForm";
var tableTitle = "DataTablE_experiment";
var url = urls.base_url + "/Experiments/" ;
var url_data = urls.base_url + "/Experiments/data_experiments";

var tableColumn_experimentStep = [
    { data: 'code', name: 'code' },
    { data: 'description', name: 'description' },
    { data: 'recommendation', name: 'recommendation' },
    { data: 'date', name: 'date' },
    { data: 'option', name: 'option' },
];


var tableColumn= [
    { data: 'code', name: 'code' },
    { data: 'name', name: 'name' },
    { data: 'experiment_type', name: 'experiment_type' },
    { data: 'box_id', name: 'box_id' },
    { data: 'palms', name: 'palms' },
    { data: 'option', name: 'option' },
];


var filter=function ($table,$url) {
    var status=$('#status').val();
    var url=urls.base_url+'/'+$url+'?status='+status;
    dataTable_search($table,url,tableColumn);

}


$(document).ready(function() {
    dataTable(tableTitle, url_data+'/experiment', tableColumn);
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

$('#SubmitButton').click(function() {
    if (valdition(ruels)) {
        var id = document.getElementById('id').value;
        if (id == '') {
            var data = getData(AddformTitle);
            sendPost('POST', url+'experiments', data);
        } else {
            var data = getData(AddformTitle);
            data.append('_method', 'PATCH');
            sendPost('POST', url+'experiments/'+ id, data);
        }

    }
});

$('#add-disease_step').on('click',function () {
    $('#form_add_experimentStep')[0].reset();
    $('#title').text('اضافه خطوه');
    $('#SubmitButton_experiment_step').text('حفظ');
})

$('#SubmitButton_experiment_step').click(function() {

    if (valdition(ruels)) {
        var id = document.getElementById('experiment_id').value;
        var experiment_id=$('#id').val();

            var data = getData('form_add_experimentStep');
            data.append('experiment_id',experiment_id);
            sendPost('POST', url+'execution_step', data);


    }
});

$('#steps-tab').on('click',function () {
    var id = document.getElementById('id').value;
    dataTable_search('DataTable_experiment_step', url_data+'/experiment_step/'+id, tableColumn_experimentStep);

});

function experimentStep($id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type:'get',
        url:urls.base_url+'/Experiments/getExperimentData/'+$id,
        dataType:'json',
        success:function(data){
         $('#title').text('تعديل خطوه');
         $('#description').val(data.experiment_step.description);
         $('#recommendation').val(data.experiment_step.recommendation);
         $('#date').val(data.experiment_step.date);
         $('#step_id').val(data.experiment_step.id);
         $('#experiment_id').val(data.experiment_step.experiment_id);
         $('#SubmitButton_experiment_step').text('تعديل');


        } ,
        error:function(error){
             alert('eero');
        }

    });

}