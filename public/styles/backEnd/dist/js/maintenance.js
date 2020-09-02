var curFilterTable=$(".zadnatable");
var curAddTable=$(".zadnatable");



$(document).ready(function () {
    $(".zadnatable tbody ").paginate({'perPage': 5});
$(document).on("click",".add-crepto",function(){
  $("#exampleModalLong").modal().show();
    $(".type").text("");
    $(".date").val("");
    $(".equipmentName").val("");
    $(".numric").val("");
    $(".cclose").parents("li").remove();
});
    //add a row to table
    $(document).on("click", "#saveMatrial", function () {
        var Table = $(".zadnatable");

        var cul1 = '<td>' + 33 + '</td>';
       
         var cul2 = '<td>' + $(".type").text() + '</td>';
        var cul3 = '<td>' + $(".date ").val() + '</td>';
      var cul4 = '<td>' + $(".equipmentName ").val() + '</td>';
            var cul5 = "<td><i class='fas fa-times-circle' style='color: red'></i></td>";
    
        var cul6 = "<td class=\"query-td\"><i class=\"fas fa-trash-alt delete-icon\" title=\"Delete\"></i>\n" +
            "                       <a   href=\"maintenance-current-faults-view1.html\">      <i style=\"color: #212529 !important\" class=\"fas fa-eye view-row\" title=\"View\"></i>  </a></td>\n";
        var row = '<tr>' + cul1 + cul2 + cul3 +cul4+ cul5+ cul6 + '</tr>';
        Table.find("tbody").append(row);
        Table.find("tbody").data('paginate').kill();
        Table.find("tbody").paginate({'perPage': 5});
        $("#exampleModalLong").modal("hide");

    });

    


});


