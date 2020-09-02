

var ruels = {};
var controlTitle = "material";
var AddformTitle = "AddMaterialForm";
var EditformTitle = "EditMaterialForm";
var url = urls.base_url + "/setting/" + controlTitle;
var url_data = urls.base_url + "/setting/data_" + controlTitle;
var tableTitle = "MaterialDataTable";


var tableColumn = [
    { data: 'code', name: 'code' },
    { data: 'material_type', name: 'material_type' },
    { data: 'title', name: 'title' },
    { data: 'cost', name: 'cost' },
    { data: 'option', name: 'option' }
];




function filter($table){

    var status=$('#type').val();
    var from=$('#from').val();
    var to=$('#to').val();

    var url=urls.base_url+'/setting/data_material?status='+status+'&date_from='+from+'&date_to='+to;
    dataTable_search($table,url,tableColumn);

}

$(document).ready(function() {
    // alert(url_data);
    dataTable(tableTitle, url_data, tableColumn);
});

$('#AddNewType').click(function() {
    var url_type = "add_type";
    var method = 'POST';
    var data = getData("TypeMaterial");
    data.append('_method', 'POST');
    sendPost(method, url + '/' + url_type, data);
});

$('#AddNewUnit').click(function() {
    var url_type = "unit_type";
    var method = 'POST';
    var data = getData("UnitMaterial");
    data.append('_method', 'POST');
    sendPost(method, url + '/' + url_type, data);
});


$('.typeLI').click(function() {
    var id = $(this).attr("data-id");
    var title = $(this).attr("data-title");
    document.getElementById("type_title").innerHTML = title;
    document.getElementById("type_title_hidden").value = id;
    //document.getElementById("material_type").value = id;
});

$('.unitLI').click(function() {
    var id = $(this).attr("data-id");
    var title = $(this).attr("data-title");
    document.getElementById("unit_title").innerHTML = title;
    document.getElementById("unit_title_hidden").value = id;
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

$('.DeleteUnitBtn').click(function() {
    var url_type = "delete_unit";
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