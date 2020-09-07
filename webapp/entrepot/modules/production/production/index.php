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
                    <?php $total = 0; foreach ($produits as $key => $produit) {
                        $stock = $produit->stock(Home\PARAMS::DATE_DEFAULT, dateAjoute(1));
                    $prix = $stock * $produit->price();
                    $total += $prix ?>
                    <div class="col-sm-4 col-md-3 col-lg-2 border-left border-bottom">
                        <div class="p-xs">
                            <i class="fa fa-hospital-o fa-2x text-green"></i>
                            <h6 class="m-xs gras <?= ($stock > $params->ruptureStock)?"":"clignote" ?>"><?= round($stock, 2) ?> <?= $produit->abbr ?></h6>
                            <h5 class="no-margins text-uppercase gras <?= ($stock > $params->ruptureStock)?"":"clignote" ?>"><?= $produit->name() ?> </h5>
                            <small>Es: <?= money($prix) ?> <?= $params->devise ?></small>
                        </div>
                    </div>
                <?php } ?>
            </div>

            <div class="text-center">
                <h5>Estimation du stock actuel</h5>
                <h1 class="no-margins"><?= money($total) ?> <?= $params->devise ?></h1>
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
                                        <th><span class="text-uppercase"><?= $produit->name ?></span> <br> <small><?= $produit->description ?></small></th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Stock de la veille</td>
                                    <?php foreach ($produits as $key => $produit) { ?>
                                        <td><span class="text-muted gras" style="font-size: 15px"><?= $produit->stock(dateAjoute1($productionjours[0]->ladate, -1)) ?></span> &nbsp;</td>
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
                                        $production->fourni("ligneproductionjour");
                                        foreach ($produits as $key => $produit) {
                                            foreach ($production->ligneproductionjours as $key => $ligne) {
                                                if ($produit->getId() == $ligne->produit_id) { 
                                                    $requette = "SELECT lignelivraison.produit_id, SUM(quantite) as quantite, SUM(quantite_livree) as livree FROM produit, livraison, lignelivraison WHERE produit.id = lignelivraison.produit_id AND lignelivraison.livraison_id = livraison.id AND livraison.etat_id !=? AND livraison.etat_id !=? AND produit.id = ? AND DATE(livraison.created) = ? GROUP BY lignelivraison.produit_id ";
                                                    $datas = Home\PRODUIT::execute($requette, [Home\ETAT::ANNULEE, Home\ETAT::PARTIEL, $produit->getId(), $production->ladate]);
                                                    if (count($datas) > 0) {
                                                        $item = $datas[0];
                                                    }else{
                                                        $item = new \stdclass();
                                                        $item->quantite = 0;
                                                        $item->livree = 0;
                                                    }
                                                    ?>
                                                    <td class="">
                                                        <h5 class=""><?= start0($produit->stock($production->ladate)) ?></h5>
                                                        <div class="details">
                                                            <small class="d-inline text-success gras"><?= start0($ligne->production) ?></small> |
                                                            <small class="d-inline text-green gras"><?= start0($ligne->production - $ligne->perte) ?></small> |
                                                            <small class="d-inline"><?= start0($produit->livree($production->ladate, $production->ladate)) ?></small> | 
                                                            <small class="text-red"><?= start0($ligne->perte + ($item->quantite - $item->livree)) ?></small>
                                                        </div>
                                                    </td>
                                                <?php }
                                            }
                                        } ?>
                                    </tr>
                                <?php } ?>
                                <tr style="height: 18px;"></tr>
                                <tr>
                                    <td style="width: 20%"><h3 class="text-center gras text-uppercase mp0">Stock global actuel</h3><small>stock livrable + productions non rangées</small></td>
                                    <?php foreach ($produits as $key => $produit) { ?>
                                        <td><h3 class="text-green gras" ><?= start0($produit->stock(dateAjoute())) ?></h3></td>
                                    <?php } ?>
                                </tr>
                                <tr>
                                    <td><h3 class="text-center gras text-muted text-uppercase">En commande</h3></td>
                                    <?php foreach ($produits as $key => $produit) { ?>
                                        <td><h3 class="text-success text-muted gras" ><?= start0($produit->commandee()) ?></h3></td>
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


</div>
</div>


<?php include($this->rootPath("webapp/gestion/elements/templates/script.php")); ?>


</body>

</html>