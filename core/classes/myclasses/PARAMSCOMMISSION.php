<?php
namespace Home;
use Native\RESPONSE;
/**
 * 
 */
class PARAMSCOMMISSION extends TABLE
{
	public static $tableName = __CLASS__;
	public static $namespace = __NAMESPACE__;

	public $typecommande_id;
	public $valeur;
	public $is_pourcentage;
	public $minimum;


	public function enregistre(){
		return  $this->save();
	}



	public function sentenseCreate(){}
	public function sentenseUpdate(){}
	public function sentenseDelete(){}

}



?>