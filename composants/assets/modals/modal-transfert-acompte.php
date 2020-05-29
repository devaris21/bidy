<div class="modal inmodal fade" id="modal-transfert-acompte">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title text-blue">Transfert de fonds</h4>
            </div>
            <form method="POST" id="formTransfertAcompte">
                <div class="modal-body">
                    <div>
                        <label>Client concerné <span style="color: red">*</span> </label>                                
                        <div class="input-group">
                            <?php Native\BINDING::html("select", "client", null, "client_id_receive"); ?>
                        </div>
                    </div><br><br>
                    <div class="">
                        <label>Montant à transfert sur le compte <span1>*</span1></label>
                        <div class="form-group">
                            <input type="text" number class="form-control" name="montant" required>
                        </div>
                    </div><br>  
                    <div>
                        <label>Détails du transfert</label>
                        <textarea class="form-control" rows="4" name="comment1"></textarea>
                    </div>              
                </div><hr>
                <div class="container">
                    <input type="hidden" name="client_id" value="<?= $client->getId() ?>">
                    <button type="button" class="btn btn-sm  btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Annuler</button>
                    <button class="btn btn-sm dim btn-success pull-right"><i class="fa fa-check"></i> Valider</button>
                </div>
            </form>
        </div>
    </div>
</div>
