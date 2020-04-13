<?php
namespace Home;
use Native\RESPONSE;
use Native\EMAIL;
use \DateTime;
/**
 * La classe PERSONNE herite deja de la classe TABLE 
 */

class CESSION extends TABLE
{

	public static $tableName = __CLASS__;
	public static $namespace = __NAMESPACE__;

	public $utilisateur_id = null;
	public $carplan_id;
	public $comment;
	public $vehicule_id;
	public $objet;
	public $started;
	public $finished;
	public $etat_id = 0;



	public function enregistre(){
		$data = new RESPONSE;
		$this->vehicule_id = getSession("vehicule_id");
		$datas = static::findBy(["vehicule_id ="=>$this->vehicule_id, "etat_id ="=>0]);
		if (count($datas) == 0) {
			if ($this->objet != "") {
				if ($this->started >= date("Y-m-d") && $this->finished >= $this->started) {
					$datas = VEHICULE::findBy(["id ="=>$this->vehicule_id]);
					if (count($datas) == 1) {
						$datas = carplan::findBy(["id ="=>$this->carplan_id]);
						if (count($datas) == 1) {
							$this->gestionnaire_id = getSession("gestionnaire_connecte_id");
							$data = $this->save();
						}else{
							$data->status = false;
							$data->message = "Une eurreur s'est produite pendant le processus, veuillez recommencer !";
						}
					}else{
						$data->status = false;
						$data->message = "Une eurreur s'est produite pendant le processus, veuillez recommencer !";
					}
				}else{
					$data->status = false;
					$data->message = "Les dates mentionnées pour l'affectation ne sont pas correctes !";
				}
			}else{
				$data->status = false;
				$data->message = "Veuillez renseigner le nom de la nouvelle direction";
			}
		}else{
			$data->status = false;
			$data->message = "Cet vehicule est déja affecté à quelqu'un d'autre !";
		}
		return $data;
	}




	public function name(){
		$this->actualise();
		if ($this->gestionnaire_id != null) {
			return $this->gestionnaire->name." ".$this->gestionnaire->lastname." // Gestionnaire GPA";

		}elseif ($this->utilisateur_id != null) {
			return $this->utilisateur->name." ".$this->utilisateur->lastname." // Direction";

		}elseif ($this->carplan_id != null) {
			return $this->carplan->name." ".$this->carplan->lastname." // Car plan";

		}elseif ($this->prestataire_id != null) {
			return $this->prestataire->name." ".$this->prestataire->lastname." // Prestataire";
		}
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