<?php 
namespace Home;
unset_session("produits");
unset_session("commande-encours");

GROUPECOMMANDE::etat();


$groupes__ = GROUPECOMMANDE::encours();
// $prospections__ = PROSPECTION::findBy(["etat_id ="=>ETAT::ENCOURS, "typeprospection_id ="=>TYPEPROSPECTION::PROSPECTION]);;
// $ventecaves__ = PROSPECTION::findBy(["etat_id ="=>ETAT::ENCOURS, "typeprospection_id ="=>TYPEPROSPECTION::VENTECAVE]);
// $livraisons__ = PROSPECTION::findBy(["etat_id ="=>ETAT::ENCOURS, "typeprospection_id ="=>TYPEPROSPECTION::LIVRAISON]);
$approvisionnements__ = APPROVISIONNEMENT::encours();

$title = "BRICX | Tableau de bord";

?>