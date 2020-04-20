<!DOCTYPE html>
<html>

<?php include($this->rootPath("webapp/gestion/elements/templates/head.php")); ?>


<body class="fixed-sidebar">

    <div id="wrapper">

        <?php include($this->rootPath("webapp/gestion/elements/templates/sidebar.php")); ?>  

        <div id="page-wrapper" class="gray-bg">

          <?php include($this->rootPath("webapp/gestion/elements/templates/header.php")); ?>  

          <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-sm-6">
                <h2 class="text-uppercase">Recapitulatif de la journée</h2>
                <form id="formFiltrer" class="row" method="POST">
                    <div class="col-4">
                        <input type="date" value="<?= $date ?>" name="date" class="form-control">
                    </div>
                    <div class="col-4">
                        <button type="button" class="btn btn-sm btn-primary dim" onclick="filtrer()"><i class="fa fa-eye"></i> Voir</button>
                    </div>
                </form> 
            </div>
            <div class="col-sm-6">
               
            </div>
        </div>

        <div class="wrapper wrapper-content">
            <div class="animated fadeInRightBig">
                <div class="ibox">
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-4">
                                <img style="width: 20%" src="<?= $this->stockage("images", "societe", "logo.png") ?>">
                            </div>
                            <div class="col-sm-8 text-right">
                                <h2 class="title text-uppercase gras">Recapitulatif de la journée</h2>
                                <h3>Du <?= datecourt3($date) ?></h3>
                            </div>
                        </div><hr><br>

                        <div class="row">
                            <div class="col-sm-9" style="border-right: 2px solid black">
                             <div class="row">
                                <div class="col-sm-6">
                                    <h4 class="text-uppercase text-center">Commandes</h4>
                                    <?php if (count($commandes) > 0) { ?>
                                        <div>
                                           <?php foreach ($commandes as $key => $commande) { 
                                            $commande->actualise();
                                            $datas = $commande->fourni("lignecommande"); ?>
                                            <div class="text-left">
                                                <h6 class="mp0"><span>Zone de livraison :</span> <span class="text-uppercase"><?= $commande->zonelivraison->name() ?></span></h6>   
                                                <h6 class="mp0"><span>Lieu de livraison :</span> <span class="text-uppercase"><?= $commande->lieu ?></span></h6>                              
                                                <h6 class="mp0"><span>Client :</span> <span class="text-uppercase"><?= $commande->groupecommande->client->name() ?></span></h6>
                                            </div>
                                            <table class="table table-bordered mp0">
                                                <thead>
                                                    <tr>
                                                        <?php foreach ($commande->lignecommandes as $key => $ligne) { 
                                                            if ($ligne->quantite > 0) {
                                                                $ligne->actualise(); ?>
                                                                <th class="text-center"><?= $ligne->produit->name() ?></th>
                                                            <?php }
                                                        } ?>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <?php foreach ($commande->lignecommandes as $key => $ligne) {
                                                            if ($ligne->quantite > 0) { ?>
                                                                <td class="text-center"><?= $ligne->quantite ?></td>
                                                            <?php   } 
                                                        } ?>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <span class="mp0 pull-right"><span>Coût :</span> <span class="text-uppercase"><?= money($commande->montant) ?> <?= $params->devise ?></span></span>
                                            <hr>
                                        <?php } ?>
                                    </div>
                                <?php }else{ ?>
                                    <p class="text-center text-muted italic">Aucune commande ce jour </p>
                                <?php } ?>
                            </div>

                            <div class="col-sm-6 border-left">
                                <h4 class="text-uppercase text-center">livraisons</h4>
                                <?php if (count($livraisons) > 0) { ?>
                                    <div>
                                        <?php foreach ($livraisons as $key => $livraison) { 
                                            $livraison->actualise();
                                            $datas = $livraison->fourni("lignelivraison"); ?>
                                            <div class="text-left">
                                                <h6 class="mp0"><span>Zone de livraison :</span> <span class="text-uppercase"><?= $livraison->zonelivraison->name() ?></span></h6>   
                                                <h6 class="mp0"><span>Lieu de livraison :</span> <span class="text-uppercase"><?= $livraison->lieu ?></span></h6>                              
                                                <h6 class="mp0"><span>Client :</span> <span class="text-uppercase"><?= $livraison->groupecommande->client->name() ?></span></h6>
                                                <h6 class="mp0"><span>Chauffeur :</span> <span class="text-uppercase"><?= $livraison->chauffeur->name() ?></span></h6>
                                            </div>
                                            <table class="table table-bordered mp0">
                                                <thead>
                                                    <tr>
                                                        <?php foreach ($livraison->lignelivraisons as $key => $ligne) { 
                                                            if ($ligne->quantite > 0) {
                                                                $ligne->actualise(); ?>
                                                                <th colspan="2" class="text-center"><?= $ligne->produit->name() ?></th>
                                                            <?php }
                                                        } ?>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <?php foreach ($livraison->lignelivraisons as $key => $ligne) {
                                                            if ($ligne->quantite > 0) { ?>
                                                               <td data-toogle="tooltip" title="effectivement livré" class="text-center text-green"><?= $ligne->quantite_livree ?></td>
                                                               <td data-toogle="tooltip" title="perte" class="text-center text-red"><?= $ligne->quantite - $ligne->quantite_livree  ?></td>
                                                           <?php   } 
                                                       } ?>
                                                   </tr>
                                               </tbody>
                                           </table>
                                           <h6 class="mp0 pull-right"><span>Véhicule :</span> <span class="text-uppercase"><?= $livraison->vehicule->name() ?></span></h6>
                                           <hr>
                                       <?php } ?>
                                   </div>
                               <?php }else{ ?>
                                <p class="text-center text-muted italic">Aucune livraison ce jour </p>
                            <?php } ?>
                        </div>
                    </div> <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="text-uppercase text-center">production</h4>
                            <table class="table table-bordered mp0">
                                <thead>
                                    <tr>
                                        <?php foreach (Home\PRODUIT::getAll() as $key => $produit) {  ?>
                                            <th colspan="2" class="text-center"><?= $produit->name() ?></th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                       <?php foreach (Home\PRODUIT::getAll() as $key => $produit) {
                                        $datas = $produit->fourni("ligneproductionjour", ["DATE(created) = " => $date]);  ?>
                                        <td data-toogle="tooltip" title="production" class="text-center gras"><?= money(comptage($datas, "production", "somme")) ?></td>
                                        <td data-toogle="tooltip" title="perte" class="text-center text-red"><?= money(comptage($datas, "perte", "somme")) ?></td>
                                    <?php   }  ?>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-6">
                     <h4 class="text-uppercase text-center">consommation des ressources</h4>
                     <table class="table table-bordered mp0">
                        <thead>
                            <tr>
                                <?php foreach (Home\RESSOURCE::getAll() as $key => $ressource) {  ?>
                                    <th class="text-center"><?= $ressource->name() ?></th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                               <?php foreach (Home\RESSOURCE::getAll() as $key => $ressource) {
                                $datas = $ressource->fourni("ligneconsommationjour", ["DATE(created) = " => $date]);  ?>
                                <td data-toogle="tooltip" title="production" class="text-center"><?= money(comptage($datas, "consommation", "somme")) ?> <?= $ressource->abbr  ?></td>
                            <?php   }  ?>
                        </tr>
                    </tbody>
                </table><hr>

                <h4 class="text-uppercase text-center">Approvisionnements</h4>
                <?php if (count($livraisons) > 0) { ?>
                    <div>
                        <?php foreach ($approvisionnements as $key => $approvisionnement) { 
                            $approvisionnement->actualise();
                            $datas = $approvisionnement->fourni("ligneapprovisionnement"); ?>
                            <div class="text-left">
                                <h6 class="mp0"><span>¨Prestataire :</span> <span class="text-uppercase"><?= $approvisionnement->prestataire->name() ?></span></h6>                            
                                <h6 class="mp0"><span>Etat :</span> <span class="text-uppercase"><?= $approvisionnement->etat->name() ?></span></h6>
                            </div>
                            <table class="table table-bordered mp0">
                                <thead>
                                    <tr>
                                        <?php foreach ($approvisionnement->ligneapprovisionnements as $key => $ligne) { 
                                            if ($ligne->quantite > 0) {
                                                $ligne->actualise(); ?>
                                                <th class="text-center"><?= $ligne->ressource->name() ?></th>
                                            <?php }
                                        } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <?php foreach ($approvisionnement->ligneapprovisionnements as $key => $ligne) {
                                            if ($ligne->quantite > 0) { ?>
                                                <td class="text-center"><?= $ligne->quantite ?></td>
                                            <?php   } 
                                        } ?>
                                    </tr>
                                </tbody>
                            </table>
                            <span class="mp0 pull-right"><span>Coût :</span> <span class="text-uppercase"><?= money($approvisionnement->montant) ?> <?= $params->devise ?></span></span>
                            <hr>
                        <?php } ?>
                    </div>
                <?php }else{ ?>
                    <p class="text-center text-muted italic">Aucune approvisionnement ce jour </p>
                <?php } ?>
            </div>
        </div><hr>

        <div>
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr class="text-center text-uppercase">
                            <th colspan="4" style="visibility: hidden;"></th>
                            <th>Entrée</th>
                            <th>Sortie</th>
                            <th>Résultats</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($operations as $key => $operation) {
                            $operation->actualise(); ?>
                            <tr>
                                <td width="15"><i class="fa fa-clock-o"></i></td>
                                <td><?= datelong($operation->created) ?></td>
                                <td width="15"><i class="fa fa-file-text"></i></td>
                                <td><?= $operation->categorieoperation->name() ?> <span><?= ($operation->etat_id == Home\ETAT::ENCOURS)?"*":"" ?></span></td>
                                <?php if ($operation->categorieoperation->typeoperationcaisse_id == Home\TYPEOPERATIONCAISSE::ENTREE) { ?>
                                    <td class="text-center text-green"><?= money($operation->montant) ?> <?= $params->devise ?></td>
                                    <td class="text-center"> - </td>
                                <?php }elseif ($operation->categorieoperation->typeoperationcaisse_id == Home\TYPEOPERATIONCAISSE::SORTIE) { ?>
                                    <td class="text-center"> - </td>
                                    <td class="text-center text-red"><?= money($operation->montant) ?> <?= $params->devise ?></td>
                                <?php } ?>
                                <td class="text-center gras"><?= money($operation->montant) ?> <?= $params->devise ?></td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <td colspan="4"><h4 class="text-uppercase mp0 text-right">Solde du compte au <?= datecourt($date) ?></h4></td>
                            <td><h4 class="text-center"><?= money(Home\OPERATION::entree($date, $date)) ?> <?= $params->devise ?></h4></td>
                            <td><h4 class="text-center"><?= money(Home\OPERATION::sortie($date, $date)) ?> <?= $params->devise ?></h4></td>
                            <td><h4 class="text-center"><?= money(Home\OPERATION::resultat($date, $date)) ?> <?= $params->devise ?></h4></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <div class="col-sm-3 text-right">
        <h4 class="text-uppercase">Groupe de travail</h4>
        <h6><?= $productionjour->groupemanoeuvre->name();  ?></h6>
        <ul>
            <?php foreach ($productionjour->fourni("manoeuvredujour") as $key => $man) { ?>
                <li><?= $man->name(); ?></li>
            <?php } ?>
        </ul><br>
<hr>
        <h4 class="text-uppercase">SOLDE DU COMPTE</h4>
        <div class="">
            <small>Solde en Ouverture</small>
            <h2 class="no-margins"><?= money(Home\OPERATION::resultat(Home\PARAMS::DATE_DEFAULT , dateAjoute1($date, -1))) ?> <?= $params->devise ?></h2>
            <div class="progress progress-mini">
                <div class="progress-bar" style="width: 100%;"></div>
            </div>
        </div><br>

        <div class="">
            <small>Solde à la fermeture</small>
            <h2 class="no-margins"><?= money(Home\OPERATION::resultat(Home\PARAMS::DATE_DEFAULT , $date)) ?> <?= $params->devise ?></h2>
            <div class="progress progress-mini">
                <div class="progress-bar" style="width: 100%;"></div>
            </div>
        </div>
        <hr><br>

        <h4 class="text-uppercase">COMMENTAIRE</h4>
        <p><?= $productionjour->comment ?></p>
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
