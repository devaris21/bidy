<!DOCTYPE html>
<html>

<?php include($this->rootPath("webapp/gestion/elements/templates/head.php")); ?>


<body class="fixed-sidebar">

    <div id="wrapper">

        <?php include($this->rootPath("webapp/gestion/elements/templates/sidebar.php")); ?>  

        <div id="page-wrapper" class="gray-bg">

          <?php include($this->rootPath("webapp/gestion/elements/templates/header.php")); ?>  

          <div class="wrapper wrapper-content animated fadeInRight article">
            <div class="row justify-content-md-center">
                <div class="col-lg-10">
                    <div class="ibox"  >
                        <div class="ibox-content"  style="height: 33cm; background-image: url(<?= $this->stockage("images", "societe", "filigrane.png")  ?>) ; background-size: 50%; background-position: center center; background-repeat: no-repeat;">


                           <div>
                              <div class="row">
                                <div class="col-sm-5">
                                    <div class="row">
                                        <div class="col-3">
                                            <img style="width: 120%" src="<?= $this->stockage("images", "societe", $params->image) ?>">
                                        </div>
                                        <div class="col-9">
                                            <h5 class="gras text-uppercase text-orange"><?= $params->societe ?></h5>
                                            <h5 class="mp0"><?= $params->adresse ?></h5>
                                            <h5 class="mp0"><?= $params->postale ?></h5>
                                            <h5 class="mp0">Tél: <?= $params->contact ?></h5>
                                            <h5 class="mp0">Email: <?= $params->email ?></h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-7 text-right">
                                    <h2 class="title text-uppercase gras text-blue">Proforma de prix</h2>

                                </div>
                            </div><br><hr>
                            <br><br><br>

                            <div class="">
                                <h2 class="gras text-center text-uppercase"><span>Pour la zone de livraison de </span> <span class="text-uppercase"><?= $zone->name() ?></span></h2>  
                            </div><br><br><br>

                            <table class="table table-bordered">
                                <thead class="text-uppercase" style="background-color: #dfdfdf">
                                    <tr>
                                        <th colspan="2"></th>
                                        <th class="text-center">Prix unitaire</th>
                                    </tr>
                                </thead>
                                <tbody>
                                 <?php $i =0; foreach (Home\PRODUIT::findBy([]) as $key => $produit) { 
                                    $pz = new Home\PRIX_ZONELIVRAISON();
                                    $datas = $produit->fourni("prix_zonelivraison", ["zonelivraison_id ="=>$zone->getId()]);
                                    if (count($datas) > 0) {
                                        $pz = $datas[0];
                                    }
                                    ?>
                                    <tr>
                                        <td width="100">
                                            <img style="width: 100%; height: 80px" src="<?= $this->stockage("images", "produits", $produit->image) ?>">
                                        </td>
                                        <td class="desc">
                                            <br><h2 class="mp0 text-uppercase gras"><?= $produit->name() ?></h2>
                                            <span><?= $produit->description ?></span>
                                        </td>
                                        <td class="text-center" ><br><h2><?= money($pz->price); ?> <?= $params->devise ?></h2></td>
                                    </tr>
                                <?php } ?>                           
                            </tbody>
                        </table>

                    </div><br><br><br>


                    <hr>

                    <div class="text-center">
                        <h3 class="gras text-uppercase text-orange"><?= $params->societe ?></h3>
                        <h4 class="mp0"><?= $params->adresse ?></h4>
                        <h4 class="mp0"><?= $params->postale ?></h4>
                        <h4 class="mp0">Tél: <?= $params->contact ?></h4>
                        <h4 class="mp0">Email: <?= $params->email ?></h4>
                    </div>


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
