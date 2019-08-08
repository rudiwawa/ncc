var TableX;
var ID;
function buildTbody(tableX) {
    TableX = tableX;
    console.log("build TBODY " + tableX);
    var number = 0;
    $('#table_' + tableX).DataTable({
        "processing": true,
        // "ajax": window.url[tableX],
        "ajax": { url: window.url[tableX], dataSrc: 'msg_detail.item' },//diperbaiki add dataSrc dan lokasi array nya yg ditandai [{}]
        "columns": [
            {
                "render": function () {
                    number++;
                    return number;
                }
            },

            { "data": "ket_jenis" },
            { "data": "ket_sub_jenis" },
            // { "msg_detail.item": "ket_sub_jenis" } ini salah ,
            {
                "render": function (data, type, JsonResultRow, meta) {
                    return '<button class="btn btn-info edit_sub"  style="width: 40px; margin-right : 5px;" onclick ="update_modal(' + "'" + JsonResultRow.id_sub + "'" + ')"><i class="fa fa-pencil-square-o"></i></button>'
                        + '<button class="btn btn-danger delete_sub" style="width: 40px;" onclick ="conf_delete(' + "'" + JsonResultRow.id_sub + "'" + ')"><i class="fa fa-trash-o"></i></button>'
                        ;
                }

            }
        ]
    });
}
// //error solved

function update_modal(id) {
    ID = id;
    $('.edit_sub').prop('disabled', true);
    $("#modal_sub").load("./assets/contents/modal/" + TableX + "_update.php", function () {
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        console.log("insert_modal");
        $('#modal_form_update').modal('show');
        $.when(ket_jenis_get()).then(function (x) {
            get_placehorder(id);
        });
        $('.edit_sub').prop('disabled', false);
    });

    // ID = id;
    // save_method = 'update';
    // $('#form')[0].reset(); // reset form on modals
    // $('.form-group').removeClass('has-error'); // clear error class
    // $('.help-block').empty(); // clear error string
    // console.log("update_modal"+id);
    // $.when(ket_jenis_get()).then(function( x ) {
    //     get_placehorder(id);
    // });
}

function insert_modal() {
    $("#modal_sub").load("./assets/contents/modal/" + TableX + "_insert.php", function () {
        $.when(ket_jenis_get()).then(function (x) {
            $('#form')[0].reset(); // reset form on modals
            $('.form-group').removeClass('has-error'); // clear error class
            $('.help-block').empty(); // clear error string
            console.log("insert_modal");
            $('#modal_form_insert').modal('show');
        });
    });

}

function update_save() {
    if ($("select[name='id_jenis']").length == 0) {
        console.log("div gaada");
    }
    var id_sub = ID;
    var id_jenis = $("select[name='id_jenis']").val();
    var ket_sub_jenis = $("textarea[name='ket_sub_jenis']").val();
    var json = { id_sub, id_jenis, ket_sub_jenis };
    //Ajax Load data from ajax
    console.log(ID);
    console.log(json);
    console.log(TableX);
    $.ajax({
        url: window.url[TableX],
        type: "PUT",
        dataType: "JSON",
        headers: { "X-HTTP-Method-Override": "PUT" }, // X-HTTP-Method-Override set to PUT
        data: json,
        beforeSend: function () {
            console.log("before send");
            $("#content").append('')
        },
        success: function (dataObject) {
            if (dataObject.msg_main.status == true) {
                swal("Berhasil", "Insert data berhasil", "success");
                $('#modal_form_update').modal('toggle');

                // $(':input').val('');
            }
            else {
                swal("Kesalahan!", "Silahkan cek kembali form!", "error");
                //FORM VALIDATION
                $(".text-danger").html("");
                var data = dataObject.msg_detail.item;
                $.each(data, function (key, value) {
                    if (value !== null) {
                        console.log("not null" + key);
                        console.log(('"' + '.text-danger.' + key + '"') + value);

                        $('.' + 'text-danger.' + key).html(value);
                    }
                })
            }

        },
        complete: function () {

            refreshTableX(TableX);
            // swal("Sukses", "Data berhasil di Update", "success");

        }
    });
}

function insert_save() {
    var id_jenis = $("select[name='id_jenis']").val();
    var ket_sub_jenis = $("textarea[name='ket_sub_jenis']").val();
    var json = { id_jenis, ket_sub_jenis };
    //Ajax Load data from ajax
    console.log(json);
    console.log(TableX);
    $.ajax({
        url: window.url[TableX],
        type: "POST",
        dataType: "JSON",
        data: json,
        beforeSend: function () {
            console.log("before send");
        },
        success: function (dataObject) {
            if (dataObject.msg_main.status == true) {
                swal("Berhasil", "Insert data berhasil", "success");
                $('#modal_form_insert').modal('toggle');

                // $(':input').val('');
            }
            else {
                swal("Kesalahan!", "Silahkan cek kembali form!", "error");
                //FORM VALIDATION
                $(".text-danger").html("");
                var data = dataObject.msg_detail.item;
                $.each(data, function (key, value) {
                    if (value !== null) {
                        console.log("not null" + key);
                        console.log(('"' + '.text-danger.' + key + '"') + value);

                        $('.' + 'text-danger.' + key).html(value);
                    }
                })

            }

        },
        complete: function () {
            console.log("loading");
            refreshTableX(TableX, 1);

            // swal("Sukses", "Data berhasil di Update", "success");

        }
    });
}

function get_placehorder(id) {
    var json = { id };
    var data;
    console.log("get_placehorder" + id)
    $.ajax({
        url: window.url["data_byId_sub"],
        type: "POST",
        dataType: "JSON",
        data: json,
        beforeSend: function () {
            console.log("before send get_placehorder");
        },
        success: function (dataObject) {
            if (dataObject.msg_main.status == true) {
                data = dataObject.msg_detail.item;
                console.log("sukses get Placehorder" + data[0].ket_jenis);
                // $( "#ket_jenis_select :option[value='2']" ).remove();
                $("select[name='id_jenis']").append("<option value=" + data[0].id_jenis + " selected >" + data[0].ket_jenis + "</option>");
                $("textarea[name='ket_sub_jenis']").val(data[0].ket_sub_jenis);
                console.log(data[0].id_sub);

                // console.log("placehorder");
            }
            else {
                alert("get data gagal \n" + dataObject.msg_detail.item);
            }

        },
        complete: function () {
            console.log("loading");
            // $("select[name='id_jenis']").hide().html(data).fadeIn('fast');

        }
    });

}

function conf_delete(id) {
    swal("apakah anda yakin ingin menghapus data?", {
        buttons: {
            cancel: "TIDAK",
            catch: {
                text: "Hapus",
                value: "delete",
            },
        },
    })
        .then((value) => {
            switch (value) {

                case "delete":
                    delete_byId(id);
                    break;
                default:
                // swal("cancel");
            }
        });
}

function delete_byId(id) {
    var json = { id };
    $.ajax({
        url: window.url[TableX],
        type: "DELETE",
        dataType: "JSON",
        headers: { "X-HTTP-Method-Override": "DELETE" }, // X-HTTP-Method-Override set to PUT
        data: json,
        beforeSend: function () {
            console.log("before send");
        },
        success: function (dataObject) {
            if (dataObject.msg_main.status == true) {
                // swal("Sukses", "Data berhasil di Hapus", "success");
            }
            else {
                swal("Error", "Data tidak berhasil di Hapus", "error");
            }

        },
        complete: function () {
            console.log("loading");
            refreshTableX(TableX, 1);


        }
    });
}



