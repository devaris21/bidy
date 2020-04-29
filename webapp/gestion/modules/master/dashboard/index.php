<!DOCTYPE html>
<html>

<?php include($this->rootPath("webapp/gestion/elements/templates/head.php")); ?>


<body class="fixed-sidebar">

    <div id="wrapper">

        <?php include($this->rootPath("webapp/gestion/elements/templates/sidebar.php")); ?>  

        <div id="page-wrapper" class="gray-bg">

          <?php include($this->rootPath("webapp/gestion/elements/templates/header.php")); ?>  

          <div class="wrapper wrapper-content">
            <div class="animated fadeInRightBig">
                <div class="row" >
                    <div class="col-lg-3">
                        <div class="ibox ">
                            <div class="ibox-title">
                                <h5>Commandes passés aujourd'hui</h5>
                            </div>
                            <div class="ibox-content">
                                <h2 class="no-margins">4</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="ibox ">
                            <div class="ibox-title">
                                <h5>Livraisons pour aujourd'hui</h5>
                            </div>
                            <div class="ibox-content">
                                <h2 class="no-margins"><?= start0(count($groupes__)); ?> / <?= start0(count($livraisons__)); ?></h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="ibox ">
                            <div class="ibox-title">
                                <h5>Véhicules / Machines</h5>
                            </div>
                            <div class="ibox-content">
                                <h2 class="no-margins"><?= start0(count(Home\VEHICULE::getAll())); ?> / <?= start0(count(Home\MACHINE::getAll())); ?></h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="ibox">
                            <div class="ibox-title">
                                <h5>Le personnel</h5>
                            </div>
                            <div class="ibox-content">
                                <h2 class="no-margins"><?= start0(count(array_merge(Home\CHAUFFEUR::getAll(), Home\MANOEUVRE::getAll())))  ?> personnes</h2>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="border-bottom white-bg dashboard-header">

                    <div class="row">
                        <div class="col-md-3">
                            <h3 class="text-uppercase">Stock des produits</h3>
                            <ul class="list-group clear-list m-t">
                                <?php foreach (Home\PRODUIT::getAll() as $key => $produit) { ?>
                                    <li class="list-group-item">
                                        <a class="text-dark" href="<?= $this->url("gestion", "master", "demandevehicules")  ?>">
                                            <i class="fa fa-cubes"></i>&nbsp;&nbsp;&nbsp; <?= $produit->name() ?>
                                            <span class="float-right">
                                                <span class="label label-success"><?= money($produit->stock(dateAjoute())) ?></span>
                                            </span>
                                        </a>
                                    </li>
                                <?php } ?>
                                <li class="list-group-item"></li>
                            </ul><hr>
                            
                            <button style="margin-top: -5%; font-size: 11px;" type="button" data-toggle=modal data-target='#modal-clients' class="btn btn-primary btn-sm dim float-right"><i class="fa fa-plus"></i> Nouvelle commande /livraison </button>

                        </div>
                        <div class="col-md-6 border-right border-left">
                            <div class="" style="margin-top: 0%">
                                <div id="ct-chart" style="height: 270px;"></div>
                            </div>
                            <h6 class="text-uppercase text-center">Courbe représentative du stock de produits en fonction des commandes actuelles</h6>
                            <hr class="">

                            <?php if ($employe->isAutoriser("caisse")) { ?>
                                <div class="row stat-list">
                                    <div class="col-4">
                                        <h2 class="no-margins gras"><?= money(Home\OPERATION::resultat(Home\PARAMS::DATE_DEFAULT , dateAjoute())) ?></h2>
                                        <small>En caisse actuellement</small>
                                        <div class="progress progress-mini">
                                            <div class="progress-bar bg-black" style="width: 100%;"></div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <h3 class="no-margins text-green"><?= money(Home\OPERATION::entree(dateAjoute() , dateAjoute(+1))) ?></h3>
                                        <small>Entrées du jour</small>
                                        <div class="progress progress-mini">
                                            <div class="progress-bar bg-primary" style="width: 100%;"></div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <h3 class="no-margins text-red"><?= money(Home\OPERATION::sortie(dateAjoute() , dateAjoute(+1))) ?></h3>
                                        <small>Dépenses du jour</small>
                                        <div class="progress progress-mini">
                                            <div class="progress-bar bg-danger" style="width: 100%;"></div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>

                        </div>
                        <div class="col-md-3 text-center">
                            <h3 class="text-uppercase">Stock des ressources</h3>
                            <ul class="list-group  text-left clear-list m-t">
                                <?php foreach (Home\RESSOURCE::getAll() as $key => $ressource) { ?>
                                    <li class="list-group-item">
                                        <a class="text-dark" href="<?= $this->url("gestion", "master", "demandevehicules")  ?>">
                                            <i class="fa fa-truck"></i>&nbsp;&nbsp;&nbsp; <?= $ressource->name() ?>
                                            <span class="float-right">
                                                <span class="label label-primary"><?= money($ressource->stock(dateAjoute())) ?> <?= $ressource->abbr ?></span>
                                            </span>
                                        </a>
                                    </li>
                                <?php } ?>
                                <li class="list-group-item"></li>
                            </ul> <br>
                            <hr class="mp0">

                            <a href="<?= $this->url("gestion", "caisse", "comptedujour") ?>" ><button class="btn btn-warning dim btn-block"> <i class="fa fa-file-text-o"></i> Rapport de la journée</button></a>       

                            <?php if ($employe->isAutoriser("production")) { ?>
                                <button data-toggle="modal" data-target="#modal-productionjour" onclick=" modification('productionjour', <?= $productionjour->getId(); ?>) " class="btn btn-primary dim btn-block"><i class="fa fa-cubes"></i> Production de la journée</button>
                            <?php } ?>
                            

                            
                            <!-- <h4 class="text-uppercase text-red"><i class="fa fa-car"></i> Véhicules en livraison</h4>
                            <div>
                                <?php 
                                $vehicules = Home\VEHICULE::mission();
                                if (count($vehicules) > 0) { ?>
                                    <table class="table text-left">
                                        <tbody>
                                            <?php foreach ($vehicules as $key => $vehicule) {
                                                $vehicule->actualise();
                                                ?>
                                                <tr>    
                                                    <td>
                                                        <img alt="image" style="width: 30px;" class="m-t-xs" src="<?= $this->stockage("images", "vehicules", $vehicule->image) ?>">
                                                    </td>
                                                    <td class="">
                                                        <h5 class="text-uppercase gras"><?= $vehicule->marque->name() ?> <?= $vehicule->modele ?></h5>
                                                        <h6 class=""><?= $vehicule->immatriculation ?></h6>
                                                    </td>                                      
                                                    <td class="project-status">
                                                        <span class="pull-right label label-<?= $vehicule->etatvehicule->class ?>"></span>
                                                    </td>   
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>    
                                <?php }else{ ?>
                                    <p class="text-center text-muted">Aucun pour le moment!</p>
                                <?php } ?>                         
                            </div> -->

                        </div>
                    </div>    
                </div>

<div>
    <div>
                            <div class="row">
                            <div class="col-lg-6">
                                <div class="ibox ">
                                    <div class="ibox-title">
                                        <h5>User project list</h5>
                                        <div class="ibox-tools">
                                            <a class="collapse-link">
                                                <i class="fa fa-chevron-up"></i>
                                            </a>
                                            <a class="close-link">
                                                <i class="fa fa-times"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="ibox-content table-responsive">
                                        <table class="table table-hover no-margins">
                                            <thead>
                                            <tr>
                                                <th>Status</th>
                                                <th>Date</th>
                                                <th>User</th>
                                                <th>Value</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td><small>Pending...</small></td>
                                                <td><i class="fa fa-clock-o"></i> 11:20pm</td>
                                                <td>Samantha</td>
                                                <td class="text-navy"> <i class="fa fa-level-up"></i> 24% </td>
                                            </tr>
                                            <tr>
                                                <td><span class="label label-warning">Canceled</span> </td>
                                                <td><i class="fa fa-clock-o"></i> 10:40am</td>
                                                <td>Monica</td>
                                                <td class="text-navy"> <i class="fa fa-level-up"></i> 66% </td>
                                            </tr>
                                            <tr>
                                                <td><small>Pending...</small> </td>
                                                <td><i class="fa fa-clock-o"></i> 01:30pm</td>
                                                <td>John</td>
                                                <td class="text-navy"> <i class="fa fa-level-up"></i> 54% </td>
                                            </tr>
                                            <tr>
                                                <td><small>Pending...</small> </td>
                                                <td><i class="fa fa-clock-o"></i> 02:20pm</td>
                                                <td>Agnes</td>
                                                <td class="text-navy"> <i class="fa fa-level-up"></i> 12% </td>
                                            </tr>
                                            <tr>
                                                <td><small>Pending...</small> </td>
                                                <td><i class="fa fa-clock-o"></i> 09:40pm</td>
                                                <td>Janet</td>
                                                <td class="text-navy"> <i class="fa fa-level-up"></i> 22% </td>
                                            </tr>
                                            <tr>
                                                <td><span class="label label-primary">Completed</span> </td>
                                                <td><i class="fa fa-clock-o"></i> 04:10am</td>
                                                <td>Amelia</td>
                                                <td class="text-navy"> <i class="fa fa-level-up"></i> 66% </td>
                                            </tr>
                                            <tr>
                                                <td><small>Pending...</small> </td>
                                                <td><i class="fa fa-clock-o"></i> 12:08am</td>
                                                <td>Damian</td>
                                                <td class="text-navy"> <i class="fa fa-level-up"></i> 23% </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>               
</div>
    </div>
</div>

            </div>
        </div>
        <br>

        <?php include($this->rootPath("webapp/gestion/elements/templates/footer.php")); ?>

        <?php include($this->rootPath("composants/assets/modals/modal-clients.php")); ?> 
        <?php include($this->rootPath("composants/assets/modals/modal-client.php")); ?> 

    </div>
</div>


<?php include($this->rootPath("webapp/gestion/elements/templates/script.php")); ?>


<script>
    $(document).ready(function() {

        var id = "<?= $this->getId();  ?>";
        if (id == 1) {
            setTimeout(function() {
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    showMethod: 'slideDown',
                    timeOut: 4000
                };
                toastr.success('Content de vous revoir de nouveau!', 'Bonjour <?= $employe->name(); ?>');
            }, 1300);
        }
        

 // Stocked horizontal bar

 new Chartist.Bar('#ct-chart', {
    labels: [<?php foreach ($tableau as $key => $data){ ?> "<?= $data->name ?>", <?php } ?>],
    series: [
    [<?php foreach ($tableau as $key => $data){ ?> <?= $data->stock ?>, <?php } ?>],
    [<?php foreach ($tableau as $key => $data){ ?> <?= $data->commande ?>, <?php } ?>]
    ]
}, {
    seriesBarDistance: 10,
    reverseData: true,
    horizontalBars: true,
    axisY: {
        offset: 80
    }
});


});
</script>


</body>

</html>