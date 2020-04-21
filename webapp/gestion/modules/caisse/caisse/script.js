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


	$("#top-search").on("keyup", function() {
		var value = $(this).val().toLowerCase();
		$(".table-operation tr").filter(function() {
			$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
		});
	});



	valider = function(id){
		var url = "../../webapp/gestion/modules/caisse/caisse/ajax.php";
		alerty.confirm("Confirmez-vous être maintenant en possession effective de ladite somme ?", {
			title: "Validation de l'opération",
			cancelLabel : "Non",
			okLabel : "OUI, valider",
		}, function(){
			alerty.prompt("Entrer votre mot de passe pour confirmer l'opération !", {
				title: 'Récupération du mot de passe !',
				inputType : "password",
				cancelLabel : "Annuler",
				okLabel : "Valider"
			}, function(password){
				Loader.start();
				$.post(url, {action:"valider", password:password, id:id}, (data)=>{
					if (data.status) {
						window.location.reload()
					}else{
						Alerter.error('Erreur !', data.message);
					}
				},"json");
			})
		})
	}

})