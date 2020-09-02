var controlTitle = "fixedasset";
var AddformTitle = "AddFixedAssetForm";
var EditformTitle = "EditFixedAssetForm";
var tableTitle = "FixedAssetDataTable";

var ruels = {};
var url = urls.base_url + "/setting/" + controlTitle;
var url_data = urls.base_url + "/setting/data_" + controlTitle;

var tableColumn = [
    { data: 'code', name: 'code' },
    { data: 'fixedasset_type', name: 'fixedasset_type' },
    { data: 'title', name: 'title' },
    { data: 'Purchasing_value', name: 'Purchasing_value' },
    { data: 'Market_value', name: 'Market_value' },
    { data: 'option', name: 'option' }
];


$("#filter_data").on("change",function(){
    var data=$(this).val();
    var new_url_data=url_data+"?type="+data;
    dataTable_search(tableTitle, new_url_data, tableColumn);


});

$(document).ready(function() {
    dataTable(tableTitle, url_data, tableColumn);
});

$('#AddNewType').click(function() {
    var url_type = "add_type";
    var method = 'POST';
    var data = getData("TypeAsset");
    data.append('_method', 'POST');
    sendPost(method, url + '/' + url_type, data);
});


$('.DeleteTypeBtn').click(function() {
    var url_type = "delete_type";
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



$('.typeLI').click(function() {
    var id = $(this).attr("data-id");
    var title = $(this).attr("data-title");
    document.getElementById("type_title").innerHTML = title;
    document.getElementById("type_title_hidden").value = id;
    //document.getElementById("material_type").value = id;
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