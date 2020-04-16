<?php 
namespace Home;

$pannes = PANNE::getAll();
foreach ($pannes as $key => $value) {
	$value->actualise();
	$value->type = "machine";
}

$demandes = DEMANDEENTRETIEN::getAll();
foreach ($demandes as $key => $value) {
	$value->actualise();
	$value->type = "vehicule";
}
$datas = array_merge($pannes, $demandes);
usort($datas, "comparerDateCreated");


$pannes = ENTRETIENMACHINE::getAll();
foreach ($pannes as $key => $value) {
	$value->actualise();
	$value->type = "machine";
}

$demandes = ENTRETIENVEHICULE::getAll();
foreach ($demandes as $key => $value) {
	$value->actualise();
	$value->type = "vehicule";
}
$datas1 = array_merge($pannes, $demandes);
usort($datas1, "comparerDateCreated");

$title = "AMB | Pannes  de véhicules/Machine";
?>