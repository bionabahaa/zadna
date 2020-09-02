$(document).ready(function () {

    $(".mainTable tbody ").paginate({'perPage': 5});


    $(document).on("click", ".addNewRow", function (){
         var parent = $(this).parents(".Tparent");
         var table = parent.find(".mainTable");
         var modal=parent.find(".modal");
        modal.attr("currtable",table.attr("tableId"));
        modal.find("input").val("");
    });

    $(document).on("click", ".edit-row", function (){
        var row=$(this).parents("tr");
        Edittable(row,$(this));

    });



    $(document).on("click", ".btnSave", function (){
        var modal=$(this).parents(".modal");
        var table=$("[tableid="+  modal.attr("currtable") +"]");
        var TBody=table.find("tbody");


        var cellsNum=table.find("th").length;
        var inputs=modal.find("input");
        var inputsVal=[];

        for(var i=0 ; i<inputs.length;i++){
            inputsVal[i]=inputs[i].value ;
        }

        addRow(TBody ,cellsNum , inputsVal);


        modal.modal("hide");
        TBody.data('paginate').kill();
        TBody.paginate({'perPage': 5});

    });


    $(document).on("click", ".edit-btn", function (){
        var edit=$(this);
        var save=$("#save-edit");
        $(".radio-enabled").attr("disabled",false);
        $("#madona input").attr("disabled",false);
        $("#madona input").css({
            "box-sizing": "border-box ",
            "border": "2px inset #ccc",
            "border-radius": "4px",

        });


        edit.hide();
        save.attr("hidden",false);

        save.click(function () {
            $(".radio-enabled").attr("disabled",true);
            $("#madona input").attr("disabled",true);
            $("#madona input").css({
                "box-sizing": "border-box ",
                "border": "0",

            });



            edit.show();
            save.attr("hidden",true);

        })


    });





});

