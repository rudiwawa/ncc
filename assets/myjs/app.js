$(document).ready(function() {

// CONFIG URL API
window.bashUrl = "/app";
window.url = new Array();
window.url["pariwisata_jenis"] = window.bashUrl +"/index.php/tesapi/sub";
window.url["pariwisata_sub_jenis"] = window.bashUrl +"/index.php/Api_sub_pariwisata";
window.url["pariwisata_content"] = window.bashUrl +"/index.php/tesapi/sub";
window.url["ket_jenis"] = window.bashUrl +"/index.php/Api_sub_pariwisata/ket_jenis";
window.url["data_byId"] = window.bashUrl +"/index.php/Api_sub_pariwisata/data_byId";


// ONCLICK EVENT!
$('#pariwisata_jenis').on('click', function(e) {
	buildTableX("pariwisata_jenis");
});

$('#pariwisata_sub_jenis').on('click', function(e) {
	buildTableX("pariwisata_sub_jenis");
});

$('#pariwisata_content').on('click', function(e) {
	buildTableX("pariwisata_content");
});


});

//render table
function buildTableX(tableX){

	console.log(tableX+" clicked");
	//load table
	$( "#content" ).load( "./assets/contents/table/"+tableX+".php", function() {
		//load modelnya tableX
		$( "#divmodals" ).load( "./assets/contents/modal/"+tableX+".php", function() {
			$.getScript('./assets/myjs/table/'+tableX+'.js', function()
			{
				buildTbody(tableX);
			});
		});

	});
}

function refreshTableX(tableX){
	$( "#content" ).load( "./assets/contents/table/"+tableX+".php", function() {
		//load modelnya tableX
		buildTbody(tableX);
	});
}

function ket_jenis_get() {
	console.log("ket_jenis_get");
	$.ajax({
		url : window.url["ket_jenis"],
		type: "GET",
		dataType: "JSON",
		beforeSend : function(){
			console.log("before send"+"url"+window.url["ket_jenis"]);
		},
		success : function(dataObject){
			if (dataObject.msg_main.status==true) {
				$('#ket_jenis_select').empty(); 
				console.log(dataObject.msg_detail.item);
				var myjson = dataObject.msg_detail.item;
				$.each(myjson, function(key,value){
					$("select[name='id_jenis']").append("<option value="+value.id_jenis+">"+value.ket_jenis+"</option>");
					console.log(value.id_jenis+"  "+value.ket_jenis);
				});
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