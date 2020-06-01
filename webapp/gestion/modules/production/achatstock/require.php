<?php 
namespace Home;

unset_session("produits");

$title = "BRIXS | Toutes les achats de stock";

$achatstocks = ACHATSTOCK::findBy(["visibility ="=> 1]);
$total = 0;
foreach ($achatstocks as $key => $liv) {
	if ($liv->etat_id == ETAT::ENCOURS) {
		$total++;
	}
}

?>