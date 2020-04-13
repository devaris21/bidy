<?php
namespace Home;
use Native\RESPONSE;
/**
 * 
 */
class PROMOTION extends TABLE
{
	public static $tableName = __CLASS__;
	public static $namespace = __NAMESPACE__;

	public $name;
	public $nombre;
	public $valeur;
	public $infini;
	public $is_pourcentage;
	public $finished;


	public function enregistre(){
		return  $this->save();
	}



	public function sentenseCreate(){}
	public function sentenseUpdate(){}
	public function sentenseDelete(){}

}



?>