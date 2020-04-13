<?php
namespace Home;
use Native\RESPONSE;/**
 * 
 */
class MODELE extends TABLE
{

	public static $tableName = __CLASS__;
	public static $namespace = __NAMESPACE__;

	public $name;
	public $marque_id;

	public function enregistre(){}


	public function sentenseCreate(){}
	public function sentenseUpdate(){}
	public function sentenseDelete(){}

}
?>