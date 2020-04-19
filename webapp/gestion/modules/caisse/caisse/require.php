<?php 
namespace Home;
$operations = OPERATION::findBy(["DATE(created) >= "=> dateAjoute(-7)]);

$statistiques = OPERATION::statistiques();

$title = "BIDY | Compte de caisse";
?>