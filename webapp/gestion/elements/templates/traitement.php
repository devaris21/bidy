<?php 
namespace Home;
require '../../../../core/root/includes.php';
use Native\RESPONSE;
extract($_POST);

$data = new RESPONSE;




if ($action === "productionjour") {
	$montant = 0;
	$productionjour = PRODUCTIONJOUR::today();
	$productionjour->fourni("ligneproductionjour");
	foreach ($productionjour->ligneproductionjours as $cle => $ligne) {
		$ligne->production = intval($_POST["prod-".$ligne->produit_id]);
		$ligne->perte = intval($_POST["perte-".$ligne->produit_id]);
		$ligne->save();

		$lots = PAYE_PRODUIT::findBy(["produit_id ="=>$ligne->produit_id]);
		if (count($lots) > 0) {
			$ppr = $lots[0];
			$montant += $ligne->production * $ppr->price;
		}
	}

	$productionjour->fourni("ligneconsommationjour");
	foreach ($productionjour->ligneconsommationjours as $cle => $ligne) {
		$ligne->consommation = intval($_POST["conso-".$ligne->ressource_id]);
		$ligne->save();
	}


	$datas = $productionjour->fourni("manoeuvredujour");
	foreach ($datas as $cle => $ligne) {
		$ligne->delete();
	}

	if (isset($manoeuvres) && $manoeuvres != "") {
		$datas = explode(",", $manoeuvres);
		foreach ($datas as $key => $value) {
			$item = new MANOEUVREDUJOUR();
			$item->productionjour_id = $productionjour->getId();
			$item->manoeuvre_id = $value;
			$item->price = $montant / count($datas);
			$item->enregistre();
		}
	}else{
		$datas = MANOEUVRE::findBy(["groupemanoeuvre_id ="=>$groupemanoeuvre_id]);
		foreach ($datas as $key => $value) {
			$item = new MANOEUVREDUJOUR();
			$item->productionjour_id = $productionjour->getId();
			$item->manoeuvre_id = $value->getId();
			$item->price = $montant / count($datas);
			$item->enregistre();
		}
	}

	$productionjour->hydrater($_POST);
	$productionjour->employe_id = getSession("employe_connecte_id");
	$data = $productionjour->save();
	echo json_encode($data);
}

?>