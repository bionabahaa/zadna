var curFilterTable=$(".zadnatable");
var curAddTable=$(".zadnatable");



$(document).ready(function () {
    $(".zadnatable tbody ").paginate({'perPage': 5});





    //add a row to table
    $(document).on("click", "#saveMatrial", function () {
        var Table = $(".zadnatable");

        var cul1 = '<td>' + 33 + '</td>';
        var cul2 = '<td>' + $(".NameCrop").val() + '</td>';
        var cul3 = '<td>' + $(".typeCrop ").val() + '</td>';
        var cul4 = '<td>' + $(".3ddelfdan").val() + '</td>';
        var cul5 = '<td>' + $(".elmsa7a").val() + '</td>';
        
        var cul6 = "<td class=\"query-td\"><i class=\"fas fa-trash-alt delete-icon\" title=\"Delete\"></i>\n" +
            "                            <i class=\"fas fa-eye view-row\" title=\"View\"  data-toggle=\"modal\" data-target=\"#ُEditTypeModal\"></i></td>\n";
        var row = '<tr>' + cul1 + cul2 + cul3 + cul4 +cul5+ cul6 + '</tr>';
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
        $(".typescrop :selected").val(row.find("td")[2].innerHTML);
        $(".elmsa7a").val(row.find("td")[3].innerHTML);
        $(".3ddelfdan").val(row.find("td")[4].innerHTML);
        


    });

    $(document).on("click", ".edit-btn", function () {
        var editBtn=$(this);
        var modal=editBtn.parents(".modal");
        var EditRow=modal.attr("viewrow");
        var saveBtn=modal.find(".save-btn");
        var name=modal.find(".name");
        var type=modal.find(".typescrop");
        var addelfdan =modal.find(".3ddelfdan");
        var elmsa7a =modal.find(".elmsa7a");
        var numeric=modal.find("input");
        var formControl=modal.find(".form-control");
       

       // var addNew=modal.find(".add-cate");
        var culs=$("[rowid="+EditRow+"]").find("td");
        var cell1=culs[1];
        var cell2=culs[2];
        var cell3=culs[3];
            var cell4=culs[4];
      
        


        editBtn.hide();
        saveBtn.attr("hidden",false);

        name.attr("disabled",false);
        type.attr("disabled",false);
       numeric.attr("disabled",false);
     
       formControl.attr("disabled",false);
//
//        width.attr("disabled",false);
//       numberOfyard.attr("disabled",false);
//        priceOfyard.attr("disabled",false);
//        code1.attr("disabled",false);
//  planeType.attr("disabled",false);


        saveBtn.on("click",function () {
            editBtn.show();
            saveBtn.attr("hidden",true);
              name.attr("disabled",true);
        type.attr("disabled",true);
       numeric.attr("disabled",true);
            
                   formControl.attr("disabled",true);



            
            cell1.innerHTML=name.val();
            cell2.innerHTML=type.val();
              cell3.innerHTML=elmsa7a.val();
            cell4.innerHTML=addelfdan.val();
          


        })


    });


});


