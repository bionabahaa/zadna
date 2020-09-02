var ruels = {};
var AddformTitle = "AddPlantingForm";
var EditformTitle = "EditPlantingForm";
var controlTitle = "planting";
var url = urls.base_url + "/operation/" + controlTitle;
var url_data = urls.base_url + "/operation/data_" + controlTitle;
var tableTitle = "PlantingDataTable";

$('.upload').on('change', function() {
   
    var url_upload = url + '/' + 'upload';
    var data = getData('form_upload');
    sendPost('POST', url_upload, data);
});


if (report == true) {
    var tableColumn = [
        { data: 'code', name: 'code' },
        { data: 'box_code', name: 'box_code' },
        { data: 'type_title', name: 'type_title' },
        { data: 'start_date', name: 'start_date' }
    ];
} else {
    var tableColumn = [
        { data: 'code', name: 'code' },
        { data: 'box_code', name: 'box_code' },
        { data: 'type_title', name: 'type_title' },
        { data: 'start_date', name: 'start_date' },
        { data: 'option', name: 'option' }
    ];
}

function filter($table){
    var status=$('#status').val();
    var from=$('#from').val();
    var to=$('#to').val();
    var url=urls.base_url+'/operation/data_planting?status='+status+'&date_from='+from+'&date_to='+to;
    dataTable_search($table,url,tableColumn);

}

$(document).ready(function() {

    dataTable(tableTitle, url_data, tableColumn);
});

$('#SubmitButton').click(function() {
    if (valdition(ruels)) {
        var id = document.getElementById('id').value;
        if (id == '') {
            var data = getData(AddformTitle);

            sendPost('POST', url+'/add_plan', data);
        } else {
            var data = getData(EditformTitle);
            data.append('_method', 'PATCH');
            sendPost('POST', url + '/' + id, data);
        }

    }
});

$("#filter_data").on("change", function() {
    var data = $(this).val();
    var new_url_data = url_data + "?type=" + data;
    dataTable_search(tableTitle, new_url_data, tableColumn);
});
////////////////////////////////////////////////////////
$('#saveDatePlan').click(function() {
    var url_type = "add_plan";
    var method = 'POST';
    var data = getData("OperationPlanAdd");
    data.append('_method', 'POST');
    sendPost(method, url + '/' + url_type, data);
});
$('.delete_plan').click(function() {
    var url_type = "delete_plan";
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
////////////////////////////////////////////////////////
var get_crop = function(id) {
    var url_ajax = url + '/get_crops?box_id=' + id;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var inputs = $(".mySelectCrop");
            
            for (var i = 0; i < inputs.length; i++) {
                $(inputs[i]).html(this.responseText);
            }
            get_user(id);
        }
    };
    xhttp.open("GET", url_ajax, true);
    xhttp.send();
}
var get_user = function(id) {
    var url_ajax = url + '/get_users?box_id=' + id;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var inputs = $(".mySelectUser");
            for (var i = 0; i < inputs.length; i++) {
                $(inputs[i]).html(this.responseText);
            }
        }
    };
    xhttp.open("GET", url_ajax, true);
    xhttp.send();
}