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
                <h2 class="text-uppercase text-blue gras">Productions & rangements</h2>
            </div>
            <div class="col-sm-3">
                <button style="margin-top: 5%" data-toggle="modal" data-target="#modal-productionjour" onclick=" modification('productionjour', <?= $productionjour->getId(); ?>)" class="btn btn-success pull-right dim"><i class="fa fa-plus"></i> Nouvelle Production</button>
            </div>
        </div>

        <div class="wrapper wrapper-content">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Toutes les productions non rangées</h5>
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
                <div class="ibox-content">
                 <?php if (count($datas + $encours) > 0) { ?>
                    <table class="footable table table-stripped toggle-arrow-tiny">
                        <thead>
                            <tr>

                                <th data-toggle="true">Status</th>
                                <th></th>
                                <th>Date</th>
                                <th>Enregistré par</th>
                                <th data-hide="all"></th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($encours as $key => $production) {
                                $production->actualise(); 
                                $lots = $production->fourni("ligneproductionjour");
                                ?>
                                <tr style="border-bottom: 2px solid black">
                                    <td class="project-status">
                                        <span class="label label-<?= $production->etat->class ?>"><?= $production->etat->name ?></span>
                                    </td>
                                    <td>
                                        <h5 class="text-uppercase">Production non rangé</h5>
                                    </td>
                                    <td>
                                        <h5 class="text-uppercase"><?= datecourt3($production->ladate) ?></h5>
                                    </td>
                                    <td>
                                        <h5 class="text-uppercase"><?= $production->employe->name() ?></h5>
                                    </td>
                                    <td class="border-right">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <?php foreach ($production->ligneproductionjours as $key => $ligne) { 
                                                        $ligne->actualise(); ?>
                                                        <th class="text-center"><?= $ligne->produit->name() ?></th>
                                                    <?php } ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><h4 class="mp0 text-muted">Produite : </h4></td>
                                                    <?php foreach ($production->ligneproductionjours as $key => $ligne) { ?>
                                                        <th class="text-center " style="color: #ccc"><?= $ligne->production ?></th>
                                                    <?php } ?>
                                                </tr>

                                                <?php if ($production->etat_id == Home\ETAT::VALIDEE) { ?>
                                                    <tr>
                                                        <td><h4 class="mp0">Rangées : </h4></td>
                                                        <?php foreach ($production->ligneproductionjours as $key => $ligne) { ?>
                                                            <th class="text-center"><?= $ligne->production - $ligne->perte ?></th>
                                                        <?php } ?>
                                                    </tr>

                                                    <tr>
                                                        <td><h4 class="mp0 text-red">Perte : </h4></td>
                                                        <?php foreach ($production->ligneproductionjours as $key => $ligne) { ?>
                                                            <th class="text-center text-red"><?= $ligne->perte ?></th>
                                                        <?php } ?>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </td>
                                    <td>
                                        <a href="<?= $this->url("fiches", "master", "production", $production->id) ?>" target="_blank" class="btn btn-white btn-sm"><i class="fa fa-file-text text-blue"></i></a>
                                        <button data-toggle="modal" data-target="#modal-rangement<?= $production->getId() ?>" class="btn btn-white btn-xs"><i class="fa fa-plus"></i> Faire le rangement </button>
                                    </td>
                                </tr>
                            <?php  } ?>
                            <tr />
                            <?php foreach ($datas as $key => $production) {
                                $production->actualise(); 
                                $lots = $production->fourni("ligneproductionjour");
                                ?>
                                <tr style="border-bottom: 2px solid black">
                                    <td class="project-status">
                                        <span class="label label-<?= $production->etat->class ?>"><?= $production->etat->name ?></span>
                                    </td>
                                    <td>
                                        <h5 class="text-uppercase">Production déjà rangé</h5>
                                    </td>
                                    <td>
                                        <h5 class="text-uppercase"><?= datecourt3($production->ladate) ?></h5>
                                    </td>
                                    <td>
                                        <h5 class="text-uppercase"><?= $production->employe->name() ?></h5>
                                    </td>
                                    <td class="border-right">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <?php foreach ($production->ligneproductionjours as $key => $ligne) { 
                                                        $ligne->actualise(); ?>
                                                        <th class="text-center"><?= $ligne->produit->name() ?></th>
                                                    <?php } ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><h4 class="mp0 text-muted">Produite : </h4></td>
                                                    <?php foreach ($production->ligneproductionjours as $key => $ligne) { ?>
                                                        <th class="text-center " style="color: #ccc"><?= $ligne->production ?></th>
                                                    <?php } ?>
                                                </tr>

                                                <?php if ($production->etat_id == Home\ETAT::VALIDEE) { ?>
                                                    <tr>
                                                        <td><h4 class="mp0">Rangées : </h4></td>
                                                        <?php foreach ($production->ligneproductionjours as $key => $ligne) { ?>
                                                            <th class="text-center"><?= $ligne->production - $ligne->perte ?></th>
                                                        <?php } ?>
                                                    </tr>

                                                    <tr>
                                                        <td><h4 class="mp0 text-red">Perte : </h4></td>
                                                        <?php foreach ($production->ligneproductionjours as $key => $ligne) { ?>
                                                            <th class="text-center text-red"><?= $ligne->perte ?></th>
                                                        <?php } ?>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </td>
                                    <td>
                                        <a href="<?= $this->url("fiches", "master", "production", $production->id) ?>" target="_blank" class="btn btn-white btn-sm"><i class="fa fa-file-text text-blue"></i></a>
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
                    <h1 style="margin: 6% auto;" class="text-center text-muted"><i class="fa fa-folder-open-o fa-3x"></i> <br> Aucune production non rangée pour le moment</h1>
                <?php } ?>


            </div>
        </div>
    </div>


    <?php include($this->rootPath("webapp/gestion/elements/templates/footer.php")); ?> 

</div>
</div>


<?php 
foreach ($encours as $key => $production) {
    include($this->rootPath("composants/assets/modals/modal-rangement.php"));
} 
?>


<?php include($this->rootPath("webapp/gestion/elements/templates/script.php")); ?>


</body>

</html>
