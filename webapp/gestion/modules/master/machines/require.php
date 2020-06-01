<?php 
namespace Home;

VEHICULE::etat();
$vehicules = VEHICULE::findBy(["visibility ="=>1]);

$machines = MACHINE::getAll();


$title = "BRIXS | Le parc de vehicules et de machines ";
?>