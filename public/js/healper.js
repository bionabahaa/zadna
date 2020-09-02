var lang;
var message;
var data_table_grid;
var notiAlert = function(type = 'success', title = 'Success', message = '', url = '') {
    $.notify({
        title: '<strong>' + title + '</strong>',
        message: message,
        url: url
    }, {
        type: type,
        placement: {
            from: "bottom",
            align: "left"
        }
    });
};
var timerInterval;
var loading = function(close = false) {
    if (close) {
        swal.close();
    } else {
        timerInterval = swal({
            title: 'إنتظر من فضلك!',
            text: "... جارى تنفيذ العمليه",
            icon: urls.base_url + '/public/images/loading.gif',
            buttons: false

        })
    }
}



var sendPost = function(method, action, data) {
    loading();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: action,
        type: method,
        data: data,
        contentType: false,
        cache: false,
        processData: false,
        success: function(data) {
            // swal({
            //     title: 'Error!',
            //     text: data,
            // });
            loading(true);
            if (data.type == 'success') {
                if (method != "POST") {
                    data_table_grid.ajax.reload();
                }
                //notiAlert('success', 'good Job!', data.message);

                swal({
                    title: "تمت العمليه بنجاح",
                    title: "تمت العمليه بنجاح",
                    text: "سوف يتم إعاده تحميل الصفحه لاجراء التغيرات التى تمت",
                    icon: "success",
                    button: "تم",
                }).then((value) => {
                    location.reload();
                });

            } else {
                var result = data.message;
                if (result.original) {
                    for (var key in result.original.errors) {
                        var div = "<p class='error_massage' style='color:red'>*" + result.original.errors[key] + "</p>";
                        $("#" + key + "_demo").append(div);

                    }
                    notiAlert('warning', 'Warning!', 'someThing wrong');
                } else {
                    if (Array.isArray(result)) {
                        for (var key in result) {
                            var div = "<p class='error_massage' style='color:red'>*" + result[key] + "</p>";
                            $("#" + key + "_demo").append(div);
                        }
                        notiAlert('warning', 'Warning!', 'someThing wrong');
                    } else {
                        notiAlert('warning', 'Warning!', result);
                    }
                }
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            notiAlert('error', 'Error!', 'Coding Error!');
            swal({
                title: 'Error!',
                text: jqXHR,
            });
            console.log(jqXHR);
        }
    });
};
var getPost = function(model) {
    $.ajax({
        url: action,
        type: 'GET',
        data: data,
        contentType: false,
        cache: false,
        processData: false,
        success: function(data) {
            if (data.Error) {
                alert('warning', 'Warning!', 'Something wrong!');
            } else if (data.Success) {
                passData(model);
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert('error', 'Error!', 'Coding Error!');
            swal(jqXHR);
            console.log(jqXHR);
        }
    });
};

var valdition = function(ruels) {
    var returnFun = true;
    var list = document.getElementsByClassName('error_massage');
    var n;
    for (n = 0; n < list.length; ++n) {
        list[n].innerHTML = '';
    }
    for (var k in ruels) {
        // console.log(k);
        var value = $("#" + k).val();
        // var value = document.getElementById("#" + k);
        // console.log(k);
        for (var key in ruels[k]) {
            if (ruels[k][key] == 'required') {
                if (value.trim() == '') {
                    returnFun = false;
                    var div = "<p class='error_massage' style='color:red'>*The " + k + " field is required</p>";
                    $("#" + k + "_demo").append(div);
                    break;
                }
            } else if (ruels[k][key] == 'email') {
                if (!validateEmail(value)) {
                    returnFun = false;
                    var div = "<p class='error_massage' style='color:red'>*Not valied Email</p>";
                    $("#" + k + "_demo").append(div);
                    break;
                }
            } else if (ruels[k][key] == 'number') {
                if (!Number.isInteger(parseInt(value))) {
                    if (!isFloat(parseInt(value))) {
                        returnFun = false;
                        var div = "<p class='error_massage' style='color:red'>*this field must be number</p>";
                        $("#" + k + "_demo").append(div);
                        break;
                    }
                }
            }
        }
    }
    return returnFun;
}

function validateEmail(email) {
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

function isFloat(val) {
    var floatRegex = /^-?\d+(?:[.,]\d*?)?$/;
    if (!floatRegex.test(val))
        return false;

    val = parseFloat(val);
    if (isNaN(val))
        return false;
    return true;
}
var passData = function() {
    $.each(data.data, function(index, val) {
        if (index.includes("_image")) {
            $('#' + index).attr('src', val);
        } else {
            $('#' + index).val(val).change();
        }
    });
    $('#' + model).modal('show');
};
var getData = function(form) {
    var formData = new FormData($("#" + form)[0]);

    // console.log(formData);
    // console.log(formData);
    // $("#" + form).find('textarea').each(function() {
    //     formData.append(this.name, $(this).val());
    // });
    // for (var pair of formData.entries()) {
    //     console.log(pair[0] + ', ' + pair[1]);
    // }
    // return;
    var data = formData;
    return data;
};
var formClean = function(form) {
    $("#" + form)[0].reset();
    $("#" + form + ' select').val('').change();
};
var dataTable = function(form, url, colmuns) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    data_table_grid = $('#' + form).DataTable({
        // destroy: true,
        processing: true,
        serverSide: true,
        searching: true,
        ajax: url,
        columns: colmuns,
        responsive: true,
        ordering: false,
        lengthChange: false,
        pageLength: 5,
        language: {
            'sSearch': "",
            'paginate': {
                'next': ">>",
                'previous': "<<"

            }

        },
        dom: 'Bfrtip',
        buttons: [
            'copy', 'excel', 'pdf'
        ]
    });

    filterChange();
};

var dataTable_search = function(form, url, colmuns) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    data_table_grid = $('#' + form).DataTable({
        destroy: true,
        processing: true,
        serverSide: true,
        searching: true,
        ajax: url,
        columns: colmuns,
        responsive: true,
        ordering: false,
        lengthChange: false,
        pageLength: 5,
        language: {
            'sSearch': "",
            'paginate': {
                'next': ">>",
                'previous': "<<"

            }

        },
        dom: 'Bfrtip',
        buttons: [
            'copy', 'excel', 'pdf'
        ]
    });
};
var dataTable_ajax = function(form, url, colmuns) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    data_table_grid = $('#' + form).DataTable({
        destroy: true,
        processing: true,
        serverSide: true,
        searching: false,
        ajax: url,
        columns: colmuns,
        responsive: true,
        ordering: false,
        lengthChange: false,
        pageLength: 5,
        language: {
            'sSearch': "",
            'paginate': {
                'next': ">>",
                'previous': "<<"

            }

        },
        dom: 'Bfrtip',
        buttons: [
            'copy', 'excel', 'pdf'
        ]
    });
};

var filterChange = function() {
    var filter = $(".dataTables_filter");
    $(".search-div").append(filter);
};

$(document).on("click", ".view-req", function() {
    $(".tab-pane").removeClass("active show");
    $("#req-chat").addClass("active show");
});

$(document).on("click", "#req-back", function() {
    $(".tab-pane").removeClass("active show");
    $("#requests").addClass("active show");
});

///////////////////////////////////////////////////////
$('.saveDateCosts').click(function() {
    var id = $(this).attr("data-id");
    var url_type = urls.base_url + '/operation/' + 'add_costs';

    var method = 'POST';
    var data = getData("CostsAdd" + id);

    data.append('_method', 'POST');
    sendPost(method, url_type, data);
});
$('.delete_costs').click(function() {
    var url_type = "delete_costs";

    var id = $(this).attr("data-id");
    // alert(urls.base_url + '/operation/' + url_type + '/' + id);
    // return;
    var method = 'Delete';
    swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this data!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                var data = { _method: 'DELETE' };
                sendPost('DELETE', urls.base_url + '/operation/' + url_type + '/' + id, data);
            } else {
                swal("Your data is safe!");
            }
        });
});
///////////////////////////////////////////////////////
$('#saveDateNotes').click(function() {
    var url_type = urls.base_url + '/operation/' + 'add_notes';
    var method = 'POST';
    var data = getData("NotesAdd");
    data.append('_method', 'POST');
    sendPost(method, url_type, data);
});
$('.delete_notes').click(function() {
    var url_type = "delete_notes";
    var id = $(this).attr("data-id");
    // alert(urls.base_url + '/operation/' + url_type + '/' + id);
    // return;
    var method = 'Delete';
    swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this data!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                var data = { _method: 'DELETE' };
                sendPost('DELETE', urls.base_url + '/operation/' + url_type + '/' + id, data);
            } else {
                swal("Your data is safe!");
            }
        });
});
///////////////////////////////////////////////////////
$('#saveDateRecommendtions').click(function() {
    var url_type = urls.base_url + '/operation/' + 'add_recommendtions';
    var method = 'POST';
    var data = getData("RecommendtionsAdd");
    data.append('_method', 'POST');
    sendPost(method, url_type, data);
});
$('.delete_recommendtions').click(function() {
    var url_type = "delete_recommendtions";
    var id = $(this).attr("data-id");
    // alert(urls.base_url + '/operation/' + url_type + '/' + id);
    // return;
    var method = 'Delete';
    swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this data!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                var data = { _method: 'DELETE' };
                sendPost('DELETE', urls.base_url + '/operation/' + url_type + '/' + id, data);
            } else {
                swal("Your data is safe!");
            }
        });
});
$('.saveDateReplayRecommendtions').click(function() {
    var id=$(this).attr('data-id');
    var url_type = urls.base_url + '/operation/' + 'add_recommendtions';
    var method = 'POST';
    var data = getData("ReplayRecommendtionsAdd"+id);
    data.append('_method', 'POST');
    sendPost(method, url_type, data);
});
var showRecommendtionDetails = function(id) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("RecommendtionDetails").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", urls.base_url + "/operation/show_recommection_details/" + id, true);
    xhttp.send();
}


//set navbar links to active
$(function($) {
    $(".navbar-nav .nav-link")
        .click(function(e) {
            var link = $(this);

            var item = link.parent("li");

            if (item.hasClass("active")) {
                item.removeClass("active").children("a").removeClass("active");
            } else {
                item.addClass("active").children("a").addClass("active");
            }


        })
        .each(function() {
            var link = $(this);
            if (link.get(0).href === location.href) {
                link.addClass("active").parents("li").addClass("active");
                return false;
            }
        });
});

//set navbar links to active
$(function($) {
    $(".list-group-item")
        .click(function(e) {
            var link = $(this);


            $(".list-group-item").removeClass("active");

        })
        .each(function() {
            var link = $(this);
            if (link.get(0).href === location.href) {
                link.addClass("active").parents(".collapse").prev().addClass("active");
                link.addClass("active").parents(".collapse").addClass("show");
                return false;
            }
        });
});




//  set tab to active
$(function() {
    $("a.nav-link").click(function(e) {
        $(".nav-tabs li").removeClass("active selected");
        $($(this).parent(".nav-item")).addClass("active selected");
    });
});

//repate row
// var add = function(){
//     // var CopyTR = '<tr><td  style="border:0;">' + $(".td-rep").html() + '</td></tr>';
//
//     var CopyTR='' +
//         '<div class="form-group  InputGroup" style="border: 2px inset #ccc"> '+
//         '<input type="text" name="north[]"  class="form-control numric loc" placeholder="شمال  ">'+
//         '<input name="degree[]"  type="text" class="form-control numric loc1" placeholder="درجه">'+
//         '<input name="minute[]"  type="text" class="form-control numric loc1" placeholder="دقيقه">'+
//         '<input name="second[]"  type="text" class="form-control numric loc1" placeholder="ثانيه">'+
//         '</div>'+
//         '<div class="form-group  InputGroup" style="border: 2px inset #ccc"> '+
//         '<input type="text" name="east[]"  class="form-control numric loc" placeholder="شرق ">'+
//         '<input name="degree1[]"  type="text" class="form-control numric loc1" placeholder="درجه">'+
//         '<input name="minute1[]"  type="text" class="form-control numric loc1" placeholder="دقيقه">'+
//         '<input name="second1[]"  type="text" class="form-control numric loc1" placeholder="ثانيه">'+
//         '</div>';
//
//     $(".Ttyps").append(CopyTR);
// }

$(document).on("click",".delete-row",function () {
    $(this).parents("tr").remove();
})



setInterval(function() {
    // console.log(urls.base_url);
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            count_noti();
            document.getElementById("show_noti").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", urls.base_url + '/Noti/' + 'get_noti', true);
    xhttp.send();
}, 3000);

var count_noti = function() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("show_noti_count").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", urls.base_url + '/Noti/' + 'get_noti_count', true);
    xhttp.send();
}
var updateNotiSeen = function() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {}
    };
    xhttp.open("GET", urls.base_url + '/Noti/' + 'update_seen', true);
    xhttp.send();
}