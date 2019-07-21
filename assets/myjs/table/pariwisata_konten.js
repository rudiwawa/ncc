var TableX;
var ID;
var files = new Array();
var idc = 0, id_alamat_input = 1;


var c = 0;
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
			{
				"render": function (data, type, JsonResultRow, meta) {
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
					return get_detail(JsonResultRow.detail, "alamat");
				}
			},
			{
				"render": function (data, type, JsonResultRow, meta) {
					return get_detail(JsonResultRow.detail, "official_account");
				}
			},
			{
				"render": function (data, type, JsonResultRow, meta) {

					idc++;
					return get_image_collection(JsonResultRow.img);
				}
			},
			// { "msg_detail.item": "ket_sub_jenis" } ini salah ,
			{
				"render": function (data, type, JsonResultRow, meta) {
					return '<button class="btn btn-info edit_jenis"  style="width: 40px; margin-right : 5px;" onclick ="update_modal(' + "'" + JsonResultRow.id_pariwisata + "'" + ')"><i class="fa fa-pencil-square-o"></i></button>'
						+ '<button class="btn btn-danger delete_jenis" style="width: 40px;" onclick ="conf_delete(' + "'" + JsonResultRow.id_pariwisata + "'" + ')"><i class="fa fa-trash-o"></i></a>'
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
		console.log(result_tmp);
	});
	console.log("IMG OPEN 1=" + img_open_1);
	console.log(result);
	return img_open + img_open_1 + img_open_2 + result + img_close;
	//
}
function get_detail(data, i) {
	var data = JSON.parse(data);
	console.log(data);
	switch (i) {
		case "alamat":
			var tmp = ""
			$.each(data.alamat, function (i, item) {
				tmp += '<li class="list-group-item border-0 bg-transparent pt-1 pb-1">' + item.alamat + item.loc + "</li>";
			});
			return '<ul class="list-group ">' + tmp + "<ll>";

		case "official_account":
			var tmp = ""
			tmp += '<li class="list-group-item border-0 bg-transparent pt-1 pb-1">' + data.website + "</li>";
			tmp += '<li class="list-group-item border-0 bg-transparent pt-1 pb-1">' + data.tlp + "</li>";
			tmp += '<li class="list-group-item border-0 bg-transparent pt-1 pb-1">' + data.email + "</li>";

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
	console.log(data.alamat[0].alamat);
}




function update_modal(id) {
	insert_modal();
	$.when(ket_jenis_get()).then(function (x) {
		get_placehorder(id);
	});
}

function insert_modal() {
	id_alamat_input = 1;
	files = new Array();
	$("#divmodals").load("./assets/contents/modal/" + TableX + "_insert.php", function () {
		// $('#form')[0].reset(); // reset form on modals
		$('.form-group').removeClass('has-error'); // clear error class
		$('.help-block').empty(); // clear error string
		console.log("insert_modal");
		$('#modal_form_update').modal('show');
		$("#img_temp").change(function () {
			readURL(this);
		});
		$.when(ket_jenis_get()).then(function (x) {
			// return true;
			$(function () {
				// var tmp_firstIdJen =$("#id_jenis").prop("selectedIndex", 0).val();
				console.log("tmp_firstIdSub" + window.url["tmp_firstIdjenis"]);
				ket_sub_get(window.url["tmp_firstIdjenis"]);
				$('#save').click(function (e) {
					e.preventDefault();
					var mydata = new FormData(document.getElementById("form"));
					console.log(mydata);
					files.forEach(element => {
						mydata.append('img[]', element);
					});



					// mydata.append('c[]', files[1]);
					// mydata.append('"c[]"', files[1]);
					// var fileList = files;
					console.log(files);
					console.log(mydata);
					console.log($('#img').prop('files'));
					// var file_data = $('#img').prop('files')[0];
					// mydata.append('id_jenis', id); 
					$.ajax({
						url: window.url["pariwisata_konten"],
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
								var is_image_exist = dataObject.msg_detail.item[0];
								var form_validation_msg = dataObject.msg_detail.item[1];
								var upload_msg = dataObject.msg_detail.item[1];
								set_msg_error(is_image_exist)
								set_msg_error(form_validation_msg)
								set_msg_error(upload_msg)

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
						complete: function () {
							console.log("complete");
							// $('#modal_form_update').modal('toggle');

						}
					});
					// return false;
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
		url: window.url["data_byId_konten"],
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
				ket_sub_get(data[0].id_jenis);
				$("select[name='id_sub']").append("<option value=" + data[0].id_sub + " selected >" + data[0].ket_sub + "</option>");
				$("#ket_main").val(data[0].ket_main);
				$("#deskripsi").val(get_detail(data[0].detail, "ket"));
				$("#tlp").val(get_detail(data[0].detail, "tlp"));
				$("#email").val(get_detail(data[0].detail, "email"));
				$("#website").val(get_detail(data[0].detail, "website"));
				render_alamat_from_db(data[0].detail);
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

function render_alamat_from_db(data) {
	var dataArr=JSON.parse(data);
	var is_first = true,i=0;
	dataArr.alamat.forEach(element => {
		console.log("ALAMAT LOKASI"+element.loc+element.alamat);
		if(is_first){
			is_first=false;
		}else{
			add_form_alamat();
		}
		$("#loc_input_"+i).val(element.loc);
		$("#alamat_input_"+i).val(element.alamat);
		i++;
	});
}

function get_placehorder_sub(id) {
	var json = { id };
	var data;
	console.log("get_placehorder_sub" + id)
	$.ajax({
		url: window.url["get_sub_byId_jenis"],
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
				console.log("sukses get Placehorder SUBBBB" + data[0].ket_jenis);
				$("#ket_jenis").val(data[0].ket_jenis);
				// $(".image_view").append('<img src="/app/uploads/'+data[0].img+'" class="rounded" alt="..." style = "width:200px;"></img>');
				$('.image_view').attr('src', "/app/uploads/" + data[0].img);
				console.log(data[0].id_sub);

				// console.log("placehorder");
			}
			else {
				console.log("get data gagal \n" + dataObject.msg_detail.item);
			}

		},
		complete: function () {
			console.log("loading");
			// $("select[name='id_jenis']").hide().html(data).fadeIn('fast');

		}
	});

}
// the Hell make change ga bisa
$(document.body).delegate('#id_jenis', 'change', function () {
	ket_sub_get($(this).val());
	console.log($(this).val());
});


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
	console.log("add_form_alamat");
	$("#form_alamat").append('<div class="col-lg-12 row" id="form_alamat' + id_form_alamat + '">' +
		html_loc + html_alamat + html_bt_alamat +
		'</div>').ready(function () {
			// var selection = $('#form_alamat' + id_form_alamat + '.dell').html();
			// console.log('#form_alamat'+id_form_alamat+".dell");
			// console.log($('#form_alamat'+id_form_alamat+" .dell").html());
			$('#form_alamat' + id_form_alamat + " .dell").attr('onClick', "dell_form_alamat(" + id_form_alamat + ")");
			console.log("#form_alamat" + id_form_alamat + ".btn");
			id_form_alamat++;
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

function dell_form_alamat(id) {
	$('#form_alamat' + id).remove();
	console.log("dell_form_alamat");
}

// $("#img_temp").change(function () {
// 	readURL(this);

// });

var tmp_file_0;
var boolean_before_set
function readURL(input) {
	console.log("c " + c);
	console.log(input.files[0]);
	$("#add_img").prop('disabled', false);
	boolean_before_set = true;
	$("#image_preview img").remove();
	if (input.files) {
		var filesAmount = input.files.length;
		var reader = new FileReader();
		reader.onload = function (e) {
			$("#image_preview").append('<img src="' + e.target.result + '" class="rounded image_view" alt="..." style="width:480px;">')
			// console.log( "e.target.result" );
			// console.log( e.target.result );
		}
		reader.readAsDataURL(input.files[0]);
		tmp_file_0 = input.files[0];
		// console.log("IMAGE ORIGINAL");
		// console.log(input.files[0]);
		// console.log(input.files[0]);

		// $("#add_img").click(function (e) {
		// 	if (boolean_before_set) {
		// 		console.log("add_img_btn");
		// 		// files.push.apply(input.files[0]);
		// 		tmp_file_0 = input.files[0];
		// 		readURL_array(files);
		// 		boolean_before_set = false;
		// 		$("#add_img").prop('disabled', true);
		// 		c++;
		// 	}
		// })


	}
}


function tambah_img() {
	console.log("add_img_btn");
	if (boolean_before_set) {
		console.log("add_img_btn");
		// files.push.apply(input.files[0]);
		files.push(tmp_file_0);
		readURL_array(files);
		boolean_before_set = false;
		$("#add_img").prop('disabled', true);
		c++;
	}
}





function readURL_array(input) {
	console.log("readURL_array");
	$("#image_preview_array img").remove();
	$("#image_preview_array button").remove();
	if (input) {
		var filesAmount = input.length;
		console.log("file amount" + filesAmount);
		var id_img = 0;
		for (i = 0; i < filesAmount; i++) {
			var reader = new FileReader();
			console.log("file reader run" + i + reader);
			console.log(input);


			reader.onload = function (e) {
				$("#image_preview_array").append('<div class="show-image"><img src="' + e.target.result + '" class="rounded image_view p-1" alt="..." style="width:100%;">' +
					'<button type="button" class="btn btn-danger btn-sm dell "  onclick="dell_img(' + id_img + ')" style="position:absolute;"><i class="ti-minus text"></i></button></div>')
				id_img++;//krn ini dijalankan terakhir, klo make i yg dipakai nilai i terakhr
				// console.log("e.target.result");
				// console.log(e.target.result );
			}

			console.log(reader.readAsDataURL(input[i]));
		}
	}
}

function dell_img(i) {
	files.splice(i, 1);
	readURL_array(files);
}