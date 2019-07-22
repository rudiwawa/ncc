$(document).ready(function () {


	// CONFIG URL API
	window.bashUrl = "/app";
	window.url = new Array();
	window.url["pariwisata_jenis"] = window.bashUrl + "/index.php/Api_jenis_pariwisata";
	window.url["pariwisata_sub_jenis"] = window.bashUrl + "/index.php/Api_sub_pariwisata";
	window.url["pariwisata_konten"] = window.bashUrl + "/index.php/Api_konten_pariwisata";
	window.url["ket_jenis"] = window.bashUrl + "/index.php/Api_sub_pariwisata/ket_jenis";
	window.url["data_byId_sub"] = window.bashUrl + "/index.php/Api_sub_pariwisata/data_byId";
	window.url["data_byId_jenis"] = window.bashUrl + "/index.php/Api_jenis_pariwisata/data_byId";
	window.url["data_byId_konten"] = window.bashUrl + "/index.php/Api_konten_pariwisata/data_byId";
	window.url["get_sub_byId_jenis"] = window.bashUrl + "/index.php/Api_konten_pariwisata/get_sub_byId_jenis";
	window.url["scroll"];
	window.url["tmp_firstIdjenis"] = "dancok";

	// CONFIG IMAGE
	var config = new Array();
	config['max_size'] = 500;
	config['max_width'] = 600;
	config['max_height'] = 600;

	// ONCLICK EVENT!
	$('#pariwisata_jenis').on('click', function (e) {
		buildTableX("pariwisata_jenis");
	});

	$('#pariwisata_sub_jenis').on('click', function (e) {
		buildTableX("pariwisata_sub_jenis");
	});

	$('#pariwisata_content').on('click', function (e) {
		buildTableX("pariwisata_konten");
	});


});

//render table
function buildTableX(tableX) {

	console.log(tableX + " clicked");
	//load table
	$("#content").load("./assets/contents/table/" + tableX + ".php", function () {
		//load modelnya tableX
		// $( "#divmodals" ).load( "./assets/contents/modal/"+tableX+"_update.php", function() {
		$.getScript('./assets/myjs/table/' + tableX + '.js', function () {
			buildTbody(tableX);
		});
		// });

	});
}

function refreshTableX(tableX) {

	//mencegah scroll saat
	var clientHeight = $('#content').height();
	$('#content').height(clientHeight);
	return $("#content").load("./assets/contents/table/" + tableX + ".php", function () {
		//load modelnya tableX

		// $('#content').height(clientHeight);
		buildTbody(tableX);


	});
}
function refreshTableX(tableX, n) {
	$("#content").load("./assets/contents/table/" + tableX + ".php", function () {
		//load modelnya tableX

		// $('#content').height(clientHeight);
		buildTbody(tableX);
	});
}

function ket_jenis_get() {
	console.log("ket_jenis_get");
	return $.ajax({
		url: window.url["ket_jenis"],
		type: "GET",
		dataType: "JSON",
		beforeSend: function () {
			console.log("before send" + "url" + window.url["ket_jenis"]);
		},
		success: function (dataObject) {
			if (dataObject.msg_main.status == true) {
				$('#ket_jenis_select').empty();
				console.log(dataObject.msg_detail.item);
				var myjson = dataObject.msg_detail.item;
				var is_insert = false;
				$.each(myjson, function (key, value) {
					$("select[name='id_jenis']").append("<option value=" + value.id_jenis + ">" + value.ket_jenis + "</option>");
					console.log(value.id_jenis + "  " + value.ket_jenis);
					if (is_insert==false){
						window.url["tmp_firstIdjenis"] =value.id_jenis;
						is_insert = true;
					}
				});
			}
			else {
				alert("register gagal \n" + dataObject.msg_detail.item);
			}

		},
		complete: function () {
			console.log("loading");

		}
	});
}

function ket_sub_get(id) {
	var json = { id };
	var data;
	console.log("get_placehorder" + id)
	$.ajax({
		url: window.url["get_sub_byId_jenis"],
		type: "POST",
		dataType: "JSON",
		data: json,
		beforeSend: function () {
			console.log("before send get_placehorder");
		},
		success: function (dataObject) {
			if (dataObject.msg_main.status == true) {
				$('#id_sub').empty();
				console.log(dataObject.msg_detail.item);
				var myjson = dataObject.msg_detail.item;
				$.each(myjson, function (key, value) {
					$("select[name='id_sub']").append("<option value=" + value.id_sub + ">" + value.ket_sub_jenis + "</option>");
					console.log(value.id_jenis + "  " + value.ket_jenis);
				});
			}
			else {
				alert("register gagal \n" + dataObject.msg_detail.item);
			}

		},
		complete: function () {
			console.log("loading");
			// $("select[name='id_jenis']").hide().html(data).fadeIn('fast');

		}
	});

}
