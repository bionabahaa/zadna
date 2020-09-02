var ruels = {};
var controlTitle = "seasons";
var AddformTitle = "form_create_season";
var EditformTitle = "form_edit_season";
var url = urls.base_url + "/setting/" + controlTitle;
var url_data = urls.base_url + "/setting/data_" + controlTitle;
var tableTitle = "SeasonDataTable";


var tableColumn = [
    { data: 'code', name: 'code' },
    { data: 'title', name: 'title' },
    { data: 'season_start', name: 'season_start' },
    { data: 'season_end', name: 'season_end' },
    { data: 'option', name: 'option' }
];

var filter=function ($table,$url) {

    var from=$('#from').val();
    var to=$('#to').val();

    var url=urls.base_url+'/'+$url+'?date_from='+from+'&date_to='+to;
    dataTable_search($table,url,tableColumn);

}


$('.import_data').on('change', function() {
    var data = $(this).val();

    var data = new FormData($('#form_import_data')[0]);


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'post',
        url: 'import_data',
        data: data,
        processData: false,
        contentType: false,
        success: function(data) {
            alert('don');

        },
        error: function(error) {
            alert('eero');
        }

    });
});



$('#date').on('change', function() {
    var data = $('#form_filter_date').serialize();
    $(this).val('');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'get',
        url: url_data,
        data: data,
        success: function(data) {
            alert('don');

        },
        error: function(error) {
            alert('eero');
        }

    });


})


$(document).ready(function() {

    dataTable(tableTitle, url_data + '/' + $('#view_name').val(), tableColumn);
});


$('.SubmitButton').click(function() {
    if (valdition(ruels)) {
        var id = document.getElementById('id').value;
        if (id == '') {
            var data = getData(AddformTitle);
            sendPost('POST', url, data);
        } else {
            var data = getData(EditformTitle);
            data.append('_method', 'PATCH');
            sendPost('POST', url + '/' + id, data);
            id = '';
        }
    }
});


$('#SubmitButtonFilter').click(function() {
    var start_date = document.getElementById('start_date').value;
    var end_date = document.getElementById('end_date').value;
    var url_filter = urls.base_url + "/setting/season/current_season?start_date=" + start_date + "&end_date" + end_date;
    loading();
    setTimeout(function() {
        window.location = url_filter;
    }, 3000);
});