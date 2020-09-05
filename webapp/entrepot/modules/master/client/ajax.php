<?php 
namespace Home;
use Native\ROOTER;
require '../../../../../core/root/includes.php';

use Native\RESPONSE;

$data = new RESPONSE;
extract($_POST);

if ($action == "changer") {
	$data->setUrl("gestion", "master", "client", $id);
	echo json_encode($data);
}

if ($action == "newproduit") {
	$params = PARAMS::findLastId();
	$rooter = new ROOTER;
	$produits = [];
	if (getSession("produits") != null) {
		$produits = getSession("produits"); 
	}
	if (!in_array($id, $produits)) {
		$produits[] = $id;
		$datas = PRODUIT::findBy(["id ="=> $id]);
		if (count($datas) == 1) {
			$produit = $datas[0];
			$produit->fourni("prix_zonelivraison", ["zonelivraison_id ="=> $zone]);
			if (count($produit->prix_zonelivraisons) > 0) {
				$prix = $produit->prix_zonelivraisons[0]->price;
			}else{
				$prix = 1000;
			}
			?>
			<tr class="border-0 border-bottom " id="ligne<?= $id ?>" data-id="<?= $id ?>">
				<td><i class="fa fa-close text-red cursor" onclick="supprimeProduit(<?= $id ?>)" style="font-size: 18px;"></i></td>
				<td >
					<img style="width: 40px" src="<?= $rooter->stockage("images", "produits", $produit->image) ?>">
				</td>
				<td class="text-left">
					<h4 class="mp0 text-uppercase"><?= $produit->name() ?></h4>
					<small><?= $produit->description ?></small>
				</td>
				<td><h5 class="price" data-price="<?= $prix  ?>"><?= money($prix) ?> <?= $params->devise ?></h5></td>
				<td><h4>X</h4></td>
				<td width="70"><input type="text" number class="form-control text-center gras" value="1" style="padding: 3px"></td>
			</tr>
			<?php
		}
	}
	session("produits", $produits);
}


if ($action == "supprimeProduit") {
	$produits = [];
	if (getSession("produits") != null) {
		$produits = getSession("produits"); 
		foreach ($produits as $key => $value) {
			if ($value == $id) {
				unset($produits[$key]);
			}
			session("produits", $produits);
		}
	}
}


if ($action == "calcul") {
	$params = PARAMS::findLastId();
	$rooter = new ROOTER;
	$montant = 0;
	$produits = explode(",", $tableau);
	foreach ($produits as $key => $value) {
		$data = explode("-", $value);
		$id = $data[0];
		$val = end($data);
		$datas = PRODUIT::findBy(["id ="=> $id]);
		if (count($datas) == 1) {
			$produit = $datas[0];
			$produit->fourni("prix_zonelivraison", ["zonelivraison_id ="=> $zonelivraison_id]);
			if (count($produit->prix_zonelivraisons) > 0) {
				$prix = $produit->prix_zonelivraisons[0]->price;
			}else{
				$prix = 1000;
			}
			$montant += $prix * $val;
			?>
			<tr class="border-0 border-bottom " id="ligne<?= $id ?>" data-id="<?= $id ?>">
				<td><i class="fa fa-close text-red cursor" onclick="supprimeProduit(<?= $id ?>)" style="font-size: 18px;"></i></td>
				<td >
					<img style="width: 40px" src="<?= $rooter->stockage("images", "produits", $produit->image) ?>">
				</td>
				<td class="text-left">
					<h4 class="mp0 text-uppercase"><?= $produit->name() ?></h4>
					<small><?= $produit->description ?></small>
				</td>
				<td><h5 class="price" data-price="<?= $prix  ?>"><?= money($prix) ?> <?= $params->devise ?></h5></td>
				<td><h4>X</h4></td>
				<td width="70"><input type="text" number class="form-control text-center gras" value="<?= $val ?>" style="padding: 3px"></td>
				<td class="text-right"><h4 class="" style="font-weight: normal;"><?= money($prix*$val) ?> <?= $params->devise ?></h4></td>
			</tr>
			<?php
		}
	}

	$tva = ($montant * $params->tva) / 100;
	session("montant", $montant);
	session("tva", $tva);
	session("total", $montant + $tva);
}


if ($action == "total") {
	$params = PARAMS::findLastId();
	$data = new \stdclass();
	$data->tva = money(getSession("tva"))." ".$params->devise;
	$data->montant = money(getSession("montant"))." ".$params->devise;
	$data->total = money(getSession("total"))." ".$params->devise;
	echo json_encode($data);
}



if ($action == "calcul_vente") {
	$params = PARAMS::findLastId();
	$rooter = new ROOTER;
	$montant = 0;
	$produits = explode(",", $tableau);
	foreach ($produits as $key => $value) {
		$data = explode("-", $value);
		$id = $data[0];
		$val = end($data);
		$datas = PRODUIT::findBy(["id ="=> $id]);
		if (count($datas) == 1) {
			$produit = $datas[0];
			$produit->fourni("prix_zonelivraison", ["zonelivraison_id ="=> $zonelivraison_id]);
			if (count($produit->prix_zonelivraisons) > 0) {
				$prix = $produit->prix_zonelivraisons[0]->price;
			}else{
				$prix = 1000;
			}
			$montant += $prix * $val;
			?>
			<tr class="border-0 border-bottom " id="ligne<?= $id ?>" data-id="<?= $id ?>">
				<td><i class="fa fa-close text-red cursor" onclick="supprimeProduit(<?= $id ?>)" style="font-size: 18px;"></i></td>
				<td >
					<img style="width: 40px" src="<?= $rooter->stockage("images", "produits", $produit->image) ?>">
				</td>
				<td class="text-left">
					<h4 class="mp0 text-uppercase"><?= $produit->name() ?></h4>
					<small><?= $produit->description ?></small>
				</td>
				<td><h5 class="price" data-price="<?= $prix  ?>"><?= money($prix) ?> <?= $params->devise ?></h5></td>
				<td><h4>X</h4></td>
				<td width="70"><input type="text" number class="form-control text-center gras" value="<?= $val ?>" style="padding: 3px"></td>
				<td class="text-right"><h4 class="" style="font-weight: normal;"><?= money($prix*$val) ?> <?= $params->devise ?></h4></td>
			</tr>
			<?php
		}
	}

	$tva = ($montant * $params->tva) / 100;
	session("montant_", $montant);
	session("tva_", $tva);
	session("total_", $montant + $tva);
}


if ($action == "total_vente") {
	$params = PARAMS::findLastId();
	$data = new \stdclass();
	$data->tva = money(getSession("tva_"))." ".$params->devise;
	$data->montant = money(getSession("montant_"))." ".$params->devise;
	$data->total = money(getSession("total_"))." ".$params->devise;
	echo json_encode($data);
}




if ($action == "validerCommande") {
	$montant = 0;
	$params = PARAMS::findLastId();
	$datas = CLIENT::findBy(["id ="=> $client_id]);
	if (count($datas) > 0) {
		$client = $datas[0];
		$produits = explode(",", $tableau);
		if (count($produits) > 0) {

			if (getSession("total") > 0) {
				if ($modepayement_id == MODEPAYEMENT::PRELEVEMENT_ACOMPTE || ($modepayement_id != MODEPAYEMENT::PRELEVEMENT_ACOMPTE && intval($avance) <= getSession("total") && intval($avance) > 0)) {

					if ($modepayement_id == MODEPAYEMENT::PRELEVEMENT_ACOMPTE) {
						$avance = getSession("total");
					}
					if ((getSession("total") - intval($avance) + $client->dette) <= $params->seuilCredit ) {
						if (getSession("commande-encours") != null) {
							$datas = GROUPECOMMANDE::findBy(["id ="=>getSession("commande-encours")]);
							if (count($datas) > 0) {
								$groupecommande = $datas[0];
								$groupecommande->etat_id = ETAT::ENCOURS;
								$groupecommande->save();
							}else{
								$groupecommande = new GROUPECOMMANDE();
								$groupecommande->hydrater($_POST);
								$groupecommande->enregistre();
							}
						}else{
							$groupecommande = new GROUPECOMMANDE();
							$groupecommande->hydrater($_POST);
							$groupecommande->enregistre();
						}

						$commande = new COMMANDE();
						$commande->hydrater($_POST);
						$commande->groupecommande_id = $groupecommande->getId();
						$data = $commande->enregistre();
						if ($data->status) {
							foreach ($produits as $key => $value) {
								$lot = explode("-", $value);
								$id = $lot[0];
								$qte = end($lot);
								$datas = PRODUIT::findBy(["id ="=> $id]);
								if (count($datas) == 1) {
									$produit = $datas[0];
									$produit->fourni("prix_zonelivraison", ["zonelivraison_id ="=> $zonelivraison_id]);
									if (count($produit->prix_zonelivraisons) > 0) {
										$prix = $produit->prix_zonelivraisons[0]->price;
									}else{
										$prix = 1000;
									}
									$montant += $prix * $qte;

									$lignecommande = new LIGNECOMMANDE;
									$lignecommande->commande_id = $commande->getId();
									$lignecommande->produit_id = $id;
									$lignecommande->quantite = $qte;
									$lignecommande->price =  $prix * $qte;
									$lignecommande->enregistre();	
								}
							}

							$tva = ($montant * $params->tva) / 100;
							$total = $montant + $tva;

							if ($modepayement_id == MODEPAYEMENT::PRELEVEMENT_ACOMPTE ) {
								if ($client->acompte >= $total) {
									$commande->avance = $total;
								}else{
									$commande->avance = $client->acompte;
								}
								$lot = $client->debiter($total);

							}else{

								if ($total > intval($avance)) {
									$client->dette($total - intval($avance));
								}

								$payement = new OPERATION();
								$payement->hydrater($_POST);
								$payement->categorieoperation_id = CATEGORIEOPERATION::PAYEMENT;
								$payement->montant = $commande->avance;
								$payement->client_id = $client_id;
								$payement->comment = "Réglement de la facture pour la commande N°".$commande->reference;
								$lot = $payement->enregistre();

								$commande->operation_id = $lot->lastid;

								$client->actualise();
								$payement->acompteClient = $client->acompte;
								$payement->detteClient = $client->dette;
								$payement->save();
							}

							$commande->tva = $tva;
							$commande->montant = $total;
							$commande->reste = $commande->montant - $commande->avance;
							
							$commande->acompteClient = $client->acompte;
							$commande->detteClient = $client->dette;
							$data = $commande->save();

							$data->setUrl("gestion", "fiches", "boncommande", $data->lastid);
						}

					}else{
						$data->status = false;
						$data->message = "Le crédit restant pour la commande ne doit pas excéder ".money($params->seuilCredit)." ".$params->devise;
					}
				}else{
					$data->status = false;
					$data->message = "Le montant de l'avance de la commande est incorrect, verifiez-le!";
				}
			}else{
				$data->status = false;
				$data->message = "Veuillez verifier le montant de la commande !";
			}
		}else{
			$data->status = false;
			$data->message = "Veuillez selectionner des produits et leur quantité pour passer la commande !";
		}
	}else{
		$data->status = false;
		$data->message = "Erreur lors de la validation de la commande, veuillez recommencer !";
	}
	echo json_encode($data);
}



if ($action == "annulerCommande") {
	$datas = EMPLOYE::findBy(["id = "=>getSession("employe_connecte_id")]);
	if (count($datas) > 0) {
		$employe = $datas[0];
		$employe->actualise();
		if ($employe->checkPassword($password)) {
			$datas = COMMANDE::findBy(["id ="=>$id]);
			if (count($datas) == 1) {
				$commande = $datas[0];
				$data = $commande->annuler();
			}else{
				$data->status = false;
				$data->message = "Une erreur s'est produite lors de l'opération! Veuillez recommencer";
			}
		}else{
			$data->status = false;
			$data->message = "Votre mot de passe ne correspond pas !";
		}
	}else{
		$data->status = false;
		$data->message = "Vous ne pouvez pas effectué cette opération !";
	}
	echo json_encode($data);
}





if ($action == "validerVente") {
	$montant = 0;
	$params = PARAMS::findLastId();
	$datas = CLIENT::findBy(["id ="=> $client_id]);
	if (count($datas) > 0) {
		$client = $datas[0];
		$produits = explode(",", $tableau);
		if (count($produits) > 0) {

			if (getSession("total_") > 0) {
				if ($modepayement_id == MODEPAYEMENT::PRELEVEMENT_ACOMPTE || ($modepayement_id != MODEPAYEMENT::PRELEVEMENT_ACOMPTE && intval($avance) <= getSession("total_") && intval($avance) > 0)) {

					if ($modepayement_id == MODEPAYEMENT::PRELEVEMENT_ACOMPTE) {
						$avance = getSession("total_");
					}
					if ((getSession("total_") - intval($avance) + $client->dette) <= $params->seuilCredit ) {

						$tests = $produits;
						foreach ($tests as $key => $value) {
							$lot = explode("-", $value);
							$id = $lot[0];
							$qte = end($lot);
							$produit = PRODUIT::findBy(["id ="=>$id])[0];
							if ($qte > 0 && $qte <= $produit->livrable()) {
								unset($tests[$key]);
							}
						}
						if (count($tests) == 0) {
							$groupecommande = new GROUPECOMMANDE();
							$groupecommande->hydrater($_POST);
							$groupecommande->enregistre();

							$commande = new COMMANDE();
							$commande->hydrater($_POST);
							$commande->groupecommande_id = $groupecommande->getId();
							$data = $commande->enregistre();

							$livraison = new LIVRAISON();
							$livraison->hydrater($_POST);
							if ($vehicule_id == VEHICULE::AUTO){
								$livraison->etat_id = ETAT::VALIDEE;
								$livraison->nom_receptionniste = $client->name();
								$livraison->contact_receptionniste = $client->contact;
							}else{
								$livraison->comment = '';
								$livraison->datelivraison = null;
							}
							if ($vehicule_id <= VEHICULE::TRICYCLE) {
								$_POST["chauffeur_id"] = 0;
							}
							$livraison->groupecommande_id = $groupecommande->getId();
							$data = $livraison->enregistre();

							if ($data->status) {
								foreach ($produits as $key => $value) {
									$lot = explode("-", $value);
									$id = $lot[0];
									$qte = end($lot);
									$datas = PRODUIT::findBy(["id ="=> $id]);
									if (count($datas) == 1) {
										$produit = $datas[0];
										$produit->fourni("prix_zonelivraison", ["zonelivraison_id ="=> $zonelivraison_id]);
										$prix = 0;
										if (count($produit->prix_zonelivraisons) > 0) {
											$prix = $produit->prix_zonelivraisons[0]->price;
										}
										$montant += $prix * $qte;

										$lignecommande = new LIGNECOMMANDE;
										$lignecommande->commande_id = $commande->getId();
										$lignecommande->produit_id = $id;
										$lignecommande->quantite = $qte;
										$lignecommande->price =  $prix * $qte;
										$lignecommande->enregistre();	

										$lignecommande = new LIGNELIVRAISON;
										$lignecommande->livraison_id = $livraison->getId();
										$lignecommande->produit_id = $id;
										$lignecommande->quantite = $qte;
										$lignecommande->enregistre();	
										$lignecommande->reste = $groupecommande->reste($id);
										$lignecommande->save();
									}
								}

								$tva = ($montant * $params->tva) / 100;
								$total = $montant + $tva;

								if ($modepayement_id == MODEPAYEMENT::PRELEVEMENT_ACOMPTE ) {
									if ($client->acompte >= $total) {
										$commande->avance = $total;
									}else{
										$commande->avance = $client->acompte;
									}
									$lot = $client->debiter($total);

								}else{

									if ($total > intval($avance)) {
										$client->dette($total - intval($avance));
									}

									$payement = new OPERATION();
									$payement->hydrater($_POST);
									$payement->categorieoperation_id = CATEGORIEOPERATION::PAYEMENT;
									$payement->montant = $commande->avance;
									$payement->client_id = $client_id;
									$payement->comment = "Réglement de la facture pour la commande N°".$commande->reference;
									$lot = $payement->enregistre();

									$commande->operation_id = $lot->lastid;

									
								}

								$commande->tva = $tva;
								$commande->montant = $total;
								$commande->reste = $commande->montant - $commande->avance;

								
								if ($vehicule_id != VEHICULE::AUTO && $vehicule_id != VEHICULE::TRICYCLE) {
									$datas = VEHICULE::findBy(["id="=>$vehicule_id]);
									if (count($datas) > 0) {
										$vehicule = $datas[0];
										$vehicule->etatvehicule_id = ETATVEHICULE::MISSION;
										$vehicule->save();
									}

									$datas = CHAUFFEUR::findBy(["id="=>$chauffeur_id]);
									if (count($datas) > 0) {
										$chauffeur = $datas[0];
										$chauffeur->etatchauffeur_id = ETATCHAUFFEUR::MISSION;
										$chauffeur->save();
									}

									if($isLouer == 1 && $montant_location > 0 ){
										if ($modepayement_id2 == MODEPAYEMENT::PRELEVEMENT_ACOMPTE ) {
											$lot = $client->debiter($montant_location);

										}else{

											if ($montant_location > intval($avance_location)) {
												$client->dette($montant_location - intval($avance_location));
											}

											$livraison->actualise();
											$payement2 = new OPERATION();
											$payement2->modepayement_id = $modepayement_id2;
											$payement2->structure = $structure2;
											$payement2->numero = $numero2;
											$payement2->categorieoperation_id = CATEGORIEOPERATION::LOCATION_LIVRAISON;
											$payement2->montant = $avance_location;
											$payement2->client_id = $livraison->groupecommande->client_id;
											$payement2->comment = "Réglement pour la location d'engins de livraison pour la livraison N°".$livraison->reference;
											$lot = $payement2->enregistre();

											$livraison->operation_id = $lot->lastid;
										}
									}
								}

								$client->actualise();
								if ($modepayement_id != MODEPAYEMENT::PRELEVEMENT_ACOMPTE ) {
									$payement->acompteClient = $client->acompte;
									$payement->detteClient = $client->dette;
									$payement->save();
								}

								$commande->acompteClient = $client->acompte;
								$commande->detteClient = $client->dette;
								$data = $commande->save();

								$livraison->save();
								$data->setUrl("gestion", "fiches", "boncommande", $data->lastid);

							}

						}else{
							$data->status = false;
							$data->message = "Le stock de certains produits sont insuffisants pour faire une livraison. Veuillez à bien vérifier les quantités des différents produits à livrer, ou opter une pour une simple commande !";
						}
					}else{
						$data->status = false;
						$data->message = "Le crédit restant pour la commande ne doit pas excéder ".money($params->seuilCredit)." ".$params->devise;
					}
				}else{
					$data->status = false;
					$data->message = "Le montant de l'avance de la commande est incorrect, verifiez-le!";
				}
			}else{
				$data->status = false;
				$data->message = "Veuillez verifier le montant de la commande !";
			}
		}else{
			$data->status = false;
			$data->message = "Veuillez selectionner des produits et leur quantité pour passer la commande !";
		}
	}else{
		$data->status = false;
		$data->message = "Erreur lors de la validation de la commande, veuillez recommencer !";
	}
	echo json_encode($data);
}






if ($action == "livraisonCommande") {
	$params = PARAMS::findLastId();
	if (getSession("commande-encours") != null) {
		$datas = GROUPECOMMANDE::findBy(["id ="=>getSession("commande-encours")]);
		if (count($datas) > 0) {
			$groupecommande = $datas[0];
			$groupecommande->actualise();

			if ($modepayement_id == MODEPAYEMENT::PRELEVEMENT_ACOMPTE) {
				$avance = 0;
			}

			if ($isLouer == 0 || ((intval($montant_location) - intval($avance) + $groupecommande->client->dette) <= $params->seuilCredit)) {

				$produits = explode(",", $tableau);
				if (count($produits) > 0) {
					$produits1 = explode(",", $tableau1);
					$tests = $produits;
					foreach ($tests as $key => $value) {
						$lot = explode("-", $value);
						$id = $lot[0];
						$qte = end($lot);
						$produit = PRODUIT::findBy(["id ="=>$id])[0];
						if ($qte > 0 && $groupecommande->reste($id) >= $qte && $qte <= $produit->livrable()) {
							unset($tests[$key]);
						}
					}
					if (count($tests) == 0) {
						$livraison = new LIVRAISON();
						if ($vehicule_id <= VEHICULE::TRICYCLE) {
							$_POST["chauffeur_id"] = 0;
						}
						if ($vehicule_id == VEHICULE::AUTO){
							$livraison->nom_receptionniste = $groupecommande->client->name();
							$livraison->contact_receptionniste = $groupecommande->client->contact;
							$livraison->datelivraison = dateAjoute();
							$livraison->etat_id = ETAT::VALIDEE;
						}
						$livraison->hydrater($_POST);
						$livraison->groupecommande_id = $groupecommande->getId();
						$data = $livraison->enregistre();
						if ($data->status) {
							$montant = 0;
							$productionjour = PRODUCTIONJOUR::today();

							foreach ($produits1 as $key => $value) {
								$lot = explode("-", $value);
								$array[$lot[0]] = end($lot);
							}

							foreach ($produits as $key => $value) {
								$lot = explode("-", $value);
								$id = $lot[0];
								$qte = end($lot);

								$datas = PRODUIT::findBy(["id="=>$id]);
								if (count($datas) > 0) {
									$produit = $datas[0];

									$paye = $produit->coutProduction("livraison", $qte);
									if (isset($chargement_manoeuvre) && $chargement_manoeuvre == "on") {
										$montant += $paye / 2;
									}

									if (isset($dechargement_manoeuvre) && $dechargement_manoeuvre == "on") {
										$montant += $paye / 2;
									}

									$lignecommande = new LIGNELIVRAISON;
									$lignecommande->livraison_id = $livraison->getId();
									$lignecommande->produit_id = $id;
									$lignecommande->quantite = $qte;
									$lignecommande->perte = $array[$id];
									$lignecommande->enregistre();
									$lignecommande->reste = $groupecommande->reste($id);
									$lignecommande->save();
								}
							}

							$productionjour->total_livraison += $montant;
							$productionjour->save();

							if ($vehicule_id != VEHICULE::AUTO && $vehicule_id != VEHICULE::TRICYCLE) {
								$datas = VEHICULE::findBy(["id="=>$vehicule_id]);
								if (count($datas) > 0) {
									$vehicule = $datas[0];
									$vehicule->etatvehicule_id = ETATVEHICULE::MISSION;
									$vehicule->save();
								}

								$datas = CHAUFFEUR::findBy(["id="=>$chauffeur_id]);
								if (count($datas) > 0) {
									$chauffeur = $datas[0];
									$chauffeur->etatchauffeur_id = ETATCHAUFFEUR::MISSION;
									$chauffeur->save();
								}

								if($isLouer == 1 && $montant_location > 0 ){
									if ($modepayement_id == MODEPAYEMENT::PRELEVEMENT_ACOMPTE ) {
										$lot = $client->debiter($montant_location);

									}else{

										if ($montant_location > intval($avance)) {
											$client->dette($montant_location - intval($avance));
										}

										$livraison->actualise();
										$payement = new OPERATION();
										$payement->hydrater($_POST);
										$payement->categorieoperation_id = CATEGORIEOPERATION::LOCATION_LIVRAISON;
										$payement->montant = $avance;
										$payement->client_id = $livraison->groupecommande->client_id;
										$payement->comment = "Réglement pour la location d'engins de livraison pour la livraison N°".$livraison->reference;
										$lot = $payement->enregistre();

										$livraison->operation_id = $lot->lastid;
									}


								}
							}

							$data = $livraison->save();
							$data->setUrl("gestion", "fiches", "bonlivraison", $data->lastid);				
						}	
					}else{
						$data->status = false;
						$data->message = "Veuillez à bien vérifier les quantités des différents produits à livrer, certaines sont incorrectes !";
					}
				}else{
					$data->status = false;
					$data->message = "Veuillez selectionner des produits et leur quantité pour passer la commande !";
				}
			}else{
				$data->status = false;
				$data->message = "Le seuil de credit pour ce client sera dépassé !";
			}
		}else{
			$data->status = false;
			$data->message = "Une erreur s'est produite lors de l'operation, veuillez recommencer !";
		}
	}else{
		$data->status = false;
		$data->message = "Une erreur s'est produite lors de l'operation, veuillez recommencer !";
	}
	echo json_encode($data);
}




if ($action == "validerProgrammation") {
	if ($datelivraison >= dateAjoute()) {
		if (getSession("commande-encours") != null) {
			$datas = GROUPECOMMANDE::findBy(["id ="=>getSession("commande-encours")]);
			if (count($datas) > 0) {
				$groupecommande = $datas[0];

				$produits = explode(",", $tableau);
				if (count($produits) > 0) {
					$produits1 = explode(",", $tableau1);
					$tests = $produits;
					foreach ($tests as $key => $value) {
						$lot = explode("-", $value);
						$id = $lot[0];
						$qte = end($lot);
						if ($groupecommande->reste($id) >= $qte) {
							unset($tests[$key]);
						}
					}
					if (count($tests) == 0) {
						$livraison = new LIVRAISON();
						$livraison->hydrater($_POST);
						$livraison->groupecommande_id = $groupecommande->getId();
						$livraison->etat_id = ETAT::PARTIEL;
						if ($vehicule_id == VEHICULE::AUTO){
							$livraison->nom_receptionniste = $groupecommande->client->name();
							$livraison->contact_receptionniste = $groupecommande->client->contact;
							$livraison->datelivraison = dateAjoute();
							$livraison->etat_id = ETAT::VALIDEE;
						}
						$data = $livraison->save();
						if ($data->status) {
							foreach ($produits1 as $key => $value) {
								$lot = explode("-", $value);
								$array[$lot[0]] = end($lot);
							}

							foreach ($produits as $key => $value) {
								$lot = explode("-", $value);
								$id = $lot[0];
								$qte = end($lot);

								$datas = PRODUIT::findBy(["id="=>$id]);
								if (count($datas) > 0) {
									$produit = $datas[0];

									$lignecommande = new LIGNELIVRAISON;
									$lignecommande->livraison_id = $livraison->getId();
									$lignecommande->produit_id = $id;
									$lignecommande->quantite = $qte;
									$lignecommande->perte = $array[$id];
									$lignecommande->enregistre();
									$lignecommande->reste = $groupecommande->reste($id);
									$lignecommande->save();
								}

							}

							if ($vehicule_id != VEHICULE::AUTO && $vehicule_id != VEHICULE::TRICYCLE) {
								$datas = VEHICULE::findBy(["id="=>$vehicule_id]);
								if (count($datas) > 0) {
									$vehicule = $datas[0];
									$vehicule->etatvehicule_id = ETATVEHICULE::MISSION;
									$vehicule->save();
								}

								$datas = CHAUFFEUR::findBy(["id="=>$chauffeur_id]);
								if (count($datas) > 0) {
									$chauffeur = $datas[0];
									$chauffeur->etatchauffeur_id = ETATCHAUFFEUR::MISSION;
									$chauffeur->save();
								}

								if($isLouer == 1 && $montant_location > 0 ){
									if ($modepayement_id == MODEPAYEMENT::PRELEVEMENT_ACOMPTE ) {
										$lot = $client->debiter($montant_location);

									}else{

										if ($montant_location > intval($avance)) {
											$client->dette($montant_location - intval($avance));
										}

										$livraison->actualise();
										$payement = new OPERATION();
										$payement->hydrater($_POST);
										$payement->categorieoperation_id = CATEGORIEOPERATION::LOCATION_LIVRAISON;
										$payement->montant = $avance;
										$payement->client_id = $livraison->groupecommande->client_id;
										$payement->comment = "Réglement pour la location d'engins de livraison pour la livraison N°".$livraison->reference;
										$lot = $payement->enregistre();

										$livraison->operation_id = $lot->lastid;
									}

								}
							}

							$data->setUrl("gestion", "fiches", "bonlivraison", $data->lastid);				
						}	
					}else{
						$data->status = false;
						$data->message = "Veuillez à bien vérifier les quantités des différents produits à livrer, certaines sont incorrectes !";
					}
				}else{
					$data->status = false;
					$data->message = "Veuillez selectionner des produits et leur quantité pour passer la commande !";
				}
			}else{
				$data->status = false;
				$data->message = "Une erreur s'est produite lors de l'operation, veuillez recommencer !";
			}
		}else{
			$data->status = false;
			$data->message = "Une erreur s'est produite lors de l'operation, veuillez recommencer !";
		}
	}else{
		$data->status = false;
		$data->message = "Veuillez vérifier la date de programmation de la livraison !";
	}
	echo json_encode($data);
}



if ($action == "validerChangement") {
	if (getSession("commande-encours") != null) {
		$datas = GROUPECOMMANDE::findBy(["id ="=>getSession("commande-encours")]);
		if (count($datas) > 0) {
			$grcom = $datas[0];
			$datas = $grcom->fourni("commande");
			$com = end($datas);
			$grcom->etat_id = ETAT::VALIDEE;
			$grcom->save();

			$groupecommande = new GROUPECOMMANDE();
			$groupecommande->hydrater($_POST);
			$groupecommande->enregistre();

			$produits = explode(",", $tableau);
			if (count($produits) > 0) {

				$commande = new COMMANDE();
				$commande->hydrater($_POST);
				$commande->zonelivraison_id = $com->zonelivraison_id;
				$commande->lieu = $com->lieu;
				$commande->datelivraison = $com->datelivraison;
				if ($commande->datelivraison < dateAjoute()) {
					$commande->datelivraison = dateAjoute();
				}
				$commande->groupecommande_id = $groupecommande->getId();
				$commande->setId(null);
				$data = $commande->enregistre();

				$changement = new CHANGEMENT();
				$changement->hydrater($_POST);
				$changement->groupecommande_id = $grcom->getId();
				$changement->groupecommande_id_new = $groupecommande->getId();
				$data = $changement->enregistre();

				if ($data->status) {
					foreach ($produits as $key => $value) {
						$lot = explode("-", $value);
						$id = $lot[0];
						$qte = end($lot);

						$datas = PRODUIT::findBy(["id="=>$id]);
						if (count($datas) > 0) {
							$produit = $datas[0];
							$lignecommande = new LIGNECOMMANDE;
							$lignecommande->commande_id = $commande->getId();
							$lignecommande->produit_id = $id;
							$lignecommande->quantite = $qte;
							$lignecommande->price = 0;
							$lignecommande->enregistre();

							$lignechangement = new LIGNECHANGEMENT;
							$lignechangement->changement_id = $changement->getId();
							$lignechangement->produit_id = $id;
							$lignechangement->quantite_avant = $grcom->reste($id);
							$lignechangement->quantite_apres = $qte;
							$lignechangement->enregistre();
						}

					}				
				}	
			}else{
				$data->status = false;
				$data->message = "Veuillez selectionner des produits et leur quantité pour passer la commande !";
			}
		}else{
			$data->status = false;
			$data->message = "Une erreur s'est produite lors de l'operation, veuillez recommencer !";
		}
	}else{
		$data->status = false;
		$data->message = "Une erreur s'est produite lors de l'operation, veuillez recommencer !";
	}
	echo json_encode($data);
}



if ($action == "fichecommande") {
	$rooter = new ROOTER;
	$params = PARAMS::findLastId();
	$datas = GROUPECOMMANDE::findBy(["id ="=> $id]);
	if (count($datas) == 1) {
		session('commande-encours', $id);
		$groupecommande = $datas[0];
		$groupecommande->actualise();

		$datas = EMPLOYE::findBy(["id = "=>getSession("employe_connecte_id")]);
		$employe = $datas[0];

		include("../../../../../composants/assets/modals/modal-groupecommande.php");
	}
}


if ($action == "modalcommande") {
	$rooter = new ROOTER;
	$params = PARAMS::findLastId();
	session("commande-encours", $id);
	include("../../../../../composants/assets/modals/modal-newcommande.php");
}



if ($action == "newlivraison") {
	$rooter = new ROOTER;
	$params = PARAMS::findLastId();
	$datas = GROUPECOMMANDE::findBy(["id ="=> $id]);
	if (count($datas) == 1) {
		session('commande-encours', $id);
		$groupecommande = $datas[0];
		$groupecommande->actualise();
		$groupecommande->fourni("commande", ["etat_id !="=>ETAT::ANNULEE]);
		include("../../../../../composants/assets/modals/modal-newlivraison.php");
	}
}


if ($action == "newProgrammation") {
	$rooter = new ROOTER;
	$params = PARAMS::findLastId();
	$datas = GROUPECOMMANDE::findBy(["id ="=> $id]);
	if (count($datas) == 1) {
		session('commande-encours', $id);
		$groupecommande = $datas[0];
		$groupecommande->actualise();
		$groupecommande->fourni("commande", ["etat_id !="=>ETAT::ANNULEE]);
		include("../../../../../composants/assets/modals/modal-programmation.php");
	}
}



if ($action == "changement") {
	$rooter = new ROOTER;
	$params = PARAMS::findLastId();
	$datas = GROUPECOMMANDE::findBy(["id ="=> $id]);
	if (count($datas) == 1) {
		session('commande-encours', $id);
		$groupecommande = $datas[0];
		$groupecommande->actualise();
		$groupecommande->fourni("commande", ["etat_id !="=>ETAT::ANNULEE]);
		include("../../../../../composants/assets/modals/modal-changement.php");
	}
}



if ($action == "acompte") {
	$datas = EMPLOYE::findBy(["id = "=>getSession("employe_connecte_id")]);
	if (count($datas) > 0) {
		$employe = $datas[0];
		$employe->actualise();
		if ($employe->checkPassword($password)) {
			$datas = CLIENT::findBy(["id=" => $client_id]);
			if (count($datas) > 0) {
				$client = $datas[0];
				$data = $client->crediter(intval($montant), $_POST);
			}else{
				$data->status = false;
				$data->message = "Une erreur s'est produite lors de l'opération, veuillez recommencer !";
			}
		}else{
			$data->status = false;
			$data->message = "Votre mot de passe ne correspond pas !";
		}
	}else{
		$data->status = false;
		$data->message = "Vous ne pouvez pas effectué cette opération !";
	}
	echo json_encode($data);
}



if ($action == "dette") {
	$datas = EMPLOYE::findBy(["id = "=>getSession("employe_connecte_id")]);
	if (count($datas) > 0) {
		$employe = $datas[0];
		$employe->actualise();
		if ($employe->checkPassword($password)) {
			$datas = CLIENT::findBy(["id=" => $client_id]);
			if (count($datas) > 0) {
				$client = $datas[0];
				$data = $client->reglerDette(intval($montant), $_POST);
			}else{
				$data->status = false;
				$data->message = "Une erreur s'est produite lors de l'opération, veuillez recommencer !";
			}
		}else{
			$data->status = false;
			$data->message = "Votre mot de passe ne correspond pas !";
		}
	}else{
		$data->status = false;
		$data->message = "Vous ne pouvez pas effectué cette opération !";
	}
	echo json_encode($data);
}


if ($action == "rembourser") {
	$datas = EMPLOYE::findBy(["id = "=>getSession("employe_connecte_id")]);
	if (count($datas) > 0) {
		$employe = $datas[0];
		$employe->actualise();
		if ($employe->checkPassword($password)) {
			$datas = CLIENT::findBy(["id=" => $client_id]);
			if (count($datas) > 0) {
				$client = $datas[0];
				$data = $client->rembourser(intval($montant), $_POST);
			}else{
				$data->status = false;
				$data->message = "Une erreur s'est produite lors de l'opération, veuillez recommencer !";
			}
		}else{
			$data->status = false;
			$data->message = "Votre mot de passe ne correspond pas !";
		}
	}else{
		$data->status = false;
		$data->message = "Vous ne pouvez pas effectué cette opération !";
	}
	echo json_encode($data);
}



if ($action == "transferer") {
	if ($client_id != $client_id_receive) {
		$datas = EMPLOYE::findBy(["id = "=>getSession("employe_connecte_id")]);
		if (count($datas) > 0) {
			$employe = $datas[0];
			$employe->actualise();
			if ($employe->checkPassword($password)) {
				$datas = CLIENT::findBy(["id=" => $client_id]);
				if (count($datas) > 0) {
					$client = $datas[0];

					$datas = CLIENT::findBy(["id=" => $client_id_receive]);
					if (count($datas) > 0) {
						$client2 = $datas[0];
						$data = $client->transferer(intval($montant), $client2);
						if ($data->status) {
							$transfert = new TRANSFERT();
							$transfert->hydrater($_POST);
							$transfert->enregistre();
						}
					}else{
						$data->status = false;
						$data->message = "Une erreur s'est produite lors de l'opération, veuillez recommencer !";
					}
				}else{
					$data->status = false;
					$data->message = "Une erreur s'est produite lors de l'opération, veuillez recommencer !";
				}
			}else{
				$data->status = false;
				$data->message = "Votre mot de passe ne correspond pas !";
			}
		}else{
			$data->status = false;
			$data->message = "Vous ne pouvez pas effectué cette opération !";
		}
	}else{
		$data->status = false;
		$data->message = "Vous ne pouvez pas vous transferer des fonds";
	}

	echo json_encode($data);
}


if ($action == "annuler") {
	$datas = MISSION::findBy(["id ="=> $id]);
	if (count($datas) == 1) {
		$mission = $datas[0];
		$data = $mission->annuler();
	}else{
		$data->status = false;
		$data->message = "Une erreur s'est produite pendant le processus, veuillez recommencer !";
	}	
	echo json_encode($data);
}