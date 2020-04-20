$(function(){

	newcommande = function(){
		alerty.confirm("Une ou plusieurs commandes sont déjà en cours, voulez-vous continuer avec l'une d'entre elles ?", {
			title: "Nouvelle commande",
			cancelLabel : "Non, une nouvelle commande",
			okLabel : "OUI, continuer avec elles",
		}, function(){			
			modal("#modal-listecommande");
		}, function(){
			session("commande-encours", null);
			modal("#modal-newcommande");
		})
	}

	chosir = function(id){
		session('commande-encours', id);
		$("#modal-listecommande").modal("hide")
		modal("#modal-newcommande");
	}

	fichecommande = function(id){	
		Loader.start();	
		var url = "../../webapp/gestion/modules/master/client/ajax.php";
		$.post(url, {action:"fichecommande", id:id}, (data)=>{
			$("body #modal-groupecommande").remove();
			$("body").append(data);
			$("body #modal-groupecommande").modal("show");
			Loader.stop();	
		},"html");
	}

	newlivraison = function(id){	
		Loader.start();	
		var url = "../../webapp/gestion/modules/master/client/ajax.php";
		$.post(url, {action:"newlivraison", id:id}, (data)=>{
			$("body #modal-newlivraison").remove();
			$("body").append(data);
			$("body #modal-newlivraison").modal("show");
			Loader.stop();	
		},"html");
	}

	//nouvelle commande
	$(".newproduit").click(function(event) {
		var url = "../../webapp/gestion/modules/master/client/ajax.php";
		var id = $(this).attr("data-id");
		var zone = $("select[name=zonelivraison_id]").val();
		$.post(url, {action:"newproduit", id:id, zone:zone}, (data)=>{
			$("tbody.commande").append(data);
			$("button[data-id ="+id+"]").hide(200);
			$("#actualise").show(200);
		},"html");
	});


	supprimeProduit = function(id){
		var url = "../../webapp/gestion/modules/master/client/ajax.php";
		$.post(url, {action:"supprimeProduit", id:id}, (data)=>{
			$("tbody.commande tr#ligne"+id).hide(400).remove();
			$("button[data-id ="+id+"]").show(200);
			$("#actualise").show(200);
		},"html");
	}


	$("body").on("change", "select[name=zonelivraison_id]", function(){
		calcul()
	})


	calcul = function(){
		var url = "../../webapp/gestion/modules/master/client/ajax.php";
		var formdata = new FormData($("#formCommande")[0]);
		var tableau = new Array();
		$("#modal-newcommande .commande tr").each(function(index, el) {
			var id = $(this).attr('data-id');
			var val = $(this).find('input').val();
			var item = id+"-"+val;
			tableau.push(item);
		});
		formdata.append('tableau', tableau);
		formdata.append('action', "calcul");
		$.post({url:url, data:formdata, contentType:false, processData:false}, function(data){
			$("#modal-newcommande tbody.commande").html(data);
		}, 'html')
		formdata.append('action', "total");
		$.post({url:url, data:formdata, contentType:false, processData:false}, function(data){
			$(".tva").html(data.tva);
			$(".montant").html(data.montant);
			$(".total").html(data.total);
		}, 'json')
		$("#actualise").hide(200);
		return formdata;
	}


	validerCommande = function(){
		formdata = calcul();
		alerty.confirm("Voulez-vous vraiment valider la commande ?", {
			title: "Validation de la commande",
			cancelLabel : "Non",
			okLabel : "OUI, valider",
		}, function(){
			Loader.start();
			var url = "../../webapp/gestion/modules/master/client/ajax.php";

			// val = $("input[name=datelivraison]").data('datepicker');
			// console.log(val)
			// let debut =val.format('YYYY-MM-DD');
			// console.log(debut)
			formdata.append('action', "validerCommande");
			$.post({url:url, data:formdata, contentType:false, processData:false}, function(data){
				if (data.status) {
					window.open(data.url1, "_blank");
					window.open(data.url2, "_blank");
					window.location.reload();
				}else{
					Alerter.error('Erreur !', data.message);
				}
			}, 'json')
		})
	}


	validerLivraison = function(){
		val = $('.date').data("datepicker").viewDate;
		console.log(val);
		return false;
		var formdata = new FormData($("#formLivraison")[0]);
		var tableau = new Array();
		$("#modal-newlivraison .commande tr").each(function(index, el) {
			var id = $(this).attr('data-id');
			var val = $(this).find('input').val();
			var item = id+"-"+val;
			tableau.push(item);
		});
		formdata.append('tableau', tableau);

		alerty.confirm("Voulez-vous vraiment confirmer la livraison de ces produits ?", {
			title: "livraison de la commande",
			cancelLabel : "Non",
			okLabel : "OUI, livrer",
		}, function(){
			Loader.start();
			var url = "../../webapp/gestion/modules/master/client/ajax.php";
			formdata.append('action', "livraisonCommande");
			$.post({url:url, data:formdata, contentType:false, processData:false}, function(data){
				if (data.status) {
					window.open(data.url, "_blank");
					window.location.reload();
				}else{
					Alerter.error('Erreur !', data.message);
				}
			}, 'json')
		})
	}


	$("#formAcompte").submit(function(event) {
		var url = "../../webapp/gestion/modules/master/client/ajax.php";
		alerty.confirm("Voulez-vous vraiment créditer ce montant sur ce compte ?", {
			title: "Créditer l'acompte",
			cancelLabel : "Non",
			okLabel : "OUI, créditer",
		}, function(){
			alerty.prompt("Entrer votre mot de passe pour confirmer l'opération !", {
				title: 'Récupération du mot de passe !',
				inputType : "password",
				cancelLabel : "Annuler",
				okLabel : "Valider"
			}, function(password){
				var formdata = new FormData($("#formAcompte")[0]);
				formdata.append('password', password);
				formdata.append('action', "acompte");
				Loader.start();
				$.post({url:url, data:formdata, contentType:false, processData:false}, function(data){
					if (data.status) {
						window.open(data.url, "_blank");
						window.location.reload();
					}else{
						Alerter.error('Erreur !', data.message);
					}
				}, 'json')
			})
		})
		return false;
	});


	$('.input-group.date').datepicker({
		autoclose: true,
		format: "dd MM yyyy",
		language: "fr"
	});

})