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
                    <h2 class="text-uppercase text-green gras">Programmation des livraisons</h2>
                    <div class="container">

                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="row">
                        <div class="col-md-12">

                        </div>
                    </div>
                </div>
            </div>

            <div class="wrapper wrapper-content">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Programme de livraison</h5>
                        <div class="ibox-tools">

                        </div>
                    </div>
                    <div class="ibox-content">

                       <?php if (count($datas + $encours) > 0) { ?>
                        <table class="footable table table-stripped toggle-arrow-tiny">
                            <thead>
                                <tr>

                                    <th data-toggle="true">Status</th>
                                    <th>Reference</th>
                                    <th>Client</th>
                                    <th>Chauffeur</th>
                                    <th>Zone de livraison</th>
                                    <th data-hide="all"></th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                             <?php foreach ($encours as $key => $livraison) {
                                $livraison->actualise(); 
                                $client = $livraison->groupecommande->client;
                                $lots = $livraison->fourni("lignelivraison");
                                ?>
                                <tr style="border-bottom: 2px solid black">
                                    <td class="project-status">
                                        <span class="label label-<?= $livraison->etat->class ?>"><?= $livraison->etat->name ?></span>
                                    </td>
                                    <td>
                                        <span class="text-uppercase gras">Livraison N°<?= $livraison->reference ?></span><br>
                                        <span><?= depuis($livraison->created) ?></span>
                                    </td>
                                    <td>
                                        <h6 class="text-uppercase text-muted gras" style="margin: 0"><?= $client->name() ?></h6>
                                    </td>
                                    <td>
                                        <h6 class="text-uppercase text-muted">Chauffeur :  <?= $livraison->chauffeur->name() ?></h6>
                                        <h6 class="text-uppercase text-muted">Véhicule :  <?= $livraison->vehicule() ?></h6>
                                    </td>
                                    <td class="border-right">
                                        <h5 class="mp0"><small><?= $livraison->zonelivraison->name() ?></small><br> <?= $livraison->lieu ?></h5>
                                    </td>
                                    <td class="border-right" style="width: 30%">
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
                                        <button onclick="validerProg(<?= $livraison->id ?>)" class="btn btn-white btn-sm text-green"><i class="fa fa-check"></i> Valider</button>
                                    </td>
                                </tr>
                            <?php  } ?>
                            </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5">
                                    <ul class="pagination float-right"></ul>
                                </td>
                            </tr>
                        </tfoot>
                    </table>

                <?php }else{ ?>
                    <h1 style="margin: 6% auto;" class="text-center text-muted"><i class="fa fa-folder-open-o fa-3x"></i> <br> Aucune livraison programmée pour le moment</h1>
                <?php } ?>

            </div>
        </div>
    </div>


    <?php include($this->rootPath("webapp/gestion/elements/templates/footer.php")); ?> 

</div>
</div>


<?php include($this->rootPath("webapp/gestion/elements/templates/script.php")); ?>
<script type="text/javascript" src="<?= $this->relativePath("../../master/client/script.js") ?>"></script>


</body>

</html>
