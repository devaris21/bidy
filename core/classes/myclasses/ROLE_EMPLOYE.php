<?php
namespace Home;
use Native\RESPONSE;

/**
 * 
 */
class ROLE_EMPLOYE extends TABLE
{
	
	
	public static $tableName = __CLASS__;
	public static $namespace = __NAMESPACE__;


	public $role_id;
	public $employe_id;


	public function enregistre(){
		$data = new RESPONSE;
		$datas = ROLE::findBy(["id ="=>$this->role_id]);
		if (count($datas) == 1) {
			$datas = EMPLOYE::findBy(["id ="=>$this->employe_id]);
			if (count($datas) == 1) {
				$data = $this->save();
			}else{
				$data->status = false;
				$data->message = "Une erreur s'est produite lors du prix !";
			}
		}else{
			$data->status = false;
			$data->message = "Une erreur s'est produite lors du prix !";
		}
		return $data;
	}



	public function sentenseCreate(){}
	public function sentenseUpdate(){}
	public function sentenseDelete(){}
}

?>