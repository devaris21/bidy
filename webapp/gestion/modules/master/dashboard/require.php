<?php 
namespace Home;

GROUPECOMMANDE::etat();

$title = "BIDY | Tableau de bord";

$tableau = [];
foreach (PRODUIT::getAll() as $key => $prod) {
	$data = new \stdclass();
	$data->name = $prod->name();
	$data->livrable = $prod->livrable();
	$data->attente = $prod->enAttente();
	$data->commande = $prod->commandee();
	$tableau[] = $data;
}

?>