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
	{ 
        "render": function (data, type, JsonResultRow, meta) {
            return '<img src="'+window.bashUrl+"/uploads/"+JsonResultRow.img+'" alt="..." class="img-thumbnail style="width:200px;">'
        }
},
	// { "msg_detail.item": "ket_sub_jenis" } ini salah ,
	{
		"render": function (data, type, JsonResultRow, meta) {
			return '<a href="javascript:void(0)" data-toggle="modal"  data-original-title="Edit" style="margin : 10px 10px;" onclick ="update_modal('+"'"+JsonResultRow.id_jenis+"'"+')"><i class="fa fa-pencil text-inverse m-r-10"></i></a>'
			+ '<a href="javascript:void(0)" data-toggle="tooltip" data-original-title="Close" onclick ="conf_delete('+"'"+JsonResultRow.id_jenis+"'"+')"><i class="fa fa-close text-danger"></i></a>'
			;
		}

	}
	]
} );
}
// //error solved

function update_modal(id){
	ID = id;
    console.log("ID    "+id)
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
                			var mydata = new FormData(document.getElementById("form"));
                            console.log(mydata);
                            console.log("id "+ID);
                            console.log($('#img').prop('files')[0]);
                			// var file_data = $('#img').prop('files')[0];
                			mydata.append('id_jenis', id); 
                			$.ajax({
                				url 			:"http://192.168.86.219/app/index.php/Api_jenis_pariwisata/update", 
                				type: "POST",
                				dataType: "json",
                				// mimeType:"multipart/form-data",
                				// headers: {"X-HTTP-Method-Override": "PUT"},
                				data			: mydata,
                				async: false,
                				processData: false,
                				contentType: false,
                				beforeSend : function(){
                					console.log("before send");
                					// $("#content").append('')
                				},
                				success	: function (dataObject)
                				{
                					if(dataObject.status != 'error')
                					{
                						console.log("sukses");
                					}
                				},
                				complete : function(){
                					console.log("complete");
                                    $('#modal_form_update').modal('toggle');
                                    refreshTableX(TableX);
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

function get_placehorder(id) {
    var json = {id};
    var data;
    console.log("get_placehorder"+id)
    $.ajax({
        url : window.url["data_byId"],
        type: "POST",
        dataType: "JSON",
        data: json,
        beforeSend : function(){
            console.log("before send get_placehorder");
        },
        success : function(dataObject){
            if (dataObject.msg_main.status==true) {
                data = dataObject.msg_detail.item;
                console.log("sukses get Placehorder"+data[0].ket_jenis);
                // $( "#ket_jenis_select :option[value='2']" ).remove();
                $("#ket_jenis").append("");
                $("textarea[name='ket_sub_jenis']").val(data[0].ket_sub_jenis);
                console.log(data[0].id_sub);

                // console.log("placehorder");
            }
            else{
                alert("get data gagal \n"+ dataObject.msg_detail.item );
            }

        },
        complete : function(){
            console.log("loading");
            // $("select[name='id_jenis']").hide().html(data).fadeIn('fast');

        }
    });
    
}


