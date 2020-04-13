<?php
namespace Home;
use Native\RESPONSE;/**
 * 
 */
class GROUPEVEHICULEOPEN extends TABLE
{

	public static $tableName = __CLASS__;
	public static $namespace = __NAMESPACE__;

	public $groupevehicule_id;

	public function enregistre(){
		$data = new RESPONSE;
		$datas = GROUPEVEHICULE::findBy(["id ="=>$this->groupevehicule_id]);
			if (count($datas) == 1) {
				$data = $this->save();
			}else{
				$data->status = false;
				$data->message = "Une erreur s'est produite lors de l'opération, veuillez recommencer !";
			}		
		return $data;
	}


	public static function get(){
		$tab = [];
		foreach (static::getAll() as $key => $value) {
			$tab[] = $value->groupevehicule_id;
		}		
		return $tab;
	}


	public function sentenseCreate(){
		return $this->sentense = "Ajout d'un nouveau type d'equipement de vehicule : $this->name dans les paramétrages";
	}
	public function sentenseUpdate(){
		return $this->sentense = "Modification des informations du type d'equipement de vehicule $this->id : $this->name ";
	}
	public function sentenseDelete(){
		return $this->sentense = "Suppression definitive du type d'equipement de vehicule $this->id : $this->name";
	}


}
?>