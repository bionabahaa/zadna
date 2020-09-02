/////////////////////////////////////////////////////

var controlTitle = "boxes";
var AddformTitle = "AddCostsForm";
var EditformTitle = "EditCostsForm";
var tableTitle = "CostsDataTable";

var image_form = document.getElementById("icone_image");
var fileupload = document.getElementById("map_area");
if (image_form) {
    image_form.onclick = function() {
        fileupload.click();
    };
}

var tableColumn = [
    { data: 'code', name: 'code' },
    { data: 'count_plam_tree', name: 'count_plam_tree' },
    { data: 'total', name: 'total' },
    { data: 'option', name: 'option' }
];
var ruels = {};
var url = urls.base_url + "/costs/" + controlTitle;
var url_data = urls.base_url + "/costs/data_" + controlTitle;


/////////////////////////////////////////////////////


function filter() {
    var status = $('#type').val();
    var from = $('#from').val();
    var to = $('#to').val();
    // var url = urls.base_url + '/costs/data_boxes?generall=1&status=' + status + '&date_from=' + from + '&date_to=' + to;
    var url = urls.base_url + '/costs/boxes?generall=1&status=' + status + '&date_from=' + from + '&date_to=' + to;
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'GET',
        url: url,
        dataType: 'json',
        success: function(data) {
          $('#body').html(data.res);
        },

        error: function(error) {
        }

    });
}






$('.upload').on('change', function() {
    var form = $(this).attr("data-id");
    var url_upload = url + '/' + 'upload';
    var data = getData(form);
    sendPost('POST', url_upload, data);
});



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
    // console.log('asdasd');return;
    var id = document.getElementById('id').value;
    if (valdition(ruels)) {
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
///////////////////////////////////

$('#search_cost_palm_tree').click(function() {
    // console.log('asdasd');return;
    var id = document.getElementById('palm_tree_code').value;
    if (id == '') {
        alert('أختار النخله أولا');
        return;
    }
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("CostPlamTree").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", urls.base_url + "/costs/palmTree/cost" + '?palm_tree=' + id, true);
    xhttp.send();
});