<!DOCTYPE html>
<html>

<?php include($this->rootPath("webapp/gestion/elements/templates/head.php")); ?>


<body class="fixed-sidebar">

    <div id="wrapper">

        <?php include($this->rootPath("webapp/gestion/elements/templates/sidebar.php")); ?>  

        <div id="page-wrapper" class="gray-bg">

          <?php include($this->rootPath("webapp/gestion/elements/templates/header.php")); ?>  

          <div class="wrapper wrapper-content  animated fadeInRight">
            <div class="row">
                <div class="col-sm-8">
                    <div class="ibox">
                        <div class="ibox-content">
                            <p></p>
                            <div class="">                                
                             <ul class="nav nav-tabs">
                                <li><a class="nav-link active" data-toggle="tab" href="#tab-1"><i class="fa fa-user"></i> Les commandes en cours</a></li>
                                <li><a class="nav-link" data-toggle="tab" href="#tab-2"><i class="fa fa-briefcase"></i> Flux des transactions</a></li>
                                <li><a class="nav-link" data-toggle="tab" href="#tab-3"><i class="fa fa-briefcase"></i> Transactions de caisse</a></li>
                            </ul>
                            <div class="tab-content">
                                <div id="tab-1" class="tab-pane active"><br>
                                    <div class="row container-fluid">
                                        <button type="button" <?= (count($client->groupecommandes) > 0)?" onclick='newcommande()' ": "data-toggle=modal data-target='#modal-newcommande.php'" ?>  class="btn btn-primary btn-sm dim float-right"><i class="fa fa-plus"></i> Nouvelle commande </button>
                                    </div>
                                    <div class="">
                                        <?php if (count($client->groupecommandes) > 0) { ?>

                                            <?php foreach ($client->groupecommandes as $key => $commande) {
                                                $commande->actualise(); 
                                                ?>
                                                <h4 class="text-uppercase gras">Commande du <?= datecourt($commande->created)  ?></h4>
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th></th>
                                                            <?php foreach (Home\PRODUIT::getAll() as $key => $produit){ 
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
                                                        <?php foreach (Home\PRODUIT::getAll() as $key => $produit) {
                                                            $reste = $commande->reste($produit->getId());
                                                            if ($reste > 0) { ?>
                                                                <td class="text-center" style="font-size: 20px;"><?= start0($reste) ?></td>
                                                            <?php   } 
                                                        } ?>
                                                        <td style="width: 60px; padding: 0"><button onclick="fichecommande(<?= $commande->getId()  ?>)" style="margin-top: 5%; margin-left: 5%;" class="btn btn-success btn-sm dim"><i class="fa fa-plus"></i> de détails </button></td>
                                                    </tr>
                                                </tbody>
                                            </table><hr>
                                        <?php  }  }else{ ?>
                                            <h1 style="margin-top: 20%;" class="text-center text-muted"><i class="fa fa-folder-open-o fa-3x"></i> <br> Aucune commande en cours pour ce client !</h1>
                                        <?php } ?>


                                    </div>
                                </div>
                                <div id="tab-2" class="tab-pane">

                                    <div class="ibox-content inspinia-timeline">
                                        <?php foreach ($flux as $key => $transaction) { ?>
                                            <div class="timeline-item">
                                                <div class="row">
                                                    <div class="col-2 date" style="padding-right: 1%; padding-left: 1%;">
                                                        <i data-toggle="tooltip" tiitle="Imprimer le bon de <?= $transaction->type  ?> " class="fa fa-file-text"></i>
                                                        <?= heurecourt($transaction->created) ?>
                                                        <br/>
                                                        <small class="text-navy"><?= datecourt($transaction->created) ?></small>
                                                    </div>
                                                    <div class="col-10 content">
                                                        <p class="m-b-xs text-uppercase"><?= $transaction->type ?> N°<strong><?= $transaction->reference ?></strong></p>
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
                                                                        <td><h5 class="text-<?= ($transaction->type == "livraison")? "orange":"green" ?> text-center"> <?= $ligne->quantite  ?> </h5></td>
                                                                    <?php  } ?>

                                                                    <?php if ($transaction->type == "commande") { ?>
                                                                        <td>
                                                                            <small>Montant de la commande</small>
                                                                            <h4 class="mp0 text-uppercase" style="margin-top: -1.5%;"><?= money($transaction->montant) ?> <?= $params->devise  ?> <small style="font-weight: normal;;" data-toggle="tooltip" title="Payement par <?= $transaction->operation->modepayement->name();  ?>">(<?= $transaction->operation->modepayement->initial;  ?>)</small></h4>
                                                                        </td>
                                                                        <td data-toggle="tooltip" title="imprimer le facture">
                                                                            <a href=""><i class="fa fa-file-text"></i></a>
                                                                        </td>
                                                                    <?php }  ?>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>                                      
                                    </div>

                                </div>


                                <div id="tab-3" class="tab-pane"><br>
                                    <?php foreach ($fluxcaisse as $key => $transaction) {
                                        $transaction->actualise(); ?>
                                        <div class="timeline-item">
                                            <div class="row">
                                                <div class="col-2 date" style="padding-right: 1%; padding-left: 1%;">
                                                    <i data-toggle="tooltip" tiitle="Imprimer le bon de <?= $transaction->type  ?> " class="fa fa-file-text"></i>
                                                    <?= heurecourt($transaction->created) ?>
                                                    <br/>
                                                    <small class="text-navy"><?= datecourt($transaction->created) ?></small>
                                                </div>
                                                <div class="col-10 content">
                                                    <p>
                                                        <span class="">Bon de caisse N°<strong><?= $transaction->reference ?></strong></span>
                                                        <span class="pull-right text-right">
                                                            <span class="gras" style="font-size: 22px"><?= money($transaction->montant) ?> <?= $params->devise ?></span> <br>
                                                            Par <?= $transaction->modepayement->name() ?></span>
                                                        </p>
                                                        <p class="m-b-xs"><?= $transaction->comment ?> </p>
                                                        <p></p>
                                                        <h3></h3>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>                 
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="ibox selected">

                        <div class="ibox-content">
                            <div class="tab-content">
                                <div id="contact-1" class="tab-pane active">
                                    <h2><?= $client->name() ?> <i onclick="modification('client', <?= $client->getId() ?>)" data-toggle="modal" data-target="#modal-client" class="pull-right fa fa-pencil cursor"></i></h2>
                                    <span><?= $client->typeclient->name() ?></span>
                                    <address>
                                        <i class="fa fa-phone"></i>&nbsp; <?= $client->contact ?><br>
                                        <i class="fa fa-map-marker"></i>&nbsp; <?= $client->adresse ?><br>
                                        <i class="fa fa-envelope"></i>&nbsp; <?= $client->email ?>
                                    </address><hr>

                                    <div class="m-b-lg">
                                        <span>Acompte actuel du client</span>
                                        <h2 class="font-bold"><?= money($client->acompte) ?> <?= $params->devise  ?></h2><br>
                                        <button type="button" data-toggle="modal" data-target="#modal-acompte" class="btn btn-primary dim btn-block"><i
                                            class="fa fa-envelope"></i> Créditer l'accompte
                                        </button>
                                    </div>
                                </div>

                            </div>
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
    <?php include($this->rootPath("composants/assets/modals/modal-newcommande.php")); ?>  

</div>
</div>


<?php include($this->rootPath("webapp/gestion/elements/templates/script.php")); ?>


</body>

</html>
