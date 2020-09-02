$(document).ready(function ($) {
    $('#addgroup').click(function () {
        if ($("#name-text").val() == '') {

        } else
            $("#myUL").prepend("<li><span  class='item'>" + $('#name-text').val() + "</span> <i class='fa fa-times cclose' ></i> </li>");


         $("#name-text").html();
       

    });

    $('#addgroup2').click(function () {
        if ($("#name-text2").val() == '') {

        } else
            $("#myUL3").prepend("<li >  <span class='item'>" + $('#name-text2').val() + "</span> <i class='fa fa-times cclose' ></i></li>");


           
        $('#name-text2').text('');

    });
    
//    jquery code for model (check box list )

    $('#add-item').click(function () {
        if ($("#name-text-kind").val() == '') {

        } else
            $("#myUL2").prepend("<li >  <span class='item'>"+ $('#name-text-kind').val() + "</span> <i class='fa fa-times cclose' ></i></li>");




    });
    
});


$(document).on('click', '.item', function () {
    var item = $(this).text();
    $(this).parents('.card').find('.selected-value').text(item);
   
});

$(document).on('click', '.cclose', function () {
    
   
    var item = $(".item").text();
    if($(this).parents('.card').find('.selected-value').text() ==  $(this).parents("li").find('.item').text()){
        $(this).parents('.card').find('.selected-value').text(" ");
    }
 
    var clos = $(".cclose").val();
     $(this).parents("li").remove();

   
});


$(document).on('click', '#radio1', function () {
 
   $(".numofworker2").prop('disabled', false);
    
//    $(".selectcl").attr("disabled", 'disabled');
    $("#id-select2").attr("disabled", true);
    
    
   
    
   
});
$(document).on('click', '#radio2', function () {
    $(".numofworker2").prop('disabled', true);
       $("#id-select2").attr("disabled", false);
   
   
});
$(function(){
  $(".fold-table tr.view").on("click", function(){
    $(this).toggleClass("open").next(".fold").toggleClass("open");
  });
});

