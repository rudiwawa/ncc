var TableX;
var ID;
// IMAGE CONFIG
var Blob;
var img = new Array();
img["width"] = 1024 ;
img["height"] = 768 ;

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
$('#divmodals').on('hidden.bs.modal', function () {
    $('#divmodals div').remove(); 
    // refreshTableX(TableX);
	console.log("modal hidden");
    Blob = null;
})
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
        Blob = null;
        $("#img").change(function () {
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
                    console.log($('#img').prop('files')[0]);
                    if (Blob!=null) {
                        mydata.append('img', Blob,"aaaa.jpg");
                    }
                    mydata.append('id_jenis', id);
                    $.ajax({
                        url: window.url["pariwisata_jenis"] + "/update",
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
                                swal("Berhasil!", "Update data berhasil!", "success");
                                $('#modal_form_update').modal('toggle');
                                window.url["scroll"] = $(window).scrollTop();
                                refreshTableX(TableX);



                            } else {
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
                            var body = $("html, body");
                            body.stop().animate({ scrollTop: window.url["scroll"] }, 1000, 'swing', function () {
                                console.log("Finished animating");
                            });
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
        $("#img").change(function () {
            readURL(this);
        });
        $.when(ket_jenis_get()).then(function (x) {
            $(function () {
                $('#save').click(function (e) {
                    e.preventDefault();
                    var mydata = new FormData(document.getElementById("form"));
                    console.log(mydata);
                    if (Blob!=null) {
                        mydata.append('img', Blob,"aaaa.jpg");
                    }
                    // console.log($('#img').prop('files')[0]);
                    // console.log(Blob);
                    // var file_data = $('#img').prop('files')[0];
                    // mydata.append('id_jenis', id); 
                    $.ajax({
                        url: window.url["pariwisata_jenis"],
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
                                swal("Berhasil!", "Insert data berhasil!", "success");
                                $('#modal_form_update').modal('toggle');
                                refreshTableX(TableX, 1);
                                // $(':input').val('');
                            } else {
                                swal("Kesalahan!", "Silahkan cek kembali form!", "error");
                                //FORM VALIDATION
                                $(".text-danger").html("");
                                var form_validation_msg = dataObject.msg_detail.item[0];
                                var upload_msg = dataObject.msg_detail.item[1];
                                var is_image_exist = dataObject.msg_detail.item[0];
                                var form_validation_msg = dataObject.msg_detail.item[1];
                                var upload_msg = dataObject.msg_detail.item[1];
                                set_msg_error(is_image_exist)
                                set_msg_error(form_validation_msg)
                                set_msg_error(upload_msg)
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
function set_msg_error(data) {
    $.each(data, function (key, value) {
        key = key.replace('[', '');
        key = key.replace(']', '');
        if (value !== null) {
            console.log($('.' + 'text-danger.' + key).html(value));
        }
    })
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
                swal("Sukses", "Data berhasil di Hapus", "success");
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
                $('.image_view').attr('src', "/app/uploads/" + data[0].img);
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
    // var avatar = document.getElementById("avatar");
    var image = document.getElementById('image');
    var $alert = $('.alert');
    var $modal = $('#modal_crop');
    console.log("READ URL");
    var cropper;
    // $modal.modal('toggle');
    $('[data-toggle="tooltip"]').tooltip();
    var files = input.files;
    // console.log(files);
    var done = function (url) {
        input.value = '';
        image.src = url;
        $alert.hide();
        $modal.modal('show');
        console.log("PPP");
    };
    var reader;
    var file;
    var url;
    console.log(files);

    if (files) {
        file = files[0];
        console.log(file);

        if (URL) {
            done(URL.createObjectURL(file));
        } else if (FileReader) {
            reader = new FileReader();
            reader.onload = function (e) {
                done(reader.result);
            };
            reader.readAsDataURL(file);
        }
    }

    $modal.on('shown.bs.modal', function () {
        cropper = new Cropper(image, {
            aspectRatio: 4 / 3,
            viewMode: 3,
        });
    }).on('hidden.bs.modal', function () {
        console.log("cropper destroy");
        cropper.destroy();
        cropper = null;
    });

    document.getElementById('crop').addEventListener('click', function () {
        // var initialAvatarURL;
        var canvas;
        // var reader = new FileReader();

        $modal.modal('hide');
        console.log(cropper.cropped);
        if (cropper.cropped) {
             canvas = cropper.getCroppedCanvas({
                width: img["width"],
                height: img["height"],
                // imageSmoothingQuality: 'low',
            });
            // initialAvatarURL = avatar.src;
            // console.log(canvas);
            console.log(canvas);
            // console.log(avatar.src);
            // $progress.show();
            // $alert.removeClass('alert-success alert-warning');
            // avatar.src = canvas.toDataURL("image/jpg", 0.7);

            canvas.toBlob(function (blob) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('.image_view').attr('src', e.target.result);
                }
                reader.readAsDataURL(blob);
                // console.log(blob);
                Blob = blob;
            },'image/jpeg',
            0.7
            );
            
        }
    });
}

