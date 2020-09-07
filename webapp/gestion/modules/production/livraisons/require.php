<?php 
namespace Home;

$title = "BRIXS | Toutes les livraisons en cours";

$encours = LIVRAISON::findBy(["etat_id ="=>ETAT::ENCOURS], [], ["created"=>"DESC"]);

$datas = LIVRAISON::findBy(["etat_id !="=>ETAT::ENCOURS, "DATE(created) >="=>$date1, "DATE(created) <="=>$date2], [], ["created"=>"DESC"]);


?>