var ruels = {};

var AddformTitle = "AddSunstainableOperationsForm";
var EditformTitle = "EditSunstainableOperationsForm";
var controlTitle = "sunstainable_operations";
var url = urls.base_url + "/operation/" + controlTitle;
var url_data = urls.base_url + "/operation/data_" + controlTitle + "?level_id=" + level_id;
var tableTitle = "SunstainableOperationsDataTable";


$('.upload').on('change', function() {
    var url_upload = url + '/' + 'upload';
    var data = getData('form_upload');
    sendPost('POST', url_upload, data);
});



if (report == true) {
    var tableColumn = [
        { data: 'code', name: 'code' },
        { data: 'box_code', name: 'box_code' },
        { data: 'used_type_title', name: 'used_type_title' },
        { data: 'operation_type_title', name: 'operation_type_title' },
        { data: 'start_date', name: 'start_date' }
    ];
} else {
    var tableColumn = [
        { data: 'code', name: 'code' },
        { data: 'box_code', name: 'box_code' },
        { data: 'used_type_title', name: 'used_type_title' },
        { data: 'operation_type_title', name: 'operation_type_title' },
        { data: 'start_date', name: 'start_date' },
        { data: 'option', name: 'option' }
    ];
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

$("#filter_data").on("change", function() {
    var data = $(this).val();
    var new_url_data = url_data + "?type=" + data;
    dataTable_search(tableTitle, new_url_data, tableColumn);


});