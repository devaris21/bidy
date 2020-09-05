$(function(){

    $(".details").hide()
    $("input[type=checkbox].onoffswitch-checkbox").change(function(event) {
        if($(this).is(":checked")){
            Loader.start()
            setTimeout(function(){
                Loader.stop()
                $(".details").fadeIn(400)
            }, 500);
        }else{
            $(".details").fadeOut(400)
        }
    });



    filtrer = function(){
        var url = "../../webapp/gestion/modules/production/production/ajax.php";
        var formdata = new FormData($("#formFiltrer")[0]);
        formdata.append('action', "filtrer");
        $.post({url:url, data:formdata, contentType:false, processData:false}, function(data){
            window.location.href = data.url;
        }, 'json')
    }
})