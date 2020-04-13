<?php
namespace Home;
use Native\RESPONSE;
use Native\EMAIL;
/**
 * 
 */
class LOCATION extends TABLE
{
	public static $tableName = __CLASS__;
	public static $namespace = __NAMESPACE__;

	public $ticket;
	public $typelocation_id;
	public $prestataire_id = null;
	public $started;
	public $finished;
	public $comment;
	public $date_fin;
	public $etat_id = 0;

	public $vehicules;



	public function enregistre(){
		$data = new RESPONSE;
		if ($this->finished >= $this->started && $this->started >= date("Y-m-d")) {
			$this->ticket = strtoupper(substr(uniqid(), 5, 6));
			$data = $this->save();
		}else{
			$data->status = false;
			$data->message = "Les dates pour la location ne sont pas correctes  * !";
		}
		return $data;
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
		if ($this->typelocation_id == 1) {
			$this->actualise();
			return $this->prestataire->name();
		}else{
			$this->fourni("preteur");
			$preteur = $this->preteurs[0];
			return $preteur->matricule." - ".$preteur->name();
		}
	}



	public function consession(){
		$this->actualise();
		if ($this->typelocation_id == 1) {
			return $this->prestataire->name;
		}else{
			return $this->preteur->name;
		}
	}


	public function email(){
		$this->actualise();
		if ($this->typelocation_id == 1) {
			return $this->prestataire->email;
		}else{
			return $this->preteur->email;
		}
	}


	public function adresse(){
		$this->actualise();
		if ($this->typelocation_id == 1) {
			return $this->prestataire->adresse;
		}else{
			return $this->preteur->adresse;
		}
	}

	public function contact(){
		$this->actualise();
		if ($this->typelocation_id == 1) {
			return $this->prestataire->contact." // ".$this->prestataire->contact2;
		}else{
			return $this->preteur->contact." // ".$this->preteur->contact2;
		}
	}


	public function terminer(){
		$data = new RESPONSE;
		$rooter = new ROOTER;
		$this->etat_id = 1;
		$this->date_fin = date("Y-m-d H:i:s");
		$this->historique("Approbation de la demande d'entretien de véhicule N° $this->id");
		$data = $this->save();
		if ($data->status) {
			$this->actualise();
			$message = "Votre demande d'entretien de véhicule pour la ".$this->vehicule->marque->name." ".$this->vehicule->modele." immatriculé ".$this->vehicule->immatriculation." a bien été prise en compte et approuver par la gestion du parc automobile de l'ARTCI !";
			$image = $rooter->stockage("images", "vehicules", $this->vehicule->image);
			$objet = "Demande d'entretien de véhicule approuvé";

			ob_start();
			include(__DIR__."/../../sections/home/elements/mails/demandeentretien1.php");
			$contenu = ob_get_contents();
			ob_end_clean();
			//EMAIL::send([$this->email()], $objet, $contenu);
		}
		return $data;
	}
	

	public function refuser(){
		$data = new RESPONSE;
		$rooter = new ROOTER;
		$this->etat_id = -1;
		$this->date_fin = date("Y-m-d H:i:s");
		$this->historique("Refus de la demande d'entretien de véhicule N° $this->id");
		$data = $this->save();
		if ($data->status) {
			$this->actualise();
			$message = "Votre demande d'entretien de véhicule pour la ".$this->vehicule->marque->name." ".$this->vehicule->modele." immatriculé ".$this->vehicule->immatriculation." a bien été refusé par la gestion du parc automobile de l'ARTCI !";
			$image = $rooter->stockage("images", "vehicules", $this->vehicule->image);
			$objet = "Demande d'entretien de véhicule refusé";

			ob_start();
			include(__DIR__."/../../sections/home/elements/mails/demandeentretien1.php");
			$contenu = ob_get_contents();
			ob_end_clean();
			//EMAIL::send([$this->email()], $objet, $contenu);
		}
		return $data;
	}




	public function sentenseCreate(){
		return $this->sentense = "Nouvelle location de vehicule chez ".$this->prestataire->name;
	}
	public function sentenseUpdate(){}
	public function sentenseDelete(){}

}



?>