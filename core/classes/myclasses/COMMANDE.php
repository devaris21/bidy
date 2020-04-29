<?php
namespace Home;
use Native\RESPONSE;/**
 * 
 */
class COMMANDE extends TABLE
{

	public static $tableName = __CLASS__;
	public static $namespace = __NAMESPACE__;

	public $reference;
	public $groupecommande_id;
	public $datelivraison;
	public $zonelivraison_id;
	public $lieu;
	public $taux_tva = 0;
	public $tva = 0;
	public $operation_id = 0;
	public $montant = 0;
	public $avance = 0;
	public $reste = 0;
	public $etat_id = ETAT::VALIDEE;
	public $employe_id;
	public $comment;
	


	public function enregistre(){
		$data = new RESPONSE;
		if ($this->datelivraison >= dateAjoute()) {
			if ($this->lieu != "") {
				$datas = ZONELIVRAISON::findBy(["id ="=>$this->zonelivraison_id]);
				if (count($datas) == 1) {
					 $params = PARAMS::findLastId();

					$this->employe_id = getSession("employe_connecte_id");
					$this->reference = "BCO/".date('dmY')."-".strtoupper(substr(uniqid(), 5, 6));
					$this->taux_tva = $params->tva;

					$data = $this->save();
				}else{
					$data->status = false;
					$data->message = "Une erreur s'est produite lors de l'enregistrement de la commande!";
				}
			}else{
				$data->status = false;
				$data->message = "veuillez indiquer la destination précise de la commande *!";
			}
		}else{
			$data->status = false;
			$data->message = "La date de livraison de la commande n'est pas correcte *!";
		}
		return $data;
	}



	public function sentenseCreate(){}
	public function sentenseUpdate(){}
	public function sentenseDelete(){}


}
?>