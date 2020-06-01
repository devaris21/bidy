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
                <h2 class="text-uppercase text-warning gras">Les achats de stocks </h2>
                <div class="container">
                    <div class="row">
                        <div class="col-xs-7 gras ">Afficher même les achats de stocks passées</div>
                        <div class="offset-1"></div>
                        <div class="col-xs-4">
                            <div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" class="onoffswitch-checkbox" id="example1">
                                    <label class="onoffswitch-label" for="example1">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
               <div class="row">
                <div class="col-md-12">
                    <div class="widget style1 bg-warning">
                        <div class="row">
                            <div class="col-2">
                                <i class="fa fa-bus fa-3x"></i>
                            </div>
                            <div class="col-10 text-right">
                                <span> Achat de stock en cours </span>
                                <h2 class="font-bold"><?= start0($total) ?></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="wrapper wrapper-content">
        <div class="ibox">
            <div class="ibox-title">
                <h5>Tous les achats de stocks</h5>

                <div class="ibox-tools">
                   <button style="margin-top: -5%" data-toggle='modal' data-target="#modal-achat-stock" class="btn btn-warning dim"><i class="fa fa-plus"></i> Nouvel Achat de stock</button>
               </div>
           </div>
           <div class="ibox-content" style="min-height: 300px;">
               <?php if (count($achatstocks) > 0) { ?>
                <table class="table table-hover table-achatstock">
                    <tbody>
                        <?php foreach ($achatstocks as $key => $achat) {
                            $achat->actualise(); 
                            $achat->fourni("ligneachatstock");
                            ?>
                            <tr class=" <?= ($achat->etat_id != Home\ETAT::ENCOURS)?'fini':'' ?> border-bottom">
                                <td class="project-status">
                                    <span class="label label-<?= $achat->etat->class ?>"><?= $achat->etat->name ?></span>
                                </td>
                                <td class=" border-right" style="width: 30%;">
                                    <h4 class="text-uppercase">Appro. N°<?= $achat->reference ?></h4>
                                    <h6 class="text-uppercase text-muted">Fournisseur :  <?= $achat->fournisseur->name() ?></h6>
                                    <span>Enregistré le <?= depuis($achat->created) ?></span>
                                </td>
                                <td class="border-right" style="width: 30%">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr class="no">
                                                <?php foreach ($achat->ligneachatstocks as $key => $ligne) { 
                                                    $ligne->actualise(); ?>
                                                    <th class="text-center text-uppercase"><?= $ligne->produit->name() ?></th>
                                                <?php } ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="no">
                                                <?php foreach ($achat->ligneachatstocks as $key => $ligne) { ?>
                                                 <td class="text-center gras <?= ($achat->etat_id == Home\ETAT::VALIDEE)?'text-primary':'' ?>"><?= $ligne->quantite_recu ?></td>
                                             <?php   } ?>
                                         </tr>
                                     </tbody>
                                 </table>
                             </td>
                             <td><span>Montant</span> <h3 class="gras text-orange"><?= money($achat->montant) ?> <?= $params->devise  ?></h3>
                                <span><?= $achat->operation->structure ?> - <?= $achat->operation->numero ?></span>
                            </td>
                            <td class="border-left">
                                <?php if ($achat->etat_id == Home\ETAT::ENCOURS) { ?>
                                    <button onclick="terminer(<?= $achat->getId() ?>)" class="btn btn-primary btn-sm"><i class="fa fa-check"></i> Valider</button>
                                    <?php if ($employe->isAutoriser("modifier-supprimer")) { ?>
                                        <button onclick="annuler(<?= $achat->getId() ?>)" class="btn btn-white btn-sm"><i class="fa fa-close text-red"></i></button>
                                    <?php } ?>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php  } ?>
                </tbody>
            </table>
        <?php }else{ ?>
            <h1 style="margin-top: 6%;" class="text-center text-muted"><i class="fa fa-folder-open-o fa-3x"></i> <br> Aucun achatstock en cours pour le moment!</h1>
        <?php } ?>

    </div>
</div>
</div>


<?php include($this->rootPath("webapp/gestion/elements/templates/footer.php")); ?>
<?php include($this->rootPath("composants/assets/modals/modal-achat-stock.php")); ?> 



<?php 
foreach ($achatstocks as $key => $achat) {
    if ($achat->etat_id == Home\ETAT::ENCOURS) { 
        $achat->actualise();
        $achat->fourni("ligneachatstock");
        include($this->rootPath("composants/assets/modals/modal-achat-stock2.php"));
    } 
} 
?>

</div>
</div>


<?php include($this->rootPath("webapp/gestion/elements/templates/script.php")); ?>


</body>

</html>
