<?php 
namespace Home;

$groupes = GROUPEMANOEUVRE::getAll();
foreach ($groupes as $key => $value) {
	$value->fourni("manoeuvre");
}

$title = "BIDY | Le personnel";
?>