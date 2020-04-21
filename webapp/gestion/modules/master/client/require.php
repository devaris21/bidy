<?php 
namespace Home;

unset_session("produits");

if ($this->getId() != null) {
	$datas = CLIENT::findBy(["id ="=> $this->getId()]);
	if (count($datas) > 0) {
		$client = $datas[0];
		$client->actualise();

		$groupes = $client->fourni("groupecommande");

		$client->fourni("groupecommande", ["etat_id ="=>ETAT::ENCOURS]);

		$datas1 = $datas2 = [];
		foreach ($client->groupecommandes as $key => $groupecommande) {
			$datas1 = array_merge($datas1, $groupecommande->fourni("commande"));
			$datas2 = array_merge($datas2, $groupecommande->fourni("livraison"));
		}
		foreach ($datas1 as $key => $ligne) {
			$ligne->fourni("lignecommande");
			$ligne->type = "commande";
		}
		foreach ($datas2 as $key => $ligne) {
			$ligne->fourni("lignelivraison");
			$ligne->type = "livraison";
		}
		$flux = array_merge($datas1, $datas2);
		usort($flux, "comparerDateCreated");


		$fluxcaisse = $client->fourni("operation");
		usort($fluxcaisse, "comparerDateCreated2");

		$title = "BIDY | ".$client->name();

		
	}else{
		header("Location: ../master/clients");
	}
}else{
	header("Location: ../master/clients");
}
?>