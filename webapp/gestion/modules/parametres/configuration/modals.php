
<?php include($this->rootPath("composants/assets/modals/modal-params.php") );  ?>


<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->


<div class="modal inmodal fade" id="modal-produit">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title">Formulaire de produit</h4>
			</div>
			<form method="POST" class="formShamman" classname="produit">
				<div class="modal-body">
					<div class="row">
						<div class="col-sm-6">
							<label>Libéllé </label>
							<div class="form-group">
								<input type="text" class="form-control" name="name" required>
							</div>
						</div>
						<div class="col-sm-6">
							<label>Description </label>
							<div class="form-group">
								<input type="text" class="form-control" name="description" required>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<label>Stock actuel </label>
							<div class="form-group">
								<input type="number" number class="form-control" name="stock" value="0" min="0" required>
							</div>
						</div>
						<div class="col-sm-6">
							<label>Illustration du produit</label>
							<div class="">
								<img style="width: 80px;" src="" class="img-thumbnail logo">
								<input class="hide" type="file" name="image">
								<button type="button" class="btn btn-sm bg-purple pull-right btn_image"><i class="fa fa-image"></i> Ajouter une image</button>
							</div>
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
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title">Formulaire de ressource</h4>
			</div>
			<form method="POST" class="formShamman" classname="ressource">
				<div class="modal-body">
					<div class="row">
						<div class="col-sm-6">
							<label>Libéllé </label>
							<div class="form-group">
								<input type="text" class="form-control" name="name" required>
							</div>
						</div>
						<div class="col-sm-6">
							<label>Unité de mesure </label>
							<div class="form-group">
								<input type="text" class="form-control" name="unite" required placeholder="Ex... tonne">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-4">
							<label>abbréviation </label>
							<div class="form-group">
								<input type="text" class="form-control" name="abbr" placeholder="Ex... T" required>
							</div>
						</div>
						<div class="col-sm-4">
							<label>Stock actuel </label>
							<div class="form-group">
								<input type="number" number class="form-control" name="stock" value="0" min="0" required>
							</div>
						</div>
						<div class="col-sm-4">
							<label>Image ressource</label>
							<div class="">
								<img style="width: 80px;" src="" class="img-thumbnail logo">
								<input class="hide" type="file" name="image">
								<button type="button" class="btn btn-sm bg-purple pull-right btn_image"><i class="fa fa-image"></i> Ajouter une image</button>
							</div>
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




<div class="modal inmodal fade" id="modal-paye_produit">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title">Prix de paye du produit</h4>
			</div>
			<form method="POST" class="formPayeProduit">
				<div class="modal-body">
					<div class="row">
						<?php $i =0; foreach (Home\PAYE_PRODUIT::getAll() as $key => $item) {
						$item->actualise(); ?>
						<div class="col-sm-6">
							<label><b>1</b> <?= $item->produit->name() ?> est payé à</label>
							<div class="form-group">
								<input type="number" data-id="<?= $item->getId(); ?>" number class="form-control" name="price" value="<?= $item->price ?>">
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
								$pz = new Home\PRIX_ZONELIVRAISON();
								$datas = $prod->fourni("prix_zonelivraison", ["zonelivraison_id ="=>$zone->getId()]);
								if (count($datas) > 0) {
									$pz = $datas[0];
								}
								?>
								<div class="col-sm-4">
									<label><?= $prod->name() ?> </label>
									<div class="form-group">
										<input data-id="<?= $pz->getId(); ?>" type="number" number class="form-control" value="<?= $pz->price; ?>">
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



<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

<div class="modal inmodal fade" id="modal-groupemanoeuvre">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title">Groupe de manoeuvre</h4>
			</div>
			<form method="POST" class="formShamman" classname="groupemanoeuvre">
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

<?php include($this->rootPath("composants/assets/modals/modal-manoeuvre.php")); ?>

<?php include($this->rootPath("composants/assets/modals/modal-chauffeur.php")); ?>

<?php include($this->rootPath("composants/assets/modals/modal-prestataire.php")); ?>

<?php include($this->rootPath("composants/assets/modals/modal-fournisseur.php") ); ?>

<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->



<div class="modal inmodal fade" id="modal-typevehicule">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title">Type de véhicule</h4>
			</div>
			<form method="POST" class="formShamman" classname="typevehicule">
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


<div class="modal inmodal fade" id="modal-groupevehicule">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title">Catégorie de véhicule</h4>
			</div>
			<form method="POST" class="formShamman" classname="groupevehicule">
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


<div class="modal inmodal fade" id="modal-typeentretienvehicule">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title">Type panne de véhicule</h4>
			</div>
			<form method="POST" class="formShamman" classname="typeentretienvehicule">
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


<?php include($this->rootPath("composants/assets/modals/modal-vehicule.php") ); ?>

<?php include($this->rootPath("composants/assets/modals/modal-machine.php") ); ?>



<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->


<div class="modal inmodal fade" id="modal-categorieoperation">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title">Formulaire des type d'operations</h4>
			</div>
			<form method="POST" class="formShamman" classname="categorieoperation">
				<div class="modal-body">
					<div class="row">
						<div class="col-sm-5">
							<label>Type d'opération <span1>*</span1></label>
							<div class="form-group">
								<?php Native\BINDING::html("select", "typeoperationcaisse") ?>
							</div>
						</div>
						<div class="col-sm-7">
							<label>Libéllé </label>
							<div class="form-group">
								<input type="text" class="form-control" name="name" required>
							</div>
						</div>
					</div>
					<div class="">
						<label>Couleur spécifique </label>
						<div class="form-group">
							<input type="color" name="color">
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

<?php include($this->rootPath("composants/assets/modals/modal-employe.php") ); ?>




