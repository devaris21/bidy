<?php
namespace Home;
use Native\RESPONSE;/**
 * 
 */
class ETATCHAUFFEUR extends TABLE
{


	const INDISPONIBLE = -1;
	const LIBRE = 0;
	const MISSION = 1;

	public static $tableName = __CLASS__;
	public static $namespace = __NAMESPACE__;

	public $name;
	public $class;

	public function enregistre(){}


	public function sentenseCreate(){}
	public function sentenseUpdate(){}
	public function sentenseDelete(){}

}
?>