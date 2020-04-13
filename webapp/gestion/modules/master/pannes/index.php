<!DOCTYPE html>
<html>

<?php include($this->rootPath("webapp/gestion/elements/templates/head.php")); ?>


<body class="fixed-sidebar">

    <div id="wrapper">

        <?php include($this->rootPath("webapp/gestion/elements/templates/sidebar.php")); ?>  

        <div id="page-wrapper" class="gray-bg">

            <?php include($this->rootPath("webapp/gestion/elements/templates/header.php")); ?>  

            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-sm-6">
                    <h2 class="text-uppercase text-red gras">Affectation - <br> bénéficiaires de carplan</h2>
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-7 gras text-capitalize">Afficher seulement les affectations en cours</div>
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
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-md-6">
                        <div class="widget style1 navy-bg">
                            <div class="row">
                                <div class="col-4">
                                    <i class="fa fa-cloud fa-3x"></i>
                                </div>
                                <div class="col-8 text-right">
                                    <span>Déclaration en cours </span>
                                    <h2 class="font-bold"><?= start0(count(Home\SINISTRE::encours()))  ?></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="widget style1 lazur-bg">
                            <div class="row">
                                <div class="col-4">
                                    <i class="fa fa-envelope-o fa-3x"></i>
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
            <div class="animated fadeInRightBig">

              <div class="row">
                <div class="col-md-12">

                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>Listes des bénéficiaires de Carplan</h5>
                            <div class="ibox-tools">
                                <a href="" class="btn btn-primary btn-sm dim"><i class="fa fa-plus"></i> Ajouter Nouvelle Carte Grise</a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <table class="table table-striped" id="tableCarplan">
                                    <tbody>
                                        <?php foreach ($affectations as $key => $affectation) {
                                            $affectation->actualise();
                                            $affectation->fourni("renouvelementaffectation");
                                            $renouv = new Home\RENOUVELEMENTAFFECTATION;
                                            if (count($affectation->renouvelementaffectations) > 0) {
                                                $renouv = end($affectation->renouvelementaffectations);
                                            }
                                            ?>
                                            <tr class=" <?= ($affectation->etat_id == 0)?'encours':'' ?> border-bottom" >    
                                                <td class="project-status">
                                                    <span class="label label-<?= $affectation->etat->class ?>"><?= $affectation->etat->name ?></span>
                                                </td>                                            
                                                <td width="80">
                                                    <img alt="image" style="width: 80px;" class="m-t-xs" src="<?= $this->stockage("images", "carplans", $affectation->carplan->image) ?>">
                                                </td>
                                                <td class="border-right">
                                                    <h3><a href="#" class="text-navy"><?= $affectation->carplan->name() ?> </a></h3>
                                                    <h5><?= $affectation->carplan->matricule ?> - <?= $affectation->carplan->fonction ?></h5>
                                                    <div class="m-t-sm">
                                                        <span class="gras text-uppercase"><?= $affectation->typeaffectation->name ?></span> |
                                                        <a href="#" class="text-muted"><i class="fa fa-calendar"></i> Du <?= datecourt($renouv->started) ?> au <?= datecourt($renouv->finished) ?> (<?= count($affectation->renouvelementaffectations) ?>)</a>
                                                    </div>
                                                </td>
                                                <td class="border-right">
                                                    <div>
                                                        <a class="row" style="color: black; margin-top: 10%" href="<?= $this->url("gestionnaire", "master", "vehicule", $affectation->vehicule_id) ?>">
                                                            <div class="col-4">
                                                                <div class="text-center">
                                                                    <img alt="image" style="height: 45px;" class="m-t-xs" src="<?= $this->stockage("images", "vehicules", $affectation->vehicule->image) ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-8" style="font-size: 12px;">
                                                                <h3 style="margin: 0"><strong><?= $affectation->vehicule->immatriculation ?></strong></h3>
                                                                <address>
                                                                    <strong><?= $affectation->vehicule->marque->name ?></strong><br>
                                                                    <?= $affectation->vehicule->modele ?>
                                                                </address>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </td>
                                                <td class="text-right">
                                                    <?php if ($affectation->etat_id == 0) { ?>

                                                        <button onclick="modification('affectation', <?= $affectation->getId() ?>)" data-toggle="modal" data-target="#modal-affectation" class="btn btn-outline btn-warning  dim" type="button"><i data-toggle="tooltip" title="Modifier les infos de l'affectation" class="fa fa-pencil"></i></button> <br>                 
                                                        <button onclick="terminerAffectation(<?= $affectation->getId() ?>)" data-toggle="tooltip" title="Terminer l'affectation" class="btn btn-outline btn-primary dim" type="button"><i class="fa fa-check"></i></button>
                                                        <button onclick="annulerAffectation(<?= $affectation->getId() ?>)" data-toggle="tooltip" title="Annuler l'affectation" class="btn btn-outline btn-danger  dim" type="button"><i class="fa fa-close"></i> </button>
                                                    <?php }else{ ?>
                                                        <button onclick="renouveler(<?= $affectation->getId() ?>)" data-toggle="tooltip" title="Renouveler l'affectation" class="btn btn-outline btn-success dim" type="button"><i class="fa fa-refresh"></i></button>
                                                    <?php } ?>
                                                    
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>


        </div>
    </div>


    <?php include($this->rootPath("webapp/gestion/elements/templates/footer.php")); ?>

    <div class="modal inmodal fade" id="modal-renouvelement">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Renouvelement</h4>
                </div>
                <form method="POST" id="formRenouvelement">
                    <div class="modal-body">
                        <div class="">
                            <label>Date de début <span1>*</span1></label>
                            <div class="form-group">
                                <input type="date" class="form-control" name="started" required>
                            </div>
                        </div>
                        <div class="">
                            <label>Date de fin <span1>*</span1></label>
                            <div class="form-group">
                                <input type="date" class="form-control" name="finished" required>
                            </div>
                        </div>
                    </div><hr>
                    <div class="container">
                        <button type="button" class="btn btn-sm  btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Annuler</button>
                        <button class="btn btn-sm btn-danger pull-right"><i class="fa fa-refresh"></i> Renouveler</button>
                    </div>
                    <br>
                </form>
            </div>
        </div>
    </div>



</div>
</div>


<?php include($this->rootPath("webapp/gestion/elements/templates/script.php")); ?>


</body>

</html>
