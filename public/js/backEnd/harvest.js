var ruels = {};

var AddformTitle = "AddHarvestForm";
var EditformTitle = "EditHarvestForm";
var controlTitle = "harvest";
var url = urls.base_url + "/operation/" + controlTitle;
var url_data = urls.base_url + "/operation/data_" + controlTitle;
var tableTitle = "HarvestDataTable";


$('.upload').on('change', function() {
    var url_upload = url + '/' + 'upload';
    var data = getData('form_upload');
    sendPost('POST', url_upload, data);
});


if (report == true) {
    var tableColumn = [
        { data: 'code', name: 'code' },
        { data: 'box_code', name: 'box_code' },
        { data: 'row', name: 'row' },
        { data: 'column', name: 'column' },
        { data: 'crop', name: 'crop' },
        { data: 'qyt', name: 'qyt' },
        { data: 'date', name: 'date' }
    ];
} else {
    var tableColumn = [
        { data: 'code', name: 'code' },
        { data: 'box_code', name: 'box_code' },
        { data: 'row', name: 'row' },
        { data: 'column', name: 'column' },
        { data: 'crop', name: 'crop' },
        { data: 'qyt', name: 'qyt' },
        { data: 'date', name: 'date' },
        { data: 'option', name: 'option' }
    ];
}

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

$("#filter_data").on("change", function() {
    var data = $(this).val();
    var new_url_data = url_data + "?type=" + data;
    dataTable_search(tableTitle, new_url_data, tableColumn);


});