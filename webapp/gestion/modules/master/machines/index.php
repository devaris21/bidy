<!DOCTYPE html>
<html>

<?php include($this->rootPath("webapp/gestion/elements/templates/head.php")); ?>


<body class="fixed-sidebar">

    <div id="wrapper">

        <?php include($this->rootPath("webapp/gestion/elements/templates/sidebar.php")); ?>  

        <div id="page-wrapper" class="gray-bg">

            <?php include($this->rootPath("webapp/gestion/elements/templates/header.php")); ?>  


            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-sm-4">
                    <h2 class="text-uppercase">Véhicules & machines</h2>
                </div>
                <div class="col-sm-8 cards">
                    <!-- TODO decompte des véhicules -->
                    <div class="row">
                        <div class="col-md-4">
                            <div class="ibox text-blue">
                                <div class="ibox-title">
                                    <h5 class="text-uppercase">Fonctionnels</h5>
                                </div>
                                <div class="ibox-content">
                                    <h2 class="no-margins"><?= start0(count(Home\VEHICULE::parcauto())); ?></h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="ibox text-green">
                                <div class="ibox-title">
                                    <h5 class="text-uppercase">En réparation</h5>
                                </div>
                                <div class="ibox-content">
                                    <h2 class="no-margins"><?= start0(count(Home\VEHICULE::libres())); ?></h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="ibox text-red">
                                <div class="ibox-title">
                                    <h5 class="text-uppercase">En panne</h5>
                                </div>
                                <div class="ibox-content">
                                    <h2 class="no-margins"><?= start0(count(Home\VEHICULE::mission())); ?></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="wrapper wrapper-content" id="autos">
                <div class="row">
                    <div class="col-md-8">
                        <div class="ibox" >
                            <div class="ibox-title">
                                <h5 class="text-uppercase">Tous les véhicules </h5>
                                <div class="ibox-tools">
                                    <button data-toggle="modal" data-target="#modal-vehicule" style="margin-top: -5%" class="btn btn-primary btn-xs dim"><i class="fa fa-plus"></i> Nouveau véhicule</button>
                                </div>
                            </div>
                            <div class="ibox-content table-responsive" style="min-height: 400px;">
                                <table class="table table-striped" id="tableCarplan">
                                    <tbody>
                                        <?php foreach ($vehicules as $key => $vehicule) {
                                            $vehicule->actualise();
                                            ?>
                                            <tr class="mp0 <?= ($vehicule->etatvehicule_id == 0)?'encours':'' ?> border-bottom" >    
                                                <td>
                                                    <img alt="image" style="width: 40px;" class="m-t-xs" src="<?= $this->stockage("images", "vehicules", $vehicule->image) ?>">
                                                </td>
                                                <td class="">
                                                    <h5 class="text-uppercase gras"><?= $vehicule->marque->name() ?> <?= $vehicule->modele ?></h5>
                                                    <h6 class=""><?= $vehicule->immatriculation ?></h6>
                                                </td>
                                                <td class="">
                                                    <h5 class="mp0"><?= $vehicule->typevehicule->name() ?></h5>
                                                    <h5 class="mp0"><?= $vehicule->groupevehicule->name() ?></h5>
                                                </td>                                      
                                                <td class="project-status">
                                                    <span class="pull-right label label-<?= $vehicule->etatvehicule->class ?>"><?= $vehicule->etatvehicule->name ?></span><br>
                                                    <div class="btn-group btn-tools">
                                                        <span data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="mp5 cursor dropdown-toggle"><i class="fa fa-gears"></i> options</span>
                                                          <div class="dropdown-menu">
                                                            <div class="dropdown-divider"></div>
                                                            <?php if ($vehicule->etatvehicule_id == Home\ETATVEHICULE::RAS) { ?>
                                                                <a class="dropdown-item" data-toggle="modal" data-target="#modal-sinistre"  href="#"><i class="fa fa-user"></i> Déclarer un sinistre</a>
                                                                <div class="dropdown-divider"></div>
                                                            <?php }else{ ?>
                                                                <a class="dropdown-item" onclick="creerCompte(<?= $vehicule->getId() ?>)" href="#"><i class="fa fa-user"></i> Déclarer une panne/sinistre</a>
                                                                <div class="dropdown-divider"></div>
                                                            <?php } ?>
                                                            <a class="dropdown-item" onclick="modification('vehicule', <?= $vehicule->getId() ?>)" data-toggle="modal" data-target="#modal-vehicule" href="#"><i class="fa fa-pencil"></i> Modifier les infos du véhicule</a>
                                                            <a class="dropdown-item"  onclick="suppressionWithPassword('vehicule', <?= $vehicule->getId() ?>)" data-toggle="tooltip" title="Supprimer la vehicule" href="#"><i class="fa fa-close text-red"></i> Supprimer cette vehicule</a>
                                                        </div>
                                                    </div>
                                                </td>      

                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>                             
                            </div>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="ibox" >
                            <div class="ibox-title">
                                <h5 class="text-uppercase">les machines </h5>
                                <div class="ibox-tools">
                                    <button data-toggle="modal" data-target="#modal-machine" style="margin-top: -5%" class="btn btn-success btn-xs dim"><i class="fa fa-plus"></i> Nouvelle machine</button>
                                </div>
                            </div>
                            <div class="ibox-content table-responsive" style="min-height: 400px;">
                                <table class="table table-striped" id="tableCarplan">
                                    <tbody>
                                        <?php foreach ($machines as $key => $machine) {
                                            $machine->actualise();
                                            ?>
                                            <tr class="mp0 <?= ($machine->etatvehicule_id == 0)?'encours':'' ?> border-bottom" >    
                                                <td>
                                                    <img alt="image" style="width: 40px;" class="m-t-xs" src="<?= $this->stockage("images", "machines", $machine->image) ?>">
                                                </td>
                                                <td class="">
                                                    <h5 class="text-uppercase gras"><?= $machine->name() ?></h5>
                                                    <h6 class=""><?= $machine->marque ?> <?= $machine->modele ?></h6>
                                                </td>                                     
                                                <td class="project-status">
                                                    <span class="pull-right label label-<?= $machine->etatvehicule->class ?>"><?= $machine->etatvehicule->name ?></span><br>
                                                    <div class="btn-group pull-right">
                                                        <span data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="mp5 cursor dropdown-toggle"><i class="fa fa-gears"></i> option</span>
                                                        <div class="dropdown-menu">
                                                            <div class="dropdown-divider"></div>
                                                            <?php if ($machine->etatvehicule_id == Home\ETATVEHICULE::RAS) { ?>
                                                                <a class="dropdown-item" data-toggle="modal" data-target="#modal-panne" href="#"><i class="fa fa-user"></i> Déclarer une panne</a>
                                                                <div class="dropdown-divider"></div>
                                                            <?php } ?>
                                                            <a class="dropdown-item" onclick="modification('machine', <?= $machine->getId() ?>)" data-toggle="modal" data-target="#modal-machine" href="#"><i class="fa fa-pencil"></i> Modifier les infos du véhicule</a>
                                                            <a class="dropdown-item"  onclick="suppressionWithPassword('machine', <?= $machine->getId() ?>)" data-toggle="tooltip" title="Supprimer la machine" href="#"><i class="fa fa-close text-red"></i> Supprimer cette machine</a>
                                                        </div>
                                                    </div>
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

            <?php include($this->rootPath("webapp/gestion/elements/templates/footer.php")); ?>
            <?php include($this->rootPath("composants/assets/modals/modal-vehicule.php")); ?> 
            <?php include($this->rootPath("composants/assets/modals/modal-machine.php")); ?> 
            <?php include($this->rootPath("composants/assets/modals/modal-sinistre.php")); ?> 
            <?php include($this->rootPath("composants/assets/modals/modal-panne.php")); ?> 

        </div>
    </div>


    <?php include($this->rootPath("webapp/gestion/elements/templates/script.php")); ?>


</body>

</html>
