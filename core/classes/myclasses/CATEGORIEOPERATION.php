<?php
namespace Home;
use Native\RESPONSE;
use Native\EMAIL;
/**
 * 
 */
class CATEGORIEOPERATION extends TABLE
{
	public static $tableName = __CLASS__;
	public static $namespace = __NAMESPACE__;

	const PAYEMENT = 1;
	const APPROVISIONNEMENT = 2;
	const REMBOURSEMENT = 3;
	const PAYE = 4;
	const ENTRETIENVEHICULE = 5;

	
	public $typeoperationcaisse_id;
	public $name;
	public $color;



	public function enregistre(){
		$data = new RESPONSE;
		if ($this->name != "") {
			$datas = TYPEOPERATIONCAISSE::findBy(["id ="=>$this->typeoperationcaisse_id]);
			if (count($datas) == 1) {
				$data = $this->save();					
			}else{
				$data->status = false;
				$data->message = "Une erreur s'est produite lors de l'enregistrement de la commande!";
			}
		}else{
			$data->status = false;
			$data->message = "Veuillez renseigner le nom de votre entreprise (votre flotte) !";
		}
		return $data;
	}





	public function sentenseCreate(){}
	public function sentenseUpdate(){}
	public function sentenseDelete(){}

}



?>