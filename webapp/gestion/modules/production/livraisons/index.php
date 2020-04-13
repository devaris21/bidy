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
                <h2 class="text-uppercase text-green gras">Les livraisons en cours</h2>
                <div class="container">
                    <div class="row">
                        <div class="col-xs-7 gras ">Afficher même les livraisons passées</div>
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
                <h5>Toutes les livraisons</h5>
            </div>
            <div class="ibox-content">
             <?php if (count($groupes) > 0) { ?>
               <table class="table table-hover table-sinistre">
                <tbody>
                    <?php foreach ($groupes as $key => $livraison) {
                        $livraison->actualise(); 
                        $client = $livraison->groupecommande->client;
                        $livraison->fourni("lignelivraison");
                        ?>
                        <tr class=" <?= ($livraison->etat_id != 0)?'fini':'' ?> border-bottom">
                            <td class="project-status">
                                <span class="label label-<?= $livraison->etat->class ?>"><?= $livraison->etat->name ?></span>
                            </td>
                            <td class="project-title border-right" style="width: 30%;">
                                <h4 class="text-uppercase">Livraison N°<?= $livraison->reference ?></h4>
                                <h6 class="text-uppercase text-muted">Client :  <?= $livraison->groupecommande->client->name() ?></h6>
                                <h6 class="text-uppercase text-muted">Chauffeur :  <?= $livraison->chauffeur->name() ?></h6>
                                <span>Emise <?= depuis($livraison->created) ?></span>
                            </td>
                            <td class="border-right" style="width: 25%">
                                <div class="row">
                                    <div class="col-3">
                                        <img style="width: 40px" src="<?= $this->stockage("images", "vehicules", $livraison->vehicule->image) ?>">
                                    </div>
                                    <div class="col-9">
                                        <h5 class="mp0"><?= $livraison->vehicule->typevehicule->name() ?></h5>
                                        <h6 class="mp0"><?= $livraison->vehicule->name() ?></h6>
                                    </div>
                                </div><hr class="mp3">
                                <h5 class="mp0"><small><?= $livraison->zonelivraison->name() ?></small><br> <?= $livraison->lieu ?></h5>
                            </td>
                            <td class="border-right" style="width: 35%">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <?php foreach ($livraison->lignelivraisons as $key => $ligne) { 
                                                $ligne->actualise(); ?>
                                                <th class="text-center text-uppercase"><?= $ligne->produit->name() ?></th>
                                            <?php } ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><h4 class="mp0">à livrer : </h4></td>
                                            <?php foreach ($livraison->lignelivraisons as $key => $ligne) { ?>
                                               <td class="text-center"><?= $ligne->quantite ?></td>
                                           <?php   } ?>
                                       </tr>
                                   </tbody>
                               </table>
                           </td>
                           <td>
                            <a href="<?= $this->url("gestion", "fiches", "bonlivraison", $livraison->getId()) ?>" target="_blank" class="btn btn-block btn-white btn-sm"><i class="fa fa-file-text text-red"></i> Bon de livraison</a>
                            <button onclick="annuler(<?= $livraison->getId()  ?>)" class="btn btn-block btn-white btn-sm"><i class="fa fa-close text-red"></i> Annuler</button>
                            <button onclick="fichecommande(<?= $livraison->getId()  ?>)" class="btn btn-block btn-white btn-sm"><i class="fa fa-check text-green"></i> Terminer</button>
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
