$(document).ready(function() {

// CONFIG URL API
window.bashUrl = "/app";
window.url = new Array();
window.url["pariwisata_jenis"] = window.bashUrl +"/index.php/tesapi/sub";
window.url["pariwisata_sub_jenis"] = window.bashUrl +"/index.php/Api_sub_pariwisata";
window.url["pariwisata_content"] = window.bashUrl +"/index.php/tesapi/sub";


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
