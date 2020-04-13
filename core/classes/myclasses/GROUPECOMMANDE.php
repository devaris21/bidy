<?php
namespace Home;
use Native\RESPONSE;/**
 * 
 */
class GROUPECOMMANDE extends TABLE
{

	public static $tableName = __CLASS__;
	public static $namespace = __NAMESPACE__;

	public $client_id;
	public $etat_id = 0;
	

	public function enregistre(){
		return $data = $this->save();
	}


	public static function etat(){
		foreach (static::findBy(["etat_id ="=>0]) as $key => $groupe) {
			$test = false;
			$datas = $groupe->fourni("lignegroupecommande");
			foreach ($datas as $key => $ligne) {
				if ($ligne->quantite > 0) {
					$test = true;
					break;
				}
			}
			if (!$test) {
				$groupe->etat_id = ETAT::VALIDEE;
				$groupe->save();
			}
		}
	} 

	public static function encours(){
		return static::findBy(["etat_id ="=>0]);
	}


	public function sentenseCreate(){}
	public function sentenseUpdate(){}
	public function sentenseDelete(){}


}
?>