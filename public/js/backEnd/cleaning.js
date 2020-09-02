/////////////////////////////////////////////////////
/*
|
| Config File
|
*/
var controlTitle = "clean";
var AddformTitle = "AddCleaningForm";
var EditformTitle = "EditCleaningForm";
var tableTitle = "CleaningDataTable";

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
        { data: 'box_code', name: 'box_code' },
        { data: 'start_date', name: 'start_date' },
        { data: 'implementation_table', name: 'implementation_table' }
    ];
} else {
    var tableColumn = [
        { data: 'code', name: 'code' },
        { data: 'box_code', name: 'box_code' },
        { data: 'start_date', name: 'start_date' },
        { data: 'implementation_table', name: 'implementation_table' },
        { data: 'option', name: 'option' }
    ];
}

var ruels = {};
var url = urls.base_url + "/operation/" + controlTitle;
var url_data = urls.base_url + "/operation/data_" + controlTitle + "?level_id=" + level_id;


/////////////////////////////////////////////////////

function filter($table){
    // var status=$('#status').val();
    var from=$('#from').val();
    var to=$('#to').val();
    var url=urls.base_url+'/operation/data_clean?status='+status+'&date_from='+from+'&date_to='+to;
    dataTable_search($table,url,tableColumn);

}



var files = [];
// $('input[type=file]').on('change', prepareUpload);

function prepareUpload(event) {
    $('#' + this.name + "_image").attr('src', window.URL.createObjectURL(this.files[0]));
    files[this.name] = event.target.files;
}
$(document).ready(function() {
    // alert(url_data);
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
/////////////////////////////////////////////////
$('#saveDataPlanningIrrigation').click(function() {
    var url_type = "add_planning_irrigation";
    var method = 'POST';
    var data = getData("PlanningIrrigation");
    data.append('_method', 'POST');
    sendPost(method, url + '/' + url_type, data);
});
$('.delete_PlanningIrrigation').click(function() {
    var url_type = "delete_planning_irrigation";
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