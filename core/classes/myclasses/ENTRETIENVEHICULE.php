<?php
namespace Home;
use Native\RESPONSE;
use Native\EMAIL;
use Native\ROOTER;



/**
 * 
 */
class ENTRETIENVEHICULE extends TABLE
{

	public static $tableName = __CLASS__;
	public static $namespace = __NAMESPACE__;


	public $ticket;
	public $typeentretienvehicule_id;
	public $name;
	public $vehicule_id;
	public $prestataire_id;
	public $price;
	public $started;
	public $finished;
	public $gestionnaire_id;
	public $etat_id = 0;
	public $date_approuve; 
	public $image; 
	public $comment; 



	public function enregistre(){
		$data = new RESPONSE;
		$datas = TYPEENTRETIENVEHICULE::findBy(["id ="=>$this->typeentretienvehicule_id]);
		if (count($datas) == 1) {
			$item = $datas[0];
			$this->name = $item->name;
			$datas = VEHICULE::findBy(["id ="=>$this->vehicule_id]);
			if (count($datas) == 1) {
				$this->ticket = strtoupper(substr(uniqid(), 5, 6));
					// TODO verifier les dates
					// TODO champ pour rejouter au commentaire quand ca vient des demandes d'entretien
				$this->gestionnaire_id = getSession("gestionnaire_connecte_id");
				$data = $this->save();
				if ($data->status) {
					$this->uploading($files);
				}
			}else{
				$data->status = false;
				$data->message = "Une erreur s'est produite lors de l'opération b, veuillez recommencer !";
			}
		}else{
			$data->status = false;
			$data->message = "Une erreur s'est produite lors de l'opération n, veuillez recommencer !";
		}		
		return $data;
	}


	public function uploading(Array $files){
		if (isset($this->image1) && $this->image1["tmp_name"] != "") {
			$image = new FICHIER();
			$image->hydrater($this->image1);
			if ($image->is_image()) {
				$a = substr(uniqid(), 5);
				$result = $image->upload("images", "entretienvehicules", $a);
				$this->image1 = $result->filename;
				$this->save();
			}
		}
		if (isset($this->image2) && $this->image2["tmp_name"] != "") {
			$image = new FICHIER();
			$image->hydrater($this->image2);
			if ($image->is_image()) {
				$a = substr(uniqid(), 5);
				$result = $image->upload("images", "entretienvehicules", $a);
				$this->image2 = $result->filename;
				$this->save();
			}
		}
	}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/// 

	public static function commencerCeMois(){
		return static::findBy(["started >="=>date("Y-m")."-01", "started < "=>date("Y")."-".(date("m")+1)."-01"]);
	}

	public static function annuleesCeMois(){
		return static::findBy(["etat_id ="=>-1, "date_approuve >="=>date("Y-m")."-01"]);
	}

	public static function coutAnnuel(){
		return comptage(static::findBy(["DATE(started) >= "=> date("Y")."-01-01"]), "price", "somme");
	}



	public function approuver(){
		$data = new RESPONSE;
		$rooter = new ROOTER;
		$this->etat_id = 2;
		$this->date_approuve = date("Y-m-d H:i:s");
		$this->historique("Approbation de la demande d'entretien de véhicule N° $this->id");
		$data = $this->save();
		if ($data->status) {
			$this->actualise();
			$message = "L'entretien pour le véhicule ".$this->vehicule->marque->name." ".$this->vehicule->modele." immatriculé ".$this->vehicule->immatriculation." a été effectué avec succes! Veuillez contacter le responsable/gestion du parc automobile pour plus de précision!";
			$image = $rooter->stockage("images", "vehicules", $this->vehicule->image);
			$objet = "Demande d'entretien de véhicule approuvé";

			ob_start();
			include(__DIR__."/../../sections/home/elements/mails/demandeentretien1.php");
			$contenu = ob_get_contents();
			ob_end_clean();
			//EMAIL::send([$this->email()], $objet, $contenu);
			session("demandeentretien", $this);
		}
		return $data;
	}
	

	public function refuser(){
		$data = new RESPONSE;
		$rooter = new ROOTER;
		$this->etat_id = -1;
		$this->date_approuve = date("Y-m-d H:i:s");
		$this->historique("Echec de l'entretien de véhicule N° $this->id");
		$data = $this->save();
		if ($data->status) {
			$this->actualise();
			$message = "L'entretien pour le véhicule ".$this->vehicule->marque->name." ".$this->vehicule->modele." immatriculé ".$this->vehicule->immatriculation." n'a pas abouti !<br> Veuillez contacter le responsable/gestion du parc automobile pour plus de précision";
			$image = $rooter->stockage("images", "vehicules", $this->vehicule->image);
			$objet = "Entretien de véhicule échoué!";

			ob_start();
			include(__DIR__."/../../sections/home/elements/mails/demandeentretien1.php");
			$contenu = ob_get_contents();
			ob_end_clean();
			//EMAIL::send([$this->email()], $objet, $contenu);
		}
		return $data;
	}




	public static function encours(){
		return static::findBy(["etat_id ="=>0]);
	}



	public function sentenseCreate(){}
	public function sentenseUpdate(){}
	public function sentenseDelete(){}

}



?>