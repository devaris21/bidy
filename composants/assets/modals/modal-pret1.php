


<div class="modal inmodal fade" id="modal-pret1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Formulaire de prêt de véhicule</h4>
                <small class="font-bold">Renseigner ces champs pour enregistrer l'assurance</small>
            </div>
            <form method="POST" id="formPret">
                <div class="modal-body">
                   <u><h2 class="subtitle text-uppercase mp3">INFORMATIONS DU bénéficiaire</h2></u>
                   <div class="row">
                    <div class="col-md-4">
                        <label>Matricule </label>
                        <div class="form-group">
                            <input type="text" class="form-control" name="matricule">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <label>Nom / Raison sociale du beneficiaire <span1>*</span1></label>
                        <div class="form-group">
                            <input type="text" class="form-control" name="name" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <label>Adresse géographique</label>
                        <div class="form-group">
                            <input type="text" class="form-control" name="adresse">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label>Email </label>
                        <div class="form-group">
                            <input type="email" class="form-control" name="email">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label>Contact <span1>*</span1></label>
                        <div class="form-group">
                            <input type="text" class="form-control" name="contact" required>
                        </div>
                    </div>
                </div>

                <u><h2 class="subtitle text-uppercase mp3">détails du prêt</h2></u>
                <div class="row">
                    <div class="col-md-4">
                        <label>Date de début <span1>*</span1></label>
                        <div class="form-group">
                            <input type="date" class="form-control" name="started" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label>Date de fin<span1>*</span1></label>
                        <div class="form-group">
                            <input type="date" class="form-control" name="finished" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label>Ajouter une note (motif ou but)</label>
                        <div class="form-group">
                            <textarea class="form-control" rows="4" name="comment" ></textarea>
                        </div>
                    </div> 
                </div>
            </div><hr class="">
            <div class="container">
                <input type="hidden" name="id">
                <input type="hidden" name="typelocation_id" value="2">
                <input type="hidden" name="prestataire_id" value="1">
                <button type="button" class="btn btn-sm  btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Annuler</button>
                <button class="btn btn-sm btn-success pull-right"><i class="fa fa-check"></i> Valider le prêt du véhicule</button>
            </div>
            <br>
        </form>
    </div>
</div>
</div>