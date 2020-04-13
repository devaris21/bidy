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
                    <h2>Votre Parc Automobile</h2>
                    <ol class="breadcrumb">
                        <li class="text-center">
                            <span>Afficher par ...</span><br>
                            <div class="btn-group">
                                <a href="<?= $this->url("gestion", "master", "parcauto", "categorie") ?>" class="btn btn-white btn-xs <?= ($this->getId() == "categorie")?"active":""?>"><i class="fa fa-thumbs-up"></i> Groupe</a>
                                <a href="<?= $this->url("gestion", "master", "parcauto", "parcauto") ?>" class="btn btn-white btn-xs <?= ($this->getId() == "parcauto")?"active":""?>"><i class="fa fa-comments"></i>  Type d'auto</a>
                                <a href="<?= $this->url("gestion", "master", "parcauto", "fabriquant") ?>" class="btn btn-white btn-xs <?= ($this->getId() == "fabriquant")?"active":""?>"><i class="fa fa-share"></i> Fabriquant</a>
                            </div>
                        </li>
                    </ol>
                </div>
                <div class="col-sm-8 cards">
                    <!-- TODO decompte des véhicules -->
                    <div class="row">
                        <div class="col-md-4">
                            <div class="ibox text-blue">
                                <div class="ibox-title">
                                    <h5 class="text-uppercase">Au total</h5>
                                </div>
                                <div class="ibox-content">
                                    <h2 class="no-margins"><?= start0(count(Home\VEHICULE::parcauto())); ?></h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="ibox text-green">
                                <div class="ibox-title">
                                    <h5 class="text-uppercase">Libres</h5>
                                </div>
                                <div class="ibox-content">
                                    <h2 class="no-margins"><?= start0(count(Home\VEHICULE::libres())); ?></h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="ibox text-red">
                                <div class="ibox-title">
                                    <h5 class="text-uppercase">En mission</h5>
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
                <div class="ibox" >
                    <div class="ibox-content" style="min-height: 400px;">
                        <div class="tabs-container">
                            <ul class="nav nav-tabs" role="tablist">
                                <?php foreach ($types as $key => $type) { ?>
                                    <li class=""><a class="nav-link" data-toggle="tab" href="#parc<?= $type->getId() ?>">Manouevres <?= $type->name ?> &nbsp;&nbsp;&nbsp;<span class="label bg-aqua"><?= count($type->vehicules) ?></span></a></li>
                                <?php } ?>
                            </ul>
                            <div class="tab-content" id="parcs">
                                <br>
                                <?php foreach ($types as $key => $type) { ?>
                                    <div role="tabpanel" id="parc<?= $type->getId() ?>" class="tab-pane">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td class="project-status">
                                                        <span class="label label-primary">Active</span>
                                                    </td>
                                                    <td class="project-title">
                                                        <a href="project_detail.html">Contract with Zender Company</a>
                                                        <br/>
                                                        <small>Created 14.08.2014</small>
                                                    </td>
                                                    <td class="project-completion">
                                                        <small>Completion with: 48%</small>
                                                        <div class="progress progress-mini">
                                                            <div style="width: 48%;" class="progress-bar"></div>
                                                        </div>
                                                    </td>
                                                    <td class="project-people">
                                                        <a href=""><img alt="image" class="rounded-circle" src="img/a3.jpg"></a>
                                                        <a href=""><img alt="image" class="rounded-circle" src="img/a1.jpg"></a>
                                                        <a href=""><img alt="image" class="rounded-circle" src="img/a2.jpg"></a>
                                                        <a href=""><img alt="image" class="rounded-circle" src="img/a4.jpg"></a>
                                                        <a href=""><img alt="image" class="rounded-circle" src="img/a5.jpg"></a>
                                                    </td>
                                                    <td class="project-actions">
                                                        <a href="#" class="btn btn-white btn-sm"><i class="fa fa-folder"></i> View </a>
                                                        <a href="#" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Edit </a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php include($this->rootPath("webapp/gestion/elements/templates/footer.php")); ?>

        </div>
    </div>


    <?php include($this->rootPath("webapp/gestion/elements/templates/script.php")); ?>


</body>

</html>
