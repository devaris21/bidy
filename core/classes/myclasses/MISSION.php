<?php
namespace Home;
use Native\RESPONSE;
use Native\EMAIL;



/**
 * 
 */
class MISSION extends TABLE
{

	public static $tableName = __CLASS__;
	public static $namespace = __NAMESPACE__;


	public $reference;
	public $demandevehicule_id;
	public $departement_id;
	public $lieu;
	public $objet;
	public $comment;
	public $carburant;
	public $dotation;
	public $started;
	public $finished;
	public $vehicule_id;
	public $chauffeur_id;
	public $etat_id = 0;
	public $gestionnaire_id;


	public function enregistre(){
		$data = new RESPONSE;
		if ($this->started <= $this->finished && $this->finished >= dateAjoute()) {
			$datas = DEMANDEVEHICULE::findBy(["id ="=>$this->demandevehicule_id]);
			if (count($datas) == 1) {
				$data = $this->save();
				if ($data->status) {
					$this->actualise();
					$this->reference = $data->lastid."/".date("Y")."/".$this->departement->sigle;
					$this->save();

					$this->setId($data->lastid)->actualise();
					$params = PARAMS::findLastId();

					// $message = "Une nouvelle mission a été enregistrée suite à l'approbation générale de la demande de véhicule N°$this->id pour ".$this->demandevehicule->typedemandevehicule->name." faite par ".$this->demandevehicule->auteur();
					// ob_start();
					// include(__DIR__."/../../sections/home/elements/mails/mission.php");
					// $contenu = ob_get_contents();
					// ob_end_clean();
					// EMAIL::send(GESTIONNAIRE::getEmailGestionnaires(), "Approbation d'une nouvelle mission", $contenu);


					// $message = "Nous vous informons de la nouvelle mission suite à l'approbation générale de votre demande de véhicule N°$this->id pour ".$this->demandevehicule->typedemandevehicule->name;
					// ob_start();
					// include(__DIR__."/../../sections/home/elements/mails/missionuser.php");
					// $contenu = ob_get_contents();
					// ob_end_clean();
					// EMAIL::send([$this->demandevehicule->email()], "Approbation votre mission", $contenu);
				}
			}else{
				$data->status = false;
				$data->message = "1 Une erreur s'est produite lors de l'opération, veuillez recommencer !";
			}
		}else{
			$data->status = false;
			$data->message = "Les dates pour la période de demande ne sont correctes !";
		}
		return $data;
	}



	public static function commencerCeMois(){
		return static::findBy(["started >="=>date("Y-m")."-01", "started < "=>date("Y")."-".(date("m")+1)."-01"]);
	}

	public static function annuleesCeMois(){
		return static::findBy(["etat_id ="=>-1, "date_approuve >="=>date("Y-m")."-01"]);
	}


	public static function encours(){
		return static::findBy(["etat_id ="=>0]);
	}

	public function terminer(){
		$data = new RESPONSE;
		if ($this->etat_id != 0) {
			$this->etat_id = 1;
			$this->date_approuve = date("Y-m-d H:i:s");
			$this->historique("La mission en reference $this->reference vient d'etre declaré comme 'terminée' !");
			$data = $this->save();
		}else{
			$data->status = false;
			$data->message = "Vous ne pouvez plus faire cette opération sur cette mission !";
		}
		return $data;
	}


	public function annuler(){
		$data = new RESPONSE;
		if ($this->etat_id != 0) {
			$this->etat_id = -1;
			$this->date_approuve = date("Y-m-d H:i:s");
			$this->historique("La mission en reference $this->reference vient d'être annulée !");
			$data = $this->save();
		}else{
			$data->status = false;
			$data->message = "Vous ne pouvez plus faire cette opération sur cette mission !";
		}
		return $data;
	}


	public function sentenseCreate(){
		return $this->sentence = "Génération d'une nouvelle mission suite à l'approbation générale de la demande de véhicule N°$this->id";
	}

	public function sentenseUpdate(){}
	public function sentenseDelete(){}

}



?>