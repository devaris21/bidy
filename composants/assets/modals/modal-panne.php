<div class="modal inmodal fade" id="modal-panne<?= $item->getId() ?>">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
             <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Formulaire de declaration de panne</h4>
                <small class="font-bold">Renseigner ces champs pour enregistrer les informations</small>
            </div>
            <form method="POST" class="formPanne">
                <h3 class="text-uppercase text-center text-red">Panne sur la <?= $item->machine->name() ?></h3>
                <p class="container text-center">Toutes les autres informations concernant l'entretien sont déjà et automatiquement prise en compte avec cette validation de la déclaration de panne !</p>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <label>Début de l'Entretien <span1>*</span1></label>
                            <div class="form-group">
                                <input type="date" class="form-control" name="started" value="<?= dateAjoute() ?>"  required autocomplete="off">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label>Fin de l'Entretien <span1>*</span1></label>
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
                            <label>Coût de l'entretien <span1>*</span1></label>
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
                    <input type="hidden" name="demande_id" value="<?= $item->getId() ?>">
                    <button type="button" class="btn btn-sm  btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Annuler</button>
                    <button class="btn btn-sm btn-primary dim pull-right"><i class="fa fa-check"></i> Valider l'entretien</button>
                </div>
                <br>
            </form>

        </div>
    </div>
</div>

