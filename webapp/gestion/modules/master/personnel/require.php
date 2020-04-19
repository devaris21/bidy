<?php 
namespace Home;

$groupes = GROUPEMANOEUVRE::getAll();
foreach ($groupes as $key => $value) {
	$value->fourni("manoeuvre");
}

$chauffeurs = CHAUFFEUR::getAll();

$title = "BIDY | Le personnel";
?>