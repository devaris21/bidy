
<div class="modal inmodal fade" id="modal-vente" style="z-index: 9999999999">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Nouvelle vente directe de produits</h4>
                <small class="font-bold">Renseigner ces champs pour enregistrer et valider directement la vente</small>
            </div>
            
            <div class="row">
                <div class="col-md-8">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5 class="text-uppercase">Les produits de la commande</h5>
                        </div>
                        <div class="ibox-content"><br>
                            <div class="table-responsive">
                                <table class="table  table-striped">
                                    <tbody class="commande">
                                        <!-- rempli en Ajax -->
                                    </tbody>
                                </table>

                                <div class="text-center">
                                    <?php foreach (Home\PRODUIT::getAll() as $key => $produit) { ?>
                                      <button class="btn btn-white dim newproduit" data-id="<?= $produit->getId() ?>" data-toggle="tooltip" title="<?= $produit->description ?>"><?= $produit->name(); ?></button>
                                  <?php }  ?>
                              </div>
                          </div>
                      </div>
                  </div>

              </div>
              <div class="col-md-4 ">
                <div class="ibox"  style="background-color: #eee">
                    <div class="ibox-title" style="padding-right: 2%; padding-left: 3%; ">
                        <h5 class="text-uppercase">Finaliser la commande</h5>
                    </div>
                    <div class="ibox-content"  style="background-color: #fafafa">
                        <form id="formVente">
                            <input type="hidden" name="datelivraison" value="<?= dateAjoute() ?>">
                            <div>
                                <label>zone de livraison <span style="color: red">*</span> </label>
                                <div class="input-group">
                                    <?php Native\BINDING::html("select", "zonelivraison"); ?>
                                </div>
                            </div><br>
                            <div>
                                <label>Lieu de livraison <span style="color: red">*</span> </label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="lieu" class="form-control" required>
                                </div>
                            </div><br>
                            <div>
                                <label>Mode de payement  pour la commande<span style="color: red">*</span> </label>                                
                                <div class="input-group">
                                    <?php Native\BINDING::html("select", "modepayement"); ?>
                                </div>
                            </div><br>
                            <div class="no_modepayement_facultatif">
                                <div>
                                    <label>Montant avancé pour la commande<span style="color: red">*</span> </label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-money"></i></span><input type="text" value="0" min="0" name="avance" class="form-control">
                                    </div>
                                </div>
                            </div><br>
                            <div class="modepayement_facultatif">
                                <div>
                                    <label>Structure d'encaissement<span style="color: red">*</span> </label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-bank"></i></span><input type="text" name="structure" class="form-control">
                                    </div>
                                </div><br>
                                <div>
                                    <label>N° numero dédié<span style="color: red">*</span> </label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-pencil"></i></span><input type="text" name="numero" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <hr><hr>
                            
                            <div>
                                <label>Véhicule de la livraison <span style="color: red">*</span> </label>                                
                                <div class="input-group">
                                    <?php Native\BINDING::html("select", "vehicule"); ?>
                                </div>
                            </div><br>

                            <div class="chauffeur">
                                <label>Chauffeur de la livraison <span style="color: red">*</span> </label>                                
                                <div class="input-group">
                                    <?php Native\BINDING::html("select", "chauffeur"); ?>
                                </div><br>
                            </div>

                            <div class="location">
                                <label>Location de véhicule <span style="color: red">*</span> </label>  
                                <div class="input-group">
                                    <select class="form-control select2" name="isLouer" style="width: 100%">
                                        <option value="0">Non, pas de location de véhicule</option>
                                        <option value="1">Oui, faire louer véhicule</option>
                                    </select>
                                </div>
                            </div><br>
                            <div class="montant_location">
                                <label class="gras">Montant de la location <span style="color: red">*</span> </label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-money"></i></span><input type="number" number name="montant_location" class="form-control" value="0" min="0">
                                </div><br>
                                <div class="no_modepayement_facultatif">
                                    <div>
                                        <label>Montant avancé pour la location<span style="color: red">*</span> </label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-money"></i></span><input type="text" value="0" min="0" name="avance_location" class="form-control">
                                        </div>
                                    </div>
                                </div><br>
                                <div>
                                    <label>Mode de payement de la location<span style="color: red">*</span> </label>                                
                                    <div class="input-group">
                                        <?php Native\BINDING::html("select", "modepayement", null, "modepayement_id2"); ?>
                                    </div>
                                </div><br>
                                <div class="modepayement_facultatif">
                                    <div>
                                        <label>Structure d'encaissement<span style="color: red">*</span> </label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-bank"></i></span><input type="text" name="structure2" class="form-control">
                                        </div>
                                    </div><br>
                                    <div>
                                        <label>N° numero dédié<span style="color: red">*</span> </label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-pencil"></i></span><input type="text" name="numero2" class="form-control">
                                        </div>
                                    </div>
                                </div><br>
                            </div>

                            <div class="tricycle">
                                <div>
                                    <label>Nom & prénom du chauffeur tricycle<span style="color: red">*</span> </label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span><input type="text" name="nom_tricycle" class="form-control" >
                                    </div>
                                </div><br>
                                <div>
                                    <label>Montant à payer au chauffeur tricycle<span style="color: red">*</span> </label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-money"></i></span><input type="text" name="paye_tricycle" class="form-control" value="0" min="0" >
                                    </div>
                                </div>
                            </div><br>

                            <div>
                                <label><input class="i-checks cursor" type="checkbox" name="chargement_manoeuvre" checked > Chargement par nos manoeuvres</label>
                                <label><input class="i-checks cursor" type="checkbox" name="dechargement_manoeuvre" checked > Déchargement par nos manoeuvres</label>
                            </div><hr><hr>

                            <div>
                                <label>Ajouter une note </label>
                                <textarea class="form-control" rows="4" name="comment"></textarea>
                            </div>

                            <input type="hidden" name="client_id" value="<?= getSession("client_id") ?>">
                        </form><br>
                        <h5><span>Total </span> <span class="pull-right montant">0 Fcfa </span></h5>
                        <h5><span>TVA (<?= $params->tva ?> %)</span> <span class="pull-right tva">0 Fcfa </span></h5>
                        <h2 class="font-bold total text-right total">0 Fcfa</h2>
                        <hr/>
                        <button onclick="validerVente()" class="btn btn-primary btn-block dim"><i class="fa fa-check"></i> Valider la vente</button>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
</div>


