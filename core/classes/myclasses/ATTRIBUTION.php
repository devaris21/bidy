<?php
namespace Home;
use Native\RESPONSE;
use Native\EMAIL;
use \DateTime;
/**
 * La classe PERSONNE herite deja de la classe TABLE 
 */

class ATTRIBUTION extends TABLE
{

	public static $tableName = __CLASS__;
	public static $namespace = __NAMESPACE__;

	public $commande_id;
	public $livreur_id;
	public $entrepriselivreur_id;
	public $etat_id = 0;



	public function enregistre(){
		return $this->save();
	}



	public function sentenseCreate(){}


	public function sentenseUpdate(){
		return $this->sentense = "Modification de la demande de révélé de compte du client ".$this->client->name." ".$this->client->lastname;
	}


	public function sentenseDelete(){}


}


?>