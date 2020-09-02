// var add = function(){
//  var type=' <div class="form-group InputGroup mt-2"><select class="form-control numric select2 typescrop td-edit"style="width: 100%;"><option>1</option><option>7</option></select></div>';
//  var row=' <div class="form-group InputGroup mt-2"><select class="form-control numric select2 typescrop td-edit"style="width: 100%;"><option>1</option><option>7</option></select></div>';
//  var col=' <div class="form-group InputGroup mt-2"><select class="form-control numric select2 typescrop td-edit"style="width: 100%;"><option>1</option><option>7</option></select></div>';

//  $(".types").append(type);
//  $(".sq-row").append(row);
//  $(".sq-col").append(col);

// var CopyTR='<tr>'+document.getElementById('TRCopy').innerHTML+'</tr>';


// var CopyTR ='<tr>'+ $("#TRCopy").html() + '</tr>';
// $(".Ttyps").append(CopyTR);
// // console.log(CopyTR);
// }

var add = function() {
    var CopyTR = '<tr><td  style="border:0;">' + $(".td-rep").html() + '</tr></td>';
    $(".Ttyps").append(CopyTR);
}