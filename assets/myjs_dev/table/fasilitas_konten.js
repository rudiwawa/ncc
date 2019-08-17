var TableX;
// Flag["pariwisata_konten"] = true;
var dataAll = new Array();
var ID, is_img_valid = false, is_data_update = false;
var files = new Array();
var idc = 0, id_alamat_input = 1, is_update = false, id_update, index_update;
var imgArr_update = new Array(), imgArr_deleted = new Array();

// IMAGE CONFIG
var jumlah_maksimal_photo = 3;
var img = new Array();
img["width"] = 1024;
img["height"] = 768;


var c = 0;
function buildTbody(tableX) {
	TableX = tableX;
	// console.log("build TBODY " + tableX);

	$.ajax({
		url: window.url[tableX],
		beforeSend: function () {
			// console.log("before send");
		},
		success: function (dataObject) {
			if (dataObject.msg_main.status == true) {
				dataAll = dataObject.msg_detail.item;
				render_Tbody(dataAll);
				// render_Tbody(dataAll);
			}
			else {
				swal("Error", "Data tidak berhasil di Hapus", "error");
			}

		},
		complete: function () {
			// console.log("loading");

		}
	});
	// console.log("anjing");

}

function render_Tbody(params) {
	is_data_update = false;
	// console.log("render_Tbody");
	// console.log(params);
	var number = 0;
	$('#table_' + TableX).DataTable({
		processing: true,
		// "ajax": window.url[tableX],
		data: params,//diperbaiki add dataSrc dan lokasi array nya yg ditandai [{}]
		columns: [
			{
				"render": function () {
					number++;
					return number;
				}
			},
			{
				"render": function (data, type, JsonResultRow, meta) {
					// console.log(JsonResultRow);
					return JsonResultRow.ket_main +
						'<br>' + '<span class="text-info"> <small>' +
						JsonResultRow.ket_jenis +
						'</small></span>' +
						' | ' + '<span class="text-muted"><small>' +
						JsonResultRow.ket_sub_jenis +
						'</small></span>';
				}
			},

			{
				"render": function (data, type, JsonResultRow, meta) {
					return '<ol class="custom-counter">' + get_detail(JsonResultRow.detail, "alamat") + '</ol>';
				}
			},
			{
				"render": function (data, type, JsonResultRow, meta) {
					return get_detail(JsonResultRow.detail, "official_account");
				}
			},
			{
				"render": function (data, type, JsonResultRow, meta) {
					// console.log(JsonResultRow);

					idc++;
					return get_image_collection(JsonResultRow.img);
				}
			},
			// { "msg_detail.item": "ket_sub_jenis" } ini salah ,
			{
				"render": function (data, type, JsonResultRow, meta) {
					return '<button class="btn btn-info edit_jenis"  style="width: 40px; margin-right : 5px;" onclick ="update_modal(' + "'" + (number - 1) + "'" + ')"><i class="fa fa-pencil-square-o"></i></button>'
						+ '<button class="btn btn-danger delete_jenis" style="width: 40px;" onclick ="conf_delete(' + "'" + (number - 1) + "'" + ')"><i class="fa fa-trash-o"></i></a>'
						;
				}

			}
		]
	});
}
// //error solved
function get_image_collection(data) {
	var img_open = '<div id="carousel' + idc + '" class="carousel slide" data-ride="carousel">' +
		'<ol class="carousel-indicators">';
	var img_open_1 = '<li data-target="#carousel' + idc + '" data-slide-to="0" class="active"></li>';
	var img_open_2 = '</ol>' +
		'<div class="carousel-inner" role="listbox">';

	var img_close = ' </div>' +
		'<a class="carousel-control-prev" href="#carousel' + idc + '" role="button" data-slide="prev">' +
		'  <span class="carousel-control-prev-icon" aria-hidden="true"></span>' +
		'  <span class="sr-only">Previous</span>' +
		'</a>' +
		'<a class="carousel-control-next" href="#carousel' + idc + '" role="button" data-slide="next">' +
		'  <span class="carousel-control-next-icon" aria-hidden="true"></span>' +
		'  <span class="sr-only">Next</span>' +
		'</a>' +
		' </div>';
	var data = JSON.parse(data);
	var result = "";
	// ["jpi_1.jpg","jpi_2.jpg","jpi_3.jpg"]
	var a = '<div class="carousel-item">';
	var aa = '<div class="carousel-item active">';
	var b = '</div>';
	var is_first = true;
	var count = 0;
	data.forEach(element => {
		var img = '<img src="' + window.bashUrl + "/uploads/" + element + '" alt="a" class="d-block w-100" style="width:100%;">'
		if (is_first) {
			var result_tmp = aa + img + b;
			is_first = false;
		}
		else {
			img_open_1 = img_open_1 + '<li data-target="#carousel' + idc + '" data-slide-to="' + count + '"></li>';

			var result_tmp = a + img + b;
		}
		count++;
		result += result_tmp;
		// console.log(result_tmp);
	});
	// console.log("IMG OPEN 1=" + img_open_1);
	// console.log(result);
	return img_open + img_open_1 + img_open_2 + result + img_close;
	//
}
function get_detail(data, i) {
	var data = JSON.parse(data);
	// console.log(data);
	switch (i) {
		case "alamat":
			var tmp = ""
			$.each(data.alamat, function (i, item) {
				tmp += '<li class="list-group-item border-0 bg-transparent pt-1 pb-1">' + item.alamat + item.loc + "</li>";
			});
			return '<ul class="list-group ">' + tmp + "<ll>";

		case "official_account":
			var tmp = ""
			tmp += '<small class="text-muted">Website </small>' + '<li class="list-group-item border-0 bg-transparent pt-1 pb-1">' + data.website + "</li>";
			tmp += '<small class="text-muted">Telp </small>' + '<li class="list-group-item border-0 bg-transparent pt-1 pb-1">' + data.tlp + "</li>";
			tmp += '<small class="text-muted">Email </small>' + '<li class="list-group-item border-0 bg-transparent pt-1 pb-1">' + data.email + "</li>";

			return '<ul class="list-group ">' + tmp + "<ul>";

		case "tlp":
			return data.tlp;
		case "website":
			return data.website;
		case "email":
			return data.email;
		case "ket":
			return data.ket;
		// case 
	}
	// console.log(data.alamat[0].alamat);
}




function update_modal(id) {
	// console.log("dataAll");
	// console.log(dataAll);
	id_update = dataAll[id].id_fasilitas;
	index_update = id;
	is_update = true;
	insert_modal();
}
$('#modal_konten').on('hidden.bs.modal', function (e) {
	// alert($('#modal_form_update').hasClass('show'));
	if (e.handled !== true) {
		e.handled = true;
		jenis_sub = null;
		//memastikan bahwa event dilakukan sekali saja;
		$('#modal_konten div').remove();
		// console.log("modal hidden");
		is_update = false;
		// $("#content").empty();
		// $("#modal_konten").empty();
		if (is_data_update) {
			$.when(refreshTableX(TableX)).done(function (x) {
				var body = $("html, body");
				body.stop().animate({ scrollTop: window.url["scroll"] }, 1000, 'swing', function () {
					// console.log("Finished animating");
				});
			});
		}
		return;
	}
})

function insert_modal() {
	window.url["scroll"] = $(window).scrollTop();
	id_alamat_input = 1;
	files = new Array();
	imgArr_update = new Array();
	imgArr_deleted = new Array();
	$("#modal_konten").load("./assets/contents/modal/" + TableX + "_insert.php", function () {
		// $('#form')[0].reset(); // reset form on modals
		$('.form-group').removeClass('has-error'); // clear error class
		$('.help-block').empty(); // clear error string
		// console.log("insert_modal");
		$('#modal_form_update').modal('show');
		$("#img_temp").change(function () {

			readURL(this);
		});

		if (is_update) {
			$('.modal-title').text("Update Konten Fasilitas");
			get_placehorder(index_update);
		} else {
			$('.modal-title').text("Insert Konten Fasilitas");
			ket_sub_byId(null);
		}
		// return true;
		$(function () {
			// var tmp_firstIdJen =$("#id_jenis").prop("selectedIndex", 0).val();
			// console.log("tmp_firstIdSub" + window.url["tmp_firstIdjenis"]);
			// ket_sub_get(window.url["tmp_firstIdjenis"]);
			$('#save').click(function (e) {
				e.preventDefault();
				var mydata = new FormData(document.getElementById("form"));
				// console.log(mydata);
				files.forEach(element => {
					mydata.append('img[]', element, "aaa.jpg");
				});
				var url_temp;
				if (is_update) {
					imgArr_update.forEach(element => {
						// console.log(element);
						mydata.append('img_update[]', element);
						// console.log(imgArr_deleted);
					});
					mydata.append('id', id_update);
					imgArr_deleted.forEach(element => {
						mydata.append('imgArr_deleted[]', element);
					});
					// mydata.append("img_update[]", imgArr_update);
					url_temp = window.url[TableX] + "/update";


				} else {
					url_temp = window.url[TableX];
				}



				// mydata.append('c[]', files[1]);
				// mydata.append('"c[]"', files[1]);
				// var fileList = files;
				// console.log(files);
				// console.log(mydata);
				// console.log($('#img').prop('files'));
				// var file_data = $('#img').prop('files')[0];
				// mydata.append('id_jenis', id); 
				$.ajax({
					url: url_temp,
					type: "POST",
					dataType: "json",
					// mimeType:"multipart/form-data",
					// headers: {"X-HTTP-Method-Override": "PUT"},
					data: mydata,
					async: false,
					processData: false,
					contentType: false,
					timeout: 1000,
					beforeSend: function () {
						// console.log("before send");
						// $loading.show();

						// $("#content").append('')
					},
					success: function (dataObject) {
						if (dataObject.msg_main.status == true) {
							if (is_update) {
								swal("Update!", "Update data berhasil!", "success");
							} else {
								swal("Insert!", "Insert data berhasil!", "success");
							}
							$('#modal_form_update').modal('toggle');
							is_data_update = true;
							// refreshTableX(TableX, 1);
							// $(':input').val('');
						} else {
							//FORM VALIDATION
							swal("Ups!", "Periksa kembali form anda", "error");
							$(".text-danger").html("");
							var is_image_exist = dataObject.msg_detail.item[0];
							var form_validation_msg = dataObject.msg_detail.item[1];
							var upload_msg = dataObject.msg_detail.item[1];
							set_msg_error(is_image_exist);
							set_msg_error(form_validation_msg);
							set_msg_error(upload_msg);

							// $.each(form_validation_msg, function (key, value) {
							// 	key = key.replace('[', '');
							// 	key = key.replace(']', '');
							// 	if (value !== null) {
							// 		console.log($('.' + 'text-danger.' + key).html(value));
							// 	}
							// })
							// $.each(upload_msg, function (key, value) {
							// 	if (value !== "") {
							// 		$('.' + 'text-danger.' + key).html(value);
							// 	}
							// })

						}
					},
					complete: function (xmlhttprequest, textstatus, message) {
						// $loading.hide();
						// if(textstatus==="timeout") {
						// 	alert(textstatus); //run function here!
						// } else {
						// alert(textstatus);
						// }
						// console.log("complete");

						// $('#modal_form_update').modal('toggle');

					}, timeout: 3000
					
				});
				// return false;
			});
		});

		// console.log("");

	});
}


function conf_delete(id) {
	window.url["scroll"] = $(window).scrollTop();
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
	// id_update = dataAll[id].id_pariwisata;

	var json = { "id": dataAll[id].id_fasilitas };
	$.ajax({
		url: window.url[TableX],
		type: "DELETE",
		dataType: "JSON",
		headers: { "X-HTTP-Method-Override": "DELETE" }, // X-HTTP-Method-Override set to PUT
		data: json,
		beforeSend: function () {
			// console.log("before send");
		},
		success: function (dataObject) {
			if (dataObject.msg_main.status == true) {
				is_data_update = true;
				$.when(refreshTableX(TableX)).done(function (x) {
					var body = $("html, body");
					body.stop().animate({ scrollTop: window.url["scroll"] }, 1000, 'swing', function () {
						// console.log("Finished animating");
					});
				});
				// swal("Sukses", "Data berhasil di Hapus", "success");
			}
			else {
				swal("Error", "Data tidak berhasil di Hapus", "error");
			}

		},
		complete: function () {
			// console.log("loading");
			// if (is_data_update) {

			// }


		}
	});
}

function get_placehorder(id) {
	// dataAll
	var data = new Array();
	data[0] = dataAll[id];
	// console.log("sukses get Placehorder" + data[0].ket_jenis);
	// $( "#ket_jenis_select :option[value='2']" ).remove();
	
	$("#ket_main").val(data[0].ket_main);
	$("#deskripsi").val(get_detail(data[0].detail, "ket"));
	$("#tlp").val(get_detail(data[0].detail, "tlp"));
	$("#email").val(get_detail(data[0].detail, "email"));
	$("#website").val(get_detail(data[0].detail, "website"));
	$.when(ket_sub_byId(data[0].id_jenis)).done(function (x) {
		$("select[name='id_jenis'] option[value=" + data[0].id_jenis + "]").attr("selected", "selected");
		$("select[name='id_sub'] option[value=" + data[0].id_sub + "]").attr("selected", "selected");
		// $("select[name='id_jenis']").append("<option value=" + data[0].id_jenis + " selected >" + data[0].ket_jenis + "</option>");
		// ket_sub_get(data[0].id_jenis);
		// $("select[name='id_sub']").append("<option value=" + data[0].id_sub + " selected >" + data[0].ket_sub_jenis + "</option>");
	});
	render_alamat_from_db(data[0].detail);
	imgArr_update = JSON.parse(data[0].img);
	render_img_from_db();
	// console.log(data[0].id_sub);


}

function render_alamat_from_db(data) {
	var dataArr = JSON.parse(data);
	var is_first = true, i = 0;
	dataArr.alamat.forEach(element => {
		// console.log("ALAMAT LOKASI" + element.loc + element.alamat);
		if (is_first) {
			is_first = false;
		} else {
			add_form_alamat();
		}
		$("#loc_input_" + i).val(element.loc);
		$("#alamat_input_" + i).val(element.alamat);
		i++;
	});
}

function render_img_from_db() {
	// console.log("render_img_from_db ");
	// $("#image_preview_array img").remove();
	// $("#image_preview_array button").remove();
	var id = 0;
	// console.log(imgArr_update);
	imgArr_update.forEach(element => {
		$("#image_preview_array").append('<div class="show-image"><img src="' + window.bashUrl + "/uploads/" + element + '" class="rounded image_view p-1" alt="..." style="width:100%;">' +
			'<button type="button" class="btn btn-danger btn-sm dell "  onclick="dell_img_update(' + id + ')" style="position:absolute;"><i class="ti-minus text"></i></button></div>')
		id++;
	});

}

function dell_img_update(i) {
	imgArr_deleted.push(imgArr_update[i]);
	imgArr_update.splice(i, 1);
	render_img_All();
}


// the Hell make change ga bisa
$(document.body).delegate('#id_jenis', 'change', function () {
	ket_sub_byId($(this).val());
	// console.log($(this).val());
});
var jenis_sub;
function ket_sub_byId(id) {
	// console.log(jenis_sub == null)
	if (jenis_sub == null) {
		 $.when(ket_jenis_sub_get()).done(function (x) {
			return render_sub();
		});
	} else {
		return render_sub();
	}
	// console.log(id);

	function render_sub() {
		if (id == null) {
			ket_sub_byId(window.url["tmp_firstIdjenis"]);
		} else {
			// console.log(jenis_sub);
			const result = jenis_sub.filter(function (element) { return element.id_jenis == id; })
			$('#id_sub').empty();
			$.each(result, function (key, value) {
				$("select[name='id_sub']").append("<option value=" + value.id_sub + ">" + value.ket_sub_jenis + "</option>");
				// console.log(value.id_jenis + "  " + value.ket_jenis);
			});
		}
	}
	// console.log(ket_jenis_sub_get);
}
function ket_jenis_sub_get() {

	return $.ajax({
		url: window.url["ket_jenis_sub_get"],
		beforeSend: function () {
			// console.log("before send get_placehorder");
		},
		success: function (dataObject) {
			if (dataObject.msg_main.status == true) {
				$('#ket_jenis_select').empty();
				jenis_sub = dataObject.msg_detail.item;
				var is_insert = false;
				var tmp_value = new Array();
				$.each(jenis_sub, function (key, value) {
					// console.log(tmp_value != value);
					// console.log(tmp_value + "|" + value.id_jenis);

					if (!tmp_value.includes(value.id_jenis)) {
						$("select[name='id_jenis']").append("<option value=" + value.id_jenis + ">" + value.ket_jenis + "</option>");
						// console.log(value.id_jenis + "  " + value.ket_jenis);
						if (is_insert == false) {
							window.url["tmp_firstIdjenis"] = value.id_jenis;
							is_insert = true;
						}
						tmp_value.push(value.id_jenis);
					}

				});
			}
			else {
				return false;
				alert("register gagal \n" + dataObject.msg_detail.item);
			}

		},
		complete: function () {
			// console.log("loading");
		}
	});

}

function render_img_All() {
	readURL_array(files);
	// console.log(files);
	render_img_from_db();
}


// function readURL(input) {
// 	if (input.files && input.files[0]) {
// 		var reader = new FileReader();

// 		reader.onload = function (e) {
// 			$('.image_view').attr('src', e.target.result);
// 		}

// 		reader.readAsDataURL(input.files[0]);
// 	}
// }

var id_form_alamat = 1;
function add_form_alamat() {
	var html_loc = '<div class="form-group col-lg-4">' +
		'<label>(Latitude &amp; Longitude)</label>' +
		'<input type="text" name="loc[]" id="loc_input_' + id_alamat_input + '"' +
		'class="form-control form-control-line"></input>' +
		'<a id="msg_loc_faskes" style="color: red;"></a>' +
		'</div>';
	var html_alamat = '<div class="form-group col-lg-7">' +
		'<label>Alamat Lengkap</label>' +
		'<input name="alamat[]" id="alamat_input_' + id_alamat_input + '"' +
		'class="form-control form-control-line"></>' +
		'<a id="msg_alamat_faskes" style="color: red;"></a>' +
		'</div>';
	var html_bt_alamat = '<div class="col-lg-1">' +
		'<div style="margin-top: 2em;">' +
		'<button type="button"  class="btn btn-danger btn-sm dell" style="">' +
		'<i class="ti-minus text"></i>' +
		'</button>' +
		'</div>' +
		'</div>';
	id_alamat_input++;
	// console.log("add_form_alamat");
	$("#form_alamat").append('<div class="col-lg-12 row" id="form_alamat' + id_form_alamat + '">' +
		html_loc + html_alamat + html_bt_alamat +
		'</div>').ready(function () {
			// var selection = $('#form_alamat' + id_form_alamat + '.dell').html();
			// console.log('#form_alamat'+id_form_alamat+".dell");
			// console.log($('#form_alamat'+id_form_alamat+" .dell").html());
			$('#form_alamat' + id_form_alamat + " .dell").attr('onClick', "dell_form_alamat(" + id_form_alamat + ")");
			// console.log("#form_alamat" + id_form_alamat + ".btn");
			id_form_alamat++;
		});


}

function set_msg_error(data) {
	$.each(data, function (key, value) {
		key = key.replace('[', '');
		key = key.replace(']', '');
		if (value !== null) {
			$('.' + 'text-danger.' + key).html(value);
		}
	})
}

function dell_form_alamat(id) {
	$('#form_alamat' + id).remove();
	// console.log("dell_form_alamat");
}

// $("#img_temp").change(function () {
// 	readURL(this);

// });

var tmp_file_0;
var boolean_before_set

function readURL(input) {

	// var avatar = document.getElementById("avatar");
	var image = document.getElementById('image');
	var $alert = $('.alert');
	var $modal = $('#modal_crop');
	// console.log("READ URL");
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
		// console.log("PPP");
	};
	var reader;
	var file;
	var url;
	// console.log(files);

	if (files) {
		file = files[0];
		// console.log(file);

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
		// console.log("cropper destroy");
		cropper.destroy();
		cropper = null;
	});

	$( "#crop" ).click(function() {
		// var initialAvatarURL;
		var canvas;
		// var reader = new FileReader();

		$modal.modal('hide');
		// console.log(cropper.cropped);
		if (cropper.cropped) {
			canvas = cropper.getCroppedCanvas({
				width: img["width"],
				height: img["height"],
				// imageSmoothingQuality: 'low',
			});
			// initialAvatarURL = avatar.src;
			// console.log(canvas);
			// console.log(canvas);
			// console.log(avatar.src);
			// $progress.show();
			// $alert.removeClass('alert-success alert-warning');
			// avatar.src = canvas.toDataURL("image/jpg", 0.7);

			canvas.toBlob(function (blob) {
				var reader = new FileReader();
				reader.onload = function (e) {
					$('#avatar').attr('src', e.target.result);
				}
				reader.readAsDataURL(blob);
				// console.log(blob);
				tmp_file_0 = blob;
				// is_img_valid = true;
				$("#add_img").prop('disabled', false);
				boolean_before_set = true;
				// Blob = blob;
			}, 'image/jpeg',
				0.7
			);

		}
	});

	// var img = new Image();

	// var _URL = window.URL || window.webkitURL;


	// $("#add_img").prop('disabled', false);
	// boolean_before_set = true;
	// $("#image_preview img").remove();
	// if (input.files) {
	// 	var filesAmount = input.files.length;
	// 	var reader = new FileReader();

	// 	reader.onload = function (e) {
	// 		$("#image_preview").append('<img src="' + e.target.result + '" class="rounded image_view" alt="..." style="width:480px;">')
	// 		// console.log( "e.target.result" );
	// 		// console.log( e.target.result );
	// 	}
	// 	reader.readAsDataURL(input.files[0]);
	// 	tmp_file_0 = input.files[0];
	// }
	// // CEK IMAGE APAKAH VALID
	// var file, img;
	// if ((file = input.files[0])) {
	// 	img = new Image();
	// 	img.onload = function () {
	// 		if (this.width > config['max_width'] || this.height > config['max_height'] || this.size > config['max_size']) {
	// 			var msg = {
	// 				img: "GAMBAR YANG ANDA MASUKKAN BELUM SESUAI KRITERIA => " +
	// 					"|max_width" + config['max_width'] +
	// 					"|max_height" + config['max_height'] +
	// 					"|max_size" + config['max_size']
	// 			};
	// 			set_msg_error(msg);
	// 		}else {
	// 			var msg = {img:""};
	// 			set_msg_error(msg);
	// 			is_img_valid = true;
	// 		}
	// 	};
	// 	img.onerror = function () {
	// 		alert("not a valid file: " + file.type);
	// 	};
	// 	img.src = _URL.createObjectURL(file);
	// } 
}


function tambah_img() {
	// console.log("add_img_btn");
	var total_img = files.length + imgArr_update.length;
	// console.log(files.length+"|"+imgArr_update.length);
	// if (is_img_valid) {
	if (boolean_before_set) {
		if ((total_img + 1) <= jumlah_maksimal_photo) {
			// console.log("add_img_btn");
			// files.push.apply(input.files[0]);
			files.push(tmp_file_0);
			// readURL_array(files);
			render_img_All();
			boolean_before_set = false;
			$("#add_img").prop('disabled', true);
			c++;
		}
		else {
			swal("Ups!", "Jumlah Gambar maksimal adalah " + jumlah_maksimal_photo, "error");
		}

	}
	// }else{
	// swal("Ups!", "Gambar ERROR, periksa gambar yang telah anda masukkan", "error");
	// }

}





function readURL_array(input) {
	// console.log("readURL_array");
	$("#image_preview_array img").remove();
	$("#image_preview_array button").remove();
	if (input) {
		var filesAmount = input.length;
		// console.log("file amount" + filesAmount);
		var id_img = 0;
		for (i = 0; i < filesAmount; i++) {
			var reader = new FileReader();
			// console.log("file reader run" + i + reader);
			// console.log(input);


			reader.onload = function (e) {
				$("#image_preview_array").append('<div class="show-image"><img src="' + e.target.result + '" class="rounded image_view p-1" alt="..." style="width:100%;">' +
					'<button type="button" class="btn btn-danger btn-sm dell "  onclick="dell_img(' + id_img + ')" style="position:absolute;"><i class="ti-minus text"></i></button></div>')
				id_img++;//krn ini dijalankan terakhir, klo make i yg dipakai nilai i terakhr
				// console.log("e.target.result");
				// console.log(e.target.result );
			}

			reader.readAsDataURL(input[i]);
		}
	}
}

function dell_img(i) {
	files.splice(i, 1);
	// readURL_array(files);
	render_img_All();
}