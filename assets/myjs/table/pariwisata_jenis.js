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
            {
                "render": function (data, type, JsonResultRow, meta) {
                    return '<img src="' + window.bashUrl + "/uploads/" + JsonResultRow.img + '" alt="..." class="img-thumbnail style="width:200px;">'
                }
            },
            // { "msg_detail.item": "ket_sub_jenis" } ini salah ,
            {
                "render": function (data, type, JsonResultRow, meta) {
                    return '<button class="btn btn-info edit_jenis"  style="width: 40px; margin-right : 5px;" onclick ="update_modal(' + "'" + JsonResultRow.id_jenis + "'" + ')"><i class="fa fa-pencil-square-o"></i></button>'
                        + '<button class="btn btn-danger delete_jenis" style="width: 40px;" onclick ="conf_delete(' + "'" + JsonResultRow.id_jenis + "'" + ')"><i class="fa fa-trash-o"></i></a>'
                        ;
                }

            }
        ]
    });
}
// //error solved

function update_modal(id) {
    $('.edit_jenis').prop('disabled', true);//mencegah error
    ID = id;
    console.log("ID    " + id)
    $("#divmodals").load("./assets/contents/modal/" + TableX + "_update.php", function () {
        // $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        console.log("insert_modal");
        $('#modal_form_update').modal('show');
        //preview image
        $("#img").change(function() {
            readURL(this);
          });

        $.when(get_placehorder(id)).then(function (x) {
            $(function () {
                $('#save').click(function (e) {
                    e.preventDefault();
                    var mydata = new FormData(document.getElementById("form"));
                    console.log(mydata);
                    console.log("id " + ID);
                    console.log($('#img').prop('files')[0]);
                    // var file_data = $('#img').prop('files')[0];
                    mydata.append('id_jenis', id);
                    $.ajax({
                        url: "http://192.168.86.219/app/index.php/Api_jenis_pariwisata/update",
                        type: "POST",
                        dataType: "json",
                        // mimeType:"multipart/form-data",
                        // headers: {"X-HTTP-Method-Override": "PUT"},
                        data: mydata,
                        async: false,
                        processData: false,
                        contentType: false,
                        beforeSend: function () {
                            console.log("before send");
                            // $("#content").append('')
                        },
                        success: function (dataObject) {
                            if (dataObject.msg_main.status == true) {
                                $('#modal_form_update').modal('toggle');
                                refreshTableX(TableX, 1);
                                // $(':input').val('');
                            } else {
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
                            console.log("complete");
                            // $('#modal_form_update').modal('toggle');
                            // refreshTableX(TableX);
                        }
                    });
                    return false;
                });
            });
            console.log("");
            $('.edit_jenis').prop('disabled', false);
        });
    });
}

function insert_modal() {
    $("#divmodals").load("./assets/contents/modal/" + TableX + "_update.php", function () {
        // $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        console.log("insert_modal");
        $('#modal_form_update').modal('show');
        $("#img").change(function() {
            readURL(this);
          });
        $.when(ket_jenis_get()).then(function (x) {
            $(function () {
                $('#save').click(function (e) {
                    e.preventDefault();
                    var mydata = new FormData(document.getElementById("form"));
                    console.log(mydata);

                    console.log($('#img').prop('files')[0]);
                    // var file_data = $('#img').prop('files')[0];
                    // mydata.append('id_jenis', id); 
                    $.ajax({
                        url: "http://192.168.86.219/app/index.php/Api_jenis_pariwisata",
                        type: "POST",
                        dataType: "json",
                        // mimeType:"multipart/form-data",
                        // headers: {"X-HTTP-Method-Override": "PUT"},
                        data: mydata,
                        async: false,
                        processData: false,
                        contentType: false,
                        beforeSend: function () {
                            console.log("before send");
                            // $("#content").append('')
                        },
                        success: function (dataObject) {
                            if (dataObject.msg_main.status == true) {
                                $('#modal_form_update').modal('toggle');
                                refreshTableX(TableX, 1);
                                // $(':input').val('');
                            } else {
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
                            console.log("complete");
                            // $('#modal_form_update').modal('toggle');

                        }
                    });
                    return false;
                });
            });
            console.log("");
        });
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

function get_placehorder(id) {
    var json = { id };
    var data;
    console.log("get_placehorder" + id)
    $.ajax({
        url: window.url["data_byId_jenis"],
        type: "POST",
        dataType: "JSON",
        data: json,
        beforeSend: function () {
            console.log("before send get_placehorder");
            console.log(json);
        },
        success: function (dataObject) {
            if (dataObject.msg_main.status == true) {
                data = dataObject.msg_detail.item;
                console.log("sukses get Placehorder" + data[0].ket_jenis);
                $("#ket_jenis").val(data[0].ket_jenis);
                // $(".image_view").append('<img src="/app/uploads/'+data[0].img+'" class="rounded" alt="..." style = "width:200px;"></img>');
                $('.image_view').attr('src', "/app/uploads/"+data[0].img );
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


function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      
      reader.onload = function(e) {
        $('.image_view').attr('src', e.target.result);
      }
      
      reader.readAsDataURL(input.files[0]);
    }
  }
  
 