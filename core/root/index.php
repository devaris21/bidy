<?php 
// use Home\PRODUIT;
// use Home\RESSOURCE;
//Innitialisation des parametres de date au format français
setlocale(LC_ALL, 'fr_FR', 'fr', 'fra');
date_default_timezone_set("UTC");

use Native\ROOTER;
require_once __DIR__."/includes.php";

if (count(Home\MYCOMPTE::getAll()) == 0) {
	require_once __DIR__."/firstdatabase.php";
}

// $item = new PRODUIT();
// $item->files = [];
// $item->name = "HOURDIS";
// $item->class = "Hourdis";
// $item->enregistre();

// $item = new PRODUIT();
// $item->files = [];
// $item->name = "AC 15";
// $item->class = "Agglos creux 15";
// $item->enregistre();

// $item = new PRODUIT();
// $item->files = [];
// $item->name = "AP 15";
// $item->class = "Agglos pleins 15";
// $item->enregistre();

// $item = new PRODUIT();
// $item->files = [];
// $item->name = "BTC";
// $item->class = "Briques en terre compressée";
// $item->enregistre();


// $item = new RESSOURCE();
// $item->files = [];
// $item->name = "CIMENT";
// $item->class = "Sac";
// $item->abbr = "Sacs";
// $item->enregistre();

// $item = new RESSOURCE();
// $item->files = [];
// $item->name = "SABLE";
// $item->class = "Chargement";
// $item->abbr = "Chgs";
// $item->enregistre();

// $item = new RESSOURCE();
// $item->files = [];
// $item->name = "GRAVIER";
// $item->class = "Tonne";
// $item->abbr = "T";
// $item->enregistre();

// $item = new RESSOURCE();
// $item->files = [];
// $item->name = "EAU";
// $item->class = "Litre";
// $item->abbr = "L";
// $item->enregistre();


$rooter = new ROOTER;

$rooter->render();


?>