

$(function(){
	$("div.fini").hide()

	$("input[type=checkbox]").change(function(event) {
		if($(this).is(":checked")){
			Loader.start()
			setTimeout(function(){
				Loader.stop()
				$("div.fini").fadeIn(400)
			}, 500);
		}else{
			$("div.fini").fadeOut(400)
		}
	});

	$("#top-search").on("keyup", function() {
		var value = $(this).val().toLowerCase();
		$("div.vote-item").filter(function() {
			$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
		});
	});



/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



$("form.formEntretien").submit(function(event) {
	var url = "../../webapp/gestion/modules/master/pannes/ajax.php";
	var formdata = new FormData($(this)[0]);
	alerty.confirm("Voulez-vous vraiment valider cette demande d'entretien pour ce véhicule ?", {
		title: "Validation de la demande",
		cancelLabel : "Non",
		okLabel : "OUI, approuver",
	}, function(){
		Loader.start()
		formdata.append('action', "demandeEntretien");
		$.post({url:url, data:formdata, contentType:false, processData:false}, function(data){
			if (data.status) {
				window.location.reload();
			}else{
				Alerter.error('Erreur !', data.message);
			}
		}, 'json')
	})
	return false;
});


annulerDemandeEntretien = function(id){
	var url = "../../webapp/gestion/modules/master/pannes/ajax.php";
	alerty.confirm("Voulez-vous vraiment refuser cette demande d'entretien pour ce véhicule ?", {
		title: "Annulation de la demande",
		cancelLabel : "Non",
		okLabel : "OUI, refuser",
	}, function(){
		$.post(url, {action:"annulerDemandeEntretien", id:id}, (data)=>{
			if (data.status) {
				window.location.reload()
			}else{
				Alerter.error('Erreur !', data.message);
			}
		},"json");
	})
}


$("form.formValiderEntretienVehicule").submit(function(event) {
	var url = "../../webapp/gestion/modules/master/pannes/ajax.php";
	var formdata = new FormData($(this)[0]);
	alerty.confirm("Cet entretien est-il vraiment terminé ?", {
		title: "Entretein terminé",
		cancelLabel : "Non",
		okLabel : "OUI, Terminer",
	}, function(){
		Loader.start()
		formdata.append('action', "validerEntretienVehicule");
		$.post({url:url, data:formdata, contentType:false, processData:false}, function(data){
			if (data.status) {
				window.location.reload();
			}else{
				Alerter.error('Erreur !', data.message);
			}
		}, 'json')
	})
	return false;
});


annulerEntretienVehicule = function(id){
	var url = "../../webapp/gestionnaire/modules/master/entretiensencours/ajax.php";
	alerty.confirm("Voulez-vous vraiment refuser cette demande d'entretien pour ce véhicule ?", {
		title: "Annulation de la demande",
		cancelLabel : "Non",
		okLabel : "OUI, refuser",
	}, function(){
		$.post(url, {action:"annulerEntretienVehicule", id:id}, (data)=>{
			if (data.status) {
				window.location.reload()
			}else{
				Alerter.error('Erreur !', data.message);
			}
		},"json");
	})
}



/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


$("form.formPanne").submit(function(event) {
	var url = "../../webapp/gestion/modules/master/pannes/ajax.php";
	var formdata = new FormData($(this)[0]);
	alerty.confirm("Voulez-vous vraiment valider cette demande d'entretien pour ce véhicule ?", {
		title: "Validation de la demande",
		cancelLabel : "Non",
		okLabel : "OUI, approuver",
	}, function(){
		Loader.start()
		formdata.append('action', "panne");
		$.post({url:url, data:formdata, contentType:false, processData:false}, function(data){
			if (data.status) {
				window.location.reload();
			}else{
				Alerter.error('Erreur !', data.message);
			}
		}, 'json')
	})
	return false;
});


annulerPanne = function(id){
	var url = "../../webapp/gestion/modules/master/pannes/ajax.php";
	alerty.confirm("Voulez-vous vraiment refuser cette demande d'entretien pour ce véhicule ?", {
		title: "Annulation de la demande",
		cancelLabel : "Non",
		okLabel : "OUI, refuser",
	}, function(){
		$.post(url, {action:"annulerPanne", id:id}, (data)=>{
			if (data.status) {
				window.location.reload()
			}else{
				Alerter.error('Erreur !', data.message);
			}
		},"json");
	})
}


$("form.formValiderEntretienMachine").submit(function(event) {
	var url = "../../webapp/gestion/modules/master/pannes/ajax.php";
	var formdata = new FormData($(this)[0]);
	alerty.confirm("Cet entretien est-il vraiment terminé ?", {
		title: "Entretein terminé",
		cancelLabel : "Non",
		okLabel : "OUI, Terminer",
	}, function(){
		Loader.start()
		formdata.append('action', "validerEntretienMachine");
		$.post({url:url, data:formdata, contentType:false, processData:false}, function(data){
			if (data.status) {
				window.location.reload();
			}else{
				Alerter.error('Erreur !', data.message);
			}
		}, 'json')
	})
	return false;
});


annulerEntretienMachine = function(id){
	var url = "../../webapp/gestionnaire/modules/master/entretiensencours/ajax.php";
	alerty.confirm("Voulez-vous vraiment refuser cette demande d'entretien pour ce véhicule ?", {
		title: "Annulation de la demande",
		cancelLabel : "Non",
		okLabel : "OUI, refuser",
	}, function(){
		$.post(url, {action:"annulerEntretienMachine", id:id}, (data)=>{
			if (data.status) {
				window.location.reload()
			}else{
				Alerter.error('Erreur !', data.message);
			}
		},"json");
	})
}

})