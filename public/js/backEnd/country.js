/////////////////////////////////////////////////////
/*
|
| Config File
|
*/
var controlTitle = "countries";
var AddformTitle = "AddCountryForm";
var EditformTitle = "EditCountryForm";
var tableTitle = "CountryDataTable";

var image_form = document.getElementById("icone_image");
var fileupload = document.getElementById("icone");
if (image_form) {
    image_form.onclick = function() {
        fileupload.click();
    };
}

var tableColumn = [
    { data: 'order', name: 'order' },
    { data: 'title', name: 'title' },
    { data: 'country', name: 'country' },
    { data: 'city', name: 'city' },
    { data: 'is_active', name: 'is_active' },
    { data: 'created_at', name: 'created_at' },
    { data: 'option', name: 'option' }
];
var ruels = {
    'order': ['required', 'number'],
};
var url = urls.admin_url + "/" + controlTitle;
if (country_id == '') {
    var url_data = urls.admin_url + "/data_" + controlTitle;
} else {
    if (city_id == '') {
        var url_data = urls.admin_url + "/data_" + controlTitle + "?country_id=" + country_id;
    } else {
        var url_data = urls.admin_url + "/data_" + controlTitle + "?country_id=" + country_id + "&city_id=" + city_id;
    }
}

/////////////////////////////////////////////////////

var files = [];
$('input[type=file]').on('change', prepareUpload);

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