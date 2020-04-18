
<div class="modal inmodal fade" id="modal-productionjour" style="z-index: 1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-body">
                <div class="ibox-content">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="row">
                                <div class="col-3">
                                    <img style="width: 120%" src="<?= $this->stockage("images", "societe", $params->image) ?>">
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
                            <h2 class="title text-uppercase gras">Fiche de rapport journalier</h2>
                            <h5 class="text-uppercase">Dernière mise à jour: // <span style="font-weight: normal;"><?= $productionjour->employe->name()  ?></span></h5>
                            <h5><?= datelong($productionjour->modified) ?></h5>
                        </div>
                    </div><hr>

                    <form id="formProductionJour" classname="productionjour">
                        <div class="row">
                            <div class="col-md-4 border-right">
                                <h4 class="text-uppercase"><u>Productions du jour</u></h4><br>
                                <?php foreach (Home\PRODUIT::getAll() as $key => $produit) { ?>
                                    <label class="text-uppercase"><?= $produit->name() ?></label><br>
                                    <div class="row" style="margin-top: -2%; margin-bottom: 3%;">
                                        <div class="col-6">
                                            <label>produite</label>
                                            <input type="number" data-toggle="tooltip" title="Production du jour" value="0" min=0 number class="gras form-control text-center" name="prod-<?= $produit->getId() ?>">
                                        </div>
                                        <div class="col-6">
                                            <label class="text-red">perte</label>
                                            <input type="number" data-toggle="tooltip" title="Perte du jour au rangement" value="0" min=0 number class="gras form-control text-center text-red" name="perte-<?= $produit->getId() ?>">
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>

                            <div class="col-md-4 border-right">
                                <h4 class="text-uppercase"><u>Consommation du jour</u></h4><br>
                                <?php foreach (Home\RESSOURCE::getAll() as $key => $ressource) { ?>
                                    <div style="margin-top: 5%;">
                                        <label class=" text-blue"><?= $ressource->name() ?> (<?= $ressource->abbr ?>) consommé</label>
                                        <input data-toggle="tooltip" title="Quantité consommé aujourd'hui" type="number" value="0" min=0 number class="gras form-control text-center" name="conso-<?= $ressource->getId() ?>">
                                    </div>
                                <?php } ?>
                            </div>

                            <div class="col-md-4">
                                <h4 class="text-uppercase"><u>Personnel du jour</u></h4>
                                <ul>
                                    <?php foreach ($productionjour->fourni("manoeuvredujour") as $key => $man) {
                                        $man->actualise(); ?>
                                        <li><?= $man->manoeuvre->name() ?></li>
                                    <?php } ?>
                                </ul><hr class="mp3">

                                <b>Le groupe de manoeuvres qui travaillent</b><br><br>
                                <?php Native\BINDING::html("radio", "groupemanoeuvre", [$productionjour->groupemanoeuvre_id]) ?><br><br>

                                <b>Ou definir manuellement les manoeuvres qui travaillent</b>
                                <?php Native\BINDING::html("select-multiple", "manoeuvre") ?>


                                <hr><br><h4 class="text-uppercase"><u>Ajouter une note</u></h4>
                                <textarea class="form-control" rows="4" name="comment" placeholder="Ajouter une note..."></textarea><br>
                            </div>
                        </div>
                        <hr>
                        <div class="">
                            <button class="btn pull-right dim btn-primary" ><i class="fa fa-check"></i> Mettre à jour le rapport</button>
                        </div><br>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
