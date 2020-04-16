<div id="right-sidebar" class="animated fadeInRightBig" style="background-color: #fcfcfc;">
    <div class="sidebar-container">
        <div id="aside-1" class="">
            <br>
            <form id="formProductionJour" method="post" classname="productionjour">
                <div class="container-fluid">
                    <h4 class="text-uppercase mp0"><u>Productions du jour</u></h4>
                    <?php foreach (Home\PRODUIT::getAll() as $key => $produit) { ?>
                        <label class="text-uppercase"><?= $produit->name() ?></label>
                        <div class="row" style="margin-top: -4%; margin-bottom: 3%;">
                            <div class="col-6">
                                <input type="number" data-toggle="tooltip" title="Production du jour" value="0" min=0 number class="gras form-control" name="prod-<?= $produit->getId() ?>">
                            </div>
                            <div class="col-6">
                                <input type="number" data-toggle="tooltip" title="Perte du jour au rangement" value="0" min=0 number class="gras form-control text-red" name="perte-<?= $produit->getId() ?>">
                            </div>
                        </div>
                    <?php } ?>

                    <hr>

                    <h4 class="text-uppercase mp0"><u>Consommation du jour</u></h4>
                    <div class="row">
                        <?php foreach (Home\RESSOURCE::getAll() as $key => $ressource) { ?>
                            <div class="col-6" style="margin-top: 5%;">
                                <label class=" text-blue"><?= $ressource->name() ?> (<?= $ressource->abbr ?>)</label>
                                <input style="margin-top: -7%" data-toggle="tooltip" title="Quantité consommé aujourd'hui" type="number" value="0" min=0 number class="gras form-control" name="conso-<?= $ressource->getId() ?>">
                            </div>
                        <?php } ?>
                    </div><br>

                    <label>Le personnel qui travaille</label>
                    <div>
                        <?php Native\BINDING::html("select", "groupemanoeuvre") ?>
                    </div>
                </div><hr>

                <div class="container-fluid">
                    <textarea class="form-control" rows="4" name="comment" placeholder="Ajouter une note..."></textarea><br>
                    <button class="btn btn-block dim btn-primary" ><i class="fa fa-check"></i> Enregistrer</button>
                </div>
            </form>

        </div>
    </div>
</div>