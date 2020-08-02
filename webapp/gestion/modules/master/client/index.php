<!DOCTYPE html>
<html>

<?php include($this->rootPath("webapp/gestion/elements/templates/head.php")); ?>


<body class="fixed-sidebar">

    <div id="wrapper">

        <?php include($this->rootPath("webapp/gestion/elements/templates/sidebar.php")); ?>  

        <div id="page-wrapper" class="gray-bg">

            <?php include($this->rootPath("webapp/gestion/elements/templates/header.php")); ?>  


            <div class="wrapper wrapper-content animated fadeInRight">


                <div class="row m-b-lg">
                    <div class="col-md-6">

                        <div class="profile-image">
                            <img src="<?= $this->stockage("images", "societe", $params->image)  ?>" class="rounded-circle circle-border m-b-md" alt="profile">
                        </div>
                        <div class="profile-info">
                            <div class="">
                                <div>
                                    <h2 class="no-margins"><?= $client->name() ?> <i data-toggle="modal" data-target="#modal-client" class="fa fa-pencil cursor pull-right" onclick="modification('client', <?= $client->getId() ?>)"></i></h2>
                                    <h4><?= $client->typeclient->name() ?></h4>
                                    <small><?= $client->adresse ?></small><br>
                                    <small><?= $client->email ?> // <?= $client->contact ?></small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 border-right">
                        <table class="table small m-b-xs">
                            <tbody>
                                <tr>
                                    <td>
                                        <strong>142</strong> Commandes
                                    </td>
                                    <td>
                                        <strong>22</strong> Livraisons
                                    </td>

                                </tr>
                                <tr>
                                    <td>
                                        <strong>61</strong> Comments
                                    </td>
                                    <td>
                                        <strong>54</strong> Articles
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-3">
                        <label>Aller directement sur le compte de </label>
                        <?php Native\BINDING::html("select", "client", $client, "id") ?>   
                    </div>


                </div>
                <div class="row">

                    <div class="col-md-4">

                        <div class="social-feed-box">
                            <div class="float-right social-action dropdown">
                                <button data-toggle="dropdown" class="dropdown-toggle btn-white">
                                 Options
                             </button>
                             <ul class="dropdown-menu">
                                <li class="text-green"><a style="padding: 5px" href="#"><i class="fa fa-plus"></i> Créditer l'acompte</a></li>
                                <?php if ($client->acompte > 0) { ?>
                                    <li class="text-blue"><a style="padding: 5px" href="#"><i class="fa fa-reply"></i> Transferer les fonds</a></li>
                                    <li class="text-blue"><a style="padding: 5px" href="#"><i class="fa fa-reply"></i> Rembourser l'acompte</a></li>
                                <?php } ?> 
                                <?php if ($client->dette > 0) { ?>
                                    <li class="border"></li>
                                    <li class="text-danger"><a style="padding: 5px" href="#"><i class="fa fa-minus"></i> Régler la dette</a></li>
                                <?php } ?> 
                            </ul>
                        </div>
                        <div class="social-avatar">
                            <h5 class="mp0">Compte du client</h5>
                            <h1 class=""><?= money($client->acompte) ?> <?= $params->devise  ?></h1>
                            <div class="text-right">
                                <h5 class="text-danger">Dette du client</h5>
                                <h4 class="text-danger"><?= money($client->dette) ?> <?= $params->devise  ?></h4>                                    
                            </div>
                        </div>
                    </div>

                    <div class="">
                        <button <?= (count($groupes) > 0)?" onclick='newcommande()' ": "data-toggle=modal data-target='#modal-newcommande'" ?>  class="btn btn-primary btn-xs dim"><i class="fa fa-plus"></i> Nouvelle commande </button>
                        <button data-toggle=modal data-target='#modal-vente' class="btn btn-success btn-xs dim pull-right"><i class="fa fa-plus"></i> Nouvelle vente directe </button>   
                    </div><hr>

                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Historiques des transactions</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div class="feed-activity-list">
                                <?php foreach ($fluxcaisse as $key => $transaction) {
                                    $transaction->actualise(); ?>
                                    <div class="feed-element">
                                        <div>
                                            <span class="float-right text-navy gras"><?= money($transaction->montant)  ?> <?= $params->devise ?></span>
                                            <span><?= $transaction->reference ?></span>
                                            <div><i><?= $transaction->comment ?></i></div>
                                            <small class="text-muted"><?= depuis($transaction->created)  ?></small>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-lg-8">

                    <div class="row">
                        <div class="col-md-12">
                            <?php foreach ($groupes as $key => $commande) {
                                $commande->actualise(); 
                                ?>
                                <div class="social-feed-box">
                                    <div class="float-right social-action dropdown">
                                        <button data-toggle="dropdown" onclick="session('commande-encours', <?= $commande->getId() ?>)" class="dropdown-toggle btn-white cursor">Options</button>
                                        <ul class="dropdown-menu">
                                            <li class="text-orange" onclick="newlivraison(<?= $commande->getId()  ?>)"><a style="padding: 3px" href="#"><i class="fa fa-truck"></i> Faire une livraison</a></li>
                                            <li class="text-green" onclick="fairenewcommande(<?= $commande->getId() ?>)"><a style="padding: 3px" href="#"><i class="fa fa-plus"></i> Lui ajouter commande</a></li>
                                            <li class="" onclick="changement(<?= $commande->getId() ?>)"><a style="padding: 3px" href="#"><i class="fa fa-history"></i> convertir les produits</a></li>
                                            <li class="border"></li>
                                            <li class="text-blue" onclick="newProgrammation(<?= $commande->getId() ?>)"><a style="padding: 3px" href="#"><i class="fa fa-calendar"></i> Programmer livraison</a></li>
                                            <li class="text-green" onclick="fichecommande(<?= $commande->getId()  ?>)"><a style="padding: 3px" href="#"><i class="fa fa-eye"></i> Voir les détails</a></li>
                                        </ul>
                                    </div>
                                    <div class="social-avatar">
                                        <a href="" class="float-left">
                                            <img alt="image" src="<?= $this->stockage("images", "societe", $params->image)  ?>">
                                        </a>
                                        <div class="media-body">
                                            <a href="#" class="text-capitalize text-dark">Commande en cours </a>
                                            <small class="text-muted"><?= depuis($commande->created) ?></small><br>
                                        </div>
                                    </div>
                                    <div class="social-footer">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <?php foreach ($produits as $key => $produit){ 
                                                       $reste = $commande->reste($produit->getId());
                                                       if ($reste > 0) { ?>
                                                        <th class="text-center"><?= $produit->name() ?></th>
                                                    <?php }
                                                } ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><h3 class="text-uppercase">Reste : </h3></td>
                                                <?php foreach ($produits as $key => $produit) {
                                                    $reste = $commande->reste($produit->getId());
                                                    if ($reste > 0) { ?>
                                                        <td class="text-center" style="font-size: 20px;"><?= start0($reste) ?></td>
                                                    <?php   } 
                                                } ?>
                                                <td style="width: 60px; padding: 0"><button onclick="fichecommande(<?= $commande->getId()  ?>)" style="font-size: 11px; margin-top: 5%; margin-left: 5%;" class="btn btn-success btn-sm dim"><i class="fa fa-plus"></i> de détails </button></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        <?php } ?>
                    </div>


                    <div class="col-md-11">
                        <h3 class="gras text-uppercase text-muted"><i class="fa fa-history"></i> Historiques des mouvements .........................................................</h3>
                        <?php foreach ($flux as $key => $transaction) {
                            $transaction->actualise(); ?>
                            <div class="social-feed-box">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="social-avatar">
                                            <a href="" class="float-left">
                                                <img alt="image" src="<?= $this->stockage("images", "societe", $params->image)  ?>">
                                            </a>
                                            <div class="media-body">
                                                <a href="#" class="text-capitalize text-<?= ($transaction->type == "livraison")? "orange":"green" ?>"><?= $transaction->type ?> N°<strong><?= $transaction->reference ?></strong></a>
                                                <small class="text-muted"><?= depuis($transaction->created) ?></small><br>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="social-action ">
                                            <div class="row">
                                                <div class="col-10 text-right">
                                                    <?php if ($transaction->operation_id > 0) { ?>
                                                        <small>Montant de la commande</small>
                                                        <h3 class="text-uppercase"><?= money($transaction->montant) ?> <?= $params->devise  ?> 
                                                        <?php if ($transaction->operation_id > 0) { ?>
                                                            <small style="font-weight: normal;;" data-toggle="tooltip" title="Payement par <?= $transaction->operation->modepayement->name();  ?>">(<?= $transaction->operation->modepayement->initial;  ?>)</small>
                                                        <?php } ?>
                                                    </h3>
                                                <?php } ?>
                                            </div>
                                            <div class="col-2">
                                                <?php if ($transaction->type == "commande") { ?>
                                                    <a title="Voir le bon de commande" target="_blank" href="<?= $this->url("gestion", "fiches", "boncommande", $transaction->getId())  ?>"><i class="fa fa-file-text-o fa-2x text-green"></i></a>
                                                <?php }else{ ?>
                                                    <a title="Voir le bon de livraison" target="_blank" href="<?= $this->url("gestion", "fiches", "bonlivraison", $transaction->getId())  ?>"><i class="fa fa-file-text-o fa-2x text-orange"></i></a>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="social-footer">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <?php foreach ($transaction->items as $key => $ligne) {
                                                $ligne->actualise();  ?>
                                                <th class="text-center text-uppercase"><?= $ligne->produit->name() ?></th>
                                            <?php } ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <?php 
                                            foreach ($transaction->items as $key => $ligne) { ?>
                                                <td><h5 class="text-<?= ($transaction->type == "livraison")? "orange":"green" ?> text-center"> <?= start0(($transaction->type == "livraison")? $ligne->quantite_livree: $ligne->quantite) ?> </h5></td>
                                            <?php  } ?>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>                
        </div>
    </div>

</div>


<div class="modal inmodal fade" id="modal-listecommande">
    <div class="modal-dialog">
        <div class="modal-content">
           <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title">Choisir la commande</h4>
            <span>Double-cliquez pour selectionner la commande voulue !</span>
        </div>
        <form method="POST">
            <div class="modal-body">
                <table class="table table-bordered table-commande">
                    <tbody>
                        <?php foreach ($client->groupecommandes as $key => $commande) {
                            $commande->actualise(); 
                            ?>
                            <tr class=" border-bottom cursor" ondblclick="chosir(<?= $commande->getId() ?>)">     
                                <td class="border-right" style="width: 82%;">
                                    <h4 class="text-uppercase">Commande du <?= datecourt($commande->created)  ?></h4>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <?php foreach (Home\PRODUIT::getAll() as $key => $produit) {
                                                    $reste = $commande->reste($produit->getId());
                                                    if ($reste > 0) { ?>
                                                        <th class="text-center"><?= $produit->name() ?></th>
                                                    <?php }
                                                } ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><h3>Reste : </h3></td>
                                                <?php foreach (Home\PRODUIT::getAll() as $key => $produit) {
                                                    $reste = $commande->reste($produit->getId());
                                                    if ($reste > 0) { ?>
                                                        <td class="text-center" style="font-size: 20px;"><?= start0($reste) ?></td>
                                                    <?php   } 
                                                } ?>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        <?php  } ?>
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</div>
</div>



<?php include($this->rootPath("webapp/gestion/elements/templates/footer.php")); ?>

<?php include($this->rootPath("composants/assets/modals/modal-client.php")); ?>  
<?php include($this->rootPath("composants/assets/modals/modal-acompte.php")); ?>  
<?php include($this->rootPath("composants/assets/modals/modal-dette.php")); ?>  
<?php include($this->rootPath("composants/assets/modals/modal-rembourser.php")); ?>  
<?php include($this->rootPath("composants/assets/modals/modal-transfert-acompte.php")); ?>  
<?php include($this->rootPath("composants/assets/modals/modal-newcommande.php")); ?>  
<?php include($this->rootPath("composants/assets/modals/modal-vente.php")); ?>  

</div>
</div>


<?php include($this->rootPath("webapp/gestion/elements/templates/script.php")); ?>


</body>

</html>
