
<div class="modal inmodal fade" id="modal-groupecommande" style="z-index: -9">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-body">
                <div class="ibox-content">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="row">
                                <div class="col-3">
                                    <img style="width: 120%" src="<?= $rooter->stockage("images", "societe", $params->image) ?>">
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
                            <h2 class="title text-uppercase gras">Fiche de commande</h2>
                            <h3 class="text-uppercase"><?= $groupecommande->client->name()  ?> // <span style="font-weight: normal;"><?= $groupecommande->client->typeclient->name()  ?></span></h3>
                            <h5><?= $groupecommande->client->contact  ?> // <?= $groupecommande->client->email  ?></h5>
                        </div>
                    </div><hr>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th colspan="2"></th>
                                <?php foreach (Home\PRODUIT::getAll() as $key => $produit) { ?>
                                    <th class="text-center"><?= $produit->name() ?></th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $datas1 = $groupecommande->fourni("commande", ["etat_id !="=>ETAT::ANNULEE]);
                            foreach ($datas1 as $key => $ligne) {
                                $ligne->fourni("lignecommande");
                                $ligne->type = "commande";
                            }
                            $datas2 = $groupecommande->fourni("livraison", ["etat_id !="=>ETAT::ANNULEE]);
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
                                        <a target="_blank" href="<?= $rooter->url("gestion", "fiches", "bonlivraison", $ligne->getId()) ?>"><br><i style="font-size: 18px;" class="fa fa-file-text" style="font-style: 25px;"></i></a>
                                    <?php }else{ ?>
                                        <a target="_blank" href="<?= $rooter->url("gestion", "fiches", "boncommande", $ligne->getId()) ?>"><br><i style="font-size: 18px;" class="fa fa-file-text" style="font-style: 25px;"></i></a>
                                    <?php } ?>                                
                                </td>
                                <?php 
                                foreach (Home\PRODUIT::getAll() as $key => $produit) {
                                    $test = 0;
                                    foreach ($ligne->items as $key => $item) {
                                        if ($item->produit_id == $produit->getId() ) { 
                                            $test = $item->quantite;
                                            if ($ligne->type == "livraison") {
                                                $test = $item->quantite_livree;
                                            }
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
                                        <a target="_blank" href="<?= $rooter->url("gestion", "fiches", "boncaisse", $ligne->operation_id) ?>"><br><i style="font-size: 18px;" class="fa fa-file-text"></i></a>
                                    </td>
                                <?php }  ?>

                            </tr>
                        <?php }
                        ?>

                        <tr style="height: 20px;"></tr>

                        <tr>
                            <td colspan="2"><h2 class="text-uppercase text-right">Reste à livrer : </h2></td>
                            <?php foreach (Home\PRODUIT::getAll() as $key => $produit) { ?>
                                <td widtd="90" class="text-center"><h2 class="gras"><?= start0(money($groupecommande->reste($produit->getId()))) ?></h2></th>
                                <?php } ?>
                            </tr>
                        </tbody>
                    </table><br>

                    <div class="">
                        <button class="btn btn-primary dim" onclick="fairenewcommande(<?= $groupecommande->getId() ?>)"><i class="fa fa-cart-plus"></i> Lui ajouter nouvelle commande</button>
                        <button class="btn btn-warning dim pull-right" onclick="newlivraison(<?= $groupecommande->getId()  ?>)"><i class="fa fa-truck"></i> Faire Nouvelle livraison </button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
