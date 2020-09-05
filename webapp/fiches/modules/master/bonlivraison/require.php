<?php 

namespace Home;

if ($this->getId() != null) {
	$datas = LIVRAISON::findBy(["id ="=> $this->getId(), 'etat_id !='=>ETAT::ANNULEE]);
	if (count($datas) > 0) {
		$livraison = $datas[0];
		$livraison->actualise();

		$livraison->fourni("lignelivraison");

		$title = "BRIXS | Bon de livraison ";
		
	}else{
		header("Location: ../production/livraisons");
	}
}else{
	header("Location: ../production/livraisons");
}

?>