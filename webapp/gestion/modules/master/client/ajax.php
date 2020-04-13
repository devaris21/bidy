<?php 
namespace Home;
use Native\ROOTER;
require '../../../../../core/root/includes.php';

use Native\RESPONSE;

$data = new RESPONSE;
extract($_POST);


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
					<img style="width: 40px" src="<?= $rooter->stockage("images", "produit", $produit->image) ?>">
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
					<img style="width: 40px" src="<?= $rooter->stockage("images", "produit", $produit->image) ?>">
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





if ($action == "validerCommande") {
	$montant = 0;
	$params = PARAMS::findLastId();
	$datas = CLIENT::findBy(["id ="=> $client_id]);
	if (count($datas) > 0) {
		$client = $datas[0];
		$produits = explode(",", $tableau);
		if (count($produits) > 0) {
			if (($modepayement_id == MODEPAYEMENT::PRELEVEMENT_ACOMPTE && $client->acompte >= getSession("total")) || $modepayement_id != MODEPAYEMENT::PRELEVEMENT_ACOMPTE) {

				if (getSession("commande-encours") != null) {
					$datas = GROUPECOMMANDE::findBy(["id ="=>getSession("commande-encours")]);
					if (count($datas) > 0) {
						$groupecommande = $datas[0];
						$groupecommande->etat_id = ETAT::ENCOURS;
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
				$groupecommande->fourni("lignegroupecommande");

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
							$lignecommande->produit_id = $data[0];
							$lignecommande->quantite = $qte;
							$lignecommande->price =  $prix * $qte;
							$lignecommande->save();

							$test = false;
							foreach ($groupecommande->lignegroupecommandes as $key => $lgn) {
								if ($lgn->produit_id == $lignecommande->produit_id) {
									$lgn->quantite += $qte;
									$lgn->save();
									$test = true;
									break;
								}
							}
							if (!$test) {
								$lignegroupecommande = new LIGNEGROUPECOMMANDE;
								$lignegroupecommande->groupecommande_id = $groupecommande->getId();
								$lignegroupecommande->produit_id = $data[0];
								$lignegroupecommande->quantite = $qte;
								$lignegroupecommande->enregistre();
							}	
						}
					}

					$tva = ($montant * $params->tva) / 100;
					if ($modepayement_id == MODEPAYEMENT::PRELEVEMENT_ACOMPTE ) {
						$data = $client->debiter($montant);
					}else{
						$payement = new OPERATION();
						$payement->categorieoperation_id = CATEGORIEOPERATION::PAYEMENT;
						$payement->modepayement_id = $modepayement_id;
						$payement->montant = $montant + $tva;
						$payement->client_id = $client_id;
						$payement->comment = "Réglement de la facture pour la commande N°".$commande->reference;
						$data = $payement->enregistre();
					}
					

					$commande->montant = $tva;
					$commande->montant = $montant + $tva;
					$commande->operation_id = $data->lastid;
					$data = $commande->save();
				}
			}else{
				$data->status = false;
				$data->message = "Le montant sur l'acompte du client est insuffisant pour régler cette facture !";
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
	if (getSession("commande-encours") != null) {
		$datas = GROUPECOMMANDE::findBy(["id ="=>getSession("commande-encours")]);
		if (count($datas) > 0) {
			$groupecommande = $datas[0];
			$groupecommande->fourni("lignegroupecommande");

			$produits = explode(",", $tableau);
			if (count($produits) > 0) {
				$tests = $produits;
				foreach ($tests as $key => $value) {
					$lot = explode("-", $value);
					$id = $lot[0];
					$qte = end($lot);
					foreach ($groupecommande->lignegroupecommandes as $key => $lgn) {
						if (($lgn->produit_id == $id) && ($lgn->quantite >= $qte)) {
							unset($tests[$key]);
						}
					}
				}
				if (count($tests) == 0) {
					$livraison = new LIVRAISON();
					$livraison->hydrater($_POST);
					$livraison->groupecommande_id = $groupecommande->getId();
					$data = $livraison->enregistre();
					if ($data->status) {
						foreach ($produits as $key => $value) {
							$lot = explode("-", $value);
							$id = $lot[0];
							$qte = end($lot);

							$datas = PRODUIT::findBy(["id="=>$id]);
							if (count($datas) > 0) {
								$produit = $datas[0];
								$produit->livrer($qte);

								$lignecommande = new LIGNELIVRAISON;
								$lignecommande->livraison_id = $livraison->getId();
								$lignecommande->produit_id = $id;
								$lignecommande->quantite = $lignecommande->quantite_livree = $qte;
								$lignecommande->enregistre();

								foreach ($groupecommande->lignegroupecommandes as $key => $lgn) {
									if ($lgn->produit_id == $id) {
										$lgn->quantite -= $qte;
										$lgn->save();
										break;
									}
								}
							}
							
						}
						$datas = VEHICULE::findBy(["id="=>$vehicule_id]);
						if (count($datas) > 0) {
							$vehicule->etatvehicule_id = ETATVEHICULE::MISSION;
							$vehicule->save();
						}
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
		$groupecommande->fourni("lignegroupecommande");
		include("../../../../../composants/assets/modals/modal-groupecommande.php");
	}
}



if ($action == "newlivraison") {
	$rooter = new ROOTER;
	$params = PARAMS::findLastId();
	$datas = GROUPECOMMANDE::findBy(["id ="=> $id]);
	if (count($datas) == 1) {
		session('commande-encours', $id);
		$groupecommande = $datas[0];
		$groupecommande->actualise();
		$groupecommande->fourni("lignegroupecommande");
		$groupecommande->fourni("commande");
		include("../../../../../composants/assets/modals/modal-newlivraison.php");
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
				$data = $client->crediter(intval($montant), $modepayement_id);
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