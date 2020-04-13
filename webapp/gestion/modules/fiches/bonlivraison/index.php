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
                                        <img style="width: 120%" src="<?= $this->stockage("images", "societe", "logo.png") ?>">
                                    </div>
                                    <div class="col-9">
                                        <h5 class="gras text-uppercase text-orange">Briqueterie industrielle de yaou</h5>
                                        <h5 class="mp0">06 BP 6067 Abidjan 06</h5>
                                        <h5 class="mp0">Tél 21350198 / 46015555</h5>
                                        <h5 class="mp0">RC: CI-ABJ-09-A-8527</h5>
                                        <h5 class="mp0">CC: N°0721697 B</h5>
                                        <h5 class="mp0">Email: info@dleg.net</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-7 text-right">
                                <h2 class="title text-uppercase gras text-blue">Bon de livraison</h2>
                                <h3 class="text-uppercase">N°<?= $livraison->reference  ?></h3>
                                <h5><?= datelong($livraison->created)  ?></h5>  
                                <h4><small>Bon édité par :</small> <span class="text-uppercase"><?= $livraison->employe->name() ?></span></h4>                                
                            </div>
                        </div><hr class="mp3">

                        <div class="row">
                            <div class="col-6">
                                <h5><span>Client :</span> <span class="text-uppercase"><?= $livraison->groupecommande->client->name() ?></span></h5>   
                                <h5><span>Zone de livraison :</span> <span class="text-uppercase"><?= $livraison->zonelivraison->name() ?></span></h5>   
                                <h5><span>Lieu de livraison :</span> <span class="text-uppercase"><?= $livraison->lieu ?></span></h5>                              
                            </div>

                            <div class="col-6 text-right">
                                <h5><span>Véhicule de livraison :</span><br> <span class="text-uppercase"><?= $livraison->vehicule->typevehicule->name() ?> <?= $livraison->vehicule->name() ?></span></h5>
                                <h5><span>Chauffeur de la livraison :</span> <span class="text-uppercase"><?= $livraison->chauffeur->name() ?></span></h5>
                            </div>
                        </div><br><br>

                        <table class="table table-bordered">
                            <thead class="text-uppercase" style="background-color: #dfdfdf">
                                <tr>
                                    <th colspan="2"></th>
                                    <th>Quantité à livrer</th>
                                    <th>Quantité livrées</th>
                                    <th width="90">perte</th>
                                    <th>Reste à livrer</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($livraison->lignelivraisons as $key => $ligne) {
                                    $ligne->actualise(); ?>
                                    <tr>
                                        <td width="50">
                                            <img style="width: 120%" src="<?= $this->stockage("images", "produits", $ligne->produit->image) ?>">
                                        </td>
                                        <td class="desc">
                                            <h4 class="mp0 text-uppercase"><?= $ligne->produit->name() ?></h4>
                                            <span><?= $ligne->produit->description ?></span>
                                        </td>
                                        <td class="text-center gras"><h3><?= $ligne->quantite ?></h3></td>
                                        <td class="text-center"><h3><?= ($livraison->etat_id == Home\ETAT::VALIDEE)? $ligne->quantite_livree : "" ?></h3></td>
                                        <td class="text-center"><h3><h3><?= ($livraison->etat_id == Home\ETAT::VALIDEE)? ($ligne->quantite - $ligne->quantite_livree) : "" ?></h3></td>
                                        <td class="text-center"><h3><?= ($livraison->etat_id == Home\ETAT::VALIDEE)? $ligne->reste : "" ?></h3></td>
                                    </tr>
                                <?php } ?>                            
                            </tbody>
                        </table>

                        <br>
                        <div class="row">
                            <div class="col-7">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th colspan="4"><h4 class="gras text-uppercase">Observation du client</h4></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Livraison reçue le : </td>
                                            <td><?= datecourt($livraison->datelivraison) ?></td>
                                        </tr>
                                        <tr style="height: 60px">
                                            <td>Observation : </td>
                                            <td><?= $livraison->comment ?></td>
                                        </tr>
                                        <tr style="height: 80px">
                                            <td>Noms, contacts & signature : </td>
                                            <td>
                                                <span><?= $livraison->nom_receptionniste ?></span><br>
                                                <span><?= $livraison->contact_receptionniste ?></span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-5">
                                <div class="text-right" style="margin-top: 14%;">
                                    <span><u>Signature & Cachet</u></span>
                                </div>
                            </div>
                        </div>
                    </div>


                    <hr>




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
