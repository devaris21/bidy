<?php
namespace Home;
use Native\RESPONSE;
use \DateTime;
use \DateInterval;
/**
 * 
 */
class PARAMS extends TABLE
{

	public static $tableName = __CLASS__;
	public static $namespace = __NAMESPACE__;

	const DATE_DEFAULT = "2020-04-01";


	public $societe_name;
	public $timeout;
	public $email;
	public $email_rh;
	public $email_dg;
	public $delai_alert;
	public $email_csdg;
	public $price_min_local;
	public $pourcent_colis_local;
	public $price_min_afrique;
	public $pourcent_colis_afrique;
	public $devise;




	//verifier le temps de latente entre deux actions de l'utilisateur
	public static function checkTimeout($section){
		$data = new RESPONSE;
		$params = self::findLastId();
		$session = $params->timeout * 60;
		//umpeu moins de 2x le temps;
		if(is_null(getSession("last_access")) OR (time() - getSession("last_access") > $session * 2) ){
			$data->status = false;
			$data->message = "temps depassée, page de connexion zz!";
			$data->setUrl($section, "access", "login");
		}else if ((time() - getSession("last_access") > $session) || !is_null(getSession("page_session"))) {
			$data->status = false;
			$data->message = "temps depassée, verrouillage de la session !";
			$data->setUrl($section, "access", "locked");
		}else{
			session("last_access", time());
			$data->status = true;
			$data->message = "Tout est correct !";
		}
		return $data;
	}


	public function enregistre(){
		return  $this->save();
	}



	public function sentenseCreate(){}
	public function sentenseUpdate(){}
	public function sentenseDelete(){}


}



?>