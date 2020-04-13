
<div class="modal inmodal fade" id="modal-approvisionnement" style="z-index: 99999999">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title">Nouvel approvisionnement</h4>
            <small class="font-bold">Renseigner ces champs pour enregistrer l'approvisonnement </small>
        </div>
        
        <div class="row">
            <div class="col-md-8">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5 class="text-uppercase">Les produits de la commande</h5>
                    </div>
                    <div class="ibox-content"><br>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tbody class="approvisionnement">
                                    <!-- rempli en Ajax -->
                                </tbody>
                            </table>

                            <div class="text-center">
                                <?php foreach (Home\RESSOURCE::getAll() as $key => $ressource) { ?>
                                    <button class="btn btn-white dim newressource" data-id="<?= $ressource->getId() ?>" data-toggle="tooltip" title="<?= $ressource->unite ?>"><?= $ressource->name(); ?></button>
                                <?php }  ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 ">
                <div class="ibox"  style="background-color: #eee">
                    <div class="ibox-title" style="padding-right: 2%; padding-left: 3%; ">
                        <h5 class="text-uppercase">Finaliser l'approvisionnement </h5>
                    </div>
                    <div class="ibox-content container-fluid"  style="background-color: #fafafa">
                        <form id="formApprovisionnement" >
                            <div>
                                <label>Le fournisseur <span style="color: red">*</span> </label>                                
                                <div class="input-group">
                                    <?php Native\BINDING::html("select", "prestataire"); ?>
                                </div>
                            </div><br>
                            <div>
                                <label>Etat de l'approvisionnement <span style="color: red">*</span> </label>                                
                                <select class="select2 form-control" name="type" style="width: 100%;">
                                    <option value="<?= Home\ETAT::ENCOURS ?>">Pas encore livré</option>
                                    <option value="<?= Home\ETAT::TERMINEE ?>">Déjà livré</option>
                                </select>
                            </div><hr>
                            <div>
                                <label>Montant de l'approvisionnement <span style="color: red">*</span> </label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-money"></i></span><input type="text" name="datelivraison" class="form-control" required>
                                </div>
                            </div><br>
                            <div>
                                <label>Mode de payement <span style="color: red">*</span> </label>                                
                                <div class="input-group">
                                    <?php Native\BINDING::html("select", "modepayement"); ?>
                                </div>
                            </div>
                        </form><br>
                        <hr/>
                        <button onclick="enregistrerApprovisionnement()" class="btn btn-primary btn-block dim"><i class="fa fa-check"></i> Valider l'approvisionnement</button>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
</div>


