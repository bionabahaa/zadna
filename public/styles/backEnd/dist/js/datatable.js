$(function() {

    $('.zadnatable').DataTable({
        'paging': true,
        'pageLength': 5,
        'lengthChange': false,
        'searching': true,
        'ordering': false,
        'info': false,
        'autoWidth': false,
        'responsive': true,
        'language': {
            'sSearch': "",
            'paginate': {
                'next': ">>",
                'previous': "<<"

            }

        },
        dom: 'Bfrtip',
        buttons: [
            'copy', 'excel', 'pdf'
        ]



    })

})


$(document).ready(function() {
    //         (".zadnatable tbody ").paginate({'perPage': 5});

    $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $(".zadnatable tbody tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
        $(".zadnatable1 tbody tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
        $(".zadnatable tbody  tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });

        //  $(".zadnatable tbody").data('paginate').kill();
        // $(".zadnatable tbody").paginate({'perPage': 5});

    });

    $("#myInput2").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $(".priv tbody tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
        $(".priv tbody tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
        $(".priv tbody  tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });

        //  $(".priv tbody").data('paginate').kill();
        // $(".priv tbody").paginate({'perPage': 5});

    });




});

// code to set today date in the date input 
var fullDate = new Date();
var twoDigitMonth = fullDate.getMonth() + "";
if (twoDigitMonth.length == 1) twoDigitMonth = "0" + twoDigitMonth;
var twoDigitDate = fullDate.getDate() + "";
if (twoDigitDate.length == 1) twoDigitDate = "0" + twoDigitDate;
var currentDate = fullDate.getFullYear() + "-" + twoDigitMonth + "-" + twoDigitDate;

$(".type-date").val(currentDate);