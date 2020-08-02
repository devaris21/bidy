<!DOCTYPE html>
<html>

<?php include($this->rootPath("webapp/gestion/elements/templates/head.php")); ?>


<body class="fixed-sidebar">

    <div id="wrapper">

        <?php include($this->rootPath("webapp/gestion/elements/templates/sidebar.php")); ?>  

        <div id="page-wrapper" class="gray-bg">

          <?php include($this->rootPath("webapp/gestion/elements/templates/header.php")); ?>  

          <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-sm-9">
                <h2 class="text-uppercase text-green gras">Les commandes en cours</h2>
                <div class="container">
                    <button type="button" data-toggle=modal data-target='#modal-clients' class="btn btn-primary btn-sm dim"><i class="fa fa-plus"></i> Nouvelle commande </button>
                </div>
            </div>
            <div class="col-sm-3">
               <div class="row">
                <div class="col-md-12">
                    <div class="widget style1 lazur-bg">
                        <div class="row">
                            <div class="col-3">
                                <i class="fa fa-th-large fa-3x"></i>
                            </div>
                            <div class="col-9 text-right">
                                <span> Commandes en cours </span>
                                <h2 class="font-bold"><?= start0(count($groupes))  ?></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="wrapper wrapper-content">
       <div class="row">
        <?php foreach ($groupes as $key => $commande) {
            $commande->actualise();
            $datas = $commande->fourni("commande");
            $datas1 = $commande->fourni("livraison", ["etat_id > "=>Home\ETAT::ANNULEE, "etat_id < "=>Home\ETAT::VALIDEE]);
            $client = $commande->client;
            $com = end($datas); ?>
            <div class="col-md-4 col-sm-6">
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
                            <a class="text-capitalize text-dark gras" href="<?= $this->url("gestion", "master", "client", $commande->client_id)  ?>"><?= $commande->client->name() ?> (<?= count($datas) ?>)</a>
                            <small class="text-muted">Livraison prévue pour le <?= datecourt($com->datelivraison) ?></small><br>
                        </div>
                    </div>
                    <div class="social-footer">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <?php foreach ($produits as $key => $produit){ 
                                     $reste = $commande->reste($produit->getId());
                                     if ($reste > 0) { ?>
                                        <th class="text-center small gras"><?= $produit->name() ?></th>
                                    <?php }
                                } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php foreach ($produits as $key => $produit) {
                                    $reste = $commande->reste($produit->getId());
                                    if ($reste > 0) { ?>
                                        <td class="text-center "><?= start0($reste) ?></td>
                                    <?php   } 
                                } ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php } ?>
</div>

<!-- <div class="ibox">
    <div class="ibox-title">
        <h5>Toutes les commandes</h5>
        <div class="ibox-tools">
            <button style="margin-top: -5%;" type="button" data-toggle=modal data-target='#modal-clients' class="btn btn-primary btn-sm dim float-right"><i class="fa fa-plus"></i> Nouvelle commande </button>
        </div>
    </div>
    <div class="">

        <?php if (count($groupes) > 0) { ?>
         <table class="table table-hover table-commande">
            <tbody>
                <?php foreach ($groupes as $key => $commande) {
                    $commande->actualise(); 
                    $datas = $commande->fourni("commande");
                    $datas1 = $commande->fourni("livraison", ["etat_id > "=>Home\ETAT::ANNULEE, "etat_id < "=>Home\ETAT::VALIDEE]);
                    $client = $commande->client;
                    ?>
                    <tr class="border-bottom">
                        <td class="project-status">
                            <span class="label label-<?= $commande->etat->class ?>"><?= $commande->etat->name ?></span>
                        </td>
                        <td class="project-title border-right" style="width: 35%;">
                            <h3 class="text-uppercase">Commandes (<?= count($datas) ?>)</h3>
                            <h5 class="text-uppercase text-muted">de <a href="<?= $this->url("gestion", "master", "client", $commande->client_id)  ?>"><?= $commande->client->name() ?></a></h5>
                            <ul>Date de livraison prévue
                                <?php foreach ($datas as $key => $com) { ?>
                                    <li><?= datecourt($com->datelivraison) ?></li>
                                <?php } ?>
                            </ul>
                            <?php if (count($datas1) > 0) { ?>
                                <p class="text-blue">(<?= count($datas1) ?>) livraison est déjà en cours/programmée pour cette commande</p>
                            <?php } ?>
                        </td>
                        <td class="border-right">
                            <h4>Satisfaction de la commande</h4>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <?php foreach (Home\PRODUIT::getAll() as $key => $produit) { 
                                            if ($commande->reste($produit->getId()) > 0) { ?>
                                                <th class="text-center"><?= $produit->name() ?></th>
                                            <?php }
                                        } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><h4 class="mp0">Reste : </h4></td>
                                        <?php foreach (Home\PRODUIT::getAll() as $key => $produit) {
                                            $reste = $commande->reste($produit->getId());
                                            if ($reste > 0) { ?>
                                             <td class="text-center"><?= start0($reste) ?></td>
                                         <?php } 
                                     } ?>
                                 </tr>
                             </tbody>
                         </table>
                     </td>
                     <td>
                        <br>
                        <button onclick="fichecommande(<?= $commande->getId()  ?>)" class="btn btn-block btn-primary btn-sm dim"><i class="fa fa-plus"></i> de détails </button>
                    </td>
                </tr>
            <?php  } ?>
        </tbody>
    </table>
<?php }else{ ?>
    <h1 style="margin: 6% auto;" class="text-center text-muted"><i class="fa fa-folder-open-o fa-3x"></i> <br> Aucune commande en cours pour le moment</h1>
<?php } ?>

</div>
</div> -->
</div>


<?php include($this->rootPath("webapp/gestion/elements/templates/footer.php")); ?> 

</div>
</div>


<?php include($this->rootPath("composants/assets/modals/modal-clients.php")); ?> 
<?php include($this->rootPath("composants/assets/modals/modal-client.php")); ?> 


<?php include($this->rootPath("webapp/gestion/elements/templates/script.php")); ?>
<script type="text/javascript" src="<?= $this->relativePath("../../master/client/script.js") ?>"></script>


</body>

</html>
