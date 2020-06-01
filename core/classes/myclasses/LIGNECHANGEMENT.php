<?php
namespace Home;
use Native\RESPONSE;
use Native\EMAIL;
/**
 * 
 */
class LIGNECHANGEMENT extends TABLE
{
	public static $tableName = __CLASS__;
	public static $namespace = __NAMESPACE__;

	public $changement_id;
	public $produit_id;
	public $quantite_avant;
	public $quantite_apres;



	public function enregistre(){
		$data = new RESPONSE;
		$datas = CHANGEMENT::findBy(["id ="=>$this->changement_id]);
		if (count($datas) == 1) {
			$datas = PRODUIT::findBy(["id ="=>$this->produit_id]);
			if (count($datas) == 1) {
				if ($this->quantite_avant >= 0 && $this->quantite_apres >= 0) {
					$data = $this->save();
				}else{
					$data->status = false;
					$data->message = "Les quantités ne sont pas correctes !";
				}
			}else{
				$data->status = false;
				$data->message = "Une erreur s'est produite lors de l'ajout du produit !";
			}
		}else{
			$data->status = false;
			$data->message = "Une erreur s'est produite lors de l'ajout du produit !";
		}
		return $data;
	}




	public function sentenseCreate(){
	
	}


	public function sentenseUpdate(){
		return $this->sentense = "Modification des infos de l'accessoire N°$this->id  $this->name .";
	}


	public function sentenseDelete(){
		return $this->sentense = "on a retiré le chauffeur ".$this->chauffeur->name()." sur vehicule ".$this->vehicule->marque->name." ".$this->vehicule->modele." immatriculé ".$this->vehicule->immatriculation;
	}

}



?>