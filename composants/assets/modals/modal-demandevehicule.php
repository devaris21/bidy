<div class="modal inmodal fade" id="modal-demandevehicule">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title">Formulaire de demande de véhicule</h4>
            <small class="font-bold">Renseigner ces champs pour faire votre demande de véhicule</small>
        </div>
        <form method="POST" class="formShamman" classname="demandevehicule">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-4">
                        <label>Pour quel type de demande <span1>*</span1></label>
                        <div class="form-group">
                            <?php Native\BINDING::html("select", "typedemandevehicule"); ?>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <label>Objet de la démande <span1>*</span1></label>
                        <div class="form-group">
                            <input type="text" class="form-control" name="objet" required placeholder="Tournée de controle à cocody">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <label>Lieu de la mission (Si mission) <span1>*</span1></label>
                        <div class="form-group">
                            <input type="text" class="form-control" name="lieu">
                        </div>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-sm-8">
                        <div class="row">
                            <div class="col-sm-6">
                                <label>Début période d'utilisation <span1>*</span1></label>
                                <div class="form-group">
                                    <input type="date" class="form-control" name="started" required >
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label>Fin période d'utilisation <span1>*</span1></label>
                                <div class="form-group">
                                    <input type="date" class="form-control" name="finished" required >
                                </div>
                            </div>
                        </div> 
                        <div class="row">
                            <div class="col-sm-6">
                                <label>Quel type de véhicule voulez-vous ?</label>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="caracteristique" placeholder="Pick-up, 4x4, etc...">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label>Voulez-vous un chauffeur ?</label>
                                <div class="form-group">
                                    <select class="select2" style="width: 100%" name="with_chauffeur">
                                        <option value="0">Non, ça va !</option>
                                        <option value="1">Oui</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <label>Expliquer la mission<span1>*</span1></label>
                        <div class="form-group">
                            <textarea class="form-control" rows="5" name="comment"></textarea>
                        </div>
                    </div>
                </div>
            </div><hr class="">
            <div class="container">
                <input type="hidden" name="id">
                <button type="button" class="btn btn-sm  btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Annuler</button>
                <button class="btn btn-sm btn-success pull-right"><i class="fa fa-check"></i> Emettre la demande de vehicule</button>
            </div>
            <br>
        </form>
    </div>
</div>
</div>