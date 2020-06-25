<?php 
namespace Home;

unset_session("ressources");

$title = "BRIXS | Toutes les livraisons en cours";

$approvisionnements = APPROVISIONNEMENT::encours();
$total = count($approvisionnements);

?>