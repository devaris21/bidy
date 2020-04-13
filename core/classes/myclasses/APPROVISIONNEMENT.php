<?php
namespace Home;
use Native\RESPONSE;
use Native\EMAIL;
/**
 * 
 */
class APPROVISIONNEMENT extends TABLE
{
	public static $tableName = __CLASS__;
	public static $namespace = __NAMESPACE__;

	public $reference;
	public $montant;
	public $datelivraison = "";
	public $operation_id = 0;
	public $prestataire_id;
	public $employe_id;
	public $etat_id;


	public function enregistre(){
		$data = new RESPONSE;
		$datas = PRESTATAIRE::findBy(["id ="=>$this->approvisionnement_id]);
		if (count($datas) == 1) {
			if ($this->montant > 0 ) {
				$this->reference = "APP/".date('dmY')."-".strtoupper(substr(uniqid(), 5, 6));
				$this->employe_id = getSession("employe_connecte_id");
				$data = $this->save();
			}else{
				$data->status = false;
				$data->message = "Le montant de la commande n'est pas correcte !";
			}
		}else{
			$data->status = false;
			$data->message = "Une erreur s'est produite lors de l'ajout du produit !";
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