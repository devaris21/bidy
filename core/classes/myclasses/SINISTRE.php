<?php
namespace Home;
use Native\RESPONSE;
use Native\EMAIL;
use Native\ROOTER;
use Native\FICHIER;



/**
 * 
 */
class SINISTRE extends TABLE
{

	public static $tableName = __CLASS__;
	public static $namespace = __NAMESPACE__;


	public $ticket;
	public $typesinistre_id;
	public $vehicule_id;
	public $date_etablissement; 
	public $comment;
	public $matricule;
	public $fullname;
	public $gestionnaire_id;
	public $chauffeur_id = null;
	public $carplan_id = null;
	public $lieudrame;
	public $image1;
	public $image2;
	public $image3;
	public $etat_id = 0;
	public $date_approbation = null;

	public $constat;
	public $pompiers = 0;
	public $nomautre;
	public $contactautre;
	public $vehiculeautre;
	public $assuranceautre;
	public $immatriculationautre;


	public function enregistre(){
		$data = new RESPONSE;
		$datas = VEHICULE::findBy(["id ="=>$this->vehicule_id]);
			if (count($datas) == 1) {
				$this->ticket = strtoupper(substr(uniqid(), 5, 6));
				$this->gestionnaire_id = getSession("gestionnaire_connecte_id");
				$data = $this->save();
				if ($data->status) {
					$this->uploading($this->files);
				}
				$data->message = "La déclaration de sinistre a été enregistré avec succes !";
			}else{
				$data->status = false;
				$data->message = "Une erreur s'est produite lors de l'opération, veuillez recommencer !";
			}		
		return $data;
	}


	public function uploading(Array $files){
		if (isset($this->image1) && $this->image1["tmp_name"] != "") {
			$image = new FICHIER();
			$image->hydrater($this->image1);
			if ($image->is_image()) {
				$a = substr(uniqid(), 5);
				$result = $image->upload("images", "sinistres", $a);
				$this->image1 = $result->filename;
				$this->save();
			}
		}
		if (isset($this->image2) && $this->image2["tmp_name"] != "") {
			$image = new FICHIER();
			$image->hydrater($this->image2);
			if ($image->is_image()) {
				$a = substr(uniqid(), 5);
				$result = $image->upload("images", "sinistres", $a);
				$this->image2 = $result->filename;
				$this->save();
			}
		}
		if (isset($this->image3) && $this->image3["tmp_name"] != "") {
			$image = new FICHIER();
			$image->hydrater($this->image3);
			if ($image->is_image()) {
				$a = substr(uniqid(), 5);
				$result = $image->upload("images", "sinistres", $a);
				$this->image3 = $result->filename;
				$this->save();
			}
		}
	}



	public function constat(){
		if ($this->constat == 0) {
			return "Constat à l'amiable";
		}else{
			return "Intervention de la police";
		}
	}

	public function pompier(){
		if ($this->pompiers == 1) {
			return "Intervention des sapeurs pompiers";
		}
	}


	public function auteur(){
		$this->actualise();
		if ($this->carplan_id != null) {
			return $this->carplan->name." ".$this->carplan->lastname;
		}else{
			return $this->fullname;
		}
	}

	public function contact(){
		$this->actualise();
		if ($this->chauffeur_id == null) {
			return $this->carplan->contact;
		}else{
			return $this->chauffeur->contact." - ".$this->chauffeur->contact2;
		}
	}

	public function email(){
		$this->actualise();
		if ($this->chauffeur_id == null) {
			return $this->carplan->email;
		}else{
			return $this->chauffeur->email;
		}
	}


	public function fonction(){
		$this->actualise();
		if ($this->chauffeur_id == null) {
			return "Véhicule affecté";
		}else{
			return "Chauffeur ARTCI";
		}
	}




	public static function encours(){
		return static::findBy(["etat_id ="=>0]);
	}

	public static function valideesCeMois(){
		return static::findBy(["etat_id ="=>1, "date_approbation >="=>date("Y-m")."-01"]);
	}

	public static function annuleesCeMois(){
		return static::findBy(["etat_id ="=>-1, "date_approbation >="=>date("Y-m")."-01"]);
	}



	public function approuver(){
		$data = new RESPONSE;
		$rooter = new ROOTER;
		$this->etat_id = 1;
		$this->date_approbation = date("Y-m-d H:i:s");
		$this->historique("Approbation de la demande d'entretien de véhicule N° $this->id");
		$data = $this->save();
		if ($data->status) {
			$this->actualise();
			$message = "Votre declaration de sinistre pour la ".$this->vehicule->marque->name." ".$this->vehicule->modele." immatriculé ".$this->vehicule->immatriculation." a bien été prise en compte et approuver par la gestion du parc automobile de l'ARTCI !";
			$image = $rooter->stockage("images", "vehicules", $this->vehicule->image);
			$objet = "Déclaration de sinistre approuvée";

			ob_start();
			include(__DIR__."/../../sections/home/elements/mails/sinistre.php");
			$contenu = ob_get_contents();
			ob_end_clean();
			// TODO gerer les emails
			//EMAIL::send([$this->email()], $objet, $contenu);
			session("sinistre", $this);
		}
		return $data;
	}

	public function refuser(){
		$data = new RESPONSE;
		$rooter = new ROOTER;
		$this->etat_id = -1;
		$this->date_approbation = date("Y-m-d H:i:s");
		$this->historique("Refus de la demande d'entretien de véhicule N° $this->id");
		$data = $this->save();
		if ($data->status) {
			$this->actualise();
			$message = "Votre declaration de sinistre pour la ".$this->vehicule->marque->name." ".$this->vehicule->modele." immatriculé ".$this->vehicule->immatriculation." a bien été refusé par la gestion du parc automobile de l'ARTCI !";
			$image = $rooter->stockage("images", "vehicules", $this->vehicule->image);
			$objet = "Déclaration de sinistre refusée";

			ob_start();
			include(__DIR__."/../../sections/home/elements/mails/sinistre.php");
			$contenu = ob_get_contents();
			ob_end_clean();
			// TODO gerer les emails
			//EMAIL::send([$this->email()], $objet, $contenu);
		}
		return $data;
	}


	public function sentenseCreate(){}
	public function sentenseUpdate(){}
	public function sentenseDelete(){}

}



?>