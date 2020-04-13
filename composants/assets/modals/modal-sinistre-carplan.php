
<div class="modal inmodal fade" id="modal-sinistre">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
             <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Formulaire de déclaration de sinistre</h4>
                <small class="font-bold">Renseigner ces champs pour enregistrer le sinistre</small>
            </div>
            <form method="POST" class="formShamman" classname="sinistre" reload="false">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Nom de la fiche (Titre) <span1>*</span1></label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="name" required placeholder="Ex...Crevaison pneu gauche">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label>Quel type de sinistre <span1>*</span1></label>
                                    <div class="form-group">
                                        <?php Native\BINDING::html("select", "typesinistre"); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                
                                <div class="col-sm-6">
                                    <label>Sinistre survenu le <span1>*</span1></label>
                                    <div class="form-group">
                                        <input type="datetime-local" class="form-control" name="date_etablissement"  required autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label>Lieu du sinistre <span1>*</span1></label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="lieudrame"  required autocomplete="off">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="">
                                <label>plus de détails</label>
                                <div class="form-group">
                                    <textarea class="form-control" rows="6" name="comment"></textarea>
                                </div>
                            </div>
                        </div>
                    </div><hr>
                    <div class="row">
                        <div class="col-sm-4">
                            <label>Il y a eu ....</label>
                            <div class="form-group">
                                <label><input type="radio" name="constat" value="0"> Arrangement à l'amiable</label><br>
                                <label><input type="radio" name="constat" value="1"> Intervention de la police</label>
                                <hr>
                                <label><input type="checkbox" name="pompiers" value="1"> Intervention des sapeurs pompiers</label>
                            </div>
                        </div>
                        <div class="col-sm-8 border-left">
                            <h2 class="subtitle mp3">L'AUTRE PARTIE</h2>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Nom et Prénom du conducteur</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="nomautre" >
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label>Son contact / email</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="contactautre" >
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label>Immatriculation du véhicule </label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="immatriculationautre" >
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label>Modèle et marque du véhicule  </label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="vehiculeautre" >
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label>Sa compagnie d'assurance </label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="assuranceautre" >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><br>
                    
                    <hr>
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
                    <input type="hidden" name="vehicule_id" value="<?= $affectation->vehicule->getId() ?>">
                    <input type="hidden" name="matricule" value="<?= $carplan->matricule; ?>">
                    <input type="hidden" name="fullname" value="<?= $carplan->name() ?>">
                    <button type="button" class="btn btn-sm  btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Annuler</button>
                    <button class="btn btn-sm btn-success pull-right"><i class="fa fa-check"></i> Déclarer le sinistre</button>
                </div>
                <br>
            </form>

        </div>
    </div>
</div>

