<!DOCTYPE html>
<html>

<?php include($this->rootPath("webapp/gestion/elements/templates/head.php")); ?>


<body class="fixed-sidebar">

    <div id="wrapper">

        <?php include($this->rootPath("webapp/gestion/elements/templates/sidebar.php")); ?>  

        <div id="page-wrapper" class="gray-bg">

            <?php include($this->rootPath("webapp/gestion/elements/templates/header.php")); ?>  

            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-sm-7">
                    <h2 class="text-uppercase">Les déclarations de pannes</h2>
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-7 gras">Afficher toutes les déclarations</div>
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
            <div class="col-sm-5">
             <div class="row">
                <div class="col-sm-6">
                    <div class="widget style1 lazur-bg">
                        <div class="row">
                            <div class="col-12 text-right">
                                <span> Validées ce mois </span>
                                <h2 class="font-bold"><?= start0(count(Home\DEMANDEENTRETIEN::valideesCeMois()))  ?></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="widget style1 yellow-bg">
                        <div class="row">
                            <div class="col-12 text-right">
                                <span> Annulées ce mois</span>
                                <h2 class="font-bold"><?= start0(count(Home\DEMANDEENTRETIEN::annuleesCeMois()))  ?></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="wrapper wrapper-content">
        <div class="ibox">
            <div class="ibox-content">
                <div class="wrapper wrapper-content animated fadeInRight">
                  <div class="tabs-container">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class=""><a class="nav-link active" data-toggle="tab" href="#tabpannes"><i class="fa fa-th-large"></i> Déclarations de pannes</a></li>
                        <li class=""><a class="nav-link " data-toggle="tab" href="#tabentretiens"><i class="fa fa-briefcase"></i> Entretiens de véhicules </a></li>
                    </ul><br>                               
                    <div class="tab-content">

                        <div role="tabpanel" id="tabpannes" class="tab-pane active">
                         <?php foreach ($datas as $key => $item) {
                            if ($item->type == "vehicule") { ?>
                               <div class="vote-item <?= ($item->etat_id != 0)?'fini':'' ?>">
                                <div class="row">
                                    <div class="col-md-6 border-right">
                                        <div class="vote-actions" style="margin-right: 7%; height: 100%">
                                            <div class="vote-icon" data-toggle="tooltip" title="Panne de véhicule">
                                                <i class="fa fa-car"> </i>
                                            </div>
                                        </div>
                                        <div>
                                            <span class="vote-title"><u class="text-info">#<?= $item->reference ?></u> // <?= $item->typeentretienvehicule->name() ?></span>
                                            <span><?= $item->comment ?></span>
                                            <div class="vote-info">
                                              <i class="fa fa-clock-o"></i> 
                                              <?php if ($item->etat_id == -1) { ?>
                                                <a href="#">Annulée <?= depuis($item->date_approuve) ?></a>
                                            <?php }else if ($item->etat_id == Home\ETAT::ENCOURS){ ?>
                                                <a href="#">Emise <?= depuis($item->created) ?></a>
                                            <?php }else if ($item->etat_id == 1){ ?>
                                                <a href="#">Approuvée <?= depuis($item->date_approuve) ?></a>
                                            <?php } ?>
                                            <i class="fa fa-user"></i> <a href="#">Par <?= $item->carplan->name() ?></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 border-right">
                                 <div class="row">
                                     <div class="col-4">
                                        <div class="text-center">
                                            <img alt="image" style="height: 40px;" class="m-t-xs" src="<?= $this->stockage("images", "vehicules", $item->vehicule->image) ?>">
                                        </div>
                                    </div>
                                    <div class="col-8" style="font-size: 11px;">
                                        <h4 style="margin: 0"><strong><?= $item->vehicule->immatriculation ?></strong></h4>
                                        <address>
                                            <strong><?= $item->vehicule->marque->name ?></strong><br>
                                            <?= $item->vehicule->modele ?>
                                        </address>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1 text-right border-right">
                                <img style="width: 100%;" onclick="openImage('<?= $this->stockage("images", "demandeentretiens", $item->image) ?>')" class="m-t-xs cursor" src="<?= $this->stockage("images", "demandeentretiens", $item->image) ?>">
                            </div>
                            <div class="col-md-2 text-right">
                                <?php if ($item->etat_id == 1) { ?>
                                    <div class="vote-icon">
                                        <i class="fa fa-check text-green" data-toggle="tooltip" title="Demande validée"> </i>
                                    </div>
                                <?php } else if ($item->etat_id == -1) { ?>
                                    <div class="vote-icon">
                                        <i class="fa fa-close text-red" data-toggle="tooltip" title="Demande annulée"> </i>
                                    </div>

                                <?php }else if ($item->etat_id == Home\ETAT::ENCOURS){ ?>
                                    <div class="btn-group">
                                        <button title="Faire l'entretien" data-toggle="modal" data-target="#modal-entretienvehicule<?= $item->getId() ?>" class="btn btn-white btn-sm"><i class="fa fa-check text-green"></i> Reparer</button>
                                        <button data-toggle="tooltip" title="annuler la demande" class="btn btn-white btn-sm" onclick="annulerDemandeEntretien(<?= $item->getId() ?>)"><i class="fa fa-close text-red"></i></button>
                                    </div>
                                <?php } ?>                                      
                            </div>
                        </div>
                    </div>


                <?php }else{ ?>
                   <div class="vote-item <?= ($item->etat_id != 0)?'fini':'' ?>">
                    <div class="row">
                        <div class="col-md-6 border-right">
                            <div class="vote-actions" style="margin-right: 7%; height: 100%">
                                <div class="vote-icon" data-toggle="tooltip" title="Panne de machine">
                                    <i class="fa fa-steam"> </i>
                                </div>
                            </div>
                            <div>
                                <span class="vote-title"><u class="text-info">#<?= $item->reference ?></u> // <?= $item->title ?></span>
                                <span><?= $item->comment ?></span>
                                <div class="vote-info">
                                  <i class="fa fa-clock-o"></i> 
                                  <?php if ($item->etat_id == -1) { ?>
                                    <a href="#">Annulée <?= depuis($item->date_approuve) ?></a>
                                <?php }else if ($item->etat_id == Home\ETAT::ENCOURS){ ?>
                                    <a href="#">Emise <?= depuis($item->created) ?></a>
                                <?php }else if ($item->etat_id == 1){ ?>
                                    <a href="#">Approuvée <?= depuis($item->date_approuve) ?></a>
                                <?php } ?>
                                <i class="fa fa-user"></i> <a href="#">Par <?= $item->manoeuvre->name() ?></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 border-right">
                        <div class="row">
                            <div class="col-4">
                                <div class="text-center">
                                    <img alt="image" style="height: 40px;" class="m-t-xs" src="<?= $this->stockage("images", "machines", $item->machine->image) ?>">
                                </div>
                            </div>
                            <div class="col-8" style="font-size: 11px;">
                                <h4 style="margin: 0"><strong><?= $item->machine->name() ?></strong></h4>
                                <address>
                                    <strong><?= $item->machine->marque ?></strong><br>
                                    <?= $item->machine->modele ?>
                                </address>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1 text-right border-right">
                        <img style="width: 100%;" onclick="openImage('<?= $this->stockage("images", "pannes", $item->image) ?>')" class="m-t-xs cursor" src="<?= $this->stockage("images", "pannes", $item->image) ?>">
                    </div>
                    <div class="col-md-2 text-right">
                        <?php if ($item->etat_id == 1) { ?>
                            <div class="vote-icon">
                                <i class="fa fa-check text-green" data-toggle="tooltip" title="Demande validée"> </i>
                            </div>
                        <?php } else if ($item->etat_id == -1) { ?>
                            <div class="vote-icon">
                                <i class="fa fa-close text-red" data-toggle="tooltip" title="Demande annulée"> </i>
                            </div>

                        <?php }else if ($item->etat_id == Home\ETAT::ENCOURS){ ?>
                            <div class="btn-group">
                                <button title="Faire l'entretien" data-toggle="modal" data-target="#modal-panne<?= $item->getId() ?>" class="btn btn-white btn-sm"><i class="fa fa-check text-green"></i> Reparer</button>
                                <button data-toggle="tooltip" title="annuler la demande" class="btn btn-white btn-sm" onclick="annulerPanne(<?= $item->getId() ?>)"><i class="fa fa-close text-red"></i></button>
                            </div>
                        <?php } ?>                                      
                    </div>
                </div>
            </div>

        <?php  }  } ?>
    </div>










    <div role="tabpanel" id="tabentretiens" class="tab-pane">
       <?php foreach ($datas1 as $key => $item) {
        if ($item->type == "vehicule") { ?>
            <div class="vote-item <?= ($item->etat_id != 0)?'fini':'' ?>">
                <div class="row">
                    <div class="col-md-6 border-right">
                        <div class="vote-actions" style="margin-right: 7%; height: 100%">
                            <div class="vote-icon">
                                <i class="fa fa-car text-orange"></i>
                                <span class="label label-<?= $item->etat->class ?>"><?= $item->etat->name ?></span>
                            </div>
                        </div>
                        <div>
                            <span class="vote-title"><u class="text-info">#<?= $item->reference ?></u> // <?= $item->typeentretienvehicule->name ?></span>
                            <span><?= $item->comment ?></span>
                            <div class="vote-info">
                              <i class="fa fa-clock-o"></i> 
                              <?php if ($item->etat_id == -1) { ?>
                                <a href="#">Annulée <?= depuis($item->date_approuve) ?></a>
                            <?php }else if ($item->etat_id == Home\ETAT::ENCOURS){ ?>
                                <a href="#">Emise <?= depuis($item->created) ?></a>
                            <?php }else if ($item->etat_id == 1){ ?>
                                <a href="#">Du <?= datecourt($item->started) ?> au <?= datecourt($item->finished) ?></a>
                            <?php } ?>
                            <i class="fa fa-wrench"></i> <a href="#">Entretien par <?= $item->prestataire->name() ?></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 border-right">
                    <div class="row">
                        <div class="col-4">
                            <div class="text-center">
                                <img alt="image" style="height: 40px;" class="m-t-xs" src="<?= $this->stockage("images", "vehicules", $item->vehicule->image) ?>">
                            </div>
                        </div>
                        <div class="col-8" style="font-size: 11px;">
                            <h4 style="margin: 0"><strong><?= $item->vehicule->immatriculation ?></strong></h4>
                            <address>
                                <strong><?= $item->vehicule->marque->name ?></strong><br>
                                <?= $item->vehicule->modele ?>
                            </address>
                        </div>
                    </div>
                </div>
                <div class="col-md-1 text-right border-right">
                    <img style="width: 100%;" onclick="openImage('<?= $this->stockage("images", "demandeentretiens", $item->image) ?>')" class="m-t-xs cursor" src="<?= $this->stockage("images", "demandeentretiens", $item->image) ?>">
                </div>
                <div class="col-md-2 text-right">
                    <?php if ($item->etat_id == 1) { ?>
                        <div class="vote-icon">
                            <i class="fa fa-check text-green" data-toggle="tooltip" title="Entretien terminé avec succes"> </i>
                        </div>
                    <?php } else if ($item->etat_id == -1) { ?>
                        <div class="vote-icon">
                            <i class="fa fa-close text-red" data-toggle="tooltip" title="Entretien annulé"> </i>
                        </div>

                    <?php }else if ($item->etat_id == Home\ETAT::ENCOURS){ ?>
                        <div class="">
                            <button data-toggle="modal" data-target="#modal-validerentretien-vehicule<?= $item->getId() ?>" title="Entretien terminé avec succes !" class="btn btn-white btn-block btn-sm"><i class="fa fa-check text-green"></i> Terminer</button>
                            <button data-toggle="tooltip" title="Annuler Entretien" class="btn btn-white btn-block btn-sm" onclick="annulerEntretienVehicule(<?= $item->getId() ?>)"><i class="fa fa-close text-red"></i> Annuler</button>
                        </div>
                    <?php } ?>                                      
                </div>
            </div>
        </div>

    <?php }else{ ?>
        <div class="vote-item <?= ($item->etat_id != 0)?'fini':'' ?>">
            <div class="row">
                <div class="col-md-6 border-right">
                    <div class="vote-actions" style="margin-right: 7%; height: 100%">
                        <div class="vote-icon">
                            <i class="fa fa-steam text-orange"></i>
                            <span class="label label-<?= $item->etat->class ?>"><?= $item->etat->name ?></span>
                        </div>
                    </div>
                    <div>
                        <span class="vote-title"><u class="text-info">#<?= $item->reference ?></u> // <?= $item->name ?></span>
                        <span><?= $item->comment ?></span>
                        <div class="vote-info">
                          <i class="fa fa-clock-o"></i> 
                          <?php if ($item->etat_id == -1) { ?>
                            <a href="#">Annulée <?= depuis($item->date_approuve) ?></a>
                        <?php }else if ($item->etat_id == Home\ETAT::ENCOURS){ ?>
                            <a href="#">Emise <?= depuis($item->created) ?></a>
                        <?php }else if ($item->etat_id == 1){ ?>
                            <a href="#">Du <?= datecourt($item->started) ?> au <?= datecourt($item->finished) ?></a>
                        <?php } ?>
                        <i class="fa fa-wrench"></i> <a href="#">Entretien par <?= $item->prestataire->name() ?></a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 border-right">
                <div class="row">
                    <div class="col-4">
                        <div class="text-center">
                            <img alt="image" style="height: 40px;" class="m-t-xs" src="<?= $this->stockage("images", "machines", $item->machine->image) ?>">
                        </div>
                    </div>
                    <div class="col-8" style="font-size: 11px;">
                        <h4 style="margin: 0"><strong><?= $item->machine->name() ?></strong></h4>
                        <address>
                            <strong><?= $item->machine->marque ?></strong><br>
                            <?= $item->machine->modele ?>
                        </address>
                    </div>
                </div>
            </div>
            <div class="col-md-1 text-right border-right">
                <img style="width: 100%;" onclick="openImage('<?= $this->stockage("images", "demandeentretiens", $item->image) ?>')" class="m-t-xs cursor" src="<?= $this->stockage("images", "demandeentretiens", $item->image) ?>">
            </div>
            <div class="col-md-2 text-right">
                <?php if ($item->etat_id == 1) { ?>
                    <div class="vote-icon">
                        <i class="fa fa-check text-green" data-toggle="tooltip" title="Entretien terminé avec succes"> </i>
                    </div>
                <?php } else if ($item->etat_id == -1) { ?>
                    <div class="vote-icon">
                        <i class="fa fa-close text-red" data-toggle="tooltip" title="Entretien annulé"> </i>
                    </div>

                <?php }else if ($item->etat_id == Home\ETAT::ENCOURS){ ?>
                    <div>
                        <button title="Entretien terminé avec succes !" data-toggle="modal" data-target="#modal-validerentretien-machine<?= $item->getId() ?>" class="btn btn-white btn-block btn-sm"><i class="fa fa-check text-green"></i> Terminer</button>
                        <button data-toggle="tooltip" title="Entretien échoué" class="btn btn-white btn-block btn-sm" onclick="annulerEntretienMachine(<?= $item->getId() ?>)"><i class="fa fa-close text-red"></i> Annuler</button>
                    </div>
                <?php } ?>                                      
            </div>
        </div>
    </div>

<?php  }  } ?>
</div>
</div>
</div>
</div>
</div>
</div>


<?php include($this->rootPath("webapp/gestion/elements/templates/footer.php")); ?>

<?php foreach ($datas as $key => $item) {
    if ($item->etat_id == Home\ETAT::ENCOURS) {
        if ($item->type == "vehicule") { 
            include($this->rootPath("composants/assets/modals/modal-entretienvehicule.php"));
        }else{
            include($this->rootPath("composants/assets/modals/modal-panne.php"));
        }
    } 
} ?>


<?php foreach ($datas1 as $key => $item) {
    if ($item->etat_id == Home\ETAT::ENCOURS) {
        if ($item->type == "vehicule") { 
            include($this->rootPath("composants/assets/modals/modal-validerentretien-vehicule.php"));
        }else{
            include($this->rootPath("composants/assets/modals/modal-validerentretien-machine.php"));
        }
    } 
} ?>

</div>
</div>


<?php include($this->rootPath("webapp/gestion/elements/templates/script.php")); ?>


</body>

</html>
