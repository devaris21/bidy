<?php 
namespace Home;

$title = "BIDY | Tous les clients !";
$clients = CLIENT::findBy(["visibility ="=>1],[],["name"=>"ASC"]);

?>