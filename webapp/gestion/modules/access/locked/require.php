<?php 
namespace Home;
$title = "BIDY | Session vérouillée ";

$datas = GESTIONNAIRE::findBy(["id = "=>getSession("gestionnaire_connecte_id")]);
if (count($datas) >0) {
	$gestionnaire = $datas[0];
	$gestionnaire->actualise();
	session("page_session", 1);
}else{
	header("Location: ../master/parcauto");
}

?>