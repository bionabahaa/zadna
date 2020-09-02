var curFilterTable=$(".zadnatable");
var curAddTable=$(".zadnatable");



$(document).ready(function () {
    $(".zadnatable tbody ").paginate({'perPage': 5});




    $(document).on("click", ".export-excel", function (){
        $(".zadnatable").table2excel({
            exclude: ".actions",
            name: "Worksheet Name",
            filename: "zadnafile" //do not include extension
        });
    });





    $(document).on("click", ".add-crepto", function () {
        crops = "";
        $("#myUL2 input").prop("checked", false);


    });


    $(document).on("click", ".addnew", function () {
        $("#EditModal-name-text-kind").val("");
        $("#name-text-kind").val("");
        $("#name-text").val("");
    });



    //add a row to table
    $(document).on("click", "#saveMatrial", function () {
        var Table = $(".zadnatable");
           var LastId=Table.find("tbody tr:last").attr("rowid");
        var newID=parseInt(LastId) + 1;

        var cul1 = '<td>' + 33 + '</td>';
        var cul2 = '<td>' + $(".name").val() + '</td>';
        var cul3 = '<td>' + $(".inputType :selected").val() + '</td>';
        var cul4 = '<td>' + $(".buy-date").val() + '</td>';
        
    
        var cul6 = "<td class=\"query-td\"><i class=\"fas fa-trash-alt delete-icon\" title=\"Delete\"></i>\n" +
            "                            <i class=\"fas fa-eye view-row\" title=\"View\"  data-toggle=\"modal\" data-target=\"#ُEditTypeModal\"></i></td>\n";
        var row = '<tr rowid='+newID +'>'  + cul1 + cul2 + cul3 + cul4  + cul6 + '</tr>';
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
        $(".edit-inputType").val(row.find("td")[2].innerHTML);
       
        $(".buy-date").val(row.find("td")[3].innerHTML);


    });

    $(document).on("click", ".edit-btn", function () {
        var editBtn=$(this);
        var modal=editBtn.parents(".modal");
        var EditRow=modal.attr("viewrow");
        var saveBtn=modal.find(".save-btn");
        var type=modal.find(".edit-inputType");
        var name=modal.find(".name");
        var inputType=modal.find(".edit-inputType");
        var quanti=modal.find(".quanti");
        var buydate=modal.find(".buy-date");
        var listItem=modal.find("#add-categ li");
        
        var loc=modal.find(".loc");
        var deep=modal.find(".deep");
        var all=modal.find(".numric");
//        var buydate=modal.find(".buy-date");
//        var buydate=modal.find(".buy-date");
//        var buydate=modal.find(".buy-date");

       // var addNew=modal.find(".add-cate");
        var culs=$("[rowid="+EditRow+"]").find("td");
        var cell1=culs[1];
        var cell2=culs[2];
        var cell3=culs[3];


        editBtn.hide();
        saveBtn.attr("hidden",false);
        inputType.attr("disabled",false);
         all.attr("disabled",false);

        
        saveBtn.on("click",function () {
            editBtn.show();
            
            saveBtn.attr("hidden",true);

            listItem.attr("contenteditable",false);
         

            inputType.attr("disabled",true);

            all.attr("disabled",true);
            
           cell1.innerHTML=name.val();
            cell2.innerHTML=type.val();
            cell3.innerHTML=buydate.val();


        })


    });
//
//     $('#EditModal-add-item').click(function () {
//
//
//         if ($("#EditModal-name-text-kind").val()== '')
//         {
//
//         }else
//             $("#Edit-myUL2").append("<li class='list-group-item'>" +
//                 $('#EditModal-name-text-kind').val() + "</li>");
//
//
//
//     });
//
//
//     $(".export-excel").click(function(e) {
//         window.open('data:application/vnd.ms-excel,' + $('#dvData').html());
//         e.preventDefault();
//     });
//

});


