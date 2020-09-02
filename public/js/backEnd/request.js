var ruels = {
    'titlee': {
        required: true
    },
    'order_from': {
        required: true
    },
};
var AddformTitle = "AddRequestForm";
var EditformTitle = "EditRequestForm";
var controlTitle = "requests";
var url = urls.base_url + "/stores/" + controlTitle;
var url_data = urls.base_url + "/stores/data_" + controlTitle;
var tableTitle = "RequestDataTable";


$('.upload').on('change', function() {
    var url_upload = url + '/' + 'upload';
    var data = getData('form_upload');
    sendPost('POST', url_upload, data);
});




var tableColumn = [
    { data: 'code', name: 'code' },
    { data: 'type_title', name: 'type_title' },
    { data: 'title', name: 'title' },
    { data: 'QYT', name: 'QYT' },
    { data: 'status', name: 'status' },
    { data: 'ordered_from', name: 'ordered_from' },
    { data: 'created_at', name: 'created_at' },
    { data: 'order_date', name: 'order_date' },
    { data: 'option', name: 'option' }
];



var filter=function ($table,$url) {
    var status=$('#status').val();
    var type=$('#type').val();
    var from=$('#from').val();
    var to=$('#to').val();

    var url=urls.base_url+'/'+$url+'?status='+status+'&type='+type+'&date_from='+from+'&date_to='+to;
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