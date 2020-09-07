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
                <h2 class="text-uppercase text-warning gras">Les livraisons en cours</h2>
            </div>
            <div class="col-sm-3">
                <button style="margin-top: -5%;" type="button" data-toggle=modal data-target='#modal-clients' class="btn btn-primary btn-sm dim float-right"><i class="fa fa-plus"></i> Nouvelle livraison </button>
            </div>
        </div>

        <div class="wrapper wrapper-content">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Toutes les livraisons</h5>
                    <div class="ibox-tools">
                        <form id="formFiltrer" method="POST">
                            <div class="row" style="margin-top: -1%">
                                <div class="col-5">
                                    <input type="date" value="<?= $date1 ?>" class="form-control input-sm" name="date1">
                                </div>
                                <div class="col-5">
                                    <input type="date" value="<?= $date2 ?>" class="form-control input-sm" name="date2">
                                </div>
                                <div class="col-2">
                                    <button type="button" onclick="filtrer()" class="btn btn-sm btn-white"><i class="fa fa-search"></i> Filtrer</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="ibox-content" style="min-height: 300px">
                    <table class="table table-hover table-livraison">
                        <tbody>
                            <?php foreach ($livraisons as $key => $livraison) {
                                $livraison->actualise(); 
                                $client = $livraison->groupecommande->client;
                                $livraison->fourni("lignelivraison");
                                ?>
                                <tr class="<?= ($livraison->etat_id != Home\ETAT::ENCOURS)?'fini':'' ?> border-bottom" style="border-bottom: 2px solid black">
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
                                                <h6 class="mp0"><?= $livraison->vehicule() ?></h6>
                                            </div>
                                        </div><hr class="mp3">
                                        <h5 class="mp0"><small><?= $livraison->zonelivraison->name() ?></small><br> <?= $livraison->lieu ?></h5>
                                    </td>
                                    <td class="border-right" style="width: 32%">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr class="no">
                                                    <th></th>
                                                    <?php foreach ($livraison->lignelivraisons as $key => $ligne) { 
                                                        $ligne->actualise(); ?>
                                                        <th class="text-center text-uppercase"><?= $ligne->produit->name() ?></th>
                                                    <?php } ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="no">
                                                    <td><h4 class="mp0"><?= ($livraison->etat_id == Home\ETAT::VALIDEE)?'livrés':'à livrer' ?> : </h4></td>
                                                    <?php foreach ($livraison->lignelivraisons as $key => $ligne) { ?>
                                                        <td class="text-center <?= ($livraison->etat_id == Home\ETAT::VALIDEE)?'text-warning':'' ?>"><?= $ligne->quantite_livree ?></td>
                                                    <?php   } ?>
                                                </tr>
                                                <?php if ($livraison->etat_id == Home\ETAT::VALIDEE) { ?>
                                                    <tr class="no">
                                                        <td><h4 class="mp0">Restait :</h4></td>
                                                        <?php foreach ($livraison->lignelivraisons as $key => $ligne) { ?>
                                                            <td class="text-center"><?= $ligne->reste ?></td>
                                                        <?php   } ?>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </td>
                                    <td>
                                        <a href="<?= $this->url("gestion", "fiches", "bonlivraison", $livraison->getId()) ?>" target="_blank" class="btn btn-block btn-white btn-sm"><i class="fa fa-file-text text-blue"></i> Bon de livraison</a><br>
                                        <?php if ($livraison->etat_id == Home\ETAT::ENCOURS) { ?>
                                            <button onclick="terminer(<?= $livraison->getId() ?>)" class="btn btn-primary btn-sm"><i class="fa fa-check"></i> Terminer</button>
                                            <?php if ($employe->isAutoriser("modifier-supprimer")) { ?>
                                                <button onclick="annulerLivraison(<?= $livraison->getId() ?>)" class="btn btn-white btn-sm"><i class="fa fa-close text-red"></i></button>
                                            <?php } ?>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php  } ?>
                        </tbody>
                    </table>
                    <?php if (count($livraisons__) == 0) { ?>
                        <h1 style="margin-top: 30% auto;" class="text-center text-muted aucun"><i class="fa fa-folder-open-o fa-3x"></i> <br> Aucune livraison en cours pour le moment !</h1>
                    <?php } ?>

                </div>
            </div>
        </div>


        <?php include($this->rootPath("webapp/gestion/elements/templates/footer.php")); ?>

        <?php include($this->rootPath("composants/assets/modals/modal-clients.php")); ?> 

        <?php 
        foreach ($livraisons as $key => $livraison) {
            if ($livraison->etat_id == Home\ETAT::ENCOURS) { 
                include($this->rootPath("composants/assets/modals/modal-livraison2.php"));
            } 
        } 
        ?>

    </div>
</div>


<?php include($this->rootPath("webapp/gestion/elements/templates/script.php")); ?>
<script type="text/javascript" src="<?= $this->relativePath("../../master/client/script.js") ?>"></script>


</body>

</html>