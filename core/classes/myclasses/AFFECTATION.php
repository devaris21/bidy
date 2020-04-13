<?php
namespace Home;
use Native\RESPONSE;
use Native\EMAIL;
use \DateTime;
/**
 * La classe PERSONNE herite deja de la classe TABLE 
 */

class AFFECTATION extends TABLE
{

	public static $tableName = __CLASS__;
	public static $namespace = __NAMESPACE__;

	public $carplan_id;
	public $vehicule_id;
	public $etat_id = 0;
	public $typeaffectation_id = 0;

	public $matricule;
	public $name;
	public $lastname;
	public $fonction ;
	public $email ;
	public $contact ;

	public $comment = 0;
	public $started = "";
	public $finished = "";
	public $gestionnaire_id;



	public function enregistre(){
		$data = new RESPONSE;
		static::etat();
		if ($this->finished >= $this->started  && $this->started >= date("Y-m-d")) {
			$datas = static::findBy(["vehicule_id ="=>$this->vehicule_id, "etat_id ="=>0]);
			if (count($datas) == 0) {
				$datas = VEHICULE::findBy(["id ="=>$this->vehicule_id]);
				if (count($datas) == 1) {
					$carplan = new CARPLAN;
					$carplan->cloner($this);
					$data = $carplan->enregistre();
					if ($data->status) {
						$this->carplan_id = $data->lastid;
						$data = $this->save();
						if ($data->status) {
							$renouv = new RENOUVELEMENTAFFECTATION;
							$renouv->cloner($this);
							$renouv->affectation_id = $data->lastid;
							$renouv->gestionnaire_id = getSession("gestionnaire_connecte_id");
							$data = $renouv->enregistre();
						}
					}
				}else{
					$data->status = false;
					$data->message = "Une eurreur s'est produite pendant le processus, veuillez recommencer !";
				}
			}else{
				$data->status = false;
				$data->message = "Cet vehicule est déja affecté à quelqu'un d'autre !";
			}
		}else{
			$data->status = false;
			$data->message = "Les dates de l'affectation ne correcpondent pas";
		}
		return $data;
	}




	public static function etat(){
		foreach (static::getAll() as $key => $item) {
			$datas = RENOUVELEMENTAFFECTATION::findBy(["affectation_id ="=>$item->getId()]);
			if (count($datas) > 0) {
				$last = end($datas);
				if ($last->etat_id == 0) {
					$last->etat();
				}
				$item->etat_id = $last->etat_id;
			}else{
				$item->etat_id = -2;
			}
			$item->save();
		}
	}


	public static function delai(){
		$params = PARAMS::findLastId();
		$datas = static::findBy(["etat_id = "=>0]);
		foreach ($datas as $key => $loc) {
			if (!(dateDiffe(dateAjoute(), $loc->finished) <= $params->delai_alert) ) {
				unset($datas[$key]);
			}
		}
		return $datas;
	}

	
	public function name(){
		$this->actualise();
		return $this->carplan->name." ".$this->carplan->lastname." <br> // Car plan";
	}


	public function terminer(){
		$data = new RESPONSE;
		if ($this->etat_id == 0) {
			$datas = RENOUVELEMENTAFFECTATION::findBy(["etat_id ="=>0, "affectation_id ="=>$this->getId()], [], ["finished"=>"DESC"]);
			if (count($datas) > 0) {
				$last = end($datas);
				$data = $last->terminer();
			}else{
				$item->etat_id = -1;
				$data = $this->save();
			}
		}else{
			$data->status = false;
			$data->message = "Vous ne pouvez plus effectuer cette action sur cette affectation !";
		}
		return $data;
	}


	public function annuler(){
		$data = new RESPONSE;
		if ($this->etat_id == 0) {
			$datas = RENOUVELEMENTAFFECTATION::findBy(["etat_id ="=>0, "affectation_id ="=>$this->getId()], [], ["finished"=>"DESC"]);
			if (count($datas) > 0) {
				$last = end($datas);
				$data = $last->annuler();
			}else{
				$item->etat_id = -2;
				$data = $this->save();
			}
		}else{
			$data->status = false;
			$data->message = "Vous ne pouvez plus effectuer cette action sur cette affectation !";
		}
		return $data;
	}



	public function renouveler($started, $finished){
		$data = new RESPONSE;
		if($started >= date("Y-m-d") && $finished >= $started){
			if ($this->etat_id != 0) {
				$renouv = new RENOUVELEMENTAFFECTATION;
				$renouv->affectation_id = $this->getId();
				$renouv->started = $started;
				$renouv->finished = $finished;
				$renouv->gestionnaire_id = getSession("gestionnaire_connecte_id");
				$data = $renouv->enregistre();
				if ($data->status) {
					$this->actualise();
					$this->historique("On a reconduit l'affectation du vehicule ".$this->vehicule->name()." à ".$this->name()." du ".datecourt($started)." jusqu'au ".datecourt($finished));
					$data = $this->save();
				};	
			}else{
				$data->status = false;
				$data->message = "La présente affection est toujours en cours. Vous ne pouvez donc la renouveler !";
			}
		}else{
			$data->status = false;
			$data->message = "Veuillez un intervalle de dates correctes !";
		}

		return $data;	
	}


	public static function encours(){
		return static::findBy(["etat_id ="=>0]);
	}


	public function sentenseCreate(){
		return $this->sentense = "Nouvelle affectation de  ".$this->carplan->name." ".$this->carplan->lastname." au véhicule ".$this->vehicule->marque->name." immatriculé ". $this->vehicule->immatriculation;
	}


	public function sentenseUpdate(){
		return $this->sentense = "Modification des informations de l'affectation N° $this->id ";
	}


	public function sentenseDelete(){
		return $this->sentense = "Suppression définitive de l'affectation N° $this->id ";

	}


}


?>