<!DOCTYPE html>
<html>

<?php include($this->rootPath("webapp/gestion/elements/templates/head.php")); ?>


<body class="fixed-sidebar">

    <div id="wrapper">

        <?php include($this->rootPath("webapp/gestion/elements/templates/sidebar.php")); ?>  

        <div id="page-wrapper" class="gray-bg">

            <?php include($this->rootPath("webapp/gestion/elements/templates/header.php")); ?>  

            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-sm-4">
                    <h2>Configuration de Base</h2>
                </div>
                <div class="col-sm-8">

                </div>
            </div>

            <div class="wrapper wrapper-content" id="autos">
                <div class="animated fadeInRightBig">
                    <div class="ibox" >
                        <div class="ibox-content" style="min-height: 400px;">
                            <div class="tabs-container">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class=""><a class="nav-link active" data-toggle="tab" href="#general"><i class="fa fa-info"></i> Infos Générales</a></li>
                                    <li class=""><a class="nav-link " data-toggle="tab" href="#metier"><i class="fa fa-th-large"></i> Gestion & Production </a></li>
                                    <li class=""><a class="nav-link " data-toggle="tab" href="#tabpersonnel"><i class="fa fa-male"></i> Personnel & Exte </a></li>
                                    <li class=""><a class="nav-link " data-toggle="tab" href="#tabvehicules"><i class="fa fa-car"></i> Véhicules & Machines </a></li>
                                    <li class=""><a class="nav-link " data-toggle="tab" href="#optioncaisse"><i class="fa fa-money"></i> Options de caisse </a></li>
                                    <li class=""><a class="nav-link " data-toggle="tab" href="#admin"><i class="fa fa-gears"></i> Administration </a></li>
                                </ul><br>                               
                                <div class="tab-content">
                                    <div role="tabpanel" id="general" class="tab-pane active">
                                        <div class="row">
                                            <div class="col-md-8 border-right">
                                                <div class="ibox">
                                                    <div class="ibox-content"><br>
                                                        <div class="row">
                                                            <div class="col-sm-10">
                                                                <span class="text-muted">Raison sociale</span>
                                                                <h2 class="gras text-uppercase text-primary"><?= $params->societe ?></h2>
                                                            </div>

                                                            <div class="col-sm-2">
                                                                <span class="text-muted">Votre logo</span><br>
                                                                <img style="height: 50px" src="<?= $this->stockage("images", "societe", $params->image)  ?>">
                                                            </div>
                                                        </div><br>

                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <span class="text-muted">Situation Géographique</span>
                                                                <h4><?= $params->adresse ?></h4>
                                                            </div>

                                                            <div class="col-sm-4">
                                                                <span class="text-muted">Contacts</span>
                                                                <h4><?= $params->contact ?></h4>
                                                            </div>

                                                            <div class="col-sm-4">
                                                                <span class="text-muted">Email</span>
                                                                <h4><?= $params->email ?></h4>
                                                            </div>
                                                        </div><br>

                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <span class="text-muted">Boite Postale</span>
                                                                <h4><?= $params->postale ?></h4>
                                                            </div>

                                                            <div class="col-sm-4">
                                                                <span class="text-muted">Fax</span>
                                                                <h4><?= $params->fax ?></h4>
                                                            </div>

                                                            <div class="col-sm-4">
                                                                <span class="text-muted">Devise</span>
                                                                <h4><?= $params->devise ?></h4>
                                                            </div>
                                                        </div><br>

                                                        <div>
                                                            <button onclick="modification('params', <?= $params->getId() ?>)" class="btn btn-primary dim pull-right" data-toggle="modal" data-target="#modal-params"><i class="fa fa-pencil"></i> Modifier les informations</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-md-4 col-sm-6 bloc">

                                            </div>

                                        </div>
                                    </div>



                                    <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->



                                    <div role="tabpanel" id="metier" class="tab-pane">
                                        <div class="row">

                                            <div class="col-sm-6 bloc">
                                                <div class="ibox border">
                                                    <div class="ibox-title">
                                                        <h5 class="text-uppercase">Les produits</h5>
                                                        <div class="ibox-tools">
                                                            <a class="btn_modal btn_modal" data-toggle="modal" data-target="#modal-produit">
                                                                <i class="fa fa-plus"></i> Ajouter
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="ibox-content">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th></th>
                                                                    <th>Libéllé</th>
                                                                    <th>description</th>
                                                                    <th></th>
                                                                    <th></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php $i =0; foreach (Home\PRODUIT::findBy([], [], ["name"=>"ASC"]) as $key => $item) {
                                                                    $i++; ?>
                                                                    <tr>
                                                                        <td><?= $i ?></td>
                                                                        <td ><img style="width: 40px" src="<?= $this->stockage("images", "produits", $item->image); ?>"></td>
                                                                        <td class="gras"><?= $item->name(); ?></td>
                                                                        <td><?= $item->description; ?></td>
                                                                        <td data-toggle="modal" data-target="#modal-produit" title="modifier le produit" onclick="modification('produit', <?= $item->getId() ?>)"><i class="fa fa-pencil text-blue cursor"></i></td>
                                                                        <td data-toggle="tooltip" title="modifier le produit" onclick="suppressionWithPassword('produit', <?= $item->getId() ?>)"><i class="fa fa-close cursor text-danger"></i></td>
                                                                    </tr>
                                                                <?php } ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-6 bloc">
                                                <div class="ibox border">
                                                    <div class="ibox-title">
                                                        <h5 class="text-uppercase">Les ressources de production</h5>
                                                        <div class="ibox-tools">
                                                            <a class="btn_modal" data-toggle="modal" data-target="#modal-ressource">
                                                                <i class="fa fa-plus"></i> Ajouter
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="ibox-content">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th></th>
                                                                    <th>Libéllé</th>
                                                                    <th></th>
                                                                    <th></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php $i =0; foreach (Home\RESSOURCE::findBy([], [], ["name"=>"ASC"]) as $key => $item) {
                                                                    $i++; ?>
                                                                    <tr>
                                                                        <td><?= $i ?></td>
                                                                        <td ><img style="width: 40px" src="<?= $this->stockage("images", "ressources", $item->image); ?>"></td>
                                                                        <td class="gras"><?= $item->name(); ?></td>
                                                                        <td data-toggle="modal" data-target="#modal-ressource" title="modifier l'élément" onclick="modification('ressource', <?= $item->getId() ?>)"><i class="fa fa-pencil text-blue cursor"></i></td>
                                                                        <td title="supprimer la ressource" onclick="suppressionWithPassword('ressource', <?= $item->getId() ?>)"><i class="fa fa-close cursor text-danger"></i></td>
                                                                    </tr>
                                                                <?php } ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-md-8 bloc">
                                                <div class="ibox border">
                                                    <div class="ibox-title">
                                                        <h5 class="text-uppercase">Exigence de production par ressource</h5>
                                                        <div class="ibox-tools">

                                                        </div>
                                                    </div>
                                                    <div class="ibox-content">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th></th>
                                                                    <th class="text-center border-left border-right">Quantité</th>
                                                                    <?php foreach (Home\RESSOURCE::findBy([], [], ["name"=>"ASC"]) as $key => $ressource) {  ?>
                                                                        <td class="gras text-center"><img style="width: 30px; margin-right: 2%" src="<?= $this->stockage("images", "ressources", $ressource->image); ?>"> <?= $ressource->name(); ?></td>
                                                                    <?php } ?>
                                                                    <th></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php foreach (Home\PRODUIT::findBy([], [], ["name"=>"ASC"]) as $key => $prod) {
                                                                    $datas = $prod->fourni("exigenceproduction"); ?> 
                                                                    <tr>
                                                                        <td class="gras"><img style="width: 30px; margin-right: 2%" src="<?= $this->stockage("images", "produits", $prod->image); ?>"> <?= $prod->name(); ?></td>
                                                                        <td class="text-center border-left border-right" >Pour en produire <b><?= money($datas[0]->quantite); ?></b></td>

                                                                        <?php foreach (Home\RESSOURCE::findBy([], [], ["name"=>"ASC"]) as $key => $ressource) { 
                                                                            $lots = $datas[0]->fourni("ligneexigenceproduction", ["ressource_id ="=> $ressource->getId()]); 
                                                                            foreach ($lots as $key => $item) { 
                                                                                $item->actualise(); ?>
                                                                                <td class="text-center" ><?= money($item->quantite); ?> <?= $item->ressource->abbr ?></td>
                                                                            <?php } } ?>
                                                                            <td data-toggle="modal" data-target="#modal-exigence<?= $datas[0]->getId() ?>" title="modifier les prix"><i class="fa fa-pencil text-blue cursor"></i></td>
                                                                        </tr>
                                                                    <?php } ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="col-md-4 col-sm-6 bloc">
                                                    <div class="ibox border">
                                                        <div class="ibox-title">
                                                            <h5 class="text-uppercase">Paye par production</h5>
                                                            <div class="ibox-tools">
                                                                <a class="btn_modal" data-toggle="modal" data-target="#modal-zonelivraison">
                                                                    <i class="fa fa-plus"></i> Ajouter
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="ibox-content">
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Produit</th>
                                                                        <th>Prix</th>
                                                                        <th></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php $i =0; foreach (Home\PAYE_PRODUIT::findBy() as $key => $item) {
                                                                        $item->actualise() ?>
                                                                        <tr>
                                                                            <td class="gras"><img style="width: 30px; margin-right: 2%" src="<?= $this->stockage("images", "produits", $item->produit->image); ?>"> <?= $item->produit->name(); ?></td>
                                                                            <td><?= money($item->price) ?> <?= $params->devise ?></td>
                                                                            <td data-toggle="modal" data-target="#modal-paye_produit<?= $item->getId() ?>" title="modifier le prix de paye" onclick="modification('paye_produit', <?= $item->getId() ?>)"><i class="fa fa-pencil text-blue cursor"></i></td>
                                                                        </tr>
                                                                    <?php } ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>



                                                <div class="col-md-4 col-sm-6 bloc">
                                                    <div class="ibox border">
                                                        <div class="ibox-title">
                                                            <h5 class="text-uppercase">Les zones de livraison</h5>
                                                            <div class="ibox-tools">
                                                                <a class="btn_modal" data-toggle="modal" data-target="#modal-zonelivraison">
                                                                    <i class="fa fa-plus"></i> Ajouter
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="ibox-content">
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Libéllé</th>
                                                                        <th></th>
                                                                        <th></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php $i =0; foreach (Home\ZONELIVRAISON::findBy([], [], ["name"=>"ASC"]) as $key => $item) { ?>
                                                                        <tr>
                                                                            <td class="gras"><?= $item->name(); ?></td>
                                                                            <td data-toggle="modal" data-target="#modal-zonelivraison" title="modifier la zone de livraison" onclick="modification('zonelivraison', <?= $item->getId() ?>)"><i class="fa fa-pencil text-blue cursor"></i></td>
                                                                            <td title="supprimer la zone de livraison" onclick="suppressionWithPassword('zonelivraison', <?= $item->getId() ?>)"><i class="fa fa-close cursor text-danger"></i></td>
                                                                        </tr>
                                                                    <?php } ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="col-sm-8 bloc">
                                                    <div class="ibox border">
                                                        <div class="ibox-title">
                                                            <h5 class="text-uppercase">Prix des produits par zone de livraison</h5>
                                                            <div class="ibox-tools">

                                                            </div>
                                                        </div>
                                                        <div class="ibox-content">
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th></th>
                                                                        <?php $i =0; foreach (Home\PRODUIT::findBy([], [], ["name"=>"ASC"]) as $key => $prod) {  ?>
                                                                            <td class="gras text-center"><?= $prod->name(); ?></td>
                                                                        <?php } ?>
                                                                        <th></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php $i =0; foreach (Home\ZONELIVRAISON::findBy([], [], ["name"=>"ASC"]) as $key => $zone) {
                                                                        $i++; ?>
                                                                        <tr>
                                                                            <td class="gras"><?= $zone->name(); ?></td>
                                                                            <?php $i =0; foreach (Home\PRODUIT::findBy([], [], ["name"=>"ASC"]) as $key => $prod) { 
                                                                                $datas = $prod->fourni("prix_zonelivraison", ["zonelivraison_id ="=>$zone->getId()]); ?>
                                                                                <td class="text-center" ><?= money($datas[0]->price); ?> <?= $params->devise ?></td>
                                                                            <?php } ?>
                                                                            <td data-toggle="modal" data-target="#modal-prix<?= $zone->getId() ?>" title="modifier les prix"><i class="fa fa-pencil text-blue cursor"></i></td>
                                                                        </tr>
                                                                    <?php } ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>


                                        <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->



                                        <div role="tabpanel" id="tabpersonnel" class="tab-pane">
                                            <div class="row">

                                             <div class="col-md-4 bloc">
                                                <div class="ibox border">
                                                    <div class="ibox-title">
                                                        <h5 class="text-uppercase">Groupe de manoeuvre</h5>
                                                        <div class="ibox-tools">
                                                            <a class="btn_modal" data-toggle="modal" data-target="#modal-groupemanoeuvre">
                                                                <i class="fa fa-plus"></i> Ajouter
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="ibox-content">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th>Libéllé</th>
                                                                    <th></th>
                                                                    <th></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php $i =0; foreach (Home\GROUPEMANOEUVRE::findBy([], [], ["name"=>"ASC"]) as $key => $item) {
                                                                    $item->actualise();  ?>
                                                                    <tr>
                                                                        <td class="gras"><?= $item->name(); ?></td>
                                                                        <td data-toggle="modal" data-target="#modal-groupemanoeuvre" title="modifier ce groupe" onclick="modification('groupemanoeuvre', <?= $item->getId() ?>)"><i class="fa fa-pencil text-blue cursor"></i></td>
                                                                        <td title="supprimer ce groupe" onclick="suppression('groupemanoeuvre', <?= $item->getId() ?>)"><i class="fa fa-close cursor text-danger"></i></td>
                                                                    </tr>
                                                                <?php } ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-8 bloc">
                                                <div class="ibox border">
                                                    <div class="ibox-title">
                                                        <h5 class="text-uppercase">Les manoeuvres</h5>
                                                        <div class="ibox-tools">
                                                            <a class="btn_modal" data-toggle="modal" data-target="#modal-manoeuvre">
                                                                <i class="fa fa-plus"></i> Ajouter
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="ibox-content">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th></th>
                                                                    <th>Libéllé</th>
                                                                    <th>Coordonnées</th>
                                                                    <th></th>
                                                                    <th></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php $i =0; foreach (Home\MANOEUVRE::findBy([], [], ["name"=>"ASC"]) as $key => $item) {
                                                                    $item->actualise(); ?>
                                                                    <tr>
                                                                        <td>
                                                                            <img alt="image" style="width: 40px;" class="m-t-xs" src="<?= $this->stockage("images", "manoeuvres", $item->image) ?>">
                                                                        </td>
                                                                        <td>
                                                                            <span class="gras"><?= $item->name(); ?></span><br>
                                                                            <?= $item->groupemanoeuvre->name() ?>
                                                                        </td>
                                                                        <td>
                                                                            <i class="fa fa-map-marker"></i> <?= $item->adresse  ?><br>
                                                                            <i class="fa fa-phone"></i> <?= $item->contact  ?>  
                                                                        </td>
                                                                        <td data-toggle="modal" data-target="#modal-manoeuvre" title="modifier ce manoeuvre" onclick="modification('manoeuvre', <?= $item->getId() ?>)"><i class="fa fa-pencil text-blue cursor"></i></td>
                                                                        <td title="supprimer ce manoeuvre" onclick="suppression('manoeuvre', <?= $item->getId() ?>)"><i class="fa fa-close cursor text-danger"></i></td>
                                                                    </tr>
                                                                <?php } ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-12 bloc">
                                                <div class="ibox border">
                                                    <div class="ibox-title">
                                                        <h5 class="text-uppercase">Les chauffeurs</h5>
                                                        <div class="ibox-tools">
                                                            <a class="btn_modal" data-toggle="modal" data-target="#modal-chauffeur">
                                                                <i class="fa fa-plus"></i> Ajouter
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="ibox-content">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th></th>
                                                                    <th>Libéllé</th>
                                                                    <th>Coordonnées</th>
                                                                    <th></th>
                                                                    <th></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php $i =0; foreach (Home\CHAUFFEUR::findBy([], [], ["name"=>"ASC"]) as $key => $item) {
                                                                    $i++; ?>
                                                                    <tr>
                                                                        <td>
                                                                            <img alt="image" style="width: 40px;" class="m-t-xs" src="<?= $this->stockage("images", "chauffeurs", $item->image) ?>">
                                                                        </td>
                                                                        <td>
                                                                            <span class="gras"><?= $item->name(); ?></span><br>
                                                                            Permis <?= $item->typepermis ?>
                                                                        </td>
                                                                        <td>
                                                                            <i class="fa fa-map-marker"></i> <?= $item->adresse  ?><br>
                                                                            <i class="fa fa-phone"></i> <?= $item->contact  ?>
                                                                        </td>
                                                                        <td data-toggle="modal" data-target="#modal-chauffeur" title="modifier ce chauffeur" onclick="modification('chauffeur', <?= $item->getId() ?>)"><i class="fa fa-pencil text-blue cursor"></i></td>
                                                                        <td title="supprimer ce chauffeur" onclick="suppression('chauffeur', <?= $item->getId() ?>)"><i class="fa fa-close cursor text-danger"></i></td>
                                                                    </tr>
                                                                <?php } ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-12 bloc">
                                                <div class="ibox border">
                                                    <div class="ibox-title">
                                                        <h5 class="text-uppercase">Vos fournisseurs de ressources</h5>
                                                        <div class="ibox-tools">
                                                            <a class="btn_modal" data-toggle="modal" data-target="#modal-fournisseur">
                                                                <i class="fa fa-plus"></i> Ajouter
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="ibox-content">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th></th>
                                                                    <th>Libéllé</th>
                                                                    <th>Adresse</th>
                                                                    <th>Coordonnées</th>
                                                                    <th>fax</th>
                                                                    <th></th>
                                                                    <th></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php $i =0; foreach (Home\FOURNISSEUR::findBy([], [], ["name"=>"ASC"]) as $key => $item) { ?>
                                                                    <tr>
                                                                        <td>
                                                                            <img alt="image" style="width: 40px;" class="m-t-xs" src="<?= $this->stockage("images", "fournisseurs", $item->image) ?>">
                                                                        </td>
                                                                        <td class="gras"><?= $item->name(); ?></td>
                                                                        <td><i class="fa fa-map-marker"></i> <?= $item->adresse  ?></td>
                                                                        <td>
                                                                            <i class="fa fa-envelope"></i> <?= $item->email  ?><br>
                                                                            <i class="fa fa-phone"></i> <?= $item->contact  ?>  
                                                                        </td>
                                                                        <td><i class="fa fa-fax"></i> <?= $item->fax ?></td>
                                                                        <td data-toggle="modal" data-target="#modal-fournisseur" title="modifier ce fournisseur" onclick="modification('fournisseur', <?= $item->getId() ?>)"><i class="fa fa-pencil text-blue cursor"></i></td>
                                                                        <td title="supprimer ce fournisseur" onclick="suppression('fournisseur', <?= $item->getId() ?>)"><i class="fa fa-close cursor text-danger"></i></td>
                                                                    </tr>
                                                                <?php } ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12 bloc">
                                                <div class="ibox border">
                                                    <div class="ibox-title">
                                                        <h5 class="text-uppercase">Vos prestataires de services</h5>
                                                        <div class="ibox-tools">
                                                            <a class="btn_modal" data-toggle="modal" data-target="#modal-manoeuvre">
                                                                <i class="fa fa-plus"></i> Ajouter
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="ibox-content">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th></th>
                                                                    <th>Libéllé</th>
                                                                    <th>Adresse</th>
                                                                    <th>Coordonnées</th>
                                                                    <th>fax</th>
                                                                    <th></th>
                                                                    <th></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php $i =0; foreach (Home\PRESTATAIRE::findBy([], [], ["name"=>"ASC"]) as $key => $item) { ?>
                                                                    <tr>
                                                                        <td>
                                                                            <img alt="image" style="width: 40px;" class="m-t-xs" src="<?= $this->stockage("images", "prestataires", $item->image) ?>">
                                                                        </td>
                                                                        <td class="gras"><?= $item->name(); ?></td>
                                                                        <td><i class="fa fa-map-marker"></i> <?= $item->adresse  ?></td>
                                                                        <td>
                                                                            <i class="fa fa-envelope"></i> <?= $item->email  ?><br>
                                                                            <i class="fa fa-phone"></i> <?= $item->contact  ?>  
                                                                        </td>
                                                                        <td><i class="fa fa-fax"></i> <?= $item->fax ?></td>
                                                                        <td data-toggle="modal" data-target="#modal-prestataire" title="modifier ce prestataire" onclick="modification('prestataire', <?= $item->getId() ?>)"><i class="fa fa-pencil text-blue cursor"></i></td>
                                                                        <td title="supprimer ce prestataire" onclick="suppression('prestataire', <?= $item->getId() ?>)"><i class="fa fa-close cursor text-danger"></i></td>
                                                                    </tr>
                                                                <?php } ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>



                                    <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->


                                    <div role="tabpanel" id="tabvehicules" class="tab-pane">
                                        <div class="row">

                                            <div class="col-md-4 col-sm-6 bloc">
                                                <div class="ibox border">
                                                    <div class="ibox-title">
                                                        <h5 class="text-uppercase">Type de véhicule</h5>
                                                        <div class="ibox-tools">
                                                            <a class="btn_modal" data-toggle="modal" data-target="#modal-typevehicule">
                                                                <i class="fa fa-plus"></i> Ajouter
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="ibox-content">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Libéllé</th>
                                                                    <th></th>
                                                                    <th></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php $i =0; foreach (Home\TYPEVEHICULE::findBy([], [], ["name"=>"ASC"]) as $key => $item) {
                                                                    $i++; ?>
                                                                    <tr>
                                                                        <td><?= $i ?></td>
                                                                        <td class="gras"><?= $item->name(); ?></td>
                                                                        <td data-toggle="modal" data-target="#modal-typevehicule" title="modifier l'élément" onclick="modification('typevehicule', <?= $item->getId() ?>)"><i class="fa fa-pencil text-blue cursor"></i></td>
                                                                        <td title="supprimer l'élément" onclick="suppression('typevehicule', <?= $item->getId() ?>)"><i class="fa fa-close cursor text-danger"></i></td>
                                                                    </tr>
                                                                <?php } ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-sm-6 bloc">
                                                <div class="ibox border">
                                                    <div class="ibox-title">
                                                        <h5 class="text-uppercase">Catégorie de véhicule</h5>
                                                        <div class="ibox-tools">
                                                            <a class="btn_modal" data-toggle="modal" data-target="#modal-groupevehicule">
                                                                <i class="fa fa-plus"></i> Ajouter
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="ibox-content">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Libéllé</th>
                                                                    <th></th>
                                                                    <th></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php $i =0; foreach (Home\GROUPEVEHICULE::findBy([], [], ["name"=>"ASC"]) as $key => $item) {
                                                                    $i++; ?>
                                                                    <tr>
                                                                        <td><?= $i ?></td>
                                                                        <td class="gras"><?= $item->name(); ?></td>
                                                                        <td data-toggle="modal" data-target="#modal-groupevehicule" title="modifier l'élément" onclick="modification('groupevehicule', <?= $item->getId() ?>)"><i class="fa fa-pencil text-blue cursor"></i></td>
                                                                        <td title="supprimer l'élément" onclick="suppression('groupevehicule', <?= $item->getId() ?>)"><i class="fa fa-close cursor text-danger"></i></td>
                                                                    </tr>
                                                                <?php } ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-sm-6 bloc">
                                                <div class="ibox border">
                                                    <div class="ibox-title">
                                                        <h5 class="text-uppercase">Panne de véhicule</h5>
                                                        <div class="ibox-tools">
                                                            <a class="btn_modal" data-toggle="modal" data-target="#modal-typeentretienvehicule">
                                                                <i class="fa fa-plus"></i> Ajouter
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="ibox-content">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Libéllé</th>
                                                                    <th></th>
                                                                    <th></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php $i =0; foreach (Home\TYPEENTRETIENVEHICULE::findBy([], [], ["name"=>"ASC"]) as $key => $item) {
                                                                    $i++; ?>
                                                                    <tr>
                                                                        <td><?= $i ?></td>
                                                                        <td class="gras"><?= $item->name(); ?></td>
                                                                        <td data-toggle="modal" data-target="#modal-typeentretienvehicule" title="modifier l'élément" onclick="modification('typeentretienvehicule', <?= $item->getId() ?>)"><i class="fa fa-pencil text-blue cursor"></i></td>
                                                                        <td title="supprimer l'élément" onclick="suppression('typeentretienvehicule', <?= $item->getId() ?>)"><i class="fa fa-close cursor text-danger"></i></td>
                                                                    </tr>
                                                                <?php } ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-md-7">
                                                <div class="ibox border" >
                                                    <div class="ibox-title">
                                                        <h5 class="text-uppercase"><i class="fa fa-car"></i> Tous les véhicules </h5>
                                                        <div class="ibox-tools">
                                                            <a class="btn_modal" data-toggle="modal" data-target="#modal-vehicule">
                                                                <i class="fa fa-plus"></i> Ajouter
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="ibox-content table-responsive" style="min-height: 400px;">
                                                        <table class="table">
                                                           <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Libéllé</th>
                                                                <th></th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach (Home\VEHICULE::getAll() as $key => $vehicule) {
                                                                $vehicule->actualise();
                                                                ?>
                                                                <tr>    
                                                                    <td>
                                                                        <img alt="image" style="width: 40px;" class="m-t-xs" src="<?= $this->stockage("images", "vehicules", $vehicule->image) ?>">
                                                                    </td>
                                                                    <td class="">
                                                                        <h5 class="text-uppercase gras"><?= $vehicule->marque->name() ?> <?= $vehicule->modele ?></h5>
                                                                        <h6 class=""><?= $vehicule->immatriculation ?></h6>
                                                                    </td>
                                                                    <td class="">
                                                                        <h5 class="mp0"><?= $vehicule->typevehicule->name() ?></h5>
                                                                        <h5 class="mp0"><?= $vehicule->groupevehicule->name() ?></h5>
                                                                    </td>     
                                                                    <td data-toggle="modal" data-target="#modal-vehicule" title="modifier l'élément" onclick="modification('vehicule', <?= $vehicule->getId() ?>)"><i class="fa fa-pencil text-blue cursor"></i></td>
                                                                    <td title="supprimer l'élément" onclick="suppressionWithPassword('vehicule', <?= $vehicule->getId() ?>)"><i class="fa fa-close cursor text-danger"></i></td>
                                                                </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>                             
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-md-5">
                                            <div class="ibox border" >
                                                <div class="ibox-title">
                                                    <h5 class="text-uppercase"><i class="fa fa-steam"></i> les machines </h5>
                                                    <div class="ibox-tools">
                                                        <a class="btn_modal" data-toggle="modal" data-target="#modal-machine">
                                                            <i class="fa fa-plus"></i> Ajouter
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="ibox-content table-responsive" style="min-height: 400px;">
                                                    <table class="table">
                                                       <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Libéllé</th>
                                                            <th></th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach (Home\MACHINE::getAll() as $key => $machine) {
                                                            $machine->actualise();
                                                            ?>
                                                            <tr>    
                                                                <td>
                                                                    <img alt="image" style="width: 40px;" class="m-t-xs" src="<?= $this->stockage("images", "machines", $machine->image) ?>">
                                                                </td>
                                                                <td class="">
                                                                    <h5 class="text-uppercase gras"><?= $machine->name() ?></h5>
                                                                    <h6 class=""><?= $machine->marque ?> <?= $machine->modele ?></h6>
                                                                </td>
                                                                <td data-toggle="modal" data-target="#modal-machine" title="modifier l'élément" onclick="modification('machine', <?= $machine->getId() ?>)"><i class="fa fa-pencil text-blue cursor"></i></td>
                                                                <td title="supprimer l'élément" onclick="suppression('machine', <?= $machine->getId() ?>)"><i class="fa fa-close cursor text-danger"></i></td>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>                             
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>



                            <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->



                            <div role="tabpanel" id="optioncaisse" class="tab-pane">
                                <div class="row">

                                    <div class="col-sm-8 bloc">
                                        <div class="ibox border">
                                            <div class="ibox-title">
                                                <h5 class="text-uppercase">Type d'opération</h5>
                                                <div class="ibox-tools">
                                                    <a class="btn_modal" data-toggle="modal" data-target="#modal-categorieoperation">
                                                        <i class="fa fa-plus"></i> Ajouter
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="ibox-content">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th><i class="fa fa-ticket"></i></th>
                                                            <th>Libéllé</th>
                                                            <th>Type</th>
                                                            <th></th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $i =0; foreach (Home\CATEGORIEOPERATION::findBy([], [], ["name"=>"ASC"]) as $key => $item) {
                                                            $item->actualise();
                                                            $i++; ?>
                                                            <tr>
                                                                <td><?= $i ?></td>
                                                                <td><div style="width: 20px; height: 20px; background-color: <?= $item->color ?>"></div></td>
                                                                <td class="gras"><?= $item->name(); ?></td>
                                                                <td class="gras text-<?= ($item->typeoperationcaisse_id == Home\TYPEOPERATIONCAISSE::ENTREE)?"green":"red"  ?>"><?= $item->typeoperationcaisse->name(); ?></td>
                                                                <td data-toggle="modal" data-target="#modal-categorieoperation" title="modifier la categorie" onclick="modification('categorieoperation', <?= $item->getId() ?>)"><i class="fa fa-pencil text-blue cursor"></i></td>
                                                                <td title="supprimer la categorie" onclick="suppressionWithPassword('categorieoperation', <?= $item->getId() ?>)"><i class="fa fa-close cursor text-danger"></i></td>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>




                            <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->



                            <div role="tabpanel" id="admin" class="tab-pane">
                              <div class="bloc">
                                <div class="ibox border">
                                    <div class="ibox-title">
                                        <h5 class="text-uppercase">Administrateurs et gerants</h5>
                                        <div class="ibox-tools">
                                            <a class="btn_modal" data-toggle="modal" data-target="#modal-employe">
                                                <i class="fa fa-plus"></i> Ajouter
                                            </a>
                                        </div>
                                    </div>
                                    <div class="ibox-content">
                                        <table class="table table-hover">
                                            <tbody>
                                                <?php $i =0; foreach (Home\EMPLOYE::findBy([], [], ["name"=>"ASC"]) as $key => $item) {
                                                    $item->actualise();  ?>
                                                    <tr>
                                                        <td>
                                                            <?php if ($item->is_allowed == 1) { ?>
                                                                <span class="label label-success">Actif</span>
                                                            <?php }else{ ?>
                                                                <span class="label label-red">Bloqué</span>
                                                            <?php } ?>
                                                        </td>
                                                        <td class="">
                                                            <span class="gras text-uppercase"><?= $item->name() ?></span><br>
                                                            <span><?= $item->email ?></span>
                                                        </td>
                                                        <td><?= $item->contact ?> <br> <i class="fa fa-map-marker"></i> <?= $item->adresse ?></td>
                                                        <td class="">
                                                            <?php $datas = $item->fourni("role_employe");
                                                            $lots = [];
                                                            foreach ($datas as $key => $rem) {
                                                                $rem->actualise();
                                                                $lots[] = $rem->role->getId(); ?>
                                                                <button employe="<?= $rem->employe_id ?>" role="<?= $rem->role_id ?>" class="btn btn-primary btn-xs refuser"><?= $rem->role->name() ?></button>
                                                                <?php } ?><hr class="mp3">

                                                                <?php foreach (Home\ROLE::getAll() as $key => $role) {
                                                                    if (!in_array($role->getId(), $lots)) { ?>
                                                                       <button employe="<?= $rem->employe_id ?>" role="<?= $rem->role_id ?>" class="btn btn-white btn-xs autoriser"><?= $role->name() ?></button>
                                                                   <?php } } ?>                
                                                               </td>
                                                               <td class="text-right">          
                                                                <button onclick="resetPassword('employe', <?= $item->getId() ?>)" class="btn btn-white btn-xs"><i class="fa fa-refresh text-blue"></i> Reinitialiser mot de passe</button><br>

                                                                <?php if ($item->is_allowed == 1) { ?>
                                                                    <button onclick="lock('employe', <?= $item->getId() ?>)" class="btn btn-white btn-xs"><i class="fa fa-lock text-orange"></i> Bloquer</button>
                                                                <?php }else{ ?>
                                                                    <button onclick="unlock('employe', <?= $item->getId() ?>)" class="btn btn-white btn-xs"><i class="fa fa-unlock text-green"></i> Débloquer</button>
                                                                <?php } ?>
                                                                <button class="btn btn-white btn-xs" onclick="modification('employe', <?= $item->getId() ?>)"><i class="fa fa-pencil"></i></button>
                                                                <button class="btn btn-white btn-xs" onclick="suppressionWithPassword('employe', <?= $item->getId() ?>)"><i class="fa fa-close text-red"></i></button>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
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
        </div>
    </div>




    <?php include($this->rootPath("webapp/gestion/elements/templates/footer.php")); ?>
    <?php include($this->relativePath("modals.php")); ?>


</div>
</div>


<?php include($this->rootPath("webapp/gestion/elements/templates/script.php")); ?>


</body>

</html>
