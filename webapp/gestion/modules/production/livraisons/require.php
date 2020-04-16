<?php 
namespace Home;

$title = "BIDY | Toutes les livraisons en cours";

$livraisons = LIVRAISON::getAll();
$total = 0;
foreach ($livraisons as $key => $liv) {
	if ($liv->etat_id == ETAT::ENCOURS) {
		$total++;
	}
}

?>