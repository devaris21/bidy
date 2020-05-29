<?php
namespace Home;
use Native\RESPONSE;
use Native\EMAIL;
/**
 * 
 */
class TRANSFERT extends TABLE
{
	public static $tableName = __CLASS__;
	public static $namespace = __NAMESPACE__;

	public $reference;
	public $montant;
	public $client_id;
	public $client_id_receive;
	public $comment;
	public $employe_id;
	public $etat_id = ETAT::VALIDEE;


	public function enregistre(){
		$data = new RESPONSE;
		if ($this->client_id != $this->client_id_receive) {
			$datas = CLIENT::findBy(["id ="=>$this->client_id]);
			if (count($datas) == 1) {
				$datas = CLIENT::findBy(["id ="=>$this->client_id_receive]);
				if (count($datas) == 1) {
					if ($this->montant > 0) {
						$this->employe_id = getSession("employe_connecte_id");
						$this->reference = "TRF/".date('dmY')."-".strtoupper(substr(uniqid(), 5, 6));
						$data = $this->save();
					}else{
						$data->status = false;
						$data->message = "veuillez renseigner un montant de transfert correct !";
					}			
				}else{
					$data->status = false;
					$data->message = "Une erreur s'est produite lors de l'opération, veuillez recommencer !!";
				}
			}else{
				$data->status = false;
				$data->message = "Une erreur s'est produite lors de l'opération, veuillez recommencer !!";
			}
		}else{
			$data->status = false;
			$data->message = "Vous ne pouvez pas vous transferer des fonds";
		}

		return $data;
	}



	public function sentenseCreate(){}
	public function sentenseUpdate(){}
	public function sentenseDelete(){}

}



?>