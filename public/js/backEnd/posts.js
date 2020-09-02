/////////////////////////////////////////////////////
/*
|
| Config File
|
*/
var controlTitle = "moduels";
var AddformTitle = "AddPostForm";
var EditformTitle = "EditPostForm";
var tableTitle = "PostsDataTable";

var image_form = document.getElementById("icone_image");
var fileupload = document.getElementById("icone");
if (image_form) {
    image_form.onclick = function() {
        fileupload.click();
    };
}

var tableColumn = [{ data: 'order', name: 'order' }];
$.each(features, function(index, val) {
    tableColumn.push({ data: val, name: val });
});
tableColumn.push({ data: 'is_active', name: 'is_active' });
tableColumn.push({ data: 'created_at', name: 'created_at' });
tableColumn.push({ data: 'option', name: 'option' });

var url = urls.admin_url + "/" + controlTitle;
var url_data = urls.admin_url + "/data_moduels";
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

var country_id;
$("#country_id").change(function() {
    country_id = this.value;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("city_id_div").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", urls.base_url + "/country_ajax?country_id=" + country_id, true);
    xhttp.send();
});
var get_state = function(city_id) {
    // var city_id = this.value;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("state_id_div").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", urls.base_url + "/country_ajax/?country_id=" + country_id + "&city_id=" + city_id, true);
    xhttp.send();
}

var get_sub_cat = function(id) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            $("#sub_cat").append(this.responseText);
        }
    };
    xhttp.open("GET", urls.base_url + "/sub_cat?parent_id=" + id, true);
    xhttp.send();
}