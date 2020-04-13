<?php
namespace Home;
use Native\RESPONSE;
/**
 * 
 */
class PAYS extends TABLE
{
	public static $tableName = __CLASS__;
	public static $namespace = __NAMESPACE__;

	public $name;
	public $type;


	public function enregistre(){
		return  $this->save();
	}



	public function sentenseCreate(){}
	public function sentenseUpdate(){}
	public function sentenseDelete(){}

}



?>