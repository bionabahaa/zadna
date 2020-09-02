var curFilterTable=$(".zadnatable");
var curAddTable=$(".zadnatable");



$(document).ready(function () {
    $(".zadnatable tbody ").paginate({'perPage': 5});

    //add a row to table
    $(document).on("click", "#saveMatrial", function () {
        var Table = $(".zadnatable");

        var cul1 = '<td>' + 33 + '</td>';
       
         var cul2 = '<td>' + $(".type").text() + '</td>';
        var cul3 = '<td>' + $(".date ").val() + '</td>';
      
            var cul5 = "<td><i class='fas fa-times-circle' style='color: red'></i></td>";
    
        var cul6 = "<td class=\"query-td\"><i class=\"fas fa-trash-alt delete-icon\" title=\"Delete\"></i>\n" +
            "                            <i class=\"fas fa-eye view-row\" title=\"View\"  data-toggle=\"modal\" data-target=\"#ُEditTypeModal\"></i></td>\n";
        var row = '<tr>' + cul1 + cul2 + cul3  + cul5+ cul6 + '</tr>';
        Table.find("tbody").append(row);
        Table.find("tbody").data('paginate').kill();
        Table.find("tbody").paginate({'perPage': 5});
        $("#exampleModalLong").modal("hide");

    });

    $(document).on("click", ".view-row", function () {
        var row = $(this).parents("tr");
        var Rowid=row.attr("rowid");
        $("#ViewMatrial").attr("viewrow",Rowid);
      
        $(".name").val(row.find("td")[1].innerHTML);
        $(".loc").val(row.find("td")[2].innerHTML);
       
        $(".rows").val(row.find("td")[3].innerHTML);
         $(".coloms").val(row.find("td")[4].innerHTML);


    });

    $(document).on("click", ".edit-btn", function () {
        var editBtn=$(this);
        var modal=editBtn.parents(".modal");
        var EditRow=modal.attr("viewrow");
        var saveBtn=modal.find(".save-btn");
        
      
        
        var name=modal.find(".name");
        var loc=modal.find(".loc");
        var rows=modal.find(".rows");
        var coloms=modal.find(".coloms");
       
        
        var squers=modal.find(".filter-form");
        var all=modal.find(".numric");

      
        var culs=$("[rowid="+EditRow+"]").find("td");
        var cell1=culs[1];
        var cell2=culs[2];
        var cell3=culs[3];
         var cell4=culs[4];


        editBtn.hide();
        saveBtn.attr("hidden",false);
      
        squers.attr("disabled",false);
        all.attr("disabled",false);

        
        saveBtn.on("click",function () {
            editBtn.show();
            
            saveBtn.attr("hidden",true);

           
         

            
            all.attr("disabled",true);
          squers.attr("disabled",true);
            
           cell1.innerHTML=name.val();
            cell2.innerHTML=loc.val();
            cell3.innerHTML=rows.val();
            cell4.innerHTML=coloms.val();


        })


    });


});


