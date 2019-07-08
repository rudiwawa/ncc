var TableX;
var ID;
function buildTbody(tableX) {
	TableX=tableX;
	console.log("build TBODY "+tableX);
	var number = 0;
	$('#table_'+tableX).DataTable( {
		"processing": true,
		// "ajax": window.url[tableX],
		"ajax": {url:window.url[tableX],dataSrc: 'msg_detail.item'},//diperbaiki add dataSrc dan lokasi array nya yg ditandai [{}]
		"columns": [
		{ "render": function () {
			number++;
			return number;
		}
	},
	
	{ "data": "ket_jenis" },
	{ "data": "img" },
	// { "msg_detail.item": "ket_sub_jenis" } ini salah ,
	{
		"render": function (data, type, JsonResultRow, meta) {
			return '<a href="javascript:void(0)" data-toggle="modal"  data-original-title="Edit" style="margin : 10px 10px;" onclick ="update_modal('+"'"+JsonResultRow.id_sub+"'"+')"><i class="fa fa-pencil text-inverse m-r-10"></i></a>'
			+ '<a href="javascript:void(0)" data-toggle="tooltip" data-original-title="Close" onclick ="conf_delete('+"'"+JsonResultRow.id_sub+"'"+')"><i class="fa fa-close text-danger"></i></a>'
			;
		}

	}
	]
} );
}
// //error solved

function update_modal(id){
	ID = id;
	$( "#divmodals" ).load( "./assets/contents/modal/"+TableX+"_update.php", function() {
                        // $('#form')[0].reset(); // reset form on modals
                $('.form-group').removeClass('has-error'); // clear error class
                $('.help-block').empty(); // clear error string
                console.log("insert_modal");
                $('#modal_form_update').modal('show');
                $.when(ket_jenis_get()).then(function( x ) {
                	$(function() {
                		$('#save').click(function(e) {
                			e.preventDefault();
                			var data = new FormData(document.getElementById("form"));
                			console.log(data);
                			console.log($('#img').prop('files')[0]);
                			$.ajax({
                				url 			:window.url[TableX], 
                				type: "PUT",
                				dataType: "JSON",
                				mimeType:"multipart/form-data",
                				headers: {"X-HTTP-Method-Override": "PUT"},
                				secureuri		:false,
                				data			: data,
                				async: false,
                				processData: false,
                				contentType: false,
                				success	: function (data, status)
                				{
                					if(data.status != 'error')
                					{
                						// $('#files').html('<p>Reloading files...</p>');
                						// refresh_files();
                						// $('#title').val('');
                					}
                					alert(data.msg);
                				}
                			});
                			return false;
                		});
                	});
                	console.log("");
                });
            });
}

function insert_modal(){
	$( "#divmodals" ).load( "./assets/contents/modal/"+TableX+"_insert.php", function() {
		$.when(ket_jenis_get()).then(function( x ) {
                $('#form')[0].reset(); // reset form on modals
                $('.form-group').removeClass('has-error'); // clear error class
                $('.help-block').empty(); // clear error string
                console.log("insert_modal");
                $('#modal_form_insert').modal('show');
            });
	});

}



function insert_save() {
	var id_jenis = $("select[name='id_jenis']").val();
	var ket_sub_jenis = $("textarea[name='ket_sub_jenis']").val();
	var json = {id_jenis,ket_sub_jenis};
    //Ajax Load data from ajax
    console.log(json);
    console.log(TableX);
    $.ajax({
    	url : window.url[TableX],
    	type: "POST",
    	dataType: "JSON",
    	data: json,
    	beforeSend : function(){
    		console.log("before send");
    	},
    	success : function(dataObject){
    		if (dataObject.msg_main.status==true) {
    			$('#modal_form_insert').modal('toggle');

                // $(':input').val('');
            }
            else{
            	alert("register gagal \n"+ dataObject.msg_detail.item );
            }

        },
        complete : function(){
        	console.log("loading");
        	refreshTableX(TableX);
            // swal("Sukses", "Data berhasil di Update", "success");

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
	var json = {id};
	$.ajax({
		url : window.url[TableX],
		type: "DELETE",
		dataType: "JSON",
        headers: {"X-HTTP-Method-Override": "DELETE"}, // X-HTTP-Method-Override set to PUT
        data: json,
        beforeSend : function(){
        	console.log("before send");
        },
        success : function(dataObject){
        	if (dataObject.msg_main.status==true) {
                // swal("Sukses", "Data berhasil di Hapus", "success");
            }
            else{
            	swal("Error", "Data tidak berhasil di Hapus", "error");
            }

        },
        complete : function(){
        	console.log("loading");
        	refreshTableX(TableX);


        }
    });
}



