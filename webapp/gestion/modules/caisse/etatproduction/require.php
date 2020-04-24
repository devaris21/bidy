<?php 
namespace Home;

if ($this->getId() != "") {
	$tab = explode("@", $this->getId());
	$date1 = $tab[0];
	$date2 = $tab[1];
}else{
	$date1 = PARAMS::DATE_DEFAULT;
	$date2 = dateAjoute(1);
}

$produits = PRODUIT::getAll();
foreach ($produits as $key => $produit) {
	$produit->actualise();
	$produit->production = $produit->production($date1, $date2);
	$produit->livraison = $produit->livree($date1, $date2);
	$produit->perte = $produit->perte($date1, $date2);

	foreach (RESSOURCE::getAll() as $key => $ressource) {
		$name = trim($ressource->name());
		$produit->$name = $produit->exigence(($produit->production + $produit->perte), $ressource->getId());
		$a = "perte-$name";
		$produit->$a = $produit->exigence($produit->perte, $ressource->getId());
	}
}

$pertelivraison = round(((LIVRAISON::perte($date1, $date2) / comptage($produits, "perte", "somme")) * 100),2);


$ressources = RESSOURCE::getAll();
usort($produits, "comparerPerte");

$title = "BIDY | Etat récapitulatif des produits ";
?>