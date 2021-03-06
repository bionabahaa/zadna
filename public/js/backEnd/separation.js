var ruels = {};

var AddformTitle = "AddSeparationForm";
var EditformTitle = "EditSeparationForm";
var controlTitle = "separation";
var url = urls.base_url + "/operation/" + controlTitle;
var url_data = urls.base_url + "/operation/data_" + controlTitle;
var tableTitle = "SeparationDataTable";

$('.upload').on('change', function() {
    var url_upload = url + '/' + 'upload';
    var data = getData('form_upload');
    sendPost('POST', url_upload, data);
});



if (report == true) {
    var tableColumn = [
        { data: 'code', name: 'code' },
        { data: 'box_code', name: 'box_code' },
        { data: 'plam_tree', name: 'plam_tree' },
        { data: 'number_of_separation', name: 'number_of_separation' },
        { data: 'start_date', name: 'start_date' },
        { data: 'case', name: 'case' }
    ];
} else {
    var tableColumn = [
        { data: 'code', name: 'code' },
        { data: 'box_code', name: 'box_code' },
        { data: 'plam_tree', name: 'plam_tree' },
        { data: 'number_of_separation', name: 'number_of_separation' },
        { data: 'start_date', name: 'start_date' },
        { data: 'case', name: 'case' },
        { data: 'option', name: 'option' }
    ];
}


function filter($table){
    var status=$('#status').val();
    var from=$('#from').val();
    var to=$('#to').val();
    var url=urls.base_url+'/operation/data_separation?status='+status+'&date_from='+from+'&date_to='+to;
    dataTable_search($table,url,tableColumn);

}


$(document).ready(function() {
    dataTable(tableTitle, url_data, tableColumn);
});



$('#SubmitButton').click(function(){
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