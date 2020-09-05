<?php 
namespace Home;

$date1 = getSession("date1");
$date2 = getSession("date2");

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

$perte = comptage($produits, "perte", "somme");
if ($perte > 0) {
	$pertelivraison = round(((LIVRAISON::perte($date1, $date2) / $perte) * 100),2);
}else{
	$pertelivraison = 0;
}

$productions = PRODUCTIONJOUR::findBy(["ladate >="=>$date1, "ladate <= "=>$date2]);

$tricycles = LIVRAISON::findBy(["DATE(datelivraison) >="=>$date1, "DATE(datelivraison) <= "=>$date2, "etat_id ="=>ETAT::VALIDEE, "vehicule_id ="=>VEHICULE::TRICYCLE]);


$ressources = RESSOURCE::getAll();
usort($produits, "comparerPerte");

$title = "BRIXS | Etat récapitulatif des produits ";
?>