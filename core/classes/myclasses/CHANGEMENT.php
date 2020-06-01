<?php
namespace Home;
use Native\RESPONSE;
use Native\EMAIL;
/**
 * 
 */
class CHANGEMENT extends TABLE
{
	public static $tableName = __CLASS__;
	public static $namespace = __NAMESPACE__;

	public $reference;
	public $groupecommande_id;
	public $groupecommande_id_new;
	public $comment;
	public $employe_id;
	public $etat_id = ETAT::VALIDEE;


	public function enregistre(){
		$data = new RESPONSE;
		$datas = GROUPECOMMANDE::findBy(["id ="=>$this->groupecommande_id]);
		if (count($datas) == 1) {
			$datas = GROUPECOMMANDE::findBy(["id ="=>$this->groupecommande_id_new]);
			if (count($datas) == 1) {
				$this->employe_id = getSession("employe_connecte_id");
				$this->reference = "CHANG/".date('dmY')."-".strtoupper(substr(uniqid(), 5, 6));
				$data = $this->save();			
			}else{
				$data->status = false;
				$data->message = "Une erreur s'est produite lors de l'opération, veuillez recommencer !!";
			}
		}else{
			$data->status = false;
			$data->message = "Une erreur s'est produite lors de l'opération, veuillez recommencer !!";
		}

		return $data;
	}



	public function sentenseCreate(){}
	public function sentenseUpdate(){}
	public function sentenseDelete(){}

}



?>