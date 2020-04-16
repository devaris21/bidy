<div class="modal inmodal fade" id="modal-validerentretien-vehicule<?= $item->getId() ?>">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Entretien terminé</h4>
            </div>
            <form method="POST" class="formValiderEntretienVehicule">
                <div class="modal-body">
                    <div class="">
                        <label>Reste du montant de l'entretien <span1>*</span1></label>
                        <div class="form-group">
                            <input type="text" class="form-control" name="montant" required>
                        </div>
                    </div>
                    <div class="">
                        <label>Mode de payement <span1>*</span1></label>
                         <div class="form-group">
                            <?php Native\BINDING::html("select", "modepayement") ?>
                        </div>
                    </div>
                </div><hr>
                <div class="container">
                    <input type="hidden" name="id" value="<?= $item->getId() ?>">
                    <button type="button" class="btn btn-sm  btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Annuler</button>
                    <button class="btn btn-sm btn-primary dim pull-right"><i class="fa fa-refresh"></i> Valider</button>
                </div>
                <br>
            </form>
        </div>
    </div>
</div>
