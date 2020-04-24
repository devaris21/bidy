<?php 
namespace Home;
use Native\ROOTER;
require '../../../../../core/root/includes.php';
use Native\RESPONSE;

$data = new RESPONSE;
extract($_POST);


if ($action == "prix") {
	$items = explode(",", $tableau);
	foreach ($items as $key => $value) {
		$data = explode("-", $value);
		$id = $data[0];
		$val = end($data);
		$datas = PRIX_ZONELIVRAISON::findBy(["id ="=> $id]);
		if (count($datas) == 1) {
			$pz = $datas[0];
			$pz->price = intval($val);
			$data = $pz->save();
		}
	}
	echo json_encode($data);
}



if ($action == "exigence") {
	$items = explode(",", $tableau);
	$exi = $items[0];
	$data = explode("-", $exi);
	$id = $data[0]; $val = end($data);
	$datas = EXIGENCEPRODUCTION::findBy(["id ="=> $id]);
	if (count($datas) == 1) {
		$pz = $datas[0];
		$pz->quantite = intval($val);
		$data = $pz->save();
	}
	unset($items[0]);

	foreach ($items as $key => $value) {
		$data = explode("-", $value);
		$id = $data[0];
		$val = end($data);
		$datas = LIGNEEXIGENCEPRODUCTION::findBy(["id ="=> $id]);
		if (count($datas) == 1) {
			$pz = $datas[0];
			$pz->quantite = intval($val);
			$data = $pz->save();
		}
	}
	echo json_encode($data);
}


if ($action == "formPayeProduit") {
	$items = explode(",", $tableau);
	foreach ($items as $key => $value) {
		$data = explode("-", $value);
		$id = $data[0]; $val = end($data);

		$datas = PAYE_PRODUIT::findBy(["id ="=> $id]);
		if (count($datas) == 1) {
			$pz = $datas[0];
			$pz->price = intval($val);
			$data = $pz->save();
		}
	}	
	echo json_encode($data);
}



if ($action == "autoriser") {
	$datas = ROLE_EMPLOYE::findBy(["employe_id ="=> $employe_id, "role_id ="=> $role_id]);
	if (count($datas) == 0) {
		$rem = new ROLE_EMPLOYE();
		$rem->hydrater($_POST);
		$data = $rem->enregistre();
	}else{
		$data->status = false;
		$data->message = "L'employé dispose déjà de ce droit !";
	}
	echo json_encode($data);
}


if ($action == "refuser") {
	$datas = ROLE_EMPLOYE::findBy(["employe_id ="=> $employe_id, "role_id ="=> $role_id]);
	if (count($datas) == 1) {
		$rem = $datas[0];
		if (!$rem->isProtected()) {
			$rem = $datas[0];
			$data = $rem->delete();
		}else{
			$data->status = false;
			$data->message = "Vous ne pouvez pas supprimer cet accès, il est protégé !";
		}
	}else{
		$data->status = false;
		$data->message = "L'accès est déjà refusé à cet employé !";
	}
	echo json_encode($data);
}