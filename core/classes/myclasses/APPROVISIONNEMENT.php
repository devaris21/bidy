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
	public $datelivraison;
	public $operation_id = 0;
	public $prestataire_id;
	public $employe_id;
	public $etat_id;
	public $employe_id_reception;
	public $comment;


	public function enregistre(){
		$data = new RESPONSE;
		$datas = PRESTATAIRE::findBy(["id ="=>$this->prestataire_id]);
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
	

	public function annuler(){
		$data = new RESPONSE;
		if ($this->etat_id == ETAT::ENCOURS) {
			$this->etat_id = ETAT::ANNULEE;
			$this->datelivraison = date("Y-m-d H:i:s");
			$this->historique("L'approvisionnement en reference $this->reference vient d'être annulée !");
			$data = $this->save();
			if ($data->status) {
				$this->actualise();
				$payement = new OPERATION();
				$payement->categorieoperation_id = CATEGORIEOPERATION::REMBOURSEMENT;
				$payement->modepayement_id = $this->operation->modepayement_id;
				$payement->montant = $this->operation->montant;
				$payement->client_id = CLIENT::CLIENTSYSTEME;
				$payement->comment = "Remboursement de la facture d'approvisionnement N°".$approvisionnement->reference." dû à son annulation";
				$data = $payement->enregistre();
			}
		}else{
			$data->status = false;
			$data->message = "Vous ne pouvez plus faire cette opération sur cet approvisionnement !";
		}
		return $data;
	}



	public function terminer(){
		$data = new RESPONSE;
		if ($this->etat_id == ETAT::ENCOURS) {
			$this->etat_id = ETAT::TERMINEE;
			$this->employe_id_reception = getSession("employe_connecte_id");
			$this->historique("L'approvisionnement en reference $this->reference vient d'être terminé !");
			$data = $this->save();
		}else{
			$data->status = false;
			$data->message = "Vous ne pouvez plus faire cette opération sur cet approvisionnement !";
		}
		return $data;
	}


	
	public function sentenseCreate(){}
	public function sentenseUpdate(){}
	public function sentenseDelete(){}

}



?>