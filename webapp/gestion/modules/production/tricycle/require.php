<?php 
namespace Home;

$title = "BRIXS | Toutes les livraisons par tricycle en cours";

$encours = LIVRAISON::findBy(["vehicule_id ="=>VEHICULE::TRICYCLE, "etat_id ="=>ETAT::VALIDEE, "reste > "=>0]);

?>