<?php
namespace Home;
use Native\RESPONSE;
use Native\EMAIL;
use Native\FICHIER;
use Native\ROOTER;



/**
 * 
 */
class ENTRETIENVEHICULE extends TABLE
{

	public static $tableName = __CLASS__;
	public static $namespace = __NAMESPACE__;


	public $reference;
	public $typeentretienvehicule_id;
	public $name;
	public $vehicule_id;
	public $prestataire_id;
	public $price;
	public $started;
	public $finished;
	public $employe_id;
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
				$this->reference = strtoupper(substr(uniqid(), 5, 6));
					// TODO verifier les dates
					// TODO champ pour rejouter au commentaire quand ca vient des demandes d'entretien
				$this->employe_id = getSession("demploye_connecte_id");
				$data = $this->save();
				if ($data->status) {
					$this->uploading($this->files);
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
		//les proprites d'images;
		$tab = ["image1", "image2"];
		if (is_array($files) && count($files) > 0) {
			$i = 0;
			foreach ($files as $key => $file) {
				if ($file["tmp_name"] != "") {
					$image = new FICHIER();
					$image->hydrater($file);
					if ($image->is_image()) {
						$a = substr(uniqid(), 5);
						$result = $image->upload("images", "entretienvehicules", $a);
						$name = $tab[$i];
						$this->$name = $result->filename;
						$this->save();
					}
				}	
				$i++;			
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


	public function annuler(){
		$this->etat_id = -1;
		$this->historique("Annulation de l'entretien de véhicule N° $this->reference N°".$commande->reference);
		return $this->save();
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