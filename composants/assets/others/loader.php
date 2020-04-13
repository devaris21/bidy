<div class="leloader">
    <small>Veuillez patienter </small>
    <span class="loading rhomb"></span>
</div>

<style>
    .leloader{
        display: none;
        text-align: center;
        z-index: 9999;
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background-color: rgba(0, 0, 0, 0.7);
        padding: 20% 10%;
        font-size: 50px;
        color: white
    }
</style>



<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->



<div class="imageViewer">
    <img class="img-thumbnail" src="<?= $this->stockage("images", "vehicules", "9ebe215d.png") ?>" alt="placeholder+image">

    <i class="fa fa-close fa-2x" onclick="closeImageViewer()"></i>
</div>

<script type="text/javascript">
    openImage = function(src){
        $(".imageViewer").css("display", "initial");
        $(".imageViewer img").prop("src", src);
    }

    closeImageViewer = function(src){
        $(".imageViewer").css("display", "none");
    }
</script>

<style>
    .imageViewer{
        display: none;
        text-align: center;
        z-index: 9999;
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background-color: rgba(0, 0, 0, 0.7);
        padding: 10%;
        color: white
    }

    .imageViewer img{
        height: 90%;
    }

    .imageViewer i{
        padding: 20px;
        border-radius: 100%;
        color: white;
        background-color: rgba(0, 0, 0, 0.2);
        top: -12px;
        right: -12px;  
        position: absolute;
        cursor: pointer;
        font-weight: 100;
    }

</style>


<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
