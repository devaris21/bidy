<?php 
namespace Home;

GROUPECOMMANDE::etat();

$title = "BIDY | Tableau de bord";

$tableau = [];
foreach (PRODUIT::getAll() as $key => $prod) {
	$data->name = $prod->name();
	$data->stock = $prod->stock(dateAjoute());
	$data->commande = $prod->livrable();
	$tableau[] = $data;
}

?>