<?php 
//use Home\PRODUIT;
//Innitialisation des parametres de date au format français
setlocale(LC_ALL, 'fr_FR', 'fr', 'fra');
date_default_timezone_set("UTC");

use Native\ROOTER;
require_once __DIR__."/includes.php";

if (count(Home\MYCOMPTE::getAll()) == 0) {
	require_once __DIR__."/firstdatabase.php";
}

// $item = new PRODUIT();
// $item->name = "HOURDIS";
// $item->class = "Hourdis";
// $item->save();

// $item = new PRODUIT();
// $item->name = "AC 15";
// $item->class = "Agglos creux 15";
// $item->save();

// $item = new PRODUIT();
// $item->name = "AP 15";
// $item->class = "Agglos pleins 15";
// $item->save();

// $item = new PRODUIT();
// $item->name = "BTC";
// $item->class = "Briques en terre compressée";
// $item->save();


// $item = new RESSOURCE();
// $item->name = "CIMENT";
// $item->class = "Sac";
// $item->abbr = "Sacs";
// $item->save();

// $item = new RESSOURCE();
// $item->name = "SABLE";
// $item->class = "Chargement";
// $item->abbr = "Chgs";
// $item->save();

// $item = new RESSOURCE();
// $item->name = "GRAVIER";
// $item->class = "Tonne";
// $item->abbr = "T";
// $item->save();

// $item = new RESSOURCE();
// $item->name = "EAU";
// $item->class = "Litre";
// $item->abbr = "L";
// $item->save();


$rooter = new ROOTER;

$rooter->render();


?>