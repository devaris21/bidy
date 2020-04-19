
$(function(){

	$("input[type=date]").change(function(){
		var url = "../../webapp/gestion/modules/parametres/historiques/ajax.php";
		var formData = new FormData();
		formData.append("date1", $("input[name=date1]").val());
		formData.append("date2", $("input[name=date2]").val());
		formData.append("action", "historiques");
		$.post({url:url, data:formData, processData:false, contentType:false}, function(data) {
			$("div.affichage").html(data)
		}, "html");
	})


	$("input[name=date1]").change()
})