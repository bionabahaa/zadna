
var url = urls.base_url + "/setting/";
$('#point_coordinate').click(function () {
    $('#modal_point_coordiante').modal('show');
});

//get mahbas coordinate
$('.mahbas_point_coordinate').click(function () {
     $('.modal_mahbas_point_coordiante').modal('show');

    var id=$(this).attr('data-id');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'get',
        url: url+'mahbas_coordinate/'+id,
        processData: false,
        contentType: false,
        success: function(data) {
            $('.pointNorth3').text(data.point_north[3]);
            $('.pointNorth2').text(data.point_north[2]);
            $('.pointNorth1').text(data.point_north[1]);
            $('.pointNorth0').text(data.point_north[0]);
            $('.pointEast3').text(data.point_east[3]);
            $('.pointEast2').text(data.point_east[2]);
            $('.pointEast1').text(data.point_east[1]);
            $('.pointEast0').text(data.point_east[0]);
            $('.point').text(data.point[0]);

            $('.modal_mahbas_point_coordiante').modal('show');
        },
        error: function(error) {
            alert('eero');
        }

    });

});


$('.generator_mainentance').on('click',function () {
    var id=$(this).attr('data-id');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'get',
        url: url+'generator_mainentance/'+id,
        processData: false,
        contentType: false,
        success: function(data) {
            console.log(data.html);
            $('.generator_mainentance_body').html(data.html);
            $('#generatorMainentance_modal').modal('show');

        },
        error: function(error) {
            alert('eero');
        }

    });



});