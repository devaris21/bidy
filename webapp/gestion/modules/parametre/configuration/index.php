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
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html">This is</a>
                        </li>
                        <li class="breadcrumb-item active">
                            <strong>Breadcrumb</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-sm-8">
                    <div class="title-action">
                        <a href="" class="btn btn-primary">This is action area</a>
                    </div>
                </div>
            </div>

            <div class="wrapper wrapper-content" id="autos">
                <div class="animated fadeInRightBig">
                    <div class="ibox" >
                        <div class="ibox-content" style="min-height: 400px;">
                            <div class="tabs-container">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class=""><a class="nav-link active" data-toggle="tab" href="#donnees"><i class="fa fa-th-large"></i> Les Types de données</a></li>
                                    <li class=""><a class="nav-link " data-toggle="tab" href="#metier"><i class="fa fa-briefcase"></i> Configuration du Metier </a></li>
                                    <li class=""><a class="nav-link " data-toggle="tab" href="#optioncaisse"><i class="fa fa-money"></i> Options de caisse </a></li>
                                    <li class=""><a class="nav-link " data-toggle="tab" href="#personnel"><i class="fa fa-male"></i> Configuration Utilisateurs </a></li>
                                    <li class=""><a class="nav-link " data-toggle="tab" href="#admin"><i class="fa fa-gears"></i> Administration </a></li>
                                </ul><br>                               
                                <div class="tab-content">


                                    <div role="tabpanel" id="donnees" class="tab-pane active">
                                        <div class="row">
infos params dans admin
                                            <div class="col-md-4 col-sm-6 col-xs-12 bloc">
                                                <div class="ibox border">
                                                    <div class="ibox-title">
                                                        <h5 class="text-uppercase">Type de client</h5>
                                                        <div class="ibox-tools">
                                                            <a class="btn_modal" data-toggle="modal" data-target="#modal-produit">
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
                                                                <?php $i =0; foreach (Home\TYPECLIENT::findBy([], [], ["name"=>"ASC"]) as $key => $item) {
                                                                    $i++; ?>
                                                                    <tr>
                                                                        <td><?= $i ?></td>
                                                                        <td class="gras"><?= $item->name(); ?></td>
                                                                        <td data-toggle="modal" data-target="#modal-produit" title="modifier l'élément" onclick="modification('typeequipement', <?= $item->getId() ?>)"><i class="fa fa-pencil text-blue cursor"></i></td>
                                                                        <td title="supprimer l'élément" onclick="suppression('typeequipement', <?= $item->getId() ?>)"><i class="fa fa-close cursor text-danger"></i></td>
                                                                    </tr>
                                                                <?php } ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-sm-6 col-xs-12 bloc">
                                                <div class="ibox border">
                                                    <div class="ibox-title">
                                                        <h5 class="text-uppercase">Type de véhicule</h5>
                                                        <div class="ibox-tools">
                                                            <a class="btn_modal" data-toggle="modal" data-target="#modal-produit">
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
                                                                        <td data-toggle="modal" data-target="#modal-produit" title="modifier l'élément" onclick="modification('typevehicule', <?= $item->getId() ?>)"><i class="fa fa-pencil text-blue cursor"></i></td>
                                                                        <td title="supprimer l'élément" onclick="suppression('typevehicule', <?= $item->getId() ?>)"><i class="fa fa-close cursor text-danger"></i></td>
                                                                    </tr>
                                                                <?php } ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-sm-6 col-xs-12 bloc">
                                                <div class="ibox border">
                                                    <div class="ibox-title">
                                                        <h5 class="text-uppercase">Catégorie de véhicule</h5>
                                                        <div class="ibox-tools">
                                                            <a class="btn_modal" data-toggle="modal" data-target="#modal-produit">
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
                                                                        <td data-toggle="modal" data-target="#modal-produit" title="modifier l'élément" onclick="modification('groupevehicule', <?= $item->getId() ?>)"><i class="fa fa-pencil text-blue cursor"></i></td>
                                                                        <td title="supprimer l'élément" onclick="suppression('groupevehicule', <?= $item->getId() ?>)"><i class="fa fa-close cursor text-danger"></i></td>
                                                                    </tr>
                                                                <?php } ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-sm-6 col-xs-12 bloc">
                                                <div class="ibox border">
                                                    <div class="ibox-title">
                                                        <h5 class="text-uppercase">Type de sinistre</h5>
                                                        <div class="ibox-tools">
                                                            <a class="btn_modal" data-toggle="modal" data-target="#modal-produit">
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
                                                                <?php $i =0; foreach (Home\TYPESINISTRE::findBy([], [], ["name"=>"ASC"]) as $key => $item) {
                                                                    $i++; ?>
                                                                    <tr>
                                                                        <td><?= $i ?></td>
                                                                        <td class="gras"><?= $item->name(); ?></td>
                                                                        <td data-toggle="modal" data-target="#modal-produit" title="modifier l'élément" onclick="modification('typesinistre', <?= $item->getId() ?>)"><i class="fa fa-pencil text-blue cursor"></i></td>
                                                                        <td title="supprimer l'élément" onclick="suppression('typesinistre', <?= $item->getId() ?>)"><i class="fa fa-close cursor text-danger"></i></td>
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



                                    <div role="tabpanel" id="metier" class="tab-pane">
                                        <div class="row">

                                            <div class="col-sm-6 col-xs-12 bloc">
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
                                                                        <td data-toggle="modal" data-target="#modal-produit" title="modifier le produit" onclick="suppressionWithPassword('produit', <?= $item->getId() ?>)"><i class="fa fa-close cursor text-danger"></i></td>
                                                                    </tr>
                                                                <?php } ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-xs-12 bloc">
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


                                            <div class="col-md-12 bloc">
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


                                                <div class="col-md-4 col-sm-6 col-xs-12 bloc">
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
                                                                        <th>#</th>
                                                                        <th>Libéllé</th>
                                                                        <th></th>
                                                                        <th></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php $i =0; foreach (Home\ZONELIVRAISON::findBy([], [], ["name"=>"ASC"]) as $key => $item) {
                                                                        $i++; ?>
                                                                        <tr>
                                                                            <td><?= $i ?></td>
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


                                                <div class="col-sm-8 col-xs-12 bloc">
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



                                        <div role="tabpanel" id="optioncaisse" class="tab-pane">
                                            <div class="row">

                                                <div class="col-sm-7 col-xs-12 bloc">
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

                                                <div class="col-md-5 col-sm-6 col-xs-12 bloc">
                                                    <div class="ibox border">
                                                        <div class="ibox-title">
                                                            <h5 class="text-uppercase">Mode de payement</h5>
                                                            <div class="ibox-tools">
                                                                <a class="btn_modal" data-toggle="modal" data-target="#modal-modepayement">
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
                                                                        <th>Attente</th>
                                                                        <th></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php $i =0; foreach (Home\MODEPAYEMENT::findBy([], [], ["name"=>"ASC"]) as $key => $item) {
                                                                        $item->actualise();  ?>
                                                                        <tr>
                                                                            <td class="gras"><?= $item->name(); ?></td>
                                                                            <td class="gras"><?= $item->initial; ?></td>
                                                                            <td class="gras"><?= ($item->etat_id == Home\ETAT::ENCOURS)?"*":""; ?></td>
                                                                            <td data-toggle="modal" data-target="#modal-modepayement" title="modifier ce mode" onclick="modification('modepayement', <?= $item->getId() ?>)"><i class="fa fa-pencil text-blue cursor"></i></td>
                                                                            <td title="supprimer ce mode" onclick="suppression('modepayement', <?= $item->getId() ?>)"><i class="fa fa-close cursor text-danger"></i></td>
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



                                        <div role="tabpanel" id="personnel" class="tab-pane">
                                            <div class="row">

                                                <div class="col-sm-6 col-xs-12 bloc">
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
                                                                        <th>#</th>
                                                                        <th>Libéllé</th>
                                                                        <th></th>
                                                                        <th></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php $i =0; foreach (Home\CHAUFFEUR::findBy([], [], ["name"=>"ASC"]) as $key => $item) {
                                                                        $i++; ?>
                                                                        <tr>
                                                                            <td><?= $i ?></td>
                                                                            <td class="gras"><?= $item->name(); ?></td>
                                                                            <td data-toggle="modal" data-target="#modal-chauffeur" title="modifier ce chauffeur" onclick="modification('chauffeur', <?= $item->getId() ?>)"><i class="fa fa-pencil text-blue cursor"></i></td>
                                                                            <td title="supprimer ce chauffeur" onclick="suppression('chauffeur', <?= $item->getId() ?>)"><i class="fa fa-close cursor text-danger"></i></td>
                                                                        </tr>
                                                                    <?php } ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-6 col-xs-12 bloc">
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
                                                                        <th>#</th>
                                                                        <th>Libéllé</th>
                                                                        <th></th>
                                                                        <th></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php $i =0; foreach (Home\MANOEUVRE::findBy([], [], ["name"=>"ASC"]) as $key => $item) {
                                                                        $i++; ?>
                                                                        <tr>
                                                                            <td><?= $i ?></td>
                                                                            <td class="gras"><?= $item->name(); ?></td>
                                                                            <td data-toggle="modal" data-target="#modal-manoeuvre" title="modifier ce manoeuvre" onclick="modification('manoeuvre', <?= $item->getId() ?>)"><i class="fa fa-pencil text-blue cursor"></i></td>
                                                                            <td title="supprimer ce manoeuvre" onclick="suppression('manoeuvre', <?= $item->getId() ?>)"><i class="fa fa-close cursor text-danger"></i></td>
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
                                                        <a class="btn_modal" data-toggle="modal" data-target="#modal-chauffeur">
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
                                                                        <span class="label label-primary">Added</span>
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
                                                                            <button class="btn btn-primary btn-xs"><?= $rem->role->name() ?></button>
                                                                        <?php } ?><br>

                                                                        <?php foreach (Home\ROLE::getAll() as $key => $role) {
                                                                            if (!in_array($role->getId(), $lots)) { ?>
                                                                               <button class="btn btn-white btn-xs"><?= $role->name() ?></button>
                                                                           <?php } } ?>                
                                                                       </td>
                                                                       <td class="text-right">          
                                                                        <button class="btn btn-white btn-xs"><i class="fa fa-refresh text-blue"></i> Reinitialiser mot de passe</button><br>
                                                                        <button class="btn btn-white btn-xs"><i class="fa fa-pencil"></i></button>
                                                                        <button class="btn btn-white btn-xs"><i class="fa fa-close text-red"></i></button>
                                                                        <button class="btn btn-white btn-xs"><i class="fa fa-lock text-orange"></i> Bloquer</button>
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
