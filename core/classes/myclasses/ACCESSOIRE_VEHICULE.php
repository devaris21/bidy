<?php
namespace Home;
use Native\RESPONSE;
use Native\FICHIER;
/**
 * 
 */
class ACCESSOIRE_VEHICULE extends TABLE
{
	public static $tableName = __CLASS__;
	public static $namespace = __NAMESPACE__;

	public $vehicule_id;
	public $accessoire_id;
	public $gestionnaire_id;
	public $quantite = 0;



	public function enregistre(){
		$data = new RESPONSE;
		$this->vehicule_id = getSession("vehicule_id");
		$datas = VEHICULE::findBy(["id ="=>$this->vehicule_id]);
		if (count($datas) == 1) {
			$datas = ACCESSOIRE::findBy(["id ="=>$this->accessoire_id]);
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
		$this->accessoire->stock += $this->quantite;
		$data = $this->accessoire->save();
		if ($data->status) {
			$data = $this->delete();
		}
		return $data;
	}


	public function sentenseCreate(){
		return $this->sentense = "Nouvel accessoire sur de la ".$this->vehicule->marque->name." ".$this->vehicule->modele." : ".$this->accessoire->name;
	}


	public function sentenseUpdate(){
		return $this->sentense = "Modification des infos de l'accessoire N°$this->id  $this->name .";
	}


	public function sentenseDelete(){
		return $this->sentense = "On a retiré l'accessoire ".$this->accessoire->name." sur de la ".$this->vehicule->marque->name." ".$this->vehicule->modele;
	}

}



?>