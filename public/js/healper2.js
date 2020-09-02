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
            title: 'Wait Please!',
            text: "Permissions assigned Successfully",
            icon: urls.base_url + '/public/images/loading.gif',
            buttons: false

        })
    }

}
var sendPost = function(method, action, data) {
  //  loading();
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
                    title: "Good job!",
                    title: "Good job!",
                    text: "You clicked the button!",
                    icon: "success",
                    button: "Aww yiss!",
                }).then((value) => {
                    location.reload();
                });

            } else {
                //console.log('adsasd');
                var result = data.message;

                if (result.original) {

                    for (var key in result.original.errors) {
                        console.log(key);
                        var div = "<p class='error_massage' style='color:red'>*" + result.original.errors[key] + "</p>";

                        $("#" + key + "_demo").append(div);
                    }
                    //notiAlert('warning', 'Warning!', 'someThing wrong');
                } else {
                    if (Array.isArray(result)) {
                        for (var key in result) {
                            var div = "<p class='error_massage' style='color:red'>*" + result[key] + "</p>";
                            $("#" + key + "_demo").append(div);
                        }
                        //notiAlert('warning', 'Warning!', 'someThing wrong');
                    } else {
                        //notiAlert('warning', 'Warning!', result);
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