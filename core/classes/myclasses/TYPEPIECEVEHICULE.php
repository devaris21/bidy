<?php
namespace Home;
use Native\RESPONSE;/**
 * 
 */
class TYPEPIECEVEHICULE extends TABLE
{
	public static $tableName = __CLASS__;
	public static $namespace = __NAMESPACE__;

	public $name;
	

	public function enregistre(){
		$data = new RESPONSE;
		if ($this->name != "") {
			$data = $this->save();
		}else{
			$data->status = false;
			$data->message = "Veuillez renseigner le nom de la nouvelle piece administrative";
		}
		return $data;
	}


	public function sentenseCreate(){
		return $this->sentense = "Ajout d'une nouvelle pièce administrative de vehicule : $this->name dans les paramétrages dans les paramétrages";
	}


	public function sentenseUpdate(){
		return $this->sentense = "Modification des propriétés de la pièce administrative de vehicule : $this->name.";
	}


	public function sentenseDelete(){
		return $this->sentense = "Suppression définitive de la pièce administrative de vehicule : $this->name.";
	}

}
?>