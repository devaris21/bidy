<?php 
namespace Home;

$title = "BRIXS | Programmation des livraisons";

$encours = LIVRAISON::findBy(["etat_id ="=>ETAT::PARTIEL], [], ["created"=>"DESC"]);


?>