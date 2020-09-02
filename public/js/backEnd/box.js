/////////////////////////////////////////////////////
/*
|
| Config File
|
*/
var controlTitle = "boxes";
var AddformTitle = "AddBoxForm";
var EditformTitle = "EditBoxForm";
var tableTitle = "BoxDataTable";

var image_form = document.getElementById("icone_image");
var fileupload = document.getElementById("map_area");
if (image_form) {
    image_form.onclick = function() {
        fileupload.click();
    };
}
if (report == true) {
    var tableColumn = [
        { data: 'code', name: 'code' },
        { data: 'row_count', name: 'row_count' },
        { data: 'column_count', name: 'column_count' },
       
        { data: 'Workers', name: 'Workers' },
        { data: 'Supervisors', name: 'Supervisors' },

        { data: 'signed', name: 'signed' },
        
    ];
} else {
    var tableColumn = [
        { data: 'code', name: 'code' },
        { data: 'row_count', name: 'row_count' },
        { data: 'Workers', name: 'Workers' },
        { data: 'Supervisors', name: 'Supervisors' },
       
        { data: 'signed', name: 'signed' },
        { data: 'option', name: 'option' }
    ];
}

var ruels = {
};
var url = urls.base_url + "/setting/" + controlTitle;
var url_data = urls.base_url + "/setting/data_" + controlTitle + "?operation_page=" + operation_page;


/////////////////////////////////////////////////////


$('.upload').on('change', function() {
    var form = $(this).attr("data-id");
    var url_upload = url + '/' + 'upload';
    var data = getData(form);
    sendPost('POST', url_upload, data);
});



// $('#downloadExcel').on('click',function () {
//     $.ajaxSetup({
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         }
//     });
//     $.ajax({
//         type:'get',
//         url:urls.base_url+'/downloadExcel/xls/Boxes',
//         dataType:'json',
//         success:function(data){
//         } ,
//         error:function(error){
//         }
//
//     });
// })

function add() {
    $('.box_point1 , .box_point2 ,.box_point3, .box_point4').fadeToggle('slow');
}

function choose_crop() {

}

$('#choose_crop').on('change',function () {
    var id=$(this).val();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'get',
        url:  urls.base_url + "/setting/getCrop/"+id,
        // processData: false,
        // contentType: false,
        success: function(data) {
            $('#show_crops').html(data.crops);

        },
        error: function(error) {
            alert('eero');
        }

    });



});

function showInput($name) {
    $('.'+$name).fadeIn('slow');
}

function insert() {
    var data = getData('form_excel');
    var x = sendPost('post', urls.base_url + '/setting/importExcel', data);

}


var files = [];
$('input[type=file]').on('change', prepareUpload);

function prepareUpload(event) {
    $('#' + this.name + "_image").attr('src', window.URL.createObjectURL(this.files[0]));
    files[this.name] = event.target.files;
}
$(document).ready(function() {
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
///////////////////////////////////////////////////////
$('#saveDateSoilanalysis').click(function() {
    var url_type = "add_soil_analysis";
    var method = 'POST';
    var data = getData("SoilanalysisAdd");
    data.append('_method', 'POST');
    sendPost(method, url + '/' + url_type, data);
});
$('.delete_soil_analysis').click(function() {
    var url_type = "delete_soil_analysis";
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