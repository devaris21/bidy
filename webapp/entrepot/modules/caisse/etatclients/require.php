<?php 
namespace Home;

$date1 = getSession("date1");
$date2 = getSession("date2");

$versements = OPERATION::versements($date1, $date2);
$clients = CLIENT::findBy(["visibility ="=>1]);
foreach ($clients as $key => $client) {
	$lot1 = $lot2 = [];
	$vers = $client->versements($date1, $date2);
	$datas = $client->fourni("groupecommande");
	foreach ($datas as $key => $groupe) {
		$lot1 = $groupe->fourni("commande", ["DATE(created) >= " => $date1, "DATE(created) <= " => $date2, "etat_id !="=>ETAT::ANNULEE]);
		$lot2 = $groupe->fourni("livraison", ["DATE(created) >= " => $date1, "DATE(created) <= " => $date2, "etat_id !="=>ETAT::ANNULEE]);
	}
	if (!($vers > 0 || count($lot1) > 0 || count($lot2) > 0)) {
		unset($clients[$key]);
	}else{
		$client->actualise();
		$client->versement = $vers;
		$client->commandes = count($lot1);
		$client->livraisons = count($lot2);
		$client->pct = ($versements > 0)?round((($client->versement / $versements)*100), 2 ):0;
	}
}


usort($clients, "comparer1");

$stats = CLIENT::stats($date1, $date2);


$title = "BRIXS | Etat récapitulatif des clients ";


?>