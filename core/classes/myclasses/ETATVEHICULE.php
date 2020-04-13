<?php
namespace Home;
use Native\RESPONSE;/**
 * 
 */
class ETATVEHICULE extends TABLE
{

	public static $tableName = __CLASS__;
	public static $namespace = __NAMESPACE__;

	const ANNULEE = -1;
	const RAS = 0;
	const ENTRETIEN = 1;
	const MISSION = 2;


	public $name;
	public $class;

	public function enregistre(){}


	public function sentenseCreate(){}
	public function sentenseUpdate(){}
	public function sentenseDelete(){}

}
?>