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



	$(".formExigence").submit(function(event) {
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
		formdata.append('action', "exigence");
		$.post({url:url, data:formdata, contentType:false, processData:false}, function(data){
			if (data.status) {
				window.location.reload();
			}else{
				Alerter.error('Erreur !', data.message);
			}
		}, 'json')
		return false;
	});



	$("button.autoriser").click(function(event) {
		var url = "../../webapp/gestion/modules/configuration/index/ajax.php";
		button = $(this);
		employe_id = $(this).attr("employe");
		role_id = $(this).attr("role");

		alerty.confirm("Vous êtes sur le point d'autoriser cet accès à cet employe, voulez-vous continuer ?", {
			title: "Autoriser l'acces",
			cancelLabel : "Non",
			okLabel : "OUI, autoriser",
		}, function(){
			$.post(url, {action:"autoriser", employe_id:employe_id, role_id:role_id}, (data)=>{
				if (data.status) {
					Alerter.success('Reussite !', "L'employé a maintenant cet acces !");
					button.addClass('btn-primary');
					button.removeClass('btn-white');
				}else{
					Alerter.error('Erreur !', data.message);
				}
			},"json");
		})
	});


		$("button.refuser").click(function(event) {
		var url = "../../webapp/gestion/modules/configuration/index/ajax.php";
		button = $(this);
		employe_id = $(this).attr("employe");
		role_id = $(this).attr("role");

		alerty.confirm("Vous êtes sur le point de refuser cet accès à cet employe, voulez-vous continuer ?", {
			title: "Bloquage d'accès",
			cancelLabel : "Non",
			okLabel : "OUI, refuser",
		}, function(){
			$.post(url, {action:"refuser", employe_id:employe_id, role_id:role_id}, (data)=>{
				if (data.status) {
					Alerter.success('Reussite !', "L'employé a maintenant cet acces !");
					button.removeClass('btn-primary');
					button.addClass('btn-white');
				}else{
					Alerter.error('Erreur !', data.message);
				}
			},"json");
		})
	});



})