/////////////////////////////////////////////////////
/*
|
| Config File
|
*/
var controlTitle = "";
var AddformTitle = "SystemForm";
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
var map;


/////////////////////////////////////////////////////
var url = urls.admin_url + "/setting";
var files = [];
$('input[type=file]').on('change', prepareUpload);

function prepareUpload(event) {
    $('#' + this.name + "_image").attr('src', window.URL.createObjectURL(this.files[0]));
    files[this.name] = event.target.files;
}
$(document).ready(function() {


});
$('#SearchLocation').click(function() {
    GMaps.geocode({
        address: $('#address_location').val(),
        callback: function(results, status) {
            if (status == 'OK') {
                var latlng = results[0].geometry.location;
                map.setCenter(latlng.lat(), latlng.lng());
                map.addMarker({
                    lat: latlng.lat(),
                    lng: latlng.lng()
                });
            }
        }
    });
});
$('#addNewAds').click(function() {
    var div = document.getElementById("rowAdsHidden").innerHTML;
    $("#rowAds").append(div);
});
$('#addNewStatistics').click(function() {
    var div = document.getElementById("rowStatisticHidden").innerHTML;
    $("#rowStatistic").append(div);
});


$('#SubmitButton').click(function() {
    var data = getData(AddformTitle);

    // for (var pair of data.entries()) {
    //     console.log(pair[0] + ', ' + pair[1]);
    // }
    // // console.log(AddformTitle);
    // return;
    sendPost('POST', url, data);
});