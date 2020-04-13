<div class="modal inmodal fade" id="modal-affectation">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Formulaire de nouvelle affectation</h4>
                <small class="font-bold">Renseigner ces champs pour enregistrer les informations</small>
            </div>
            <form method="POST" classname="affectation" class="formShamman">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-4 unmodified">
                            <label>Matricule du bénéficiaire <span1>*</span1></label>
                            <div class="form-group">
                                <input type="text" class="form-control" name="matricule" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label>Nom du bénéficiaire <span1>*</span1></label>
                            <div class="form-group">
                                <input type="text" class="form-control" name="name" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label>Prenom du bénéficiaire </label>
                            <div class="form-group">
                                <input type="text" class="form-control" name="lastname" >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <label>Fonction <span1>*</span1></label>
                            <div class="form-group">
                                <input type="text" class="form-control" name="fonction">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label>Email <span1>*</span1></label>
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label>Contacts <span1>*</span1></label>
                            <div class="form-group">
                                <input type="text" class="form-control" name="contact" required>
                            </div>
                        </div>
                        
                    </div><hr>
                    <div class="row">
                        <div class="col-sm-4">
                            <label>Type d'affectation <span1>*</span1></label>
                            <div class="form-group">
                                <?php Native\BINDING::html("select", "typeaffectation") ?>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label>Date de Début d'affectation <span1>*</span1></label>
                            <div class="form-group">
                                <input type="date" class="form-control" name="started" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label>Date de fin d'affectation <span1>*</span1></label>
                            <div class="form-group">
                                <input type="date" class="form-control" name="finished" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5">
                            <label>Ajouter un commentaire </label>
                            <div class="form-group">
                                <textarea class="form-control" name="comment" rows="4"></textarea>
                            </div>
                        </div>
                    </div>
                </div><hr>
                <div class="container">
                    <input type="hidden" name="id">
                    <input type="hidden" name="vehicule_id" value="<?= $levehicule->getId(); ?>">
                    <button type="button" class="btn btn-sm  btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Annuler</button>
                    <button class="btn btn-sm btn-primary pull-right"><i class="fa fa-check"></i> Nouvelle affectattion</button>
                </div>
                <br>
            </form>
        </div>
    </div>
</div>