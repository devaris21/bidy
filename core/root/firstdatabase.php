<?php 
namespace Home;

$datas = ["Abidjan"];
foreach ($datas as $key => $value) {
	$item = new ZONELIVRAISON();
	$item->name = $value;
	$item->protected = 1;
	$item->save();
}


$datas = ["Voiture", "Camion benne", "Tricycle", "Moto"];
foreach ($datas as $key => $value) {
	$item = new TYPEVEHICULE();
	$item->name = $value;
	$item->protected = 1;
	$item->save();
}


$datas = ["Entrée de caisse", "Sortie de caisse"];
foreach ($datas as $key => $value) {
	$item = new TYPEOPERATIONCAISSE();
	$item->name = $value;
	$item->protected = 1;
	$item->save();
}

$datas = ["Accrochage", "Crevaison", "Autre"];
foreach ($datas as $key => $value) {
	$item = new TYPEENTRETIENVEHICULE();
	$item->name = $value;
	$item->protected = 1;
	$item->save();
}

$datas = ["Camion de livraison", "Véhicule de mission"];
foreach ($datas as $key => $value) {
	$item = new GROUPEVEHICULE();
	$item->name = $value;
	$item->protected = 1;
	$item->save();
}


$datas = ["Entreprise", "Particulier"];
foreach ($datas as $key => $value) {
	$item = new TYPECLIENT();
	$item->name = $value;
	$item->protected = 1;
	$item->save();
}

$datas = ["Homme", "Femme"];
foreach ($datas as $key => $value) {
	$item = new SEXE();
	$item->name = $value;
	$item->protected = 1;
	$item->save();
}


$datas = ["master", "production", "caisse", "parametres", "paye des manoeuvre", "modifier-supprimer"];
foreach ($datas as $key => $value) {
	$item = new ROLE();
	$item->name = $value;
	$item->protected = 1;
	$item->save();
}


$item = new PARAMS();
$item->societe = "Devaris 21";
$item->email = "info@devaris21.com";
$item->devise = "Fcfa";
$item->tva = 0;
$item->protected = 1;
$item->enregistre();


$item = new MYCOMPTE();
$item->identifiant = strtoupper(substr(uniqid(), 5, 7));
$item->tentative = 0;
$item->expired = dateAjoute(1);
$item->protected = 1;
$item->enregistre();


$item = new PRESTATAIRE();
$item->name = "Devaris 21";
$item->email = "info@devaris21.com";
$item->protected = 1;
$item->save();



$item = new MODEPAYEMENT();
$item->name = "Espèces";
$item->initial = "ES";
$item->etat_id = 1;
$item->protected = 1;
$item->save();

$item = new MODEPAYEMENT();
$item->name = "Prelevement sur acompte";
$item->initial = "PA";
$item->etat_id = 1;
$item->protected = 1;
$item->save();

$item = new MODEPAYEMENT();
$item->name = "Chèque";
$item->initial = "CH";
$item->etat_id = 0;
$item->protected = 1;
$item->save();

$item = new MODEPAYEMENT();
$item->name = "Virement banquaire";
$item->initial = "VB";
$item->etat_id = 0;
$item->protected = 1;
$item->save();

$item = new MODEPAYEMENT();
$item->name = "Mobile money";
$item->initial = "MM";
$item->etat_id = 0;
$item->protected = 1;
$item->save();



$item = new ETAT();
$item->name = "Annulé";
$item->class = "danger";
$item->protected = 1;
$item->save();

$item = new ETAT();
$item->name = "En cours";
$item->class = "info";
$item->protected = 1;
$item->save();

$item = new ETAT();
$item->name = "Validé";
$item->class = "primary";
$item->protected = 1;
$item->save();

$item = new ETAT();
$item->name = "Terminé";
$item->class = "success";
$item->protected = 1;
$item->save();



$item = new ETATVEHICULE();
$item->name = "RAS";
$item->class = "success";
$item->protected = 1;
$item->save();

$item = new ETATVEHICULE();
$item->name = "En mission";
$item->class = "danger";
$item->protected = 1;
$item->save();

$item = new ETATVEHICULE();
$item->name = "En panne";
$item->class = "primary";
$item->protected = 1;
$item->save();

$item = new ETATVEHICULE();
$item->name = "En entretien";
$item->class = "warning";
$item->protected = 1;
$item->save();



$item = new ETATCHAUFFEUR();
$item->name = "RAS";
$item->class = "success";
$item->protected = 1;
$item->save();

$item = new ETATVEHICULE();
$item->name = "En mission";
$item->class = "danger";
$item->protected = 1;
$item->save();

$item = new ETATCHAUFFEUR();
$item->name = "Indisponible";
$item->class = "danger";
$item->protected = 1;
$item->save();


$item = new CATEGORIEOPERATION();
$item->typeoperationcaisse_id = TYPEOPERATIONCAISSE::ENTREE;
$item->name = "Réglement de commande";
$item->protected = 1;
$item->save();

$item = new CATEGORIEOPERATION();
$item->typeoperationcaisse_id = TYPEOPERATIONCAISSE::SORTIE;
$item->name = "Réglement de facture d'approvisionnemnt";
$item->protected = 1;
$item->save();

$item = new CATEGORIEOPERATION();
$item->typeoperationcaisse_id = TYPEOPERATIONCAISSE::SORTIE;
$item->name = "Payement de salaire du personnel";
$item->protected = 1;
$item->save();

$item = new CATEGORIEOPERATION();
$item->typeoperationcaisse_id = TYPEOPERATIONCAISSE::SORTIE;
$item->name = "Réglement de facture de reparation / d'entretien";
$item->protected = 1;
$item->save();

$item = new CATEGORIEOPERATION();
$item->typeoperationcaisse_id = TYPEOPERATIONCAISSE::SORTIE;
$item->name = "Remboursement du client";
$item->protected = 1;
$item->save();



$item = new EMPLOYE();
$item->name = "Super Administrateur";
$item->adresse = "...";
$item->contact = "...";
$item->login = "root";
$item->password = "5e9795e3f3ab55e7790a6283507c085db0d764fc";
$item->protected = 1;
$data = $item->save();
foreach (ROLE::getAll() as $key => $value) {
	$tr = new ROLE_EMPLOYE();
	$tr->employe_id = $data->lastid;
	$tr->role_id = $value;
	$item->protected = 1;
	$tr->enregistre();
}



$datas = ["standart"];
foreach ($datas as $key => $value) {
	$item = new TYPETRANSMISSION();
	$item->name = $value;
	$item->protected = 1;
	$item->save();

	$item = new TYPEPRESTATAIRE();
	$item->name = $value;
	$item->protected = 1;
	$item->save();

	$item = new ENERGIE();
	$item->name = $value;
	$item->protected = 1;
	$item->save();

	$item = new TYPESUGGESTION();
	$item->name = $value;
	$item->protected = 1;
	$item->save();
}

?>