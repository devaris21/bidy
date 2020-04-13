
<div class="modal inmodal fade" id="modal-panne">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
           <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title">Formulaire de déclaration de panne</h4>
            <small class="font-bold">Renseigner ces champs pour enregistrer la panne</small>
        </div>
        <form method="POST" class="formShamman" classname="sinistre">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div>
                            <label>Chauffeur / Personnel<span1>*</span1></label>
                            <div class="form-group">
                                <?php Native\BINDING::html("select", "personnel"); ?>
                            </div>
                        </div>
                        <div>
                            <label>Panne survenue le (Date et Heure)<span1>*</span1></label>
                            <div class="form-group">
                                <input type="datetime-local" class="form-control" name="date_etablissement"  required autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="">
                            <label>Dianostic</label>
                            <div class="form-group">
                                <textarea class="form-control" rows="5" name="comment"></textarea>
                            </div>
                        </div>
                    </div>
                </div><hr>

                <div class="row">
                    <div class="col-sm-4">
                        <label>Illustration 1</label>
                        <div class="">
                            <img style="width: 80px;" src="" class="img-thumbnail logo">
                            <input class="hide" type="file" name="image1">
                            <button type="button" class="btn btn-sm bg-red pull-right btn_image"><i class="fa fa-image"></i> Ajouter une image</button>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <label>Illustration 2</label>
                        <div class="">
                            <img style="width: 80px;" src="" class="img-thumbnail logo">
                            <input class="hide" type="file" name="image2">
                            <button type="button" class="btn btn-sm bg-red pull-right btn_image"><i class="fa fa-image"></i> Ajouter une image</button>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <label>Illustration 3</label>
                        <div class="">
                            <img style="width: 80px;" src="" class="img-thumbnail logo">
                            <input class="hide" type="file" name="image3">
                            <button type="button" class="btn btn-sm bg-red pull-right btn_image"><i class="fa fa-image"></i> Ajouter une image</button>
                        </div>
                    </div>

                </div>
            </div><hr class="">
            <div class="container">
                <input type="hidden" name="id">
                <input type="hidden" name="vehicule_id" value="<?= $vehicule->getId() ?>">
                <button type="button" class="btn btn-sm  btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Annuler</button>
                <button class="btn btn-sm btn-success pull-right dim"><i class="fa fa-check"></i> Déclarer le sinistre</button>
            </div>
            <br>
        </form>

    </div>
</div>
</div>

