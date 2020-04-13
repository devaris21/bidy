

<div class="modal inmodal fade" id="modal-entretienvehicule">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title">Formulaire d'entretien de véhicule</h4>
            <small class="font-bold">Renseigner ces champs pour enregistrer l'entretien de véhicule</small>
        </div>
        <form method="POST" class="formShamman" classname="entretienvehicule">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6">
                      <div class="">
                        <label>Quel type d'entretien <span1>*</span1></label>
                        <div class="form-group">
                            <?php Native\BINDING::html("select", "typeentretienvehicule"); ?>
                        </div>
                    </div><br>
                    <div class="">
                        <label>Véhicule à entretenir <span1>*</span1></label>
                        <div class="form-group">
                            <select class="select2" name="vehicule_id" style="width: 100%">
                                <!-- TODO revoir les vehicules disponibles -->
                                <?php foreach (Home\VEHICULE::parcauto() as $key => $vehicule) { ?>
                                    <option value="<?= $vehicule->getId() ?>"><?= $vehicule->name() ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <label>Détails (pannes à reparer etc...) </label>
                    <div class="form-group">
                        <textarea class="form-control" name="comment" rows="6"></textarea>
                    </div>
                </div>
            </div><br>
            <div class="row">
                <div class="col-sm-4">
                    <label>Début de l'Entretien<span1>*</span1></label>
                    <div class="form-group">
                        <input type="date" class="form-control" name="started"  required autocomplete="off">
                    </div>
                </div>
                <div class="col-sm-4">
                    <label>Fin de l'Entretien<span1>*</span1></label>
                    <div class="form-group">
                        <input type="date" class="form-control" name="finished"  required autocomplete="off">
                    </div>
                </div>
                <div class="col-sm-4">
                    <label>Prestataire de l'entretien <span1>*</span1></label>
                    <div class="form-group">
                        <?php Native\BINDING::html("select", "prestataire"); ?>
                    </div>
                </div>
            </div><br>
            <div class="row">
                <div class="col-sm-4">
                    <label>Coût de l'entretien<span1>*</span1></label>
                    <div class="form-group">
                        <input type="number" class="form-control" name="price" required autocomplete="off">
                    </div>
                </div>

                <div class="col-sm-4">
                    <label>Illustration 1</label>
                    <div class="">
                        <img style="width: 80px;" src="" class="img-thumbnail logo">
                        <input class="hide" type="file" name="photo1">
                        <button type="button" class="btn btn-sm bg-orange pull-right btn_image"><i class="fa fa-image"></i> Ajouter une image</button>
                    </div>
                </div>

                <div class="col-sm-4">
                    <label>Illustration 2</label>
                    <div class="">
                        <img style="width: 80px;" src="" class="img-thumbnail logo">
                        <input class="hide" type="file" name="photo2">
                        <button type="button" class="btn btn-sm bg-orange pull-right btn_image"><i class="fa fa-image"></i> Ajouter une image</button>
                    </div>
                </div>

            </div>
        </div><hr class="">
        <div class="container">
            <button type="button" class="btn btn-sm  btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Annuler</button>
            <button class="btn btn-sm btn-success pull-right"><i class="fa fa-check"></i> Valider l'entretien</button>
        </div>
        <br>
    </form>

</div>
</div>
</div>

