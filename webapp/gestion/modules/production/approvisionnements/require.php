<?php 
namespace Home;

unset_session("ressources");

$title = "BIDY | Toutes les livraisons en cours";

$approvisionnements = APPROVISIONNEMENT::getAll();
$total = 0;
foreach ($approvisionnements as $key => $liv) {
	if ($liv->etat_id == ETAT::ENCOURS) {
		$total++;
	}
}

?>