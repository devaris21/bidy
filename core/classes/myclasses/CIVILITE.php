<?php
namespace Home;
use Native\RESPONSE;/**
 * 
 */
class CIVILITE extends TABLE
{

	public static $tableName = __CLASS__;
	public static $namespace = __NAMESPACE__;

	public $name;
	public $abbreviation;

	public function enregistre(){
		$data = new RESPONSE;
		if ($this->name != "") {
			if ($this->abbreviation != "") {
				$data = $this->save();
			}else{
				$data->status = false;
				$data->message = "Veuillez renseigner l'abbreviation de la civilité !";
			}
		}else{
			$data->status = false;
			$data->message = "Veuillez renseigner le libéllé de la civilité !";
		}
		return $data;
	}



		public function sentenseCreate(){
			return $this->sentense = "Ajout d'un nouveau civilité : $this->name dans les paramétrages";
	}
	public function sentenseUpdate(){
			return $this->sentense = "Modification des informations du civilité $this->id : $this->name ";
	}
	public function sentenseDelete(){
			return $this->sentense = "Suppression definitive du civilité $this->id : $this->name";
	}
}
?>