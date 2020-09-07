<?php
namespace Home;
use Native\RESPONSE;/**
 * 
 */
class ENTREPOT extends TABLE
{

	public static $tableName = __CLASS__;
	public static $namespace = __NAMESPACE__;

	const PRINCIPAL = 1;

	public $name;
	public $comptebanque_id;

	public function enregistre(){
		$data = new RESPONSE;
		if ($this->name != "") {
			$data = $this->save();
			if ($data->status) {
				$compte = new COMPTEBANQUE;
				$compte->name = "Compte de ".$this->name();
				$data = $compte->enregistre();
				if ($data->status) {
					$this->comptebanque_id = $data->lastid;
					$this->save();
				}
			}
		}else{
			$data->status = false;
			$data->message = "Veuillez renseigner le nom de l'entrepot !";
		}
		return $data;
	}


	public function sentenseCreate(){
		return $this->sentense = "Ajout d'un nouveau groupe de vehicule : $this->name dans les paramétrages";
	}
	public function sentenseUpdate(){
		return $this->sentense = "Modification des informations de l'entrepot $this->id : $this->name ";
	}
	public function sentenseDelete(){
		return $this->sentense = "Suppression definitive de l'entrepot $this->id : $this->name";
	}

}
?>