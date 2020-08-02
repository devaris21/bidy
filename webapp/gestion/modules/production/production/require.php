<?php 
namespace Home;

$date1 = getSession("date1");
$date2 = getSession("date2");

$produits = PRODUIT::getAll();

$productionjours = PRODUCTIONJOUR::findBy(["DATE(created) >="=>$date1, "DATE(created) <="=>$date2],[],["ladate"=>"DESC"]);
usort($productionjours, 'comparerLadate');

$title = "BRIXS | Stock de la production ";
?>