<?php
namespace Home;
use Native\RESPONSE;
use Native\EMAIL;
use \DateTime;
/**
 * La classe PERSONNE herite deja de la classe TABLE 
 */

class RENOUVELEMENTAFFECTATION extends TABLE
{

	public static $tableName = __CLASS__;
	public static $namespace = __NAMESPACE__;

	public $affectation_id;
	public $started = "";
	public $finished = "";
	public $date_fin;
	public $etat_id = 0;
	public $gestionnaire_id;



	public function enregistre(){
		$data = new RESPONSE;
		if ($this->finished > $this->started && $this->started >= date("Y-m-d")) {
			$data = $this->save();			
		}else{
			$data->status = false;
			$data->message = "Les dates de l'affectation ne correspondent pas";
		}
		return $data;
	}


	public function etat(){
		if ($this->finished > date("Y-m-d")) {
			$this->etat_id = 0;
		}else{
			$this->etat_id = -2;
		}
		$this->save();
	}


	public function name(){
		$this->actualise();
		return $this->carplan->name." ".$this->carplan->lastname." <br> // Car plan";
	}


	public function terminer(){
		$data = new RESPONSE;
		if ($this->etat_id == 0) {
			$this->actualise();
			$this->historique("Fin de l'affectation du vehicule ".$this->affectation->vehicule->name()." à ".$this->affectation->name());
			$this->date_fin = date("Y-m-d");
			$this->etat_id = 2;
			$data = $this->save();
		}else{
			$data->status = false;
			$data->message = "Vous ne pouvez plus effectuer cette action sur cette affectation !";
		}
		return $data;
	}


	public function annuler(){
		$data = new RESPONSE;
		if ($this->etat_id == 0) {
			$this->actualise();
			$this->historique("Annulation de l'affectation du vehicule ".$this->affectation->vehicule->name()." à ".$this->affectation->name());
			$this->date_fin = date("Y-m-d");
			$this->etat_id = -1;
			$data = $this->save();
		}else{
			$data->status = false;
			$data->message = "Vous ne pouvez plus effectuer cette action sur cette affectation !";
		}
		return $data;
	}



	public function renouveler($dateA, $dateB){
		$data = new RESPONSE;
		if(date("Y-m-d") >= $this->finished){
			if ($dateA > $this->finished) {
				$data = $this->fin();
				if ($data->status) {
					$affectation = $this;
					$affectation->id = null;
					$affectation->started = date("Y-m-d"); 
					$affectation->finished = $ladate; 
					$affectation->etat_id = 0;
					$affectation->objet = "Renouvelement de la precedente affectation ";
					$affectation->gestionnaire_id = getSession("gestionnaire_connecte_id");
					$affectation->historique("On a reconduit l'affectation du vehicule ".$this->vehicule->name()." à ".$this->name()." jusqu'au ".datecourt($affectation->finished));
					$data = $affectation->save();
				}	
			}else{
				$data->status = false;
				$data->message = "La nouvelle date n'est pas plus lointaine que celle actuelle !";
			}
		}else{
			$data->status = false;
			$data->message = "L'affectation actuelle doit arriver à échéange d'abord !";
		}

		return $data;	
	}



	public function sentenseCreate(){}


	public function sentenseUpdate(){
		return $this->sentense = "Modification des informations de l'affectation N° $this->id ";
	}


	public function sentenseDelete(){
		return $this->sentense = "Suppression définitive de l'affectation N° $this->id ";

	}


}


?>