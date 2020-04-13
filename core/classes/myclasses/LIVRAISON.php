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
				$this->employe_id = getSession("employe_connecte_id");
				$this->reference = "BLI/".date('dmY')."-".strtoupper(substr(uniqid(), 5, 6));
				$data = $this->save();
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
		return static::findBy(["etat_id ="=>0]);
	}
	

	public function sentenseCreate(){}
	public function sentenseUpdate(){}
	public function sentenseDelete(){}


}
?>