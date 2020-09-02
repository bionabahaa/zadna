$(document).ready(function () {
    $(document).on("click","#add-notes",function () {
        var table=$(this).parents(".Tparent").find("table");
        var TBody=table.find("tbody");
        var ele="<i class=\"fas fa-edit edit-row\" title=\"View\"></i>";
        var inputs=[];

        var cellsNum=table.find("th").length;

        addRow(TBody ,cellsNum , inputs,ele,"");



        modal.modal("hide");
        TBody.data('paginate').kill();
        TBody.paginate({'perPage': 5});
    })



    $(document).on("click", ".edit-row", function (){
        var row=$(this).parents("tr");
        Edittable(row,$(this));

    });

    $(document).on("click", ".edit-btn", function (){
        var edit=$(this);
        var save=$("#save-edit");
        var td=$(this).parents(".top-form").find("table tbody td");
        var tdin=$(this).parents(".top-form").find("table tbody td input");


        edit.hide();
        save.attr("hidden",false);
        tdin.attr("disabled",false);
        td.attr("contenteditable",true);
        td.css({
            "box-sizing": "border-box ",
            "border": "2px inset #ccc",
            "border-radius": "4px",
            "padding":" 7px"

        });

        save.click(function () {



            edit.show();
            save.attr("hidden",true);
            tdin.attr("disabled",true);
            td.attr("contenteditable",false);
            td.css({
                "border": "none",
                "border-radius": "0",
                "padding":" 7px"

            });


        });





    });

    $(document).on("click", ".state", function (){
        var item=$(this);
        if(item.hasClass("fa-check-circle"))
        {
            item.removeClass("fa-check-circle");
            item.addClass("fa-times-circle");
            item.css("color","red");
        }
        else if(item.hasClass("fa-times-circle"))
        {
            item.removeClass("fa-times-circle");
            item.addClass("fa-check-circle");
            item.css("color","greenyellow");

        }
    });


})