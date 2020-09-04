<?php 
namespace Home;

$date1 = getSession("date1");
$date2 = getSession("date2");

$produits = PRODUIT::getAll();


$title = "BRIXS | Stock de la production ";
?>