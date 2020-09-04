<?php 
namespace Home;

$title = "BRIXS | Rangements de la production";

$encours = PRODUCTIONJOUR::findBy(["etat_id ="=>ETAT::PARTIEL], [], ["created"=>"DESC"]);

$datas = PRODUCTIONJOUR::findBy(["etat_id ="=>ETAT::VALIDEE, "DATE(created) >="=>$date1, "DATE(created) <="=>$date2], [], ["created"=>"DESC"]);



?>