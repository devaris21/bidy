<?php 
namespace Home;

$vehicules = VEHICULE::findBy(["visibility ="=>1]);

$machines = MACHINE::getAll();


$title = "BIDY | Le parc de vehicules et de machines ";
?>