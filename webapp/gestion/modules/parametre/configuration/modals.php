
<div class="modal inmodal fade" id="modal-produit">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title">Formulaire de produit</h4>
			</div>
			<form method="POST" class="formShamman" classname="produit">
				<div class="modal-body">
					<div class="">
						<label>Libéllé </label>
						<div class="form-group">
							<input type="text" class="form-control" name="name" required>
						</div>
					</div>
					<div class="">
						<label>Description </label>
						<div class="form-group">
							<input type="text" class="form-control" name="description" required>
						</div>
					</div>
					<div class="">
						<label>Illustration du produit</label>
						<div class="">
							<img style="width: 80px;" src="" class="img-thumbnail logo">
							<input class="hide" type="file" name="image">
							<button type="button" class="btn btn-sm bg-purple pull-right btn_image"><i class="fa fa-image"></i> Ajouter une image</button>
						</div>
					</div>
				</div><hr>
				<div class="container">
					<input type="hidden" name="id">
					<button type="button" class="btn btn-sm  btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Annuler</button>
					<button class="btn btn-sm btn-primary pull-right dim"><i class="fa fa-check"></i> enregistrer</button>
				</div>
				<br>
			</form>
		</div>
	</div>
</div>


<div class="modal inmodal fade" id="modal-ressource">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title">Formulaire de ressource</h4>
			</div>
			<form method="POST" class="formShamman" classname="ressource">
				<div class="modal-body">
					<div class="">
						<label>Libéllé </label>
						<div class="form-group">
							<input type="text" class="form-control" name="name" required>
						</div>
					</div>
					<div class="">
						<label>Illustration de la ressource</label>
						<div class="">
							<img style="width: 80px;" src="" class="img-thumbnail logo">
							<input class="hide" type="file" name="image">
							<button type="button" class="btn btn-sm bg-purple pull-right btn_image"><i class="fa fa-image"></i> Ajouter une image</button>
						</div>
					</div>
				</div><hr>
				<div class="container">
					<input type="hidden" name="id">
					<button type="button" class="btn btn-sm  btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Annuler</button>
					<button class="btn btn-sm btn-primary pull-right dim"><i class="fa fa-check"></i> enregistrer</button>
				</div>
				<br>
			</form>
		</div>
	</div>
</div>


<div class="modal inmodal fade" id="modal-zonelivraison">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title">Formulaire de zone de livraison</h4>
			</div>
			<form method="POST" class="formShamman" classname="zonelivraison">
				<div class="modal-body">
					<div class="">
						<label>Libéllé </label>
						<div class="form-group">
							<input type="text" class="form-control" name="name" required>
						</div>
					</div>
				</div><hr>
				<div class="container">
					<input type="hidden" name="id">
					<button type="button" class="btn btn-sm  btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Annuler</button>
					<button class="btn btn-sm btn-primary pull-right dim"><i class="fa fa-check"></i> enregistrer</button>
				</div>
				<br>
			</form>
		</div>
	</div>
</div>


<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->


<div class="modal inmodal fade" id="modal-categorieoperation">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title">Formulaire des type d'operations</h4>
			</div>
			<form method="POST" class="formShamman" classname="categorieoperation">
				<div class="modal-body">
					<div class="">
						<label>Type d'opération <span1>*</span1></label>
						<div class="form-group">
							<?php Native\BINDING::html("select", "typeoperationcaisse") ?>
						</div>
					</div>
					<div class="">
						<label>Libéllé </label>
						<div class="form-group">
							<input type="text" class="form-control" name="name" required>
						</div>
					</div>
					<div class="">
						<label>Couleur spécifique </label>
						<div class="form-group">
							<input type="color" class="form-control" name="color">
						</div>
					</div>
				</div><hr>
				<div class="container">
					<input type="hidden" name="id">
					<button type="button" class="btn btn-sm  btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Annuler</button>
					<button class="btn btn-sm btn-primary pull-right dim"><i class="fa fa-check"></i> enregistrer</button>
				</div>
				<br>
			</form>
		</div>
	</div>
</div>



<?php $i =0; foreach (Home\ZONELIVRAISON::findBy([], [], ["name"=>"ASC"]) as $key => $zone) { ?>
	<div class="modal inmodal fade" id="modal-prix<?= $zone->getId() ?>">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title">Formulaire des prix</h4>
				</div>
				<form method="POST" class="formPrix">
					<div class="modal-body">
						<h3 class="text-uppercase text-center">Pour la zone <b><?= $zone->name() ?></b></h3><br>

						<div class="row">
							<?php $i =0; foreach (Home\PRODUIT::findBy([], [], ["name"=>"ASC"]) as $key => $prod) { 
								$datas = $prod->fourni("prix_zonelivraison", ["zonelivraison_id ="=>$zone->getId()]); ?>
								<div class="col-sm-4">
									<label><?= $prod->name() ?> </label>
									<div class="form-group">
										<input data-id="<?= $datas[0]->getId(); ?>" type="number" number class="form-control" value="<?= $datas[0]->price; ?>">
									</div>
								</div>
							<?php } ?>
						</div>						
					</div><hr>
					<div class="container">
						<input type="hidden" name="id">
						<button type="button" class="btn btn-sm  btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Annuler</button>
						<button class="btn btn-sm btn-primary pull-right dim"><i class="fa fa-check"></i> enregistrer</button>
					</div>
					<br>
				</form>
			</div>
		</div>
	</div>
<?php } ?>




<?php $i =0; foreach (Home\EXIGENCEPRODUCTION::getAll() as $key => $exigence) {
	$exigence->actualise(); ?>
	<div class="modal inmodal fade" id="modal-exigence<?= $exigence->getId() ?>">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title">Formulaire des exigence de production</h4>
				</div>
				<form method="POST" class="formExigence">
					<div class="modal-body">
						<div class="row">
							<div class="col-sm-8">
								<h3 class="text-uppercase text-center">Pour la production de <b><?= $exigence->produit->name() ?></b></h3><br>
							</div>
							<div class="col-sm-4">
								<label>Quantité</label>
								<input data-id="<?= $exigence->getId(); ?>" type="number" number class="form-control" value="<?= $exigence->quantite; ?>">
							</div>
						</div>
						
						<br><div class="row">
							<?php $i =0; foreach (Home\RESSOURCE::findBy([], [], ["name"=>"ASC"]) as $key => $ressource) { 
								$datas = $exigence->fourni("ligneexigenceproduction", ["ressource_id ="=>$ressource->getId()]); ?>
								<div class="col-sm-6">
									<label><?= $ressource->name() ?> </label>
									<div class="form-group">
										<input data-id="<?= $datas[0]->getId(); ?>" type="number" number class="form-control" value="<?= $datas[0]->quantite; ?>">
									</div>
								</div>
							<?php } ?>
						</div>						
					</div><hr>
					<div class="container">
						<input type="hidden" name="id">
						<button type="button" class="btn btn-sm  btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Annuler</button>
						<button class="btn btn-sm btn-primary pull-right dim"><i class="fa fa-check"></i> enregistrer</button>
					</div>
					<br>
				</form>
			</div>
		</div>
	</div>
	<?php } ?>