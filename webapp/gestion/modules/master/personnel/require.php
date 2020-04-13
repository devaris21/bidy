<?php 
namespace Home;

VEHICULE::etat();

if ($this->getId() == "categorie") {
	$types = GROUPEVEHICULE::findBy([], [], ["name"=>"ASC"]);
	foreach ($types as $key => $type) {
		$type->fourni("vehicule", ["etatvehicule_id !="=> -2]);
		if (count($type->vehicules) < 1) {
			unset($types[$key]);
		}
	}
}elseif($this->getId() == "fabriquant"){
	$types = MARQUE::findBy([], [], ["name"=>"ASC"]);
	foreach ($types as $key => $type) {
		$type->fourni("vehicule", ["etatvehicule_id !="=> -2]);
		if (count($type->vehicules) < 1) {
			unset($types[$key]);
		}
	}
}else{
	$types = TYPEVEHICULE::findBy([], [], ["name"=>"ASC"]);
	foreach ($types as $key => $type) {
		$type->fourni("vehicule", ["etatvehicule_id !="=> -2]);
		if (count($type->vehicules) < 1) {
			unset($types[$key]);
		}
	}
}


$title = "BIDY | Tous votre Parc Auto ";
?>