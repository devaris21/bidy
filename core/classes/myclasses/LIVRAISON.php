<?php
namespace Home;
use Native\RESPONSE;/**
 * 
 */
class LIVRAISON extends TABLE
{

	public static $tableName = __CLASS__;
	public static $namespace = __NAMESPACE__;

	public $reference;
	public $groupecommande_id;
	public $zonelivraison_id;
	public $lieu;
	public $vehicule_id;
	public $chauffeur_id = 0;
	public $etat_id = ETAT::ENCOURS;
	public $employe_id = 0;
	
	public $datelivraison;
	public $comment;
	public $nom_receptionniste;
	public $contact_receptionniste;

	

	public function enregistre(){
		$data = new RESPONSE;
		if ($this->lieu != "") {
			$datas = ZONELIVRAISON::findBy(["id ="=>$this->zonelivraison_id]);
			if (count($datas) == 1) {
				$datas = VEHICULE::findBy(["id ="=>$this->vehicule_id]);
				if (count($datas) == 1) {
					$datas = CHAUFFEUR::findBy(["id ="=>$this->chauffeur_id]);
					if (count($datas) == 1) {
						$this->employe_id = getSession("employe_connecte_id");
						$this->reference = "BLI/".date('dmY')."-".strtoupper(substr(uniqid(), 5, 6));
						$data = $this->save();
					}else{
						$data->status = false;
						$data->message = "veuillez selectionner un chauffeur pour la livraison!";
					}
				}else{
					$data->status = false;
					$data->message = "veuillez selectionner un véhicule pour la livraison!";
				}
			}else{
				$data->status = false;
				$data->message = "Une erreur s'est produite lors de l'enregistrement de la livraison!";
			}
		}else{
			$data->status = false;
			$data->message = "veuillez indiquer la destination précise de la livraison *!";
		}
		return $data;
	}


	public static function encours(){
		return static::findBy(["etat_id ="=>ETAT::ENCOURS]);
	}
	


	public function annuler(){
		$data = new RESPONSE;
		if ($this->etat_id == ETAT::ENCOURS) {
			$this->etat_id = ETAT::ANNULEE;
			$this->historique("La livraison en reference $this->reference vient d'être annulée !");
			$data = $this->save();
			if ($data->status) {
				$this->actualise();
				$this->chauffeur->etat_id = ETATCHAUFFEUR::LIBRE;
				$this->chauffeur->save();
				
				$this->vehicule->etat_id = ETATVEHICULE::RAS;
				$this->vehicule->save();
			}
		}else{
			$data->status = false;
			$data->message = "Vous ne pouvez plus faire cette opération sur cette livraison !";
		}
		return $data;
	}



	public function terminer(){
		$data = new RESPONSE;
		if ($this->etat_id == ETAT::ENCOURS) {
			$this->etat_id = ETAT::VALIDEE;
			$this->datelivraison = date("Y-m-d H:i:s");
			$this->historique("La livraison en reference $this->reference vient d'être terminé !");
			$data = $this->save();
			if ($data->status) {
				$this->actualise();
				$this->chauffeur->etatchauffeur_id = ETATCHAUFFEUR::RAS;
				$this->chauffeur->save();
				
				$this->vehicule->etatvehicule_id = ETATVEHICULE::RAS;
				$this->vehicule->save();

				$this->groupecommande->etat_id = ETAT::ENCOURS;
				$this->groupecommande->save();
			}
		}else{
			$data->status = false;
			$data->message = "Vous ne pouvez plus faire cette opération sur cette livraison !";
		}
		return $data;
	}



	public static function perte(string $date1, string $date2){
		$total = 0;
		$datas = LIVRAISON::findBy(["etat_id ="=>ETAT::VALIDEE, "DATE(datelivraison) >= " => $date1, "DATE(datelivraison) <= " => $date2]);
		foreach ($datas as $key => $livraison) {
			$lots = $livraison->fourni("lignelivraison");
			foreach ($lots as $key => $ligne) {
				$total += $ligne->quantite - $ligne->quantite_livree;
			}
		}
		return $total;
	}



	public function sentenseCreate(){}
	public function sentenseUpdate(){}
	public function sentenseDelete(){}


}
?>