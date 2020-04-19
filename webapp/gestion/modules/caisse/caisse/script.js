$(function(){
	$("div[data-toggle=buttons] label").click(function(event) {
		Loader.start();
		$("div[data-toggle=buttons] label").removeClass('active');
		$(this).addClass('active');

		var url = "../../webapp/gestion/modules/caisse/caisse/ajax.php";
		var jour = $(this).attr("jour");
		var formdata = new FormData();
		formdata.append('jour', jour);
		formdata.append('action', "filtrer");
		$.post({url:url, data:formdata, contentType:false, processData:false}, function(data){
			$("tbody.tableau").html(data);
			Loader.stop();
		}, 'html')
	});
})