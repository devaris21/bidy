<?php 

namespace Home;

if ($this->getId() != null) {
	$datas = OPERATION::findBy(["id ="=> $this->getId()]);
	if (count($datas) > 0) {
		$operation = $datas[0];
		$operation->actualise();

		$title = "BIDY | Bon de caisse ";
		
	}else{
		header("Location: ../master/clients");
	}
}else{
	header("Location: ../master/clients");
}

?>