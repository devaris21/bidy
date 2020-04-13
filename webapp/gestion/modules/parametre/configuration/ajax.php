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