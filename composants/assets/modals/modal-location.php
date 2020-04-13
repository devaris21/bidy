<div class="modal inmodal fade" id="modal-location">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Formulaire de location de véhicules</h4>
                <small class="font-bold">Renseigner ces champs pour enregistrer l'assurance</small>
            </div>
            <form method="POST" id="formLocation">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4 border-right">
                            <div class="">
                                <label>Type de mouvement <span1>*</span1></label>
                                <div class="form-group">
                                    <?php Native\BINDING::html("select", "typelocation") ?>
                                </div>
                            </div>
                            <div class="">
                                <label>Date de début <span1>*</span1></label>
                                <div class="form-group">
                                    <input type="date" class="form-control" name="started" required>
                                </div>
                            </div>
                            <div class="">
                                <label>Date de fin<span1>*</span1></label>
                                <div class="form-group">
                                    <input type="date" class="form-control" name="finished" required>
                                </div>
                            </div>
                            <div class="">
                                <label>Ajouter une note (motif ou but)</label>
                                <div class="form-group">
                                    <textarea class="form-control" rows="4" name="comment" ></textarea>
                                </div>
                            </div> 
                        </div>

                        <div class="col-md-4 border-right">
                            <div class="louer">
                                <label>Le fournisseur / concessionnaire <span1>*</span1></label>
                                <div class="form-group">
                                    <?php Native\BINDING::html("select", "prestataire") ?>
                                </div>
                            </div>

                            <div class="preter">
                                <div class="">
                                    <label>Matricule </label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="matricule">
                                    </div>
                                </div>
                                <div class="">
                                    <label>Nom / Raison sociale du beneficiaire <span1>*</span1></label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="name">
                                    </div>
                                </div>
                                <div class="">
                                    <label>Adresse <span1>*</span1></label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="adresse">
                                    </div>
                                </div>
                                <div class="">
                                    <label>Email <span1>*</span1></label>
                                    <div class="form-group">
                                        <input type="email" class="form-control" name="email">
                                    </div>
                                </div>
                                <div class="">
                                    <label>Contact <span1>*</span1></label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="contact">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="louer">
                                <button type="button" class="btn btn-aqua btn-sm" data-toggle=modal data-target="#modal-vehicule-preter"><i class="fa fa-car"></i> Ajouter un véhicule</button><hr>

                                <div class="chat-users container-fluid">
                                    <div class="users-list affichage">

                                    </div>
                                </div>
                            </div>
                            <div class="preter">
                                <div class=" container-fluid scroll">
                                    <div class="chat-users">
                                        <!-- TODO gerer les etats de vehicules -->
                                        <?php foreach (Home\VEHICULE::open() as $key => $vehicule) {
                                            $vehicule->actualise(); ?>
                                            <div class="chat-user cursor vehicule" data-id="<?= $vehicule->getId() ?>">
                                                <img class="chat-avatar" style="height: 35px" src="<?= $this->stockage("images", "vehicules", $vehicule->image)  ?>" alt="" >
                                                <div class="chat-user-name">
                                                    <h4 class="mp0"><?= $vehicule->immatriculation ?></h4>
                                                    <h6 class="mp0"><?= $vehicule->marque->name ?> <?= $vehicule->modele ?></h6>
                                                </div>
                                            </div>
                                        <?php } ?>

                                    </div>
                                    <span class="nb-loues">0</span> Véhicules selectionnés
                                </div>                             
                            </div>
                        </div>
                    </div>
                </div><hr class="">
                <div class="container">
                    <button type="button" class="btn btn-sm  btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Annuler</button>
                    <button class="btn btn-sm btn-success pull-right"><i class="fa fa-check"></i> Valider la location</button>
                </div>
                <br>
            </form>
        </div>
    </div>
</div>




<div class="modal inmodal fade" id="modal-vehicule-preter">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Formulaire de location de véhicules</h4>
                <small class="font-bold">Renseigner ces champs pour enregistrer l'assurance</small>
            </div>
            <form method="POST" id="formVehicule">
                <div class="modal-body">
                 <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <label>Immatriculation <span1>*</span1></label>
                        <div class="form-group">
                            <input type="text" class="form-control input-xs" name="immatriculation" required placeholder="EX... 0102 FG 01">
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <label>Type du vehicule <span1>*</span1></label>
                        <div class="form-group">
                            <?php Native\BINDING::html("select", "typevehicule") ?>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <label>Choisir la marque<span1>*</span1></label>
                        <div class="form-group">
                            <?php Native\BINDING::html("select", "marque") ?>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <label>Le modèle du vehicule<span1>*</span1></label>
                        <div class="form-group">
                            <input type="text" class="form-control input-xs" name="modele" required placeholder="Ex...BMW 362 X2">
                        </div>
                    </div>
                </div><hr>

                <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <label>Type Energie <span1>*</span1></label>
                        <div class="form-group">
                            <?php Native\BINDING::html("select", "energie") ?>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <label>Type Transmission <span1>*</span1></label>
                        <div class="form-group">
                            <?php Native\BINDING::html("select", "typetransmission") ?>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-6">
                        <label>Puissance<span1>*</span1></label>
                        <div class="form-group">
                            <input type="number" class="form-control input-xs" min=1 value=1 name="puissance" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-2 col-sm-6">
                        <label>nbr portes<span1>*</span1></label>
                        <div class="form-group">
                            <input type="number" class="form-control input-xs" name="nb_porte" min=1 value=5 required>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-6">
                        <label>nbr places<span1>*</span1></label>
                        <div class="form-group">
                            <input type="number" class="form-control input-xs" name="nb_place" min=1 value=5 required>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <label>Couleur </label>
                        <div class="form-group">
                            <input type="text" class="form-control input-xs" name="couleur" >
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-6">
                        <label>kilometrage <span1>*</span1></label>
                        <div class="form-group">
                            <input type="number" class="form-control input-xs" name="kilometrage" min=0 value=0 required>
                        </div>
                    </div>
                </div><hr>

                <div class="row">
                    <div class="col-md-2 col-sm-6">
                        <label>kilometrage au compteur<span1>*</span1></label>
                        <div class="form-group">
                            <input type="number" class="form-control input-xs" name="kilometrage" min=0 value=0 required>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <label>N° de Chasis </label>
                        <div class="form-group">
                            <input type="text" class="form-control input-xs" name="chasis" uppercase maxlength="17">
                        </div>
                    </div>
                </div>

            </div><hr>
            <div class="container">
                <input type="hidden" name="id">
                <button type="button" class="btn btn-sm  btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Annuler</button>
                <button class="btn btn-sm btn-succes pull-right"><i class="fa fa-refresh"></i> Valider le formulaire</button>
            </div>
            <br>
        </form>
    </div>
</div>
</div>


<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////// -->



<div class="modal inmodal fade" id="modal-location2">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Formulaire de location de véhicules</h4>
                <small class="font-bold">Renseigner ces champs pour enregistrer l'assurance</small>
            </div>
            <form method="POST" class="formShamman" classname="location">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 border-right">
                            <div class="">
                                <label>Date de début <span1>*</span1></label>
                                <div class="form-group">
                                    <input type="date" class="form-control" name="started" required>
                                </div>
                            </div>
                            <div class="">
                                <label>Date de fin<span1>*</span1></label>
                                <div class="form-group">
                                    <input type="date" class="form-control" name="finished" required>
                                </div>
                            </div>
                            <div class="">
                                <label>Ajouter une note (motif ou but)</label>
                                <div class="form-group">
                                    <textarea class="form-control" rows="4" name="comment" ></textarea>
                                </div>
                            </div> 
                        </div>

                        <div class="col-md-6">
                            <div class="">
                                <label>Le fournisseur / concessionnaire <span1>*</span1></label>
                                <div class="form-group">
                                    <?php Native\BINDING::html("select", "prestataire") ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><hr class="">
                <div class="container">
                    <input type="hidden" name="id">
                    <button type="button" class="btn btn-sm  btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Annuler</button>
                    <button class="btn btn-sm btn-success pull-right"><i class="fa fa-check"></i> Valider la location</button>
                </div>
                <br>
            </form>
        </div>
    </div>
</div>






<div class="modal inmodal fade" id="modal-pret2">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Formulaire de location de véhicules</h4>
                <small class="font-bold">Renseigner ces champs pour enregistrer l'assurance</small>
            </div>
            <form method="POST" class="formShamman" classname="location">
                <div class="modal-body">
                    <div class="">
                        <div class="">
                            <label>Date de début <span1>*</span1></label>
                            <div class="form-group">
                                <input type="date" class="form-control" name="started" required>
                            </div>
                        </div>
                        <div class="">
                            <label>Date de fin<span1>*</span1></label>
                            <div class="form-group">
                                <input type="date" class="form-control" name="finished" required>
                            </div>
                        </div>
                        <div class="">
                            <label>Ajouter une note (motif ou but)</label>
                            <div class="form-group">
                                <textarea class="form-control" rows="4" name="comment" ></textarea>
                            </div>
                        </div> 
                    </div>
                </div><hr class="">
                <div class="container">
                    <input type="hidden" name="id">
                    <button type="button" class="btn btn-sm  btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Annuler</button>
                    <button class="btn btn-sm btn-success pull-right"><i class="fa fa-check"></i> Valider la location</button>
                </div>
                <br>
            </form>
        </div>
    </div>
</div>



<div class="modal inmodal fade" id="modal-preteur">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Bénéficiaire</h4>
                <small class="font-bold">Renseigner ces champs pour enregistrer l'assurance</small>
            </div>
            <form method="POST" class="formShamman" classname="preteur">
                <div class="modal-body">
                    <div class="">
                        <div class="">
                            <label>Matricule </label>
                            <div class="form-group">
                                <input type="text" class="form-control" name="matricule">
                            </div>
                        </div>
                        <div class="">
                            <label>Nom / Raison sociale du beneficiaire <span1>*</span1></label>
                            <div class="form-group">
                                <input type="text" class="form-control" name="name">
                            </div>
                        </div>
                        <div class="">
                            <label>Adresse <span1>*</span1></label>
                            <div class="form-group">
                                <input type="text" class="form-control" name="adresse">
                            </div>
                        </div>
                        <div class="">
                            <label>Email <span1>*</span1></label>
                            <div class="form-group">
                                <input type="email" class="form-control" name="email">
                            </div>
                        </div>
                        <div class="">
                            <label>Contact <span1>*</span1></label>
                            <div class="form-group">
                                <input type="text" class="form-control" name="contact">
                            </div>
                        </div>
                    </div>
                </div><hr class="">
                <div class="container">
                    <input type="hidden" name="id">
                    <button type="button" class="btn btn-sm  btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Annuler</button>
                    <button class="btn btn-sm btn-success pull-right"><i class="fa fa-check"></i> Valider la location</button>
                </div>
                <br>
            </form>
        </div>
    </div>
</div>