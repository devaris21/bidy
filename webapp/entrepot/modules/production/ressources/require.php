<?php 
namespace Home;
unset_session("ressources");
$date1 = getSession("date1");
$date2 = getSession("date2");


$ressources = RESSOURCE::getAll();

$productionjours = PRODUCTIONJOUR::findBy(["DATE(created) >="=>$date1, "DATE(created) <="=>$date2],[],["ladate"=>"DESC"]);
usort($productionjours, 'comparerLadate');

$title = "BRIXS | Stock des ressources ";
?>