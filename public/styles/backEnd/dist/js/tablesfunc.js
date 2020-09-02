var page,Tfilter,MyRows,RowLen;

$(document).ready(function () {
$(".mainTable tbody ").paginate({'perPage': 5});


    $(".filter-form").one("click", function(){
        intial($(this));
    });

    $(".filter2").on("change",function () {
        filter2()

    })

  $(".filter1").on("change",function () {
      var data= $(this).val();
      filter(data);

    })



    $(document).on("click", ".addtype-link", function (){
        var parent=$(this).parents(".newType");
        var list=parent.find(".myUL")

        $(".add-btn").click(function () {
            // colVal.val($("#name-text2").text());
            if ($("#name-text2").val() == '') {

            } else {
                list.prepend("<li class='item'>" + $('#name-text2').val() + "</li>");
            }


        })



    });

    $(document).on('click', '.item', function () {
        var item = $(this).text();
        $(this).parents('.card').find('.col-val').val(item);

    });




// remove row
    $('#deletemodal').on('show', function() {
        var id = $(this).data('id'),
            removeBtn = $(this).find('.danger');
    })
    var tr;
    var tableBody;
//    $('.delete-icon').on('click', function(e) {
    $(document).on("click", ".delete-icon", function (e){
        e.preventDefault();


        var id = $(this).data('id');
        $('#deletemodal').data('id', id).modal('show');
        tr=$(this).parents("tr");
        tableBody = $(this).parents(".zadnatable").find("tbody");


    });

    $('#btnYes').click(function() {
        // handle etion here
        var id = $('#deletemodal').data('id');
        $('[data-id='+id+']').remove();
        $('#deletemodal').modal('hide');
        tr.remove();
        tableBody.data('paginate').kill();
        tableBody.paginate({'perPage': 5});
    });
})

function Edittable(row,editbtn) {
    var savebtn=row.find(".save-edit");
    var td=row.find(".td-input");
    // var date=row.find("input");
    editbtn.attr("hidden",true);
    savebtn.attr("hidden",false);
    td.attr("disabled",false);
    td.css({
    "box-sizing": "border-box ",
        "border": "2px inset #ccc",
    "border-radius": "4px",
        "padding":" 7px"

    });

    savebtn.click(function () {
        editbtn.attr("hidden",false);
        savebtn.attr("hidden",true);
        td.attr("disabled",true);
        td.css({
            "border": "none",
            "border-radius": "0",
            "padding":" 0"

        });

    })



}




function addRow (c,table,cellsNum,inputs,elemnet,elemnet2) {
    var curRow;
    var row;
    var code=" <td >\n" +
            "<div class=\"form-group InputGroup\">\n" +
            "<input type=\"text\" class=\"form-control td-input addon\" value ="+c+" disabled >\n" +
            "\n" +
            "</div>\n" +
            "</td>";
    var actionRow= "<td >"+elemnet2 + elemnet +
        "\n" +"<i class=\"fas fa-check-square save-edit\" hidden></i>"+ "</td>";
       var LastId=$("tr:last").attr("rowid");
        var newID=parseInt(LastId) + 1;
    for(var i=0 ; i<cellsNum-2 ; i++){
        // var col='<td>'+inputs[i].val()+ '</td>';
        var col=" <td >\n" +
            "<div class=\"form-group InputGroup\">\n" +
            "<input type=\"text\" class=\"form-control td-input addon\" value =  " + inputs[i] + " disabled >\n" +
            "\n" +
            "</div>\n" +
            "</td>"
        curRow +=col;

    }
    //handle the read column in the last to tables
    if(table.hasClass("static-col"))
    {
        var readcol='<td >\n' +
            '<p data-toggle="modal" data-target="#MaintainModal" style="text-decoration: underline" >قراءه </p>\n' +
            ' </td>';
        row ='<tr rowid='+newID +'>' + code + curRow + readcol + actionRow + '</tr>';

    }
    else if(table.hasClass("static-col2"))
    {
        var readcol='<td >\n' +
        '<i class="fas fa-times-circle state not-solved" style=" cursor:pointer"></i>'+
       ' <i class="fas fa-check-circle state solved" style="cursor:pointer"></i>'+
       ' <input type="text" class="form-control  td-input addon statues"  disabled hidden></td>';
        row ='<tr rowid='+newID +'>' + code + curRow + readcol + actionRow + '</tr>';

    }  
    
    else if(table.hasClass("static-col3"))
    {
        var readcol='<td ><i class="fas fa-check-circle text-center state mr-3 solved"  data-target="#sendRepModal" data-toggle="modal"></i> '+
                  '<i class="fas fa-times-circle state not-solved"  data-target="#sendRepModal" data-toggle="modal"></i> </td>';
            
        row ='<tr rowid='+newID +'>' + code + curRow + readcol + actionRow + '</tr>';

    }
    else
        {
        row = '<tr rowid='+newID +'>' + code + curRow + actionRow + '</tr>';
    }
    table.append(row);
}


function ViewRow(cells , sLoc,inLoc) {
    var i,j,k=0;
    var c;
  

    // $(sloc[0]).val(c).trigger("change");


    for(i=1; i<=inLoc.length; i++){
        inLoc[i-1].value=cells[i].value;
        console.log("hhhhh",cells[i].value)
    }


    j=i;
    sLoc.each(function () {
        c =($(cells[j]).val()).split(",");
        $(sLoc[k]).val(c).trigger("change");
         j++;
         k++;
     });



}


//save changes
function savechanges(modal) {
    var EditRow = modal.attr("viewrow");
    var cells = $("[rowid=" + EditRow + "]").find("td input");
    var inloc = modal.find(".col-val");
    var sloc=modal.find(".col-val2");
     
    sloc.each(function(){
        inloc.push($(this));
    })

    var invals = [];

    if (inloc.length == 3) {
        inloc.each(function () {
            invals.push($(this).val());
        });
    } else {

        var i = 0;


        inloc.each(function () {

            if ($(this).hasClass("unit")) {
                invals[i] = invals[i - 1] + '_' + $(this).val();

                invals.splice(i - 1, 1);
                i--;

            } else {
                invals[i] = $(this).val();

            }
            i++;


        });


    }




    var i, j;

    for (i = 1, j = 0; j < invals.length; i++, j++) {
        cells[i].value = invals[j];
    }


    modal.modal("hide");

}

//
// function saveEdit(modal) {
//     var EditRow=modal.attr("viewrow");
//     var cells=$("[rowid="+EditRow+"]").find("td input");
//     var sLoc= modal.find( "select.col-val :selected");
//     var inLoc= modal.find( "input.col-val");
//     var areaLoc= modal.find( "textarea.col-val");


//     var i=1,j,k,l,m;

//     sLoc.each(function () {
//         cells[i].value=$(this).val();
//         i++;
//     });


//     for(k=0, j=i ; k<inLoc.length; j++,k++){
//         cells[j].value=inLoc[k].value;
//     }
    
//      for(l=0, m=j ; l<areaLoc.length; l++,m++){
//         cells[m].value=areaLoc[l].value;
//     }
//     modal.modal("hide");

// }

function intial(box) {
    page=box.parents('.Tparent');
    Tfilter=page.find('.mainTable');
    MyRows =Tfilter.find('tbody').find('tr');
    RowLen=MyRows.length;
}


function filter(data) {
    // $(".table tbody tr").remove();
    var TBody=Tfilter.find("tbody");
    Tfilter.find("tbody tr").remove();
    TBody.data('paginate').kill();
    var result=false;
    var found=false;

    TBody.append(MyRows);

    if(data != "الكل") {

        for (var i = 0; i < RowLen; i++) {
            var result = false;
            var found = false;
            $(MyRows[i]).find('td').each(function () {
                var MyIndexValue = $(this).find("input").val();
                if (MyIndexValue == data) {
                    result = true;
                }
                else {
                    result = false;
                }

                found = (found || result);


            })

            if (!found) {
                $(MyRows[i]).remove();
            }


        }

    }
    TBody.paginate({ 'perPage': 5 });
}


function filter2() {
    var TBody=Tfilter.find("tbody");
    Tfilter.find("tbody tr").remove();
    TBody.data('paginate').kill();

    var jobVal= $(".job-filt").val();
    var operatVal=$(".operate-filt").val();

    var jobAtt=$(".job-filt").attr("filtercol");
    var operatAtt=$(".operate-filt").attr("filtercol");
    var x=0;

    TBody.append(MyRows);


    for (var i = 0; i < RowLen; i++) {
        var col=$(MyRows[i]).find("td input");
        if (!( ( jobVal=="الكل" || col[jobAtt].value == jobVal ) &&(operatVal=="الكل" || col[operatAtt].value ==operatVal ) )) {
            $(MyRows[i]).remove();

        }

    }
    TBody.paginate({ 'perPage': 5 });


}
