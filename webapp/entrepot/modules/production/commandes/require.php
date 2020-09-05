<?php 
namespace Home;

$title = "BRIXS | Toutes les commandes en cours";

$produits = PRODUIT::getAll();

GROUPECOMMANDE::etat();
$groupes = GROUPECOMMANDE::encours();

?>