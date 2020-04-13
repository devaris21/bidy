$(function(){
	// $(this).masonry({
	// 	itemSelector: '.bloc',
	// });

	$('.tab-pane table').footable();


	$(".formPrix").submit(function(event) {
		Loader.start();
		var url = "../../webapp/gestion/modules/configuration/index/ajax.php";
		var formdata = new FormData($(this)[0]);
		var tableau = new Array();
		$(this).find("input[data-id]").each(function(index, el) {
			var id = $(this).attr('data-id');
			var val = $(this).val();
			var item = id+"-"+val;
			tableau.push(item);
		});
		formdata.append('tableau', tableau);
		formdata.append('action', "prix");
		$.post({url:url, data:formdata, contentType:false, processData:false}, function(data){
			if (data.status) {
					window.location.reload();
				}else{
					Alerter.error('Erreur !', data.message);
				}
		}, 'json')
		return false;
	});

})