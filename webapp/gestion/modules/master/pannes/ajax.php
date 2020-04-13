<?php 
namespace Home;
require '../../../../../core/root/includes.php';

use Native\RESPONSE;
use Native\EMAIL;
use Native\FICHIER;
$data = new RESPONSE;
extract($_POST);




/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


if ($action == "approuver") {
	$datas = GESTIONNAIRE::findBy(["id = "=>getSession("gestionnaire_connecte_id")]);
	if (count($datas) > 0) {
		$gestionnaire = $datas[0];
		$gestionnaire->actualise();
		if ($gestionnaire->checkPassword($password)) {
			$datas = AFFECTATION::findBy(["id ="=>$id]);
			if (count($datas) == 1) {
				$affectation = $datas[0];
				$data = $affectation->terminer();
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



if ($action == "renouveler") {
	if (getSession("affectation_id") != null) {
		$datas = AFFECTATION::findBy(["id ="=> getSession("affectation_id")]);
		if (count($datas) == 1) {
			$affectation = $datas[0];
			$data = $affectation->renouveler($started, $finished);
		}else{
			$data->status = false;
			$data->message = "Une erreur s'est produite lors de l'opération! Veuillez recommencer";
		}
	}else{
		$data->status = false;
		$data->message = "Une erreur s'est produite lors de l'opération! Veuillez recommencer";
	}
	echo json_encode($data);
}




if ($action == "refuser") {
	$datas = GESTIONNAIRE::findBy(["id = "=>getSession("gestionnaire_connecte_id")]);
	if (count($datas) > 0) {
		$gestionnaire = $datas[0];
		$gestionnaire->actualise();
		if ($gestionnaire->checkPassword($password)) {
			$datas = AFFECTATION::findBy(["id ="=>$id]);
			if (count($datas) == 1) {
				$affectation = $datas[0];
				$data = $affectation->annuler();
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
