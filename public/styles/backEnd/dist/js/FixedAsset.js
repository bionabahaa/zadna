var curFilterTable=$(".zadnatable");
var curAddTable=$(".zadnatable");



$(document).ready(function () {
    $(".zadnatable tbody ").paginate({'perPage': 5});




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
    $(document).on("click", "#addassets", function () {
        var Table = $(".zadnatable");
        var LastId=Table.find("tbody tr:last").attr("rowid");
        var newID=parseInt(LastId) + 1;

        var cul1 = '<td>' + 33 + '</td>';
        var cul2 = '<td>' + $(".inputType").text() + '</td>';
        var cul3 = '<td>' + $(".name").val() + '</td>';
        var cul4 = '<td>' + $(".buyVlaue").val() + '</td>';
        var cul5 = '<td>' + $(".marektValue ").val() + '</td>';
        var cul6 = ' <td class="query-td"><i class="fas fa-eye view-row" title="View" data-toggle="modal" data-target="#ViewAssests"></i> </td>';
        var row = '<tr rowid='+newID +'>' + cul1 + cul2 + cul3 + cul4 + cul5 + cul6+'</tr>';
        Table.find("tbody").append(row);
        Table.find("tbody").data('paginate').kill();
        Table.find("tbody").paginate({'perPage': 5});
        $("#exampleModalLong").modal("hide");

    });

    $(document).on("click", ".view-row", function () {
        var row = $(this).parents("tr");
        var Rowid=row.attr("rowid");
        $("#ViewAssests").attr("viewrow",Rowid);
        $(".edit-type").val(row.find("td")[1].innerHTML);
        $(".edit-name").val(row.find("td")[2].innerHTML);
        $(".edit-buyVlaue").val(row.find("td")[3].innerHTML);
        $(".edit-marektValue :selected").text(row.find("td")[4].innerHTML);


    });

    $(document).on("click", ".edit-btn", function () {
        var editBtn=$(this);
        var modal=editBtn.parents(".modal");
        var EditRow=modal.attr("viewrow");
        var saveBtn=modal.find(".save-btn");
        var type=modal.find(".edit-type");
        var name=modal.find(".edit-name");
        var bValue=modal.find(".edit-buyVlaue");
        // var Moption=modal.find(".edit-marektValue");
        var Mvalue=modal.find(".edit-marektValue");
        var details=modal.find(".details");
        var notes=modal.find(".notes");

       // var addNew=modal.find(".add-cate");
        var culs=$("[rowid="+EditRow+"]").find("td");
        var cell1=culs[1];
        var cell2=culs[2];
        var cell3=culs[3];
        var cell4=culs[4];


        editBtn.hide();
        saveBtn.attr("hidden",false);

        type.attr("disabled",false);
        name.attr("disabled",false);
        bValue.attr("disabled",false);
        Mvalue.attr("disabled",false);
        details.attr("disabled",false);
        notes.attr("disabled",false);




        saveBtn.on("click",function () {
            editBtn.show();
            saveBtn.attr("hidden",true);

            type.attr("disabled",true);
            name.attr("disabled",true);
            bValue.attr("disabled",true);
            Mvalue.attr("disabled",true);
            details.attr("disabled",true);
            notes.attr("disabled",true);

            cell1.innerHTML=type.val();
            cell2.innerHTML=name.val();
            cell3.innerHTML=bValue.val();
            cell4.innerHTML=Mvalue.val();


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


});


