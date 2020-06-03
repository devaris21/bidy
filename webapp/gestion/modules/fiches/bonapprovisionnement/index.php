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
                                                <h5 class="mp0"><?= $params->postale ?></h5>
                                                <h5 class="mp0">Tél: <?= $params->contact ?></h5>
                                                <h5 class="mp0">Email: <?= $params->email ?></h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-7 text-right">
                                        <h2 class="title text-uppercase gras text-blue">Fiche d'approvisionnement</h2>
                                        <h3 class="text-uppercase">N°<?= $appro->reference  ?></h3>
                                        <h5><?= datelong($appro->created)  ?></h5>  
                                        <h4><small>Fiche éditéé par :</small> <span class="text-uppercase"><?= $appro->employe->name() ?></span></h4>
                                        <h4><small>Fiche validéé par :</small> <span class="text-uppercase"><?= $appro->employe_reception->name() ?></span></h4>
                                    </div>
                                </div><hr class="mp3">

                                <div class="row">
                                    <div class="col-6">
                                        <h5><span>Date de commande :</span> <span class="text-uppercase"><?= datelong($appro->created) ?></span></h5>   
                                        <h5><span>Date de livraison :</span> <span class="text-uppercase"><?= datelong($appro->datelivraison) ?></span></h5>                              
                                    </div>

                                    <div class="col-6 text-right">
                                        <h5><span>Fournisseur :</span> <span class="text-uppercase"><?= $appro->fournisseur->name() ?></span></h5>
                                        <h5><span>Contacts :</span> <span class="text-uppercase"><?= $appro->fournisseur->contact ?></span></h5>
                                    </div>
                                </div><br><br>

                                <table class="table table-striped">
                                    <thead class="text-uppercase" style="background-color: #dfdfdf">
                                        <tr class="text-center">
                                            <th colspan="2"></th>
                                            <th>Prix unitaire</th>
                                            <th></th>
                                            <th>Quantité</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($appro->ligneapprovisionnements as $key => $ligne) {
                                            $ligne->actualise(); ?>
                                            <tr>
                                                <td width="55">
                                                    <img style="width: 120%" src="<?= $this->stockage("images", "ressources", $ligne->ressource->image) ?>">                        
                                                </td>
                                                <td width="35%" class="desc">
                                                    <h3 class="mp0 text-uppercase gras"><?= $ligne->ressource->name() ?><br> <small class="text-lowercase">en <?= $ligne->ressource->unite ?></small></h3>
                                                </td>
                                                <td class="text-center"><h4 class="text-muted"><?= money($ligne->price / $ligne->quantite) ?> <?= $params->devise ?></h4></td>
                                                <td><h3>X</h3></td>
                                                <td class="text-center"><h3 style="font-weight: 300px"><i><?= $ligne->quantite ?> <?= $ligne->ressource->abbr ?></i></h3></td>
                                                <td class="text-center" width="25%">
                                                    <h3 class="gras"><?= money($ligne->price) ?> <?= $params->devise ?></h3>
                                                </td>
                                            </tr>
                                        <?php } ?> 
                                        <tr style="height: 35px;"></tr>
                            
                                        <tr class="border">
                                            <td colspan="4" class="text-uppercase text-right"><h2 class="">montant total à payer = </h2></td>
                                            <td></td>
                                            <td colspan="1" class="text-center"><h2 class="gras text-success"><?= money($appro->montant) ?> <?= $params->devise ?></h2></td>
                                        </tr>

                                        <tr class="border">
                                            <td colspan="4" class="text-right">
                                                <h3 class="text-uppercase mp0">Avance sur montant = </h3>
                                                <?php if ($appro->operation_id == 0) { ?>
                                                    <small>Réglement par prélèvement sur acompte</small>
                                                <?php }else{ ?>
                                                    <small>Réglement par <?= $appro->operation->modepayement->name() ?></small>
                                                <?php } ?>
                                                
                                            </td>
                                            <td></td>
                                            <td colspan="1" class="text-center"><h3 class="gras text-"><?= money($appro->avance) ?> <?= $params->devise ?></h3></td>
                                        </tr>
                                        <tr class="border">
                                            <td colspan="4" class="text-uppercase text-right"><h4 class=" text-<?= ($appro->reste > 0) ? "warning":"muted"  ?> ">reste <?= ($appro->operation_id == null && $appro->reste == 0 ) ? "dans le compte":"à payer pour cette commande"  ?> = </h4></td>
                                            <td></td>
                                            <td colspan="1" class="text-center"><h3 class="gras text-<?= ($appro->reste > 0) ? "warning":"muted"  ?>"><?= money($appro->reste) ?> <?= $params->devise ?></h3></td>
                                        </tr>

                                        <tr style="height: 45px;"></tr>

                                        <tr class="border">
                                            <td colspan="4" class="text-right">
                                                <h4 class="text-uppercase mp0">Solde de l'acompte du fournisseur =</h4>
                                            </td>
                                            <td></td>
                                            <td colspan="1" class="text-center"><h3 class="gras text-"><?= money($appro->acompteFournisseur) ?> <?= $params->devise ?></h3></td>
                                        </tr>
                                        <tr class="border">
                                            <td colspan="4" class="text-uppercase text-right"><h4 class=" text-red ">Dette totale chez le fournisseur = </h4></td>
                                            <td></td>
                                            <td colspan="1" class="text-center"><h3 class="gras text-<?= ($appro->reste > 0) ? "danger":"muted"  ?>"><?= money($appro->detteFournisseur) ?> <?= $params->devise ?></h3></td>
                                        </tr>
                                    </tbody>
                                </table>

                                <br><br><br>
                                <div class="row" >
                                    <div class="col-7">
                                        <table class="table d-print-none">
                                            <tbody>
                                                <tr style="height: 60px">
                                                    <td class="gras">Observation : </td>
                                                    <td><?= $appro->comment ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="offset-2 col-3" style="padding-top: 0.5%; height: 100px;">
                                        <span><u>Signature & Cachet</u></span>
                                    </div>
                                </div>
                            </div>


                                <br><br>
                            <br><br><hr class="mp0">
                            <p class="text-center"><small><i>* Cette fiche ne peut en aucun cas valoir ou remplacer la facture normale pour cette opération. Elle est éditée à titre indicatif !</i></small></p>



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
