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
                <h2 class="text-uppercase">Le Stock des ressources de production</h2>
                <span>au <?= datecourt(dateAjoute())  ?></span>
            </div>
            <div class="col-sm-5">
                <div class="title-action">
                    <a href="" class="btn btn-primary">This is action area</a>
                </div>
            </div>
        </div>

        <div class="wrapper wrapper-content">
            <div class="text-center animated fadeInRightBig">

                <div class="ibox ">
                    <div class="ibox-title">
                        <h5 class="float-left">Pour les <?= $this->getId() ?> derniers jours</h5>
                        <div class="float-right">
                            <div class="btn-group text-right">
                                <a href="<?= $this->url("gestion", "master", "ressources", 7) ?>" class="btn btn-xs btn-white <?= ($this->getId() == 7)?"active":"" ?>"><i class="fa fa-calendar"></i> la semaine</a>
                                <a href="<?= $this->url("gestion", "master", "ressources", 15) ?>" class="btn btn-xs btn-white <?= ($this->getId() == 15)?"active":"" ?>"><i class="fa fa-calendar"></i> la quinzaine</a>
                                <a href="<?= $this->url("gestion", "master", "ressources", 30) ?>" class="btn btn-xs btn-white <?= ($this->getId() == 30)?"active":"" ?>"><i class="fa fa-calendar"></i> le mois</a>
                            </div>
                        </div>
                    </div>
                    <div class="ibox-content">
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
                                            <td><span class="text-muted gras" style="font-size: 15px"><?= $produit->stock(-($this->getId() +1)) ?></span> &nbsp;</td>
                                        <?php } ?>
                                    </tr>

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
                                                        $requette = "SELECT lignelivraison.produit_id, SUM(quantite) as quantite, SUM(quantite_livree) as livree FROM produit, livraison, lignelivraison WHERE produit.id = lignelivraison.produit_id AND lignelivraison.livraison_id = livraison.id  AND produit.id = ? AND DATE(livraison.created) = ? GROUP BY lignelivraison.produit_id ";
                                                        $datas = Home\PRODUIT::execute($requette, [$produit->getId(), $production->ladate]);
                                                        if (count($datas) > 0) {
                                                            $item = $datas[0];
                                                        }else{
                                                            $item = new \stdclass();
                                                            $item->quantite = 0;
                                                            $item->livree = 0;
                                                        }
                                                        ?>
                                                        <td class="myPopover cursor" data-toggle="popover" data-html="true" data-trigger="click"
                                                        title="<small class='text-uppercase'><b><?= $produit->name() ?></b> | <?= datecourt($production->ladate) ?></small>"  
                                                        data-content="<table>
                                                            <tr><td>Stock de veille :</td>  <td class='gras'><?= start0($produit->stock(dateAjoute1($production->ladate, -1))) ?></td></tr>
                                                            <tr><td>Production du jour :</td>  <td class='gras'><?= start0($ligne->production) ?></td></tr>
                                                            <tr><td>Livraisons du jour :</td>  <td class='gras'><?= start0($item->livree) ?></td></tr>
                                                            <tr><td>Perte :</td>  <td class='gras'><?= start0($ligne->perte + ($item->quantite - $item->livree)) ?></td></tr>
                                                        </table> <hr style='margin:1.5%'>
                                                        <span>En stock à ce jour : <b><?= start0($produit->stock($production->ladate)) ?></b></span>">
                                                        <h3 class="d-inline text-success gras"><?= start0($ligne->production) ?></h3> &nbsp; | &nbsp;
                                                        <h4 class="d-inline"><?= start0($item->livree) ?></h4> &nbsp; | &nbsp;
                                                        <small class="text-red"><?= start0($ligne->perte + ($item->quantite - $item->livree)) ?></small>
                                                    </td>
                                                <?php }
                                            }
                                        } ?>
                                    </tr>
                                <?php } ?>
                                <tr style="height: 18px;"></tr>
                                <tr>
                                    <td style="width: 20%"><h2 class="text-center gras text-uppercase">Stock actuel</h2></td>
                                    <?php foreach ($produits as $key => $produit) { ?>
                                        <td><h2 class="text-green gras" ><?= start0($produit->stock(dateAjoute())) ?></h2></td>
                                    <?php } ?>
                                </tr>
                                <tr>
                                    <td style="width: 20%"><h3 class="text-center gras text-muted text-uppercase">En commande</h3></td>
                                    <?php foreach ($produits as $key => $produit) { ?>
                                        <td><h3 class="text-success text-muted gras" ><?= start0($produit->livrable()) ?></h3></td>
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
