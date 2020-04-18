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
class MANOEUVRE extends PERSONNE
{
	public static $tableName = __CLASS__;
	public static $namespace = __NAMESPACE__;

	public $groupemanoeuvre_id;
	public $name;
	public $adresse;
	public $contact;
	public $image = "default.png";
	public $etatmanoeuvre_id;



	public function enregistre(){
		$data = new RESPONSE;
		if ($this->name ) {
			$data = $this->save();
			if ($data->status) {
				$this->uploading($this->files);
			}
		}else{
			$data->status = false;
			$data->message = "Veuillez le login et le mot de passe du nouvel employé !";
		}
		return $data;
	}



	public function uploading(Array $files){
		//les proprites d'images;
		$tab = ["image"];
		if (is_array($files) && count($files) > 0) {
			$i = 0;
			foreach ($files as $key => $file) {
				if ($file["tmp_name"] != "") {
					$image = new FICHIER();
					$image->hydrater($file);
					if ($image->is_image()) {
						$a = substr(uniqid(), 5);
						$result = $image->upload("images", "manoeuvres", $a);
						$name = $tab[$i];
						$this->$name = $result->filename;
						$this->save();
					}
				}	
				$i++;			
			}			
		}
	}


	public function solde(){
		$total = 0;
		$datas = $this->fourni("lignepayejour");
		$total += comptage($datas, 'montant', "somme");

		$datas = $this->fourni("operation", ["categorieoperation_id ="=> CATEGORIEOPERATION::PAYE]);
		$total -= comptage($datas, 'montant', "somme");
		return $total;
	}


	public function payer(int $montant, int $modepayement_id){
		$data = new RESPONSE;
		$solde = $this->solde();
		if ($solde > 0) {
			if ($solde >= $montant) {
				if ($modepayement_id != MODEPAYEMENT::PRELEVEMENT_ACOMPTE) {
					$payement = new OPERATION();
					$payement->categorieoperation_id = CATEGORIEOPERATION::PAYE;
					$payement->modepayement_id = $modepayement_id;
					$payement->montant = $montant;
					$payement->manoeuvre_id = $this->getId();
					$payement->comment = "Réglement de la paye de ".$this->name();
					$data = $payement->enregistre();
				}else{
					$data->status = false;
					$data->message = "Vous ne pouvez pas utiliser ce mode de payement pour effectuer cette opération !";
				}
			}else{
				$data->status = false;
				$data->message = "Le montant à verser est plus élévé que sa paye !";
			}
		}else{
			$data->status = false;
			$data->message = "Vous etes déjà à jour pour la paye de ce manoeuvre !";
		}
		return $data;
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