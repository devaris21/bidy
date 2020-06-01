
<div class="modal inmodal fade" id="modal-changement" style="z-index: 99999999">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title">Nouveau interchangement de produit</h4>
            <small class="font-bold">Renseigner ces champs pour enregistrer le changement</small>
        </div>
        
        <div class="row">
            <div class="col-md-8">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5 class="text-uppercase">Définissez le changement de produits</h5>
                    </div>
                    <div class="ibox-content"><br>
                        <div class="table-responsive">
                            <table class="table  table-striped">
                                <thead>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>Qté actuelle</td>
                                        <td></td>
                                        <td>Nouvelle Qté</td>
                                    </tr>
                                </thead>
                                <tbody class="commande">
                                    <?php foreach (Home\PRODUIT::getAll() as $key => $produit) {
                                        $reste = $groupecommande->reste($produit->getId()); ?>
                                           <tr class="border-0 border-bottom " id="ligne<?= $produit->getId() ?>" data-id="<?= $produit->getId() ?>">
                                            <td >
                                                <img style="width: 40px" src="<?= $rooter->stockage("images", "produits", $produit->image) ?>">
                                            </td>
                                            <td class="text-left">
                                                <h4 class="mp0 text-uppercase"><?= $produit->name() ?></h4>
                                                <small><?= $produit->description ?></small>
                                            </td>
                                            <td><h3 class="gras"><?= ($reste > 0)?$reste:'' ?></h3></td>
                                            <td><h3 class="gras">=></h3></td>
                                            <td width="105"><input type="number" number class="form-control text-center gras" value="<?= $reste ?>" max="<?= $reste ?>"></td>
                                        </tr>
                                    <?php }  ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 ">
            <div class="ibox"  style="background-color: #eee">
                <div class="ibox-title" style="padding-right: 2%; padding-left: 3%; ">
                    <h5 class="text-uppercase">Finaliser le changement</h5>
                </div>
                <div class="ibox-content"  style="background-color: #fafafa">
                    <form id="formChangement">
                        <div>
                            <label>Motif du changement </label>
                            <textarea class="form-control" rows="4" name="comment"></textarea>
                        </div><br>

                        <input type="hidden" name="client_id" value="<?= $groupecommande->client_id ?>">
                    </form>
                    <hr/>
                    <button onclick="validerChangement()" class="btn btn-default btn-block dim"><i class="fa fa-check"></i> Valider le changement</button>
                </div>
            </div>

        </div>
    </div>

</div>
</div>
</div>


