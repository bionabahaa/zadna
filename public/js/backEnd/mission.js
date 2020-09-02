var ruels = {};
var AddformTitle = "AddMissionForm";
var EditformTitle = "EditMissionForm";
var tableTitle = "MissonDataTable";
var controlTitle = "tasks";
var url = urls.base_url + "/missions/" + controlTitle;
var url_data = urls.base_url + "/missions/data_" + controlTitle;



$('.upload').on('change', function() {
    var url_upload = url + '/' + 'upload';
    var data = getData('form_upload');
    sendPost('POST', url_upload, data);
});



var tableColumn = [
    { data: 'box_code', name: 'box_code' },
    { data: 'task_type', name: 'task_type' },
    { data: 'task', name: 'task' },
    { data: 'to', name: 'to' },
    { data: 'implementation_at', name: 'implementation_at' },
    { data: 'status', name: 'status' },
    { data: 'option', name: 'option' }
];


var filter=function ($table,$url) {
    var status=$('#status').val();
    var from=$('#from').val();
    var to=$('#to').val();

    var url=urls.base_url+'/'+$url+'?status='+status+'&date_from='+from+'&date_to='+to;
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
            sendPost('POST', url, data);
        } else {

            var data = getData(EditformTitle);
            data.append('_method', 'PATCH');
            sendPost('POST', url + '/' + id, data);
        }

    }
});

$('#SubmitButtonEdit').click(function() {
    var id = document.getElementById('cancelled_id').value;
    var data = getData(EditformTitle);
    data.append('_method', 'PATCH');
    sendPost('POST', url + '/' + id, data);
});


$("#filter_data").on("change", function() {
    var data = $(this).val();
    var new_url_data = url_data + "?type=" + data;
    dataTable_search(tableTitle, new_url_data, tableColumn);


});


//////////////////////////////////////////
var get_user = function(id) {
    var url2 = urls.base_url + "/operation/planting";
    var url_ajax = url2 + '/get_users?box_id=' + id;
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

var showStopModel = function(id) {
    document.getElementById('cancelled_id').value = id;
    $('#mission-conf').modal('show');
}