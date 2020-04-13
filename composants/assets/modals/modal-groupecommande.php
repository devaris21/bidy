
<div class="modal inmodal fade" id="modal-groupecommande" style="z-index: 1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-body">
                <div class="ibox-content">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <div class="row">
                        <div class="col-sm-5">
                           <div class="row">
                            <div class="col-3">
                                <img style="width: 120%" src="<?= $rooter->stockage("images", "societe", "logo.png") ?>">
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
                        <h2 class="title text-uppercase gras">Fiche de commande</h2>
                        <h3 class="text-uppercase"><?= $groupecommande->client->name()  ?> // <span style="font-weight: normal;"><?= $groupecommande->client->typeclient->name()  ?></span></h3>
                        <h5><?= $groupecommande->client->contact  ?> // <?= $groupecommande->client->email  ?></h5>
                    </div>
                </div><hr>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th colspan="2"></th>
                            <?php foreach ($groupecommande->lignegroupecommandes as $key => $ligne) {
                                $ligne->actualise();  ?>
                                <th width="90" class="text-center text-uppercase"><?= $ligne->produit->name() ?></th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $datas1 = $groupecommande->fourni("commande");
                        foreach ($datas1 as $key => $ligne) {
                            $ligne->fourni("lignecommande");
                            $ligne->type= "commande";
                        }
                        $datas2 = $groupecommande->fourni("livraison");
                        foreach ($datas2 as $key => $ligne) {
                            $ligne->fourni("lignelivraison");
                            $ligne->type= "livraison";
                        }
                        $datas = array_merge($datas1, $datas2);
                        usort($datas, "comparerDateCreated");

                        foreach ($datas as $key => $ligne) { ?>
                         <tr>
                            <td>
                                <h5 class="text-uppercase mp0"><?= $ligne->type ?> N°<?= $ligne->reference  ?></h5>
                                <small><?= datelong($ligne->created)  ?></small>
                            </td>
                            <td data-toggle="tooltip" title="imprimer le bon de <?= $ligne->type ?>">
                                <?php if ($ligne->type == "livraison") { ?>
                                    <a target="_blank" href="<?= $rooter->url("gestion", "fiches", "bonlivraison", $ligne->getId()) ?>"><i class="fa fa-file-text" style="font-style: 25px;"></i></a>
                                <?php }else{ ?>
                                    <a target="_blank" href="<?= $rooter->url("gestion", "fiches", "boncommande", $ligne->getId()) ?>"><i class="fa fa-file-text" style="font-style: 25px;"></i></a>
                                <?php } ?>                                
                            </td>
                            <?php 
                            foreach ($groupecommande->lignegroupecommandes as $key => $lgn) {
                                $test = 0;
                                foreach ($ligne->items as $key => $item) {
                                    if ($item->produit_id == $lgn->produit_id ) { 
                                        $test = $item->quantite;
                                        break;
                                    }
                                }
                                ?>
                                <td><h3 class="text-<?= ($ligne->type == "livraison")? "orange":"green" ?> text-center"> <?= $test  ?> </h3></td>
                                <?php
                            }
                            ?>

                            <?php if ($ligne->type == "commande") { ?>
                                <td>
                                    <small>Montant de la commande</small>
                                    <h4 class="mp0 text-uppercase" style="margin-top: -1.5%;"><?= money($ligne->montant) ?> <?= $params->devise  ?> <small style="font-weight: normal;;" data-toggle="tooltip" title="Payement par <?= $ligne->operation->modepayement->name();  ?>">(<?= $ligne->operation->modepayement->initial;  ?>)</small></h4>
                                </td>
                                <td data-toggle="tooltip" title="imprimer le facture">
                                    <a target="_blank" href="<?= $rooter->url("gestion", "fiches", "boncaisse", $ligne->operation_id) ?>"><i class="fa fa-file-text" style="font-style: 25px;"></i></a>
                                </td>
                            <?php }  ?>
                            
                        </tr>
                    <?php }
                    ?>

                    <tr style="height: 20px;"></tr>

                    <tr>
                        <td colspan="2"><h2 class="text-uppercase text-right">Reste à livrer : </h2></td>
                        <?php foreach ($groupecommande->lignegroupecommandes as $key => $ligne) {
                            $ligne->actualise();  ?>
                            <td widtd="90" class="text-center"><h2 class="gras"><?= $ligne->quantite ?></h2></th>
                            <?php } ?>
                        </tr>
                    </tbody>
                </table><br>

                <div class="">
                    <button class="btn btn-primary dim" data-toggle="modal" data-target="#modal-newcommande" onclick="session('commande-encours', <?= $groupecommande->getId()  ?>)"><i class="fa fa-cart-plus"></i> Lui ajouter nouvelle commande</button>
                    <button class="btn btn-warning dim pull-right" onclick="newlivraison(<?= $groupecommande->getId()  ?>)"><i class="fa fa-star"></i> Faire Nouvelle livraison </button>
                </div>
            </div>

        </div>
    </div>
</div>
</div>
