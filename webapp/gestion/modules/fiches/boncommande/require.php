<?php 

namespace Home;

if ($this->getId() != null) {
	$datas = COMMANDE::findBy(["id ="=> $this->getId()]);
	if (count($datas) > 0) {
		$commande = $datas[0];
		$commande->actualise();

		$commande->fourni("lignecommande");

		$title = "BIDY | Bon de commande ";
		
	}else{
		header("Location: ../master/clients");
	}
}else{
	header("Location: ../master/clients");
}

?>