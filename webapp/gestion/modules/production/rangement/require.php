<?php 
namespace Home;

$title = "BIDY | Toutes les commandes en cours";

$productions = PRODUCTIONJOUR::findBy(["etat_id !="=>ETAT::ENCOURS]);


?>