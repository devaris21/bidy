<?php
namespace Home;
require '../../vendor/autoload.php';

$datas = GESTIONNAIRE::findBy([" id= "=>getSession("gestionnaire_connecte_id")]);
if (count($datas) == 1) {
	$gestionnaire = $datas[0];
	$gestionnaire->se_deconnecter();
}


session_destroy();
unset($_GET);
unset($_POST);

header("Location: ../access/login");

?>