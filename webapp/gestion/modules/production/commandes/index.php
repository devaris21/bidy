<!DOCTYPE html>
<html>

<?php include($this->rootPath("webapp/gestion/elements/templates/head.php")); ?>


<body class="fixed-sidebar">

    <div id="wrapper">

        <?php include($this->rootPath("webapp/gestion/elements/templates/sidebar.php")); ?>  

        <div id="page-wrapper" class="gray-bg">

          <?php include($this->rootPath("webapp/gestion/elements/templates/header.php")); ?>  

          <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-sm-9">
                <h2 class="text-uppercase text-green gras">Les commandes en cours</h2>
                <div class="container">
                    <div class="row">
                        <div class="col-xs-7 gras ">Afficher même les commandes passées</div>
                        <div class="offset-1"></div>
                        <div class="col-xs-4">
                         <div class="switch">
                            <div class="onoffswitch">
                                <input type="checkbox" class="onoffswitch-checkbox" id="example1">
                                <label class="onoffswitch-label" for="example1">
                                    <span class="onoffswitch-inner"></span>
                                    <span class="onoffswitch-switch"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
           <div class="row">
            <div class="col-md-12">
                <div class="widget style1 red-bg">
                    <div class="row">
                        <div class="col-4">
                            <i class="fa fa-unlink fa-3x"></i>
                        </div>
                        <div class="col-8 text-right">
                            <span> Sinistres ce mois </span>
                            <h2 class="font-bold"><?= start0(count(Home\SINISTRE::valideesCeMois()))  ?></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="wrapper wrapper-content">
    <div class="ibox">
        <div class="ibox-title">
            <h5>Toutes les commandes</h5>
        </div>
        <div class="ibox-content">
           <?php if (count($groupes) > 0) { ?>
             <table class="table table-hover table-sinistre">
                <tbody>
                    <?php foreach ($groupes as $key => $commande) {
                        $commande->actualise(); 
                        $client = $commande->client;
                        $commande->fourni("lignegroupecommande");
                        ?>
                        <tr class=" <?= ($commande->etat_id != 0)?'fini':'' ?> border-bottom">
                            <td class="project-status">
                                <span class="label label-<?= $commande->etat->class ?>"><?= $commande->etat->name ?></span>
                            </td>
                            <td class="project-title border-right" style="width: 45%;">
                                <h3 class="text-uppercase">Commandes</h3>
                                <h5 class="text-uppercase text-muted">de <a href="<?= $this->url("gestion", "master", "client", $commande->client_id)  ?>"><?= $commande->client->name() ?></a></h5>
                            </td>
                            <td class="border-right">
                                <h4>Satisfaction de la commande</h4>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <?php foreach ($commande->lignegroupecommandes as $key => $ligne) { 
                                                if ($ligne->quantite > 0) {
                                                    $ligne->actualise(); ?>
                                                    <th class="text-center"><?= $ligne->produit->name() ?></th>
                                                <?php }
                                            } ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><h4 class="mp0">Reste : </h4></td>
                                            <?php foreach ($commande->lignegroupecommandes as $key => $ligne) {
                                                if ($ligne->quantite > 0) { ?>
                                                 <td class="text-center"><?= $ligne->quantite ?></td>
                                             <?php   } 
                                         } ?>
                                     </tr>
                                 </tbody>
                             </table>
                         </td>
                         <td>
                            <button onclick="fichecommande(<?= $commande->getId()  ?>)" class="btn btn-block btn-white btn-sm"><i class="fa fa-plus text-green"></i> de détails </button>
                        </td>
                    </tr>
                <?php  } ?>
            </tbody>
        </table>
    <?php }else{ ?>
        <h1 style="margin-top: 20%;" class="text-center text-muted"><i class="fa fa-folder-open-o fa-3x"></i> <br> Aucune commande en cours pour ce client !</h1>
    <?php } ?>

</div>
</div>
</div>


<?php include($this->rootPath("webapp/gestion/elements/templates/footer.php")); ?>
<?php include($this->rootPath("composants/assets/modals/modal-newcommande.php")); ?> 

</div>
</div>


<?php include($this->rootPath("webapp/gestion/elements/templates/script.php")); ?>
<script type="text/javascript" src="<?= $this->relativePath("../client/script.js") ?>"></script>


</body>

</html>
