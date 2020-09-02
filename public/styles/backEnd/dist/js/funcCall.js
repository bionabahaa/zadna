$(document).ready(function () {
    $(".mainTable tbody ").paginate({
        'perPage': 5
    });
    $('[data-toggle="popover"]').popover();


//set any number min=0
  $("input[type=number]").attr("min","0");

    $(document).on("click", ".export-excel", function (){
        var table = $(this).parents(".Tparent").find(".mainTable");
        table.table2excel({
            exclude: ".actions",
            name: "Worksheet Name",
            filename: "zadnafile" //do not include extension
        });

    });


    //view chat tap 
    $(document).on("click", ".view-notes", function () {
        $(".tab-pane").removeClass("active show");
        $("#notes-chat").addClass("active show");
    })

    $(document).on("click", "#notes-back", function () {
        $(".tab-pane").removeClass("active show");
        $("#notes").addClass("active show");
    })

    $(document).on("click", ".view-req", function () {
        $(".tab-pane").removeClass("active show");
        $("#req-chat").addClass("active show");
    })

    $(document).on("click", "#req-back", function () {
        $(".tab-pane").removeClass("active show");
        $("#requests").addClass("active show");
    })
    $(document).on("click", ".view-plane", function () {
        $(".tab-pane").removeClass("active show");
        $("#plane-view").addClass("active show");
    })

    $(document).on("click", "#plane-back", function () {
        $(".tab-pane").removeClass("active show");
        $("#plane").addClass("active show");
    })


    $(document).on("click", ".btn-cancel", function () {
        $($(this).parents(".modal")[0]).modal("hide");
    })



    $(document).on("mouseover", ".notesTable td", function () {
        $(this).attr("title", $(this).find("input").val());
    });



    $(function () {

        $(".select2").select2();


    });

    //hide check modal
    $(document).on("click", ".Send", function () {
        $(this).parents(".modal").modal("hide");
    });


    $(document).on("click", ".execut", function () {
        if ($(this).hasClass("fa-check-circle")) {
            $(this).removeClass("fa-check-circle");
            $(this).addClass("fa-times-circle");
            $(this).css("color", "red");
        } else if ($(this).hasClass("fa-times-circle")) {
            $(this).removeClass("fa-times-circle");
            $(this).addClass("fa-check-circle");
            $(this).css("color", "greenyellow");

        }
    })

    //l rad 3ala l tawsya
    $(document).on("click", ".state", function () {
        var modal = $(this).parents(".Tparent").find("#sendRepModal");
        var row = $(this).parents("tr");

        var Rowid = row.attr("rowid");
        modal.attr("viewrow", Rowid);

    });


    $(document).on("click", ".solved", function () {
        var modal = $(this).parents(".Tparent").find("#sendRepModal");
        modal.attr("replayState", "solved");
    });

    $(document).on("click", ".not-solved", function () {
        var modal = $(this).parents(".Tparent").find("#sendRepModal");
        modal.attr("replayState", "not-solved");
    });

    $(document).on("click", ".Send", function () {
        var state = $("#sendRepModal").attr("replayState");
        var EditRow = $("#sendRepModal").attr("viewrow");
        var row = $("[rowid=" + EditRow + "]");
        var solved = row.find(".solved");
        var notSolved = row.find(".not-solved");

        if (state == "solved") {
            solved.css("color", "greenyellow");
            notSolved.css("color", "black");
        } else if (state == "not-solved") {
            solved.css("color", "black");
            notSolved.css("color", "red");
        }


    });




    //set tab to active
    $(function () {
        $("a.nav-link").click(function (e) {
            e.preventDefault();
            $("li").removeClass("selected");
            $(this).parents("li").addClass("selected");
        });
    });


    //set list-group-item to active
    // $(function() {
    //     $(".list-group-item").click(function(e) {
    //       e.preventDefault();
    //       $(".list-group-item").removeClass("active");
    //       $(this).addClass("active");
    //     });
    // });  

    //اضافه مواضفات فنيه-اضافه بئر
    $(document).on("click", ".addNewRow2", function () {

        var table = $(this).parents(".Tparent").find(".mainTable");
        var modal = $(this).parents(".Mparent").find(".modal");
        modal.attr("currtable", table.attr("tableId"));
        modal.find("input").val("");

        var savebtn = modal.find(".save-Medit");
        savebtn.addClass("btnSave");
        savebtn.removeClass("save-Medit");
        modal.find(".modal-title").text("اضافه");


    });

    $(document).on("click", ".addNewRow", function () {

        var table = $(this).parents(".Tparent").find(".mainTable");
        var modal = $(this).parents(".Tparent").find(".modal");
        modal.attr("currtable", table.attr("tableId"));
        modal.find(".col-val").val("");
        modal.find(".col-val2").val([]).trigger("change");

        var savebtn = modal.find(".save-Medit");
        savebtn.addClass("btnSave");
        savebtn.removeClass("save-Medit");
        modal.find(".modal-title").text("اضافه");


    });




    $(document).on("click", ".addOneRow", function () {

        var table = $(this).parents(".Tparent").find(".mainTable");
        var modal = $(this).parents(".Tparent").find(".modal");
        modal.attr("currtable", table.attr("tableId"));
        modal.find("input").val("");
        modal.find("textarea").val("");




    });



    //edaft collapse tables
    $(document).on("click", ".btnSave", function () {
        var modalID = $(this).parents(".Mparent").find(".modal").attr("id");
        var modal = $($(this).parents(".modal")[0]);
        var table = $("[tableid=" + modal.attr("currtable") + "]");
        var ele = '<i class="fas fa-eye view-row" title="View" data-toggle="modal" data-target=#' + modalID + '></i>';

        savenew(ele, " ", modal, table);
        modal.show();


    });

    //replace row on collapse tables
    $(document).on("click", ".btnReplace", function () {
        var modalID = $(this).parents(".Mparent").find(".modal").attr("id");
        var modal = $(this).parents(".modal");
        var table = $("[tableid=" + modal.attr("currtable") + "]");
        var ele = '<i class="fas fa-eye view-row" title="View" data-toggle="modal" data-target=#' + modalID + '></i>';
        table.find("tbody tr").remove();

        savenew(ele, " ", modal, table);


    });



    //edaft row to taghez l jura tables 
    $(document).on("click", ".saveJura", function () {
        var modalID = $(this).parents(".Tparent").find(".modal").attr("id");
        var modal = $($(this).parents(".modal")[0]);
        var table = $("[tableid=" + modal.attr("currtable") + "]");
        var ele = '<i class="fas fa-eye view-row" title="View" data-toggle="modal" data-target=#' + modalID + '></i>';

        savenew(ele, " ", modal, table);
        var td = $(table.find("tr:last td:last").prev());
        td.find(".form-group").remove();
        td.html('<a href="#" class="" data-toggle="modal" data-target="#addres">أضافة </a>');


    });


    //add new row to notes 
    $(document).on("click", ".SaveNote", function () {
        var viewchat = $(this).parents(".Tparent").find(".modal").attr("view-chat");
        var modal = $(this).parents(".modal");
        var table = $("[tableid=" + modal.attr("currtable") + "]");
        var ele = '<i class="fas fa-eye view-row ' + viewchat + '"></i>';

        savenew(ele, "", modal, table);
        var sendTd = $(table.find("tr:last td")[6]);
        sendTd.find("input").val("مرسله");
        console.log(sendTd.find("input").val());
        sendTd.attr("hidden", true);


    })

    //add view tab name 
    $(document).on("click", ".SaveNew", function () {
        var viewTab = $(this).parents(".Tparent").find(".modal").attr("view-tab");
        var modal = $(this).parents(".modal");
        var table = $("[tableid=" + modal.attr("currtable") + "]");
        var ele = '<i class="fas fa-eye view-row ' + viewTab + '"></i>';
        savenew(ele, "", modal, table);


     
    })


    //add new row contains a view link(maintain)
    $(document).on("click", ".Saverecom", function () {
        var viewLink = $(this).parents(".Tparent").find(".modal").attr("page-link");
        var modal = $($(this).parents(".modal")[0]);
        var table = $("[tableid=" + modal.attr("currtable") + "]");
        var ele = '<a class="text-dark" href=' + viewLink + '><i class="fas fa-eye view-row"></i></a>';

        savenew(ele, "", modal, table);


    })


    $(document).on("click", ".view-row", function () {
        var row = $(this).parents("tr");
        var cells = row.find("td input");
        var modal = $(this).parents(".Mparent").find(".modal");


        var savebtn = modal.find(".btnSave");
        var savebtn3 = modal.find(".saveJura");
        savebtn3.addClass("save-Medit");
        savebtn3.removeClass("saveJura");
        savebtn.addClass("save-Medit");
        savebtn.removeClass("btnSave");
        savebtn = modal.find(".save-Medit");

        var sLoc = modal.find("select.col-val2").select2();

        var inloc = modal.find(".col-val");

        var Rowid = row.attr("rowid");
        modal.attr("viewrow", Rowid);

        modal.find(".modal-title").text("تعديل");


        //لتعديل جدول الغلاف الخارجي للمواسير
        if (modal.attr("id") == "addModal") {
            var value1 = ($(cells[2]).val()).split("_");
            cells[2].value = value1[0];

            var value2 = ($(cells[3]).val()).split("_");
            cells[3].value = value2[0];


            cells.splice(3, 0, value1[1]);
            cells.splice(5, 0, value2[1]);

            ViewRow(cells, sLoc, inloc);
            cells[2].value = value1[0] + '_' + value1[1];
            cells[4].value = value2[0] + '_' + value2[1];
        }

        //لتعديل جدول خطة الري
        else if (modal.attr("id") == "addPlaneModal") {
            var value1 = ($(cells[4]).val()).split("_");
            cells[4].value = value1[0];
            cells.splice(5, 0, value1[1]);

            ViewRow(cells, sLoc, inloc);
            cells[4].value = value1[0] + '_' + value1[1];

        }
        //لتعديل جدول خطة الري
        else if (modal.attr("id") == "addDateModal2" || modal.attr("id") == "addDateModal3") {
            var value1 = ($(cells[3]).val()).split("_");
            cells[3].value = value1[0];
            cells.splice(5, 0, value1[1]);

            ViewRow(cells, sLoc, inloc);
            cells[3].value = value1[0] + '_' + value1[1];

        }
        //لتعديل تجهيز الجوره-احلال
        else if (modal.attr("id") == "addjura1") {
            var value1 = ($(cells[1]).val()).split("_");
            cells[1].value = value1[0];
            cells.splice(2, 0, value1[1]);

            ViewRow(cells, sLoc, inloc);
            cells[1].value = value1[0] + '_' + value1[1];

        }
        //لتعديل جدول الغلاف الخارجي للمواسير
        else if (modal.attr("id") == "addjura4") {
            var value1 = ($(cells[1]).val()).split("_");
            cells[1].value = value1[0];

            var value2 = ($(cells[2]).val()).split("_");
            cells[2].value = value2[0];


            cells.splice(2, 0, value1[1]);
            cells.splice(4, 0, value2[1]);

            ViewRow(cells, sLoc, inloc);
            cells[1].value = value1[0] + '_' + value1[1];
            cells[3].value = value2[0] + '_' + value2[1];
        } else {
            ViewRow(cells, sLoc, inloc);

        }






        $(document).on("click", ".save-Medit", function () {

            var modal = $($(this).parents(".modal")[0]);

            savechanges(modal);
            savebtn.addClass("btnSave");
            savebtn.removeClass("save-Medit");

        })


    });







    $(document).on("click", ".edit-btn", function () {
        var edit = $(this);
        // var save=$("#save-edit");
        var savebtn = $(this).parents(".tab-pane").find(".save-edit-tabs");
        var list = $(this).parents(".tab-pane").find(".list-group-item");
        var inputs = $(this).parents(".tab-pane").find(".td-edit");
        inputs.attr("disabled", false);
        $("#file-1").attr("disabled", false);
        list.attr("contenteditable", true);
        list.css({
            "background": "#fff",
            "color": "black",
        });

        edit.hide();
        // save.attr("hidden",false);
        savebtn.attr("hidden", false);

        savebtn.click(function () {
            inputs.attr("disabled", true);
            $("#file-1").attr("disabled", true);
            list.attr("contenteditable", false);
            list.css({
                "background": "#e9ecef",
                "color": "black",
            });

            edit.show();
            // save.attr("hidden",true);
            savebtn.attr("hidden", true);


        })


    });

    $(document).on("click", ".edit-row", function () {
        var row = $(this).parents("tr");
        var td = row.find(".td-input");
        var edit = $(this);
        row.find(".fa-save").attr("hidden", false);
        td.attr("disabled", false);
        edit.attr("hidden", true);
        td.css({
            "box-sizing": "border-box ",
            "border": "2px inset #ccc",
            "border-radius": "4px",
            "padding": " 7px"

        });
    });

    $(document).on("click", ".fa-save", function () {
        var row = $(this).parents("tr");
        var save = $(this);
        var td = row.find(".td-input");

        row.find(".edit-row").attr("hidden", false);
        td.attr("disabled", true);
        save.attr("hidden", true);
        td.css({
            "border": "none",
            "border-radius": "0",
            "padding": " 0"

        });

    });


});










//save new row for any page contain wells or collapsed table
function savenew(viewEle, Ele2, modal, table) {

    var cellsNum = table.find("th").length;
    var inputs = modal.find(".col-val");
    var invals = [];
    var final = [];

    if (modal.hasClass("less-culs")) {
        var i = 0;
        inputs.each(function () {

            if ($(this).hasClass("unit")) {
                invals[i] = invals[i - 1] + '_' + $(this).val();

                invals.splice(i - 1, 1);
                i--;

            } else {
                invals[i] = $(this).val();

            }
            i++;


        });
        //            inputs.each(function () {
        //                invals.push($(this).val());
        //            });
        console.log(invals);
        addRow("11", table.find("tbody"), cellsNum - 1, invals, viewEle, Ele2);
    } else {
        var i = 0;


        inputs.each(function () {

            if ($(this).hasClass("unit")) {
                invals[i] = invals[i - 1] + '_' + $(this).val();

                invals.splice(i - 1, 1);
                i--;

            } else {
                invals[i] = $(this).val();

            }
            i++;


        });





        console.log(invals);

        addRow("11", table.find("tbody"), cellsNum, invals, viewEle, Ele2);

    }

    modal.modal("hide");

}