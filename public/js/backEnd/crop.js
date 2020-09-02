/////////////////////////////////////////////////////
/*
|
| Config File
|
*/
var controlTitle = "crops";
var AddformTitle = "AddCropsForm";
var EditformTitle = "EditCropsForm";
var tableTitle = "CropsDataTable";

var image_form = document.getElementById("icone_image");
var fileupload = document.getElementById("map_area");
if (image_form) {
    image_form.onclick = function() {
        fileupload.click();
    };
}


var tableColumn = [
    { data: 'crop_code', name: 'crop_code' },
    { data: 'crop_title', name: 'crop_title' },
    { data: 'code', name: 'code' },
    { data: 'option', name: 'option' }
];
var ruels = {};
var url = urls.base_url + "/setting/" + controlTitle;
var url_data = urls.base_url + "/setting/data_" + controlTitle;


function filter($table){
    var status=$('#type').val();
    var from=$('#from').val();
    var to=$('#to').val();

    var url=urls.base_url+'/setting/data_crops?status='+status+'&date_from='+from+'&date_to='+to;
    dataTable_search($table,url,tableColumn);

}


/////////////////////////////////////////////////////

var files = [];
// $('input[type=file]').on('change', prepareUpload);

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
            data.append('_method', 'PATCH');0
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