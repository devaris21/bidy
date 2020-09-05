<?php 
namespace Home;

$groupes = GROUPEMANOEUVRE::getAll();
foreach ($groupes as $key => $value) {
	$value->fourni("manoeuvre");
}

CHAUFFEUR::etat();
$chauffeurs = CHAUFFEUR::findBy(["visibility ="=>1]);

$title = "BRIXS | Le personnel";
?>