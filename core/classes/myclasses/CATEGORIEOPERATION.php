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
	const REMBOURSEMENT_FOURNISSEUR = 6;
	const AUTRE_ENTREE = 1;

	const APPROVISIONNEMENT = 3;
	const PAYE = 4;
	const ENTRETIENVEHICULE = 5;
	const REMBOURSEMENT = 6;
	const AUTRE_DEPENSE = 6;

	
	public $typeoperationcaisse_id;
	public $name;
	public $color = "#ffffff";



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



	public static function entree(){
		return static::findBy(["typeoperationcaisse_id ="=> TYPEOPERATIONCAISSE::ENTREE]);
	}



	public static function depense(){
		return static::findBy(["typeoperationcaisse_id ="=> TYPEOPERATIONCAISSE::SORTIE]);
	}


	public function sentenseCreate(){}
	public function sentenseUpdate(){}
	public function sentenseDelete(){}

}



?>