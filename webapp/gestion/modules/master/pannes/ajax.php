<?php 
namespace Home;
require '../../../../../core/root/includes.php';

use Native\RESPONSE;
use Native\EMAIL;
use Native\FICHIER;
$data = new RESPONSE;
extract($_POST);


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

if ($action == "demandeEntretien") {
	$datas = DEMANDEENTRETIEN::findBy(["id ="=>$demande_id]);
	if (count($datas) == 1) {
		$demande = $datas[0];
		$data = $demande->approuver();
		if ($data->status) {
			$entretien = new ENTRETIENVEHICULE;
			$entretien->cloner($demande);
			$entretien->hydrater($_POST);
			$entretien->name = $demande->typeentretienvehicule->name." suite à la déclaration de panne ";
			$entretien->setId(null);
			$files = [];
			if (isset($_FILES)) {
				foreach ($_FILES as $key => $value) {
					if ($key !== "id" && $value != "") {
						$files[] = $value;
					}
				}
			}
			$entretien->files = $files;
			if ($price > 0) {
				$payement = new OPERATION();
				$payement->categorieoperation_id = CATEGORIEOPERATION::ENTRETIENVEHICULE;
				$payement->modepayement_id = $modepayement_id;
				$payement->montant = $price;
				$payement->comment = "Avance sur réglement de la facture pour l'entretien du véhicule N°".$commande->reference;
				$data = $payement->enregistre();
				if ($data->status) {
					$data = $entretien->enregistre();
				}	
			}
		}
	}else{
		$data->status = false;
		$data->message = "Une erreur s'est produite lors de l'opération! Veuillez recommencer";
	}
	echo json_encode($data);
}



if ($action == "annulerDemandeEntretien") {
	$datas = DEMANDEENTRETIEN::findBy(["id ="=>$id]);
	if (count($datas) == 1) {
		$demande = $datas[0];
		$data = $demande->annuler();
	}else{
		$data->status = false;
		$data->message = "Une erreur s'est produite lors de l'opération! Veuillez recommencer";
	}
	echo json_encode($data);
}



if ($action == "validerEntretienVehicule") {
	$datas = ENTRETIENVEHICULE::findBy(["id ="=>$id]);
	if (count($datas) == 1) {
		$entretien = $datas[0];
		if ($montant > 0) {
			$payement = new OPERATION();
			$payement->categorieoperation_id = CATEGORIEOPERATION::ENTRETIENVEHICULE;
			$payement->modepayement_id = $modepayement_id;
			$payement->montant = $montant;
			$payement->comment = "Réglement de la facture pour l'entretien du véhicule N°".$commande->reference;
			$data = $payement->enregistre();
			if ($data->status) {
				$entretien->price += $montant;
				$data = $entretien->approuver();
			}	
		}	
	}else{
		$data->status = false;
		$data->message = "Une erreur s'est produite lors de l'opération! Veuillez recommencer";
	}
	echo json_encode($data);
}


if ($action == "annulerEntretienVehicule") {
	$datas = ENTRETIENVEHICULE::findBy(["id ="=>$id]);
	if (count($datas) == 1) {
		$entretien = $datas[0];
		$data = $entretien->annuler();
	}else{
		$data->status = false;
		$data->message = "Une erreur s'est produite lors de l'opération! Veuillez recommencer";
	}
	echo json_encode($data);
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



if ($action == "panne") {
	$datas = PANNE::findBy(["id ="=>$demande_id]);
	if (count($datas) == 1) {
		$panne = $datas[0];
		$data = $panne->approuver();
		if ($data->status) {
			$entretien = new ENTRETIENVEHICULE;
			$entretien->cloner($panne);
			$entretien->hydrater($_POST);
			$entretien->name = $panne->name." suite à la déclaration de panne ";
			$entretien->setId(null);
			$files = [];
			if (isset($_FILES)) {
				foreach ($_FILES as $key => $value) {
					if ($key !== "id" && $value != "") {
						$files[] = $value;
					}
				}
			}
			$entretien->files = $files;
			if ($price > 0) {
				$payement = new OPERATION();
				$payement->categorieoperation_id = CATEGORIEOPERATION::ENTRETIENVEHICULE;
				$payement->modepayement_id = $modepayement_id;
				$payement->montant = $price;
				$payement->comment = "Avance sur réglement de la facture pour l'entretien du véhicule N°".$commande->reference;
				$data = $payement->enregistre();
				if ($data->status) {
					$data = $entretien->enregistre();
				}	
			}
		}
	}else{
		$data->status = false;
		$data->message = "Une erreur s'est produite lors de l'opération! Veuillez recommencer";
	}
	echo json_encode($data);
}



if ($action == "annulerPanne") {
	$datas = PANNE::findBy(["id ="=>$id]);
	if (count($datas) == 1) {
		$panne = $datas[0];
		$data = $panne->annuler();
	}else{
		$data->status = false;
		$data->message = "Une erreur s'est produite lors de l'opération! Veuillez recommencer";
	}
	echo json_encode($data);
}



if ($action == "validerEntretienMachine") {
	$datas = ENTRETIENMACHINE::findBy(["id ="=>$id]);
	if (count($datas) == 1) {
		$entretien = $datas[0];
		if ($montant > 0) {
			$payement = new OPERATION();
			$payement->categorieoperation_id = CATEGORIEOPERATION::ENTRETIENVEHICULE;
			$payement->modepayement_id = $modepayement_id;
			$payement->montant = $montant;
			$payement->comment = "Réglement de la facture pour l'entretien du véhicule N°".$commande->reference;
			$data = $payement->enregistre();
			if ($data->status) {
				$entretien->price += $montant;
				$data = $entretien->approuver();
			}	
		}	
	}else{
		$data->status = false;
		$data->message = "Une erreur s'est produite lors de l'opération! Veuillez recommencer";
	}
	echo json_encode($data);
}


if ($action == "annulerEntretienMachine") {
	$datas = ENTRETIENMACHINE::findBy(["id ="=>$id]);
	if (count($datas) == 1) {
		$entretien = $datas[0];
		$data = $entretien->annuler();
	}else{
		$data->status = false;
		$data->message = "Une erreur s'est produite lors de l'opération! Veuillez recommencer";
	}
	echo json_encode($data);
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////