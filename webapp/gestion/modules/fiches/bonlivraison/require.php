<?php 

namespace Home;

if ($this->getId() != null) {
	$datas = LIVRAISON::findBy(["id ="=> $this->getId()]);
	if (count($datas) > 0) {
		$livraison = $datas[0];
		$livraison->actualise();

		$livraison->fourni("lignelivraison");

		$title = "BIDY | Bon de livraison ";
		
	}else{
		header("Location: ../master/clients");
	}
}else{
	header("Location: ../master/clients");
}

?>