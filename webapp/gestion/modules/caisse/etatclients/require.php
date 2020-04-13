<?php 
namespace Home;

if ($this->getId() != "") {
	$tab = explode("@", $this->getId());
	$date1 = $tab[0];
	$date2 = $tab[1];
}else{
	$date1 = PARAMS::DATE_DEFAULT;
	$date2 = dateAjoute(1);
}

$clients = CLIENT::getAll();
foreach ($clients as $key => $client) {
	$lot1 = $lot2 = [];
	$vers = $client->versements($date1, $date2);
	$datas = $client->fourni("groupecommande");
	foreach ($datas as $key => $groupe) {
		$lot1 = $groupe->fourni("commande", ["DATE(created) >= " => $date1, "DATE(created) <= " => $date2]);
		$lot2 = $groupe->fourni("livraison", ["DATE(created) >= " => $date1, "DATE(created) <= " => $date2]);
	}
	if (!($vers > 0 || count($lot1) > 0 || count($lot2) > 0)) {
		unset($clients[$key]);
	}else{
		$client->actualise();
		$client->versement = $vers;
		$client->commandes = count($lot1);
		$client->livraisons = count($lot2);
	}
}

$stats = CLIENT::stats($date1, $date2);


$title = "BIDY | Etat récapitulatif des clients ";
?>