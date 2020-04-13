<?php 
namespace Home;

$title = "BIDY | Tous les clients !";
$clients = CLIENT::findBy([],[],["name"=>"ASC"]);

?>