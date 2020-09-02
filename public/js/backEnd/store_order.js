var ruels = {};
var AddformTitle = "AddStoreForm";
var EditformTitle = "EditStoreForm";
var controlTitle = "orders";
var url = urls.base_url + "/stores/" + controlTitle;
var url_data = urls.base_url + "/stores" + "/data_" + controlTitle;
var tableTitle = "StoreOrderDataTable";


$('.upload').on('change', function() {
    var url_upload = url + '/' + 'upload';
    var data = getData('form_upload');
    sendPost('POST', url_upload, data);
});



var tableColumn = [
    { data: 'code', name: 'code' },
    { data: 'type', name: 'type' },
    { data: 'name', name: 'name' },
    { data: 'total_qyt', name: 'total_qyt' },
    { data: 'qyt', name: 'qyt' },
    { data: 'rest_qyt', name: 'rest_qyt' },
    { data: 'sent_qyt', name: 'sent_qyt' },
    // { data: 'qyt'+ '-' +'rest_qyt', name: 'rest_qyt' },
    { data: 'datetime', name: 'datetime' },
    { data: 'option', name: 'option' }
];


function filter($table,$url){
    var status=$('#status').val();
    var from=$('#from').val();
    var to=$('#to').val();
    var url=urls.base_url+'/'+$url+'?status='+status+'&date_from='+from+'&date_to='+to;
    dataTable_search($table,url,tableColumn);


}


$(document).ready(function() {
    dataTable(tableTitle, url_data, tableColumn);
});

// var change_status = function(id) {
//     var xhttp = new XMLHttpRequest();
//     xhttp.onreadystatechange = function() {
//         if (this.readyState == 4 && this.status == 200) {
//             dataTable_search(tableTitle, url_data, tableColumn);
//         }
//     };
//     xhttp.open("GET", urls.base_url + "/stores/change_order_staus?id=" + id, true);
//     xhttp.send();
// }


function show_order(id){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'get',
        url: urls.base_url + '/stores/get_order/'+id,
        dataType: 'json',
        success: function(data) {
                $('#total_amount').val(data.result.QYT);
                $('#requested_amount').val(data.result.qyt);
                $('#order_id').val(data.result.operation_resources_id);
        },
        error: function(error) {
        }

    });
  $('#order_model').modal().open;
}



$('#save_order').on('click',function () {
    var id=$('#order_id').val();
    var url = urls.base_url + "/stores/save_order/"+id;
    var data = getData('formOrder');
    sendPost('POST', url, data);
});