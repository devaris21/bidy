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
                <h2 class="text-uppercase">Le Stock des ressources</h2>
                <div class="container">
                    <div class="row">
                        <div class="col-xs-7 gras ">Afficher tous les détails</div>
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
                </div>            </div>
                <div class="col-sm-5">
                    <div class="title-action">
                        <button data-toggle='modal' data-target="#modal-approvisionnement" class="btn btn-warning dim"><i class="fa fa-plus"></i> Nouvel Approvisionnement</button>
                    </div>
                </div>
            </div>

            <div class="wrapper wrapper-content">
                <div class="text-center animated fadeInRightBig">

                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5 class="float-left">Du <?= datecourt($date1) ?> au <?= datecourt($date2) ?></h5>
                            <div class="float-right">
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
                        <div class="ibox-content">
                            <div class="">
                                <div class="row details">
                                    <div class="col-sm">
                                        <div class="carre bg-danger"></div><span>Quantité consommée</span>
                                    </div>
                                    <div class="col-sm">
                                        <div class="carre bg-primary"></div><span>Quantité approvisionnée</span>
                                    </div>
                                </div><br>
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th class="border-none"></th>
                                            <?php foreach ($ressources as $key => $ressource) { ?>
                                                <th><span class="text-uppercase"><?= $ressource->name ?></span> <br> <small><?= $ressource->unite ?></small></th>
                                            <?php } ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Stock de la veille</td>
                                            <?php foreach ($ressources as $key => $ressource) { ?>
                                                <td><span class="text-muted gras" style="font-size: 15px"><?= round($ressource->stock(dateAjoute1($productionjours[0]->ladate, -1)), 2) ?></span> &nbsp;</td>
                                            <?php } ?>
                                        </tr>
                                        <tr style="height: 18px;"></tr>

                                        <?php
                                        $i =0;
                                        foreach ($productionjours as $key => $production) {
                                            $i++; ?>
                                            <tr>
                                                <td><?= datecourt3($production->ladate)  ?></td>
                                                <?php
                                                $production->fourni("ligneconsommationjour");
                                                foreach ($ressources as $key => $ressource) {
                                                    foreach ($production->ligneconsommationjours as $key => $ligne) {
                                                        if ($ressource->getId() == $ligne->ressource_id) { 
                                                         $requette = "SELECT ligneapprovisionnement.ressource_id, SUM(quantite_recu) as quantite FROM ressource, approvisionnement, ligneapprovisionnement WHERE ressource.id = ligneapprovisionnement.ressource_id AND ligneapprovisionnement.approvisionnement_id = approvisionnement.id  AND ressource.id = ? AND DATE(approvisionnement.datelivraison) = ? AND approvisionnement.etat_id = ? GROUP BY ligneapprovisionnement.ressource_id ";
                                                         $datas = Home\RESSOURCE::execute($requette, [$ressource->getId(), $production->ladate, Home\ETAT::VALIDEE]);
                                                         if (count($datas) > 0) {
                                                            $item = $datas[0];
                                                        }else{
                                                            $item = new \stdclass();
                                                            $item->quantite = 0;
                                                        }
                                                        ?>
                                                        <td>
                                                            <h5><?= round($ressource->stock($production->ladate), 2) ?> <?= $ressource->unite ?></h5>
                                                            <div class="details">
                                                                <span class="d-inline text-red gras"><?= start0($ligne->consommation) ?></span> &nbsp; | &nbsp;
                                                                <span class="d-inline text-green"><?= start0(round($item->quantite, 2)) ?></span>
                                                            </div>
                                                        </td>
                                                    <?php }
                                                }
                                            } ?>
                                        </tr>
                                    <?php } ?>
                                    <tr style="height: 18px;"></tr>
                                    <tr>
                                        <td style="width: 20%"><h2 class="text-center gras text-uppercase">Stock actuel</h2></td>
                                        <?php foreach ($ressources as $key => $ressource) { ?>
                                            <td><h2 class="text-success gras" ><?= round($ressource->stock(dateAjoute()), 2) ?></h2></td>
                                        <?php } ?>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>


            </div>
        </div>


        <?php include($this->rootPath("webapp/gestion/elements/templates/footer.php")); ?>
        <?php include($this->rootPath("composants/assets/modals/modal-approvisionnement.php")); ?>  

    </div>
</div>


<?php include($this->rootPath("webapp/gestion/elements/templates/script.php")); ?>


</body>

</html>
