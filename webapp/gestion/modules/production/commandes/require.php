<?php 
namespace Home;

$title = "BIDY | Toutes les commandes en cours";

GROUPECOMMANDE::etat();
$groupes = GROUPECOMMANDE::encours();


?>