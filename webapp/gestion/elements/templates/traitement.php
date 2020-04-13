<?php 
namespace Home;
require '../../../../core/root/includes.php';
use Native\RESPONSE;
extract($_POST);

$data = new RESPONSE;




if ($action === "productionjour") {
	$productionjour = PRODUCTIONJOUR::today();
	$productionjour->fourni("ligneproductionjour");
	foreach ($productionjour->ligneproductionjours as $cle => $ligne) {
		$ligne->production = intval($_POST["prod-".$ligne->produit_id]);
		$ligne->perte = intval($_POST["perte-".$ligne->produit_id]);
		$ligne->save();
	}

	$productionjour->fourni("ligneconsommationjour");
	foreach ($productionjour->ligneconsommationjours as $cle => $ligne) {
		$ligne->consommation = intval($_POST["conso-".$ligne->ressource_id]);
		$ligne->save();
	}
	
	$productionjour->hydrater($_POST);
	$productionjour->employe_id = getSession("employe_connecte_id");
	$data = $productionjour->save();
	echo json_encode($data);
}

?>