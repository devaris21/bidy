<?php 
namespace Home;
require '../../../../../core/root/includes.php';

use Native\RESPONSE;

$data = new RESPONSE;
extract($_POST);


if ($action == "filtrer") {
	session("date1", $date1);
	session("date2", $date2);

	$data->setUrl("gestion", "production", "production");
	echo json_encode($data);
}

?>