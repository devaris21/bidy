<!DOCTYPE html>
<html>

<?php include($this->rootPath("webapp/gestion/elements/templates/head.php")); ?>


<body class="fixed-sidebar">

    <div id="wrapper">

        <?php include($this->rootPath("webapp/gestion/elements/templates/sidebar.php")); ?>  

        <div id="page-wrapper" class="gray-bg">

          <?php include($this->rootPath("webapp/gestion/elements/templates/header.php")); ?>  

          <div class="ibox">
            <div class="ibox-title">
                <h5 class="text-uppercase">Stock de produits</h5>
                <div class="ibox-tools">
                    <button data-toggle='modal' data-target="#modal-approvisionnement" style="margin-top: -2%" class="btn btn-warning btn-xs dim"><i class="fa fa-plus"></i> Nouvel Approvisionnement</button>
                    <button style="margin-top: -2%;" type="button" data-toggle=modal data-target='#modal-perteentrepot' class="btn btn-danger btn-xs dim"><i class="fa fa-trash"></i> Enregistrer une perte </button>
                </div>
            </div>
            <div class="ibox-content">
                <div class="row text-center">
                    <?php foreach ($produits as $key => $produit) {
                        $stock = $produit->stock(Home\PARAMS::DATE_DEFAULT, dateAjoute(1)); ?>
                        <div class="col-sm-4 col-md-3 col-lg-2 border-left border-bottom">
                            <div class="p-xs">
                                <i class="fa fa-cube fa-2x"></i>
                                <h5 class="m-xs gras <?= ($stock > $params->ruptureStock)?"":"clignote" ?>"><?= round($stock, 2) ?> unités</h5>
                                <h6 class="no-margins text-uppercase gras <?= ($stock > $params->ruptureStock)?"":"clignote" ?>"><?= $produit->name() ?> </h6>
                            </div>
                        </div>
                    <?php } ?>
                </div>


            </div>
        </div>

        <div class="wrapper wrapper-content">
            <div class=" animated fadeInRightBig">

                <div class="ibox ">
                    <div class="ibox-title">
                        <h5 class="text-uppercase">Du <?= datecourt($date1) ?> au <?= datecourt($date2) ?></h5>
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
                        <div class="row details">
                            <div class="col-sm">
                                <div class="carre bg-success"></div><span>Quantité produite</span>
                            </div>
                            <div class="col-sm">
                                <div class="carre bg-primary"></div><span>Quantité rangée</span>
                            </div>
                            <div class="col-sm">
                                <div class="carre bg-dark"></div><span>Quantité livrée</span>
                            </div>
                            <div class="col-sm">
                                <div class="carre bg-danger"></div><span>Quantité perdue</span>
                            </div>
                        </div><br>
                        <div class="">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="border-none"></th>
                                        <?php foreach ($produits as $key => $produit) { ?>
                                            <th class="text-center"><span class="text-uppercase"><?= $produit->name ?></span> <br> <small><?= $produit->description ?></small></th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                   <?php 
                                   $index = $date1;
                                   while ($index <= $date2) { ?>
                                    <tr>
                                        <td class="gras"><?= datecourt($index) ?></td>
                                        <?php foreach ($produits as $key => $produit) {
                                            $stock = $produit->stock(Home\PARAMS::DATE_DEFAULT, $index);
                                            $production = $produit->production($index, $index);
                                            $livraison = $produit->livree($index, $index);
                                            $perte = $produit->perte($index, $index);
                                            ?>
                                            <td class="cursor myPopover text-center"
                                            data-toggle="popover"
                                            data-placement="right"
                                            title="<small><b><?= $produit->name() ?></b> | <?= datecourt($index) ?></small>"
                                            data-trigger="hover"
                                            data-html="true"
                                            data-content="
                                            <span>Production du jour : <b><?= round($production, 2) ?> <i class='fa fa-cube'></i></b></span><br>
                                            <span>Livraison du jour : <b><?= round($livraison, 2) ?> <i class='fa fa-cube'></i></b></span><br>
                                            <span>Perte : <b><?= round($perte, 2) ?> <i class='fa fa-cube'></i></b></span>
                                            <hr style='margin:1.5%'>
                                            <span>En stock à ce jour : <b><?= round($stock, 2) ?> <i class='fa fa-cube'></i></b></span><br> <span>">
                                                <?= round($stock, 2) ?> unités
                                            </td>
                                        <?php } ?>
                                    </tr>
                                    <?php
                                    $index = dateAjoute1($index, 1);
                                }
                                ?>
                            </tbody>
                        </table>
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
