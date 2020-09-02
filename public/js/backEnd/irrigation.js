var ruels = {};
var AddformTitle = "AddIrrigationForm";
var EditformTitle = "EditIrrigationForm";
var controlTitle = "irrigation";
var url = urls.base_url + "/setting/" + controlTitle;
var url_data = urls.base_url + "/setting/data_" + controlTitle + "?operation_page=" + operation_page;
var tableTitle = "IrrigationlDataTable";


$('.upload').on('change', function() {
    var url_upload = url + '/' + 'upload';
    var data = getData('form_upload');
    sendPost('POST', url_upload, data);
});

var add2 = function () {
    var CopyTR = '<tr>' + $(".td-rep").html() + '</tr>';
    $(".Ttyps").append(CopyTR);
}




if (report == true) {
    var tableColumn = [
        { data: 'code', name: 'code' },
        { data: 'title', name: 'title' },
        { data: 'line_type', name: 'line_type' },
        { data: 'water_amount', name: 'water_amount' },
        { data: 'lenght', name: 'lenght' },
        // { data: 'coordinate', name: 'coordinate' },
        { data: 'boxes', name: 'boxes' },
        { data: 'signed', name: 'signed' },
        { data: 'option', name: 'option' }
    ];
} else {
    var tableColumn = [
        { data: 'code', name: 'code' },
        { data: 'title', name: 'title' },
        { data: 'line_type', name: 'line_type' },
        { data: 'water_amount', name: 'water_amount' },
        { data: 'lenght', name: 'lenght' },
        { data: 'boxes', name: 'boxes' },
        { data: 'signed', name: 'signed' },
        { data: 'option', name: 'option' }
    ];
}

var tableColumnMahbas = [
    { data: 'code', name: 'code' },
    { data: 'desc', name: 'desc' },
    { data: 'location', name: 'location' },
    { data: 'option', name: 'option' },

];
function filter($table){

    var status=$('#type').val();
    var from=$('#from').val();
    var to=$('#to').val();
    var url=urls.base_url+'/setting/data_irrigation?status='+status+'&date_from='+from+'&date_to='+to;
    dataTable_search($table,url,tableColumn);

}

$(document).ready(function() {

    dataTable(tableTitle, url_data, tableColumn);
});

$(document).ready(function() {
    var id=$('#id').val();
    dataTable('DataTableMahbas', url+'/mahbasDatatable/'+id, tableColumnMahbas);
});


// define type of irrigation_line
$('#line_type').on('change',function () {
    var line_id=$(this).val();
    var url=urls.base_url + "/setting/line/";
    switch (line_id) {
        case '1':
            $('.under_primary').fadeOut();
            $('.primary').fadeOut();
            $('.sub').fadeOut();
            break;

        case '3':
            $('.under_primary').fadeOut();
            $('.sub').fadeOut();
            $('.primary').fadeIn();

            //send ajax request to get all primary line to display
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'get',
                url: url+1,
                success: function(data) {
                    $('#primary_line').html(data.lines);

                },
                error: function(error) {
                }

            });
         break;

        case '2':
            $('.primary').fadeOut();
            $('.sub').fadeOut();
            $('.under_primary').fadeIn();

            //send ajax request to get all  under_primary line to display
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'get',
                url: url+1,
                success: function(data) {
                    //alert('test');
                   // $('#under_primary_line').html('test');
                    $('#under_primary_line').html(data.lines);

                },
                error: function(error) {
                }

            });
            break;

        case '4':
            $('.primary').fadeOut();
            $('.under_primary').fadeOut();
            $('.sub').fadeIn();

            //send ajax request to get all  sub line to display
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'get',
                url: url+2,
                success: function(data) {
                    $('#sub').html(data.lines);
                },
                error: function(error) {
                }

            });
            break;

    }
})


 function editMahbas($id){

     $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
     });
     $.ajax({
         type: 'get',
         url: url+'/editMahbas/'+$id,
         processData: false,
         contentType: false,
         success: function(data) {
             $('#irrigation_id').val(data.mahbas.id);
             $('.desc_mahbas').val(data.mahbas.desc);
             $('#mahbas_point1').val(data.point1);
             $('#north').val(data.location_north[0]);
             $('#degree_north').val(data.location_north[1]);
             $('#minute_north').val(data.location_north[2]);
             $('#second_north').val(data.location_north[3]);
             $('#east').val(data.location_east[0]);
             $('#degree_east').val(data.location_east[1]);
             $('#minute_east').val(data.location_east[2]);
             $('#second_east').val(data.location_east[3]);
             $('#addMahbas').text('تعديل');

         },
         error: function(error) {
             alert('eero');
         }

     });

}

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

 $('#click_mahbas').on('click',function () {
     $('#FormaddMahbas')[0].reset();
     $('#addMahbas').text('اضافه');
 })

$('#addMahbas').click(function() {
    if (valdition(ruels)) {
        var id = document.getElementById('irrigation_id').value;
        if (id == '') {
            var data = getData('FormaddMahbas');
            sendPost('POST', url+'/addMahbas', data);
        } else {
            var data = getData('FormaddMahbas');
            // data.append('_method', 'PATCH');
            sendPost('POST', url+'/addMahbas', data);
        }

    }
});

$("#filter_data").on("change", function() {
    var data = $(this).val();
    var new_url_data = url_data + "?type=" + data;
    dataTable_search(tableTitle, new_url_data, tableColumn);


});