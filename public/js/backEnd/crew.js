

var controlTitle = "crews";
var AddformTitle = "form_add_crew";
var EditformTitle = "EditCrewForm";
var tableTitle = "CrewDataTable";
var url = urls.base_url + "/setting/" + controlTitle;

var url_data = urls.base_url + "/setting/data_" + controlTitle;
var url_datanote= urls.base_url + "/setting/data_crewnote/" ;

var ruels = {};


var tableColumn1= [
    { data: 'code', name: 'code' },
    { data: 'note', name: 'note' },
    { data: 'added_from', name: 'added_from' },
    { data: 'job', name: 'job' },
    { data: 'process', name: 'process' },
    { data: 'date', name: 'date' },
    { data: 'option', name: 'option' }
];

var tableColumn2= [
    { data: 'code', name: 'code' },
    { data: 'note', name: 'note' },
    { data: 'added_from', name: 'added_from' },
    { data: 'job', name: 'job' },
    { data: 'process', name: 'process' },
    { data: 'date', name: 'date' },
    { data: 'option', name: 'option' }
];


var tableColumn = [
    { data: 'username', name: 'username' },
    { data: 'role_title', name: 'role_title' },
    { data: 'email', name: 'email' },
    { data: 'option', name: 'option' }
];


var tableColumn_temporary_user = [

    { data: 'username', name: 'username' },
    { data: 'email', name: 'email' },
    { data: 'role_title', name: 'role_title' },
    { data: 'option', name: 'option' }
];


var filter=function ($table,$url) {
    var status=$('#status').val();
    var from=$('#from').val();
    var to=$('#to').val();

    var url=urls.base_url+'/'+$url+'?status='+status+'&date_from='+from+'&date_to='+to;
    dataTable_search($table,url,tableColumn);

}

$(document).ready(function() {
   dataTable(tableTitle, url_data, tableColumn);
    dataTable('DataTable_temporary_user',urls.base_url + "/setting/dataTableTemporery", tableColumn_temporary_user);
    dataTable('Crew_noteDataTable', urls.base_url + "/setting/data_crewnote/"+$('#id').val(), tableColumn1);
});


// $(document).ready(function() {
//     dataTable('DataTable_temporary_user',urls.base_url + "/setting/dataTableTemporery", tableColumn_temporary_user);
// });

//
// $(document).ready(function() {
//     dataTable('Crew_noteDataTable', urls.base_url + "/setting/data_crewnote/"+$('#id').val(), tableColumn1);
// });

$('#notes-tab').on('click',function () {
    // alert(urls.base_url + "/setting/data_crewnote/"+$('#id').val());
    dataTable_search('Crew_noteDataTable',urls.base_url + "/setting/data_crewnote/"+$('#id').val(), tableColumn1);
});


$('#add_user_permanent').on('click',function () {
    $('#form_add_tempory_user').trigger("reset");
})



function remove_user($user_id){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type:'post',
        url:url+'/'+'block_user',
        data:{user_id:$user_id},
        dataType:'json',
        success:function(data){
            swal({

                title: data.title +data.username,
                text: data.text,
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {

                        swal( data.success +  data.username , {
                            icon: "success",
                        });
                        location.href=location.pathname;
                    } else {
                        swal("تم الغاء عمليه ")+data.cancle;
                    }
                });

        } ,
        error:function(error){
            alert('eero');
        }

    });
}

$('#SubmitButton').click(function() {
    if (valdition(ruels)) {
        var id = document.getElementById('id').value;
        if (id == '') {
            var data = getData(AddformTitle);
            sendPost('POST', url, data);
        } else {
            var data = getData('EditCrewForm');
            data.append('_method', 'PATCH');
            sendPost('POST', url + '/' + id, data);
        }

    }
});


$('#SubmitButton_temporary_user').click(function() {
    if (valdition(ruels)) {
            var data = getData('form_add_tempory_user');
            sendPost('POST', urls.base_url+'/setting/temporaryUser/store', data);

    }
});

$('#SubmitButton_edit_temporary_user').on('click',function () {
    if (valdition(ruels)) {
        var data = getData('EditCrewForm');
        sendPost('POST', urls.base_url + "/setting/temporaryUser/update", data);

    }
})

$('#SubmitButton_addnote').click(function() {



    if (valdition(ruels)) {
            var data = getData('form_add_note');
            sendPost('POST', urls.base_url + "/setting/editcrew/add_note", data);
    }

});
$('#button_addNote').on('click',function () {
    $('#form_add_note')[0].reset();
    $('#note').val('');
})

function editNote(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type:'get',
        url:urls.base_url + "/setting/note/"+id+"/edit",
        dataType:'json',
        success:function(data){
            $('#note_id').val(data.userNote.id);
            $('#note').text(data.userNote.note);
            $('#job').val(data.userNote.job);
            $('#process').val(data.userNote.process);
            $('#date').val(data.userNote.date);
        } ,
        error:function(error){
            alert('error');
        }

    });
}


