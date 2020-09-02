$(document).ready(function () {
    $(".zadnatable tbody ").paginate({'perPage': 5});

    //add a row to table
    $(document).on("click", "#save-user", function () {
       var Table=$(this).parents(".Tparent").find(".zadnatable") ;
        var LastId=Table.find("tbody tr:last").attr("rowid");
        var newID=parseInt(LastId) + 1;
        var cul1 = '<td>' + 33 + '</td>';
        var cul2 = '<td>' + $(".user-name").val() + '</td>';
        var cul3 = '<td>'+ $(".user-job").val() +'</td>';
        var cul4 = '<td>'+ $(".hire-date").val() +'</td>';
        var cul5 = "<td class=\"query-td\"><i class=\"fas fa-trash-alt delete-icon\" title=\"Delete\"></i>\n" +
            "                            <i class=\"fas fa-eye view-row\" title=\"View\"  data-toggle=\"modal\" data-target=\"#viewUserModal\"></i></td>\n";
        var row = '<tr rowid='+newID +'>' + cul1 + cul2 + cul3 + cul4 + cul5 + '</tr>';
        Table.find("tbody").append(row);
        Table.find("tbody").data('paginate').kill();
        Table.find("tbody").paginate({'perPage': 5});
        $("#exampleModalLong").modal("hide");

    });

    $(document).on("click", ".view-row", function () {
        var row = $(this).parents("tr");
        var Rowid=row.attr("rowid");
        $("#viewUserModal").attr("viewrow",Rowid);
        $(".Viewuser-name").val(row.find("td")[1].innerHTML);
        $(".Viewuser-job").val(row.find("td")[2].innerHTML);
        $(".Viewhire-date").val(row.find("td")[3].innerHTML);


    });
    //
    // $(document).on("click", ".edit-btn", function () {
    //     var editBtn=$(this);
    //     var modal=editBtn.parents(".modal");
    //     var EditRow=modal.attr("viewrow");
    //     var saveBtn=modal.find(".save-btn");
    //     var name=modal.find(".Viewuser-name");
    //     var job=modal.find(".Viewuser-job");
    //     var date=modal.find(".Viewhire-date");
    //     var email=modal.find(".user-mail");
    //
    //
    //     // var addNew=modal.find(".add-cate");
    //     var culs=$("[rowid="+EditRow+"]").find("td");
    //     var cell1=culs[1];
    //     var cell2=culs[2];
    //     var cell3=culs[3];
    //
    //
    //
    //     editBtn.hide();
    //     saveBtn.attr("hidden",false);
    //
    //
    //     name.attr("disabled",false);
    //     job.attr("disabled",false);
    //     date.attr("disabled",false);
    //     email.attr("disabled",false);
    //
    //
    //
    //     saveBtn.on("click",function () {
    //         editBtn.show();
    //         saveBtn.attr("hidden",true);
    //
    //         name.attr("disabled",true);
    //         job.attr("disabled",true);
    //         date.attr("disabled",true);
    //         email.attr("disabled",true);
    //         cell1.innerHTML=name.val();
    //         cell2.innerHTML=job.val();
    //         cell3.innerHTML=date.val();
    //
    //
    //     })
    //
    //
    // });


});