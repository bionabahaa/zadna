
var controlTitle = "farm";
var AddformTitle = "AddFarmForm";
var EditformTitle = "EditFarmForm";
var tableTitle = "FarmDataTable";


var ruels = {};
var url = urls.base_url + "/setting/" + controlTitle;
/////////////////////////////////////////////////////

var files = [];


$('.upload').on('change', function() {
    var form = $(this).attr("data-id");
    var url_upload = url + '/' + 'upload';
    var data = getData(form);
    sendPost('POST', url_upload, data);
});


$('#SubmitButton').click(function() {
        var id = document.getElementById('id').value;
        if (id == '') {
            var data = getData(AddformTitle);
            sendPost('POST', url, data);
        } else {
            var data = getData(EditformTitle);
            data.append('_method', 'PATCH');
            sendPost('POST', url + '/' + id, data);
        }


});

