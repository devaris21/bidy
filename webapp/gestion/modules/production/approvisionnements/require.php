<?php 
namespace Home;

unset_session("ressources");

$title = "BRIXS | Toutes les approvisionnements en cours";

$encours = APPROVISIONNEMENT::findBy(["etat_id ="=>ETAT::ENCOURS], [], ["created"=>"DESC"]);

$datas = APPROVISIONNEMENT::findBy(["etat_id !="=>ETAT::ENCOURS, "DATE(created) >="=>$date1, "DATE(created) <="=>$date2], [], ["created"=>"DESC"]);

?>