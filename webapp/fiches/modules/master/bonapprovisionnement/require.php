<?php 

namespace Home;

if ($this->getId() != null) {
	$datas = APPROVISIONNEMENT::findBy(["id ="=> $this->getId(), 'etat_id !='=>ETAT::ANNULEE]);
	if (count($datas) > 0) {
		$appro = $datas[0];
		$appro->actualise();

		$appro->fourni("ligneapprovisionnement");

		$title = "BRIXS | Fiche d'approvisionnement ";
		
	}else{
		header("Location: ../production/approvisionnements");
	}
}else{
	header("Location: ../production/approvisionnements");
}

?>