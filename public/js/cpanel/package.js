/////////////////////////////////////////////////////
/*
|
| Config File
|
*/
var controlTitle;
var AddformTitle = "PackageForm";
var EditformTitle;
var tableTitle;
var ruels = {
    'checkbox': {
        required: true
    },
    'gender': {
        required: true
    }
};



/////////////////////////////////////////////////////
var url = urls.cpanel_url + "/packages";
var files = [];
$('input[type=file]').on('change', prepareUpload);

function prepareUpload(event) {
    $('#' + this.name + "_image").attr('src', window.URL.createObjectURL(this.files[0]));
    files[this.name] = event.target.files;
}
$(document).ready(function() {

});


$('#SubmitButton').click(function() {
    var data = getData(AddformTitle);
    sendPost('POST', url, data);
});