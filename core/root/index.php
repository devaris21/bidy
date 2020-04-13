<?php 
//Innitialisation des parametres de date au format français
setlocale(LC_ALL, 'fr_FR', 'fr', 'fra');
date_default_timezone_set("UTC");

use Native\ROOTER;
require_once __DIR__."/includes.php";

$rooter = new ROOTER;

$rooter->render();


?>