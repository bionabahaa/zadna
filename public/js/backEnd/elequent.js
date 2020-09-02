/////////////////////////////////////////////////////
/*
|
| Config File
|
*/
var controlTitle = "equipments";
var AddformTitle = "AddEquipmentsForm";
var EditformTitle = "EditEquipmentsForm";
var tableTitle = "EquipmentsDataTable";

var image_form = document.getElementById("icone_image");
var fileupload = document.getElementById("map_area");
if (image_form) {
    image_form.onclick = function() {
        fileupload.click();
    };
}

var tableColumn = [
    { data: 'code', name: 'code' },
    { data: 'type_title', name: 'type_title' },
    { data: 'title', name: 'title' },
    { data: 'model', name: 'model' },
    { data: 'option', name: 'option' }
];
var ruels = {};
var url = urls.base_url + "/setting/" + controlTitle;
var url_data = urls.base_url + "/setting/data_" + controlTitle;


/////////////////////////////////////////////////////

var files = [];
$('input[type=file]').on('change', prepareUpload);

function prepareUpload(event) {
    alert('asdas');
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

$(document).on('click', '.Deletebtn', function() {
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
                sendPost('DELETE', url + '/' + id, data);
            } else {
                swal("Your data is safe!");
            }
        });
});

/////////////////////////////////////////////////////////
$('#DeleteTypeBtn').click(function() {
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
$('#AddNewType').click(function() {
    var url_type = "add_type";
    var method = 'POST';
    var data = getData("TypeEquipment");
    data.append('_method', 'POST');
    sendPost(method, url + '/' + url_type, data);
});
$('.typeLI').click(function() {
    var id = $(this).attr("data-id");
    var title = $(this).attr("data-title");
    document.getElementById("type_title").innerHTML = title;
    document.getElementById("type_title_hidden").value = id;
});
/////////////////////////////////////////////////////////
$('#saveDateTest').click(function() {
    var url_type = "add_test";
    var method = 'POST';
    var data = getData("EquipmentTestAdd");
    data.append('_method', 'POST');
    sendPost(method, url + '/' + url_type, data);
});
$('.delete_test').click(function() {
    var url_type = "delete_test";
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
/////////////////////////////////
$("#filter_type").on("change", function() {
    var data = $(this).val();
    var new_url_data = url_data + "?type=" + data;
    dataTable_search(tableTitle, new_url_data, tableColumn);
});
/////////////////////////////////