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
	{ "data": "ket_sub_jenis" },
	// { "msg_detail.item": "ket_sub_jenis" } ini salah ,
	{
		"render": function (data, type, JsonResultRow, meta) {
			return '<a href="javascript:void(0)" data-toggle="modal" data-target="#modal_form" data-original-title="Edit" onclick ="update_modal('+JsonResultRow.id_sub+')"><i class="fa fa-pencil text-inverse m-r-10"></i></a>'
			+ '<a href="javascript:void(0)" data-toggle="tooltip" data-original-title="Close"><i class="fa fa-close text-danger"></i></a>'
			;
		}

	}
	]
} );
}
// //error solved

function update_modal(id){
	ID = id;
	save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    console.log("update_modal"+id);

}

function update_save() {
	if($("select[name='id_jenis']").length==0)
	{
		console.log("div gaada");
	}
	var id = ID;
	var id_jenis = $("select[name='id_jenis']").val();
	var ket_sub_jenis = $("textarea[name='ket_sub_jenis']").val();
	var json = {id,id_jenis,ket_sub_jenis};
    //Ajax Load data from ajax
    console.log(ID);
    console.log(json);
    console.log(TableX);
    $.ajax({
    	url : window.url[TableX],
    	type: "PUT",
    	dataType: "JSON",
        headers: {"X-HTTP-Method-Override": "PUT"}, // X-HTTP-Method-Override set to PUT
        data: json,
        beforeSend : function(){
        	console.log("before send");
        },
        success : function(dataObject){
        	if (dataObject.msg_main.status==true) {
        		$('#modal_form').modal('toggle');
        		refreshTableX(TableX);
        		// $(':input').val('');
        	}
        	else{
        		alert("register gagal \n"+ dataObject.msg_detail.item );
        	}

        },
        complete : function(){
        	console.log("loading");

        }
    });
}