<?php 
namespace Home;


$title = "BIDY | Historiques & Traçabilité ";

$notifications = NOTIFICATION::findBy(["admin ="=>1, "etat_id ="=>0]);


?>