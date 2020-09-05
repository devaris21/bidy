<?php 

namespace Home;

if ($this->getId() != null) {
	$datas = ZONELIVRAISON::findBy(["id ="=> $this->getId()]);
	if (count($datas) > 0) {
		$zone = $datas[0];
		$zone->actualise();

		$title = "BRIXS | Proforma de prix ";
		
	}else{
		header("Location: ../production/livraisons");
	}
}else{
	header("Location: ../production/livraisons");
}

?>