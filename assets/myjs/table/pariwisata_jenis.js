function buildTbody(tableX) {
	console.log("build TBODY "+tableX);
	var number = 0;
	$('#table_'+tableX).DataTable( {
		"processing": true,
		"ajax": window.url[tableX],
		"columns": [
		{ "render": function () {
			number++;
			return number;
		}
	},
	{ "data": "id_jenis" },
	{ "data": "ket_sub_jenis" },
		// { "data": "time_update" },
		// { "data": "id_admin" },
		{
			"render": function () {
				return '<a href="javascript:void(0)" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-pencil text-inverse m-r-10"></i></a>'
				+ '<a href="javascript:void(0)" data-toggle="tooltip" data-original-title="Close"><i class="fa fa-close text-danger"></i></a>'
				;
			}

		}
		]
	} );
}