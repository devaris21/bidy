<?php
namespace Home;
use Native\RESPONSE;
use Native\FICHIER;
/**
 * 
 */
class EQUIPEMENT_VEHICULE extends TABLE
{
	public static $tableName = __CLASS__;
	public static $namespace = __NAMESPACE__;

	public $vehicule_id;
	public $equipement_id;
	public $quantite = 0;
	public $gestionnaire_id;



	public function enregistre(){
		$data = new RESPONSE;
		$datas = VEHICULE::findBy(["id ="=>$this->vehicule_id]);
		if (count($datas) == 1) {
			$datas = EQUIPEMENT::findBy(["id ="=>$this->equipement_id]);
			if (count($datas) == 1) {
				$equip = $datas[0];
				$data = $equip->destock($this->quantite);
				if ($data->status) {
					$this->gestionnaire_id = getSession("gestionnaire_connecte_id");
					$data = $this->save();
				}
			}else{
				$data->status = false;
				$data->message = "Une eurreur s'est produite pendant le processus, veuillez recommencer !";
			}
		}else{
			$data->status = false;
			$data->message = "Une eurreur s'est produite pendant le processus, veuillez recommencer !";
		}
		return $data;
	}



	public function retirer(){
		$this->actualise();
		$this->equipement->stock += $this->quantite;
		$data = $this->equipement->save();
		if ($data->status) {
			$data = $this->delete();
		}
		return $data;
	}



	public function sentenseCreate(){
		return $this->sentense = "Equipement de la ".$this->vehicule->marque->name." ".$this->vehicule->modele." avec l'equipement ".$this->equipement->name;
	}


	public function sentenseUpdate(){
		return $this->sentense = "Modification des infos de l'equipement N°$this->id  $this->name .";
	}


	public function sentenseDelete(){
		return $this->sentense = "On a retiré l'equipement ".$this->equipement->name." sur de la ".$this->vehicule->marque->name." ".$this->vehicule->modele;
	}

}



?>