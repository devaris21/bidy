$(function(){


    $("input[type=checkbox].onoffswitch-checkbox").change(function(event) {
        if($(this).is(":checked")){
            Loader.start()
            setTimeout(function(){
                Loader.stop()
                $("#tableCarplan tr").hide()
                $("tr.encours").fadeIn(400)
            }, 500);
        }else{
            $("#tableCarplan tr").fadeIn(400)
        }
    });


    $("#top-search").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("table.table-sinistre tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });




    terminerAffectation = function(id){
        var url = "../../webapp/gestionnaire/modules/master/affectations/ajax.php";
        alerty.confirm("Voulez-vous vraiment terminer cette affectation de véhicule ?", {
            title: "Affectation terminée",
            cancelLabel : "Non",
            okLabel : "OUI, approuver",
        }, function(){
            alerty.prompt("Entrer votre mot de passe pour confirmer l'opération !", {
                title: 'Récupération du mot de passe !',
                inputType : "password",
                cancelLabel : "Annuler",
                okLabel : "Mot de passe"
            }, function(password){
                $.post(url, {action:"approuver", id:id, password:password}, (data)=>{
                    if (data.status) {
                        window.location.reload();
                    }else{
                        Alerter.error('Erreur !', data.message);
                    }
                },"json");
            })
        })
    }


    renouveler = function(id){
        var url = "../../composants/dist/shamman/traitement.php";
        alerty.confirm("Voulez-vous vraiment renouveler cette affectation de véhicule ?", {
            title: "Renouvelement d'affectation",
            cancelLabel : "Non",
            okLabel : "OUI, renouveler",
        }, function(){
            alerty.prompt("Entrer votre mot de passe pour confirmer l'opération !", {
                title: 'Récupération du mot de passe !',
                inputType : "password",
                cancelLabel : "Annuler",
                okLabel : "Mot de passe"
            }, function(password){
                Loader.start();
                $.post(url, {action:"verifierPassword", password:password}, (data)=>{
                    if (data.status) {
                        session('affectation_id', id);
                        modal("#modal-renouvelement");
                        Loader.stop();
                    }else{
                        Alerter.error('Erreur !', data.message);
                    }
                },"json");
            })
        })
    }

    $("form#formRenouvelement").submit( function(event) {
        Loader.start()
        var url = "../../webapp/gestionnaire/modules/master/affectations/ajax.php";
        var formdata = new FormData($(this)[0]);
        formdata.append('action', "renouveler");
        $.post({url:url, data:formdata, contentType:false, processData:false}, function(data){
            if (data.status) {
                window.location.reload();
            }else{
                Alerter.error('Erreur !', data.message);
            }
        }, 'json')
        return false;
    });


    annulerAffectation = function(id){
        var url = "../../webapp/gestionnaire/modules/master/affectations/ajax.php";
        alerty.confirm("Voulez-vous vraiment refuser cette declaration de sinistre de ce véhicule ?", {
            title: "Annulation de la declaration",
            cancelLabel : "Non",
            okLabel : "OUI, refuser",
        }, function(){
            alerty.prompt("Entrer votre mot de passe pour confirmer l'opération !", {
                title: 'Récupération du mot de passe !',
                inputType : "password",
                cancelLabel : "Annuler",
                okLabel : "Mot de passe"
            }, function(password){
                $.post(url, {action:"refuser", id:id, password:password}, (data)=>{
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