var controlTitle = "faults";
var AddformTitle = "form_add_fault";
var EditformTitle = "form_edit_disease";
var tableTitle = "DataTableFaults";
var url = urls.base_url + "/Faults/" + controlTitle;

var url_data = urls.base_url + "/Faults/data_" + controlTitle;

var ruels = {};
var tableColumn = [
    { data: 'fault_code', name: 'fault_code' },
    { data: 'type', name: 'type' },
    { data: 'desc', name: 'desc' },
    { data: 'date', name: 'date' },
    { data: 'status', name: 'status' },
    { data: 'option', name: 'option' },
];

var filter=function ($table,$url) {
    var type=$('#type').val();
    var status=$('#status').val();
    var from=$('#from').val();
    var to=$('#to').val();

    var url=urls.base_url+'/'+$url+'?status='+status+'&type='+type+'&date_from='+from+'&date_to='+to;
    dataTable_search($table,url,tableColumn);

}

$(document).ready(function() {
    dataTable(tableTitle, url_data, tableColumn);
});

$('#add_fault').on('click', function() {
    $('#form_add_fault')[0].reset();
    $('select').prop('selectedIndex', null);
    $('#fault_code').empty();
    $('.error_massage').text('');

});
// $('#search_btn').on('click', function() {
//     var date_from = document.getElementById('date_from').value;
//     var date_to = document.getElementById('date_to').value;
//     var type = document.getElementById('type').value;
//     var status = document.getElementById('status').value;
//     var state = "?";
//     if (date_from != '') {
//         state += 'date_from=' + date_from + "&";
//     }
//     if (date_to != '') {
//         state += 'date_to=' + date_to + "&";
//     }
//     if (type != '') {
//         state += 'type=' + type + "&";
//     }
//     if (status != '') {
//         state += 'status=' + status + "&";
//     }
//     var url_data_search = urls.base_url + "/Faults/data_" + controlTitle + status;
//     dataTable_search(tableTitle, url_data, tableColumn);
// });


$('.type_change').on('change', function() {
    var status = $(this).val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'GET',
        url: urls.base_url + '/Faults/faultType/',
        data: { 'status': status },
        dataType: 'json',
        success: function(data) {
            $('#fault_code').html(data.types);
        },
        error: function(error) {
        }

    });
})

function editFault($id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'GET',
        url: urls.base_url + '/Faults/editFault/',
        data: { 'id': $id },
        dataType: 'json',
        success: function(data) {
            if (data.fault.type == 1) {
                $('#beer').attr('selected', 'selected');
                $('#eqi').attr('selected', null);
            } else if (data.fault.type == 2) {
                $('#eqi').attr('selected', 'selected');
                $('#beer').attr('selected', null);
            }
            else if (data.fault.type == 3) {
                $('#irrig').attr('selected', 'selected');
                $('#beer').attr('selected', null);
                $('#eqi').attr('selected', null);
            }

            if (data.fault.fault_status == 1) {
                $('.waiting').attr('checked', 'checked');
            } else if (data.fault.fault_status == 2) {
                $('.refuse').attr('checked', 'checked');
            } else {
                $('.accept').attr('checked', 'checked');
            }
            $('#id').val(data.fault.id);
            $('#fault_code').html(data.types);
            $('#desc').val(data.fault.desc);
            $('#date').val(data.fault.date);
        },
        error: function(error) {
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
            var data = getData(AddformTitle);
            data.append('_method', 'PATCH');
            sendPost('POST', url + '/' + id, data);
        }

    }
});