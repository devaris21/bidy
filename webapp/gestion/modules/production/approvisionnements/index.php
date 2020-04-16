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
                <h2 class="text-uppercase text-green gras">Les approvisionnements en cours</h2>
                <div class="container">
                    <div class="row">
                        <div class="col-xs-7 gras ">Afficher même les approvisionnements passées</div>
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
                    <div class="widget style1 red-bg">
                        <div class="row">
                            <div class="col-3">
                                <i class="fa fa-bus fa-3x"></i>
                            </div>
                            <div class="col-9 text-right">
                                <span> Approvisionnement en cours </span>
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
                <h5>Tous les approvisionnements</h5>

                <div class="ibox-tools">
                 <button style="margin-top: -5%" data-toggle='modal' data-target="#modal-approvisionnement" class="btn btn-primary dim"><i class="fa fa-plus"></i> Nouvel Approvisionnement</button>
             </div>
         </div>
         <div class="ibox-content" style="height: 400px;">
             <?php if (count($approvisionnements) > 0) { ?>
                <table class="table table-hover table-approvisionnement">
                    <tbody>
                        <?php foreach ($approvisionnements as $key => $appro) {
                            $appro->actualise(); 
                            $appro->fourni("ligneapprovisionnement");
                            ?>
                            <tr class=" <?= ($appro->etat_id != Home\ETAT::ENCOURS)?'fini':'' ?> border-bottom">
                                <td class="project-status">
                                    <span class="label label-<?= $appro->etat->class ?>"><?= $appro->etat->name ?></span>
                                </td>
                                <td class=" border-right" style="width: 30%;">
                                    <h4 class="text-uppercase">Appro. N°<?= $appro->reference ?></h4>
                                    <h6 class="text-uppercase text-muted">Fournisseur :  <?= $appro->prestataire->name() ?></h6>
                                    <span>Enregistré le <?= depuis($appro->created) ?></span>
                                </td>
                                <td class="border-right" style="width: 30%">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr class="no">
                                                <th></th>
                                                <?php foreach ($appro->ligneapprovisionnements as $key => $ligne) { 
                                                    $ligne->actualise(); ?>
                                                    <th class="text-center text-uppercase"><?= $ligne->ressource->name() ?></th>
                                                <?php } ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="no">
                                                <td><h4 class="mp0">à livrer : </h4></td>
                                                <?php foreach ($appro->ligneapprovisionnements as $key => $ligne) { ?>
                                                   <td class="text-center"><?= $ligne->quantite ?></td>
                                               <?php   } ?>
                                           </tr>
                                       </tbody>
                                   </table>
                               </td>
                               <td><span>Montant</span> <h2 class="gras text-orange"><?= money($appro->operation->montant) ?> <?= $params->devise  ?></h2></td>
                               <td class="border-left">
                                <a href="<?= $this->url("gestion", "fiches", "bonlivraison", $appro->getId()) ?>" target="_blank" class="btn btn-block btn-white btn-sm"><i class="fa fa-file-text text-red"></i> Bon de livraison</a><br>
                                <?php if ($appro->etat_id == Home\ETAT::ENCOURS) { ?>
                                  <button onclick="terminer(<?= $appro->getId() ?>)" class="btn btn-primary btn-sm"><i class="fa fa-check"></i> Valider</button>
                                  <button onclick="annuler(<?= $appro->getId() ?>)" class="btn btn-white btn-sm"><i class="fa fa-close text-red"></i></button>
                              <?php } ?>
                          </td>
                      </tr>
                  <?php  } ?>
              </tbody>
          </table>
      <?php }else{ ?>
        <h1 style="margin-top: 8%;" class="text-center text-muted"><i class="fa fa-folder-open-o fa-3x"></i> <br> Aucun approvisionnement en cours pour le moment!</h1>
    <?php } ?>

</div>
</div>
</div>


<?php include($this->rootPath("webapp/gestion/elements/templates/footer.php")); ?>
<?php include($this->rootPath("composants/assets/modals/modal-approvisionnement.php")); ?> 



<?php 
foreach ($approvisionnements as $key => $appro) {
    if ($appro->etat_id == Home\ETAT::ENCOURS) { 
        $appro->actualise();
        $appro->fourni("ligneapprovisionnement");
        include($this->rootPath("composants/assets/modals/modal-approvisionnement2.php"));
    } 
} 
?>

</div>
</div>


<?php include($this->rootPath("webapp/gestion/elements/templates/script.php")); ?>
<script type="text/javascript" src="<?= $this->relativePath("../client/script.js") ?>"></script>


</body>

</html>
