/////////////////////////////////////////////////////
/*
|
| Config File
|
*/
var controlTitle = "wells";
var AddformTitle = "AddWellForm";
var EditformTitle = "EditWellForm";
var tableTitle = "WellDataTable";


var image_form = document.getElementById("icone_image");
var fileupload = document.getElementById("map_area");
if (image_form) {
    image_form.onclick = function() {
        fileupload.click();
    };
}
if (report == true) {
    var tableColumn = [
        { data: 'code', name: 'code' },
        { data: 'title', name: 'title' },
        { data: 'well_status', name: 'well_status' },
        { data: 'date_of_excavation', name: 'date_of_excavation' },
        { data: 'signed', name: 'signed' },
    ];
} else {
    var tableColumn = [
        { data: 'code', name: 'code' },
        { data: 'title', name: 'title' },
        { data: 'well_status', name: 'well_status' },
        { data: 'date_of_excavation', name: 'date_of_excavation' },
        { data: 'signed', name: 'signed' },
        { data: 'option', name: 'option' }
    ];
}




var ruels = {
    'location':['required'],
    'degree':['required'],
    'minute':['required'],
    'second':['required'],
    'depth':['required'],
    'cost':['required'],
    'minimum_water_quantity':['required'],
};
var url = urls.base_url + "/setting/" + controlTitle;
var url_data = urls.base_url + "/setting/data_" + controlTitle + "?operation_page=" + operation_page;


/////////////////////////////////////////////////////
$('.upload').on('change', function() {
    var form = $(this).attr("data-id");
    var url_upload = url + '/' + 'upload';
    var data = getData(form);
    sendPost('POST', url_upload, data);
});

function filter($table){

    var status=$('#type').val();
    var from=$('#from').val();
    var to=$('#to').val();

    var url=urls.base_url+'/setting/data_wells?status='+status+'&date_from='+from+'&date_to='+to;
    dataTable_search($table,url,tableColumn);

}

var files = [];
// $('input[type=file]').on('change', prepareUpload);

function prepareUpload(event) {
    $('#' + this.name + "_image").attr('src', window.URL.createObjectURL(this.files[0]));
    files[this.name] = event.target.files;
}
$(document).ready(function() {


    dataTable(tableTitle, url_data, tableColumn);
});

$('#SubmitButton').click(function() {
    // if (valdition(ruels)) {
        var id = document.getElementById('id').value;
        if (id == '') {
            var data = getData(AddformTitle);
            sendPost('POST', url, data);
        } else {
            var data = getData(EditformTitle);
            data.append('_method', 'PATCH');
            sendPost('POST', url + '/' + id, data);
        }

    // }
});

$(document).on('click', '.Deletebtn', function() {
    var id = $(this).attr("data-id");
    var method = 'Delete';
    swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this data!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                var data = { _method: 'DELETE' };
                sendPost('DELETE', url + '/' + id, data);
            } else {
                swal("Your data is safe!");
            }
        });
});

/////////////////////////////////////////////////////////
$('#saveDateTest').click(function() {
    var url_type = "add_test";
    var method = 'POST';
    var data = getData("WellTestAdd");
    data.append('_method', 'POST');
    sendPost(method, url + '/' + url_type, data);
});
$('.delete_test').click(function() {
    var url_type = "delete_test";
    var id = $(this).attr("data-id");
    var method = 'Delete';
    swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this data!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                var data = { _method: 'DELETE' };
                sendPost('DELETE', url + '/' + url_type + '/' + id, data);
            } else {
                swal("Your data is safe!");
            }
        });
});
/////////////////////////////////////////////////////////
$('#saveDatePipes').click(function() {
    var url_type = "add_Tec";
    var method = 'POST';
    var data = getData("WellPipesAdd");
    data.append('_method', 'POST');
    sendPost(method, url + '/' + url_type, data);
});
$('#saveDateExternalPipes').click(function() {
    var url_type = "add_Tec";
    var method = 'POST';
    var data = getData("WellExternalPipesAdd");
    data.append('_method', 'POST');
    sendPost(method, url + '/' + url_type, data);
});
$('#saveDateGenerator').click(function() {
    var url_type = "add_Tec";
    var method = 'POST';
    var data = getData("WellGeneratorAdd");
    data.append('_method', 'POST');
    sendPost(method, url + '/' + url_type, data);
});
$('#saveDateTrumpet').click(function() {
    var url_type = "add_Tec";
    var method = 'POST';
    var data = getData("WellTrumpetAdd");
    data.append('_method', 'POST');
    sendPost(method, url + '/' + url_type, data);
});
$('.delete_Tec').click(function() {
    var url_type = "delete_Tec";
    var id = $(this).attr("data-id");
    var method = 'Delete';
    swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this data!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                var data = { _method: 'DELETE' };
                sendPost('DELETE', url + '/' + url_type + '/' + id, data);
            } else {
                swal("Your data is safe!");
            }
        });
});
/////////////////////////////////////////////////////////
$('#saveDateTecTest').click(function() {
    var url_type = "add_tec_test";
    var method = 'POST';
    var data = getData("WellTecTestAdd");
    data.append('_method', 'POST');
    sendPost(method, url + '/' + url_type, data);
});
$(document).on('click', '.delete_TecTest', function() {
    var url_type = "delete_tec_test";
    var id = $(this).attr("data-id");
    var method = 'Delete';
    swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this data!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                var data = { _method: 'DELETE' };
                sendPost('DELETE', url + '/' + url_type + '/' + id, data);
            } else {
                swal("Your data is safe!");
            }
        });
});
$('.show_tec_test').click(function() {
    var id = $(this).attr("data-id");
    var urlType = urls.base_url + "/setting/get_tec_test?id=" + id;
    var tableColumn2 = [
        { data: 'code', name: 'code' },
        { data: 'title', name: 'title' },
        { data: 'datetime', name: 'datetime' },
        { data: 'repetition', name: 'repetition' },
        { data: 'extension', name: 'extension' },
        { data: 'option', name: 'option' }
    ];
    dataTable_ajax('TestTableGenrator', urlType, tableColumn2);
    document.getElementById('well_tec_specifications_id').value = id;
    $("#MaintainModal").modal('show');
});
/////////////////////////////////////////////////////////
$('#saveDateQuantityWater').click(function() {
    var url_type = "add_statistics_water";
    var method = 'POST';
    var data = getData("WellQuantityWaterAdd");
    data.append('_method', 'POST');
    sendPost(method, url + '/' + url_type, data);
});
$('#saveDateAnalysisWater').click(function() {
    var url_type = "add_statistics_water";
    var method = 'POST';
    var data = getData("WellAnalysisWaterAdd");
    data.append('_method', 'POST');
    sendPost(method, url + '/' + url_type, data);
});
$('.delete_statistics_water').click(function() {
    var url_type = "delete_statistics_water";
    var id = $(this).attr("data-id");
    var method = 'Delete';
    swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this data!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                var data = { _method: 'DELETE' };
                sendPost('DELETE', url + '/' + url_type + '/' + id, data);
            } else {
                swal("Your data is safe!");
            }
        });
});