<?php
namespace Home;
use Native\RESPONSE;
use Native\EMAIL;
/**
 * 
 */
class LOCATION_VEHICULE extends TABLE
{
	public static $tableName = __CLASS__;
	public static $namespace = __NAMESPACE__;

	public $location_id;
	public $vehicule_id;
	public $etat_id = 0;


	public $zones;



	public function enregistre(){
		$data = new RESPONSE;
		$datas = LOCATION::findBy(["id ="=>$this->location_id]);
		if (count($datas) == 1) {
			$datas = VEHICULE::findBy(["id ="=>$this->vehicule_id]);
			if (count($datas) == 1) {
				$data = $this->save();
			}else{
				$data->status = false;
				$data->message = "Une erreur s'est produite lors de l'ajout du véhicule !";
			}
		}else{
			$data->status = false;
			$data->message = "Une erreur s'est produite lors de l'ajout du véhicule !";
		}
		return $data;
	}






	public function sentenseCreate(){}
	public function sentenseUpdate(){}
	public function sentenseDelete(){}

}



?>