<?php
namespace Home;
use Native\RESPONSE;
use Native\FICHIER;
use \DateTime;
use \DateInterval;
/**
/**
 * 
 */
class CHAUFFEUR extends PERSONNE
{
	public static $tableName = __CLASS__;
	public static $namespace = __NAMESPACE__;

	public $matricule;
	public $name;
	public $lastname;
	public $nationalite;
	public $adresse;
	public $sexe_id;
	public $typepermis;	
	public $numero_permis;
	public $date_fin_permis;
	public $email;
	public $contact;
	public $image = "default.png";
	public $etatchauffeur_id;



	public function enregistre(){
		$data = new RESPONSE;
		if ($this->name ) {
			$data = $this->save();
			if ($data->status) {
				$this->uploading($files);
			}
		}else{
			$data->status = false;
			$data->message = "Veuillez le login et le mot de passe du nouvel employé !";
		}
		return $data;
	}


	public function uploading(Array $files){
		if (isset($this->image) && $this->image["tmp_name"] != "") {
			$image = new FICHIER();
			$image->hydrater($this->image);
			if ($image->is_image()) {
				$a = substr(uniqid(), 5);
				$result = $image->upload("images", "chauffeurs", $a);
				$this->image = $result->filename;
				$this->save();
			}
		}
	}




	public static function etat(){
		$requette = "UPDATE chauffeur SET etatchauffeur_id = 1";
		static::query($requette, []);
		$requette = "SELECT * FROM chauffeur WHERE chauffeur.id NOT IN (SELECT mission.chauffeur_id FROM mission WHERE etat_id = 1)";
		$datas =  static::execute($requette, []);
		foreach ($datas as $key => $chauffeur) {
			$chauffeur->etatchauffeur_id = 0;
			$chauffeur->save();
		}
	}


	public static function open(){
		$datas = static::etat();
		return static::getAll(["etatchauffeur_id =" => 0]);
	}


	public function sentenseCreate(){
		return $this->sentense = "Ajout d'un nouveau chauffeur dans votre gestion : $this->name $this->lastname";
	}


	public function sentenseUpdate(){
		return $this->sentense = "Modification des informations du chauffeur N°$this->id : $this->name $this->lastname.";
	}


	public function sentenseDelete(){
		return $this->sentense = "Suppression définitive du chauffeur N°$this->id : $this->name $this->lastname.";
	}



}

?>