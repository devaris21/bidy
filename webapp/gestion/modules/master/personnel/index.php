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
                    <h2 class="text-uppercase">Les ressources humaines</h2>
                </div>
                <div class="col-sm-8 cards">
                    <!-- TODO decompte des véhicules -->
                    <div class="row">
                        <div class="col-md-4 border">
                            <div class="ibox text-blue">
                                <div class="ibox-title">
                                    <h5 class="text-uppercase">Au total</h5>
                                </div>
                                <div class="ibox-content">
                                    <div class="row text-center">
                                        <div class="col-sm-6 border-right">
                                            <h2 class="no-margins"><?= start0(count(Home\MANOEUVRE::getAll())); ?></h2>
                                        </div>
                                        <div class="col-sm-6">
                                            <h2 class="no-margins"><?= start0(count(Home\CHAUFFEUR::getAll())); ?></h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 border">
                            <div class="ibox text-green">
                                <div class="ibox-title">
                                    <h5 class="text-uppercase">Libres</h5>
                                </div>
                                <div class="ibox-content">
                                    <h2 class="no-margins"><?= start0(count(Home\CHAUFFEUR::libres())); ?></h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 border">
                            <div class="ibox text-red">
                                <div class="ibox-title">
                                    <h5 class="text-uppercase">En mission</h5>
                                </div>
                                <div class="ibox-content">
                                    <h2 class="no-margins"><?= start0(count(Home\CHAUFFEUR::mission())); ?></h2>
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
                            <h4 class="text-uppercase"><i class="fa fa-user"></i> Liste des manoeuvres</h4>
                        </div>
                        <div class="ibox-content" style="min-height: 300px;">
                            <?php if (count($groupes) > 0) { ?>
                                <div class="tabs-container">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <?php foreach ($groupes as $key => $groupe) { ?>
                                            <li class=""><a class="nav-link" data-toggle="tab" href="#parc<?= $groupe->getId() ?>"><?= $groupe->name() ?> &nbsp;&nbsp;&nbsp;<span class="label bg-aqua"><?= count($groupe->manoeuvres) ?></span></a></li>
                                        <?php } ?>
                                    </ul>
                                    <div class="tab-content" id="parcs">
                                        <br>
                                        <?php foreach ($groupes as $key => $groupe) { ?>
                                            <div role="tabpanel" id="parc<?= $groupe->getId() ?>" class="tab-pane">
                                                <table class="table tableUser">
                                                    <tbody>
                                                        <?php foreach ($groupe->manoeuvres as $key => $man) { 
                                                            $man->actualise();
                                                            $solde = $man->solde(); ?>
                                                            <tr>
                                                                <td class="project-people">
                                                                    <img class="rounded-circle" src="<?= $this->stockage("images", "manoeuvres", $man->image) ?>">
                                                                </td>
                                                                <td class="project-title">
                                                                    <a href="project_detail.html"><?= $man->name() ?></a>
                                                                    <br/>
                                                                    <small class="text-<?= $man->etatmanoeuvre->class ?>"><?= $man->etatmanoeuvre->name() ?></small>
                                                                </td>
                                                                <td class="project-title">
                                                                    <small><i class="fa fa-map-marker"></i> <?= $man->adresse ?></small><br>
                                                                    <small><i class="fa fa-phone"></i> <?= $man->contact ?></small>
                                                                </td>
                                                                <td>
                                                                    <h3 class="mp0"><?= money($solde) ?> <?= $params->devise ?></h3>
                                                                    <?php if ($solde > 0) { ?>
                                                                        <button style="margin: 0%" data-toggle="modal" data-target="#modal-paye-manoeuvre<?= $man->getId() ?>" class="btn btn-primary dim btn-xs"><i class="fa fa-money"></i> Faire la paye</button>
                                                                    <?php } ?>                                                                 
                                                                </td>
                                                                <td class="project-actions">
                                                                    <button onclick="available(<?= $man->getId() ?>)" class="btn btn-white btn-sm"><i class="fa fa-lock"></i></button>
                                                                    <button onclick="modification('manoeuvre', <?= $man->getId() ?>)"  data-toggle="modal" data-target="#modal-manoeuvre" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i></button>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            <?php }else{ ?>
                                <h1 style="margin-top: 6%;" class="text-center text-muted"><i class="fa fa-folder-open-o fa-2x"></i> <br> Aucun manoeuvre enregistré pour le moment!</h1>
                            <?php } ?>
                        </div>
                    </div>
                </div>





                <div class="col-md-4">
                    <div class="ibox" >
                        <div class="ibox-title">
                            <h4 class="text-uppercase"><i class="fa fa-cab"></i> Liste des chauffeurs</h4>
                        </div>
                        <div class="ibox-content" style="min-height: 300px;">
                            <?php if (count($chauffeurs) > 0) { ?>
                                <div role="tabpanel" id="parc<?= $groupe->getId() ?>" class="tab-pane">
                                    <table class="table tableUser">
                                        <tbody>
                                            <?php foreach ($chauffeurs as $key => $man) { 
                                                $man->actualise();
                                                $solde = 140455; ?>
                                                <tr>
                                                    <td class="project-people">
                                                        <img class="rounded-circle" src="<?= $this->stockage("images", "manoeuvres", $man->image) ?>">
                                                    </td>
                                                    <td colspan="2" class="project-title">                                                    
                                                        <span class="pull-right"><button onclick="available(<?= $man->getId() ?>)" class="btn btn-white btn-sm"><i class="fa fa-lock"></i></button>
                                                            <button onclick="modification('manoeuvre', <?= $man->getId() ?>)"  data-toggle="modal" data-target="#modal-manoeuvre" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i></button></span>
                                                            <a href="project_detail.html"><?= $man->name() ?></a>
                                                            <br/>
                                                            <small class="text-<?= $man->etatchauffeur->class ?>"><?= $man->etatchauffeur->name() ?></small><br>
                                                            <small><i class="fa fa-map-marker"></i> <?= $man->adresse ?></small><br>
                                                            <small><i class="fa fa-phone"></i> <?= $man->contact ?> - Permis<b> <?= $man->typepermis ?></b> </small>
                                                            <hr class="mp5">
                                                            <h3 class="mp0 d-inline"><?= money($solde) ?> <?= $params->devise ?></h3>
                                                            <?php if ($solde > 0) { ?>
                                                                <button style="margin: -3%" data-toggle="modal" data-target="#modal-paye-manoeuvre<?= $man->getId() ?>" class="btn btn-primary btn-xs pull-right dim"><i class="fa fa-money"></i> Faire la paye</button>
                                                            <?php } ?>  
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php }else{ ?>
                                    <h2 style="margin-top: 6%;" class="text-center text-muted"><i class="fa fa-folder-open-o fa-2x"></i> <br> Aucun chauffeur enregistré pour le moment!</h2>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

            <?php include($this->rootPath("webapp/gestion/elements/templates/footer.php")); ?>


            <?php 
            foreach (Home\MANOEUVRE::getAll() as $key => $man) {
                $solde = $man->solde();
                if ($solde > 0) { 
                    include($this->rootPath("composants/assets/modals/modal-paye-manoeuvre.php"));
                } 
            } 
            ?>

        </div>
    </div>


    <?php include($this->rootPath("webapp/gestion/elements/templates/script.php")); ?>


</body>

</html>
