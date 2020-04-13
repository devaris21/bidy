<div class="modal inmodal fade" id="modal-equipement">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
           <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title">Formulaire pour les équipements de véhicule</h4>
            <small class="font-bold">Renseigner ces champs pour enregistrer l'equipement</small>
        </div>
        <form method="POST" class="formShamman" classname="equipement">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-4">
                        <label>Le type d'équipement<span1>*</span1></label>
                        <div class="form-group">
                            <?php Native\BINDING::html("select", "typeequipement") ?>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <label>Nom de l'equipement<span1>*</span1></label>
                        <div class="form-group">
                            <input type="text" class="form-control" name="name" required>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <label>Marque de l'equipement<span1>*</span1></label>
                        <div class="form-group">
                            <input type="text" class="form-control" name="marque" required>
                        </div>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-sm-4">
                        <label>Stock actuel de l'equipement<span1>*</span1></label>
                        <div class="form-group">
                            <input type="number" class="form-control" name="stock" required>
                        </div>
                    </div>  
                    <div class="col-sm-4">
                        <label>Photo de l'equipement</label>
                        <div class="">
                            <img style="width: 80px;" src="" class="img-thumbnail logo">
                            <input class="hide" type="file" name="image">
                            <button type="button" class="btn btn-sm btn-success pull-right btn_image"><i class="fa fa-image"></i> Ajouter une image</button>
                        </div>
                    </div>                     
                </div>
            </div><hr class="">
            <div class="container">
                <input type="hidden" name="id">
                <button type="button" class="btn btn-sm  btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Annuler</button>
                <button class="btn btn-sm btn-success pull-right"><i class="fa fa-check"></i> Valider le formulaire</button>
            </div>
            <br>
        </form>
    </div>
</div>
</div>
