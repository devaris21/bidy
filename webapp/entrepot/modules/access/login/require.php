<?php 
namespace Home;

@session_destroy();
unset($_GET);
unset($_POST);

$params = PARAMS::findLastId();

$title = "BRIXS | Espace de connexion";
?>