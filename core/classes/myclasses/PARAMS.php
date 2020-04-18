<?php
namespace Home;
use Native\RESPONSE;
use Native\FICHIER;
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


	public $societe;
	public $email;
	public $contact;
	public $fax;
	public $postale;
	public $devise;
	public $image;

	public $tva;



	public function enregistre(){
		return  $this->save();
	}


	public function uploading(Array $files){
		//les proprites d'images;
		$tab = ["image"];
		if (is_array($files) && count($files) > 0) {
			$i = 0;
			foreach ($files as $key => $file) {
				if ($file["tmp_name"] != "") {
					$image = new FICHIER();
					$image->hydrater($file);
					if ($image->is_image()) {
						$a = substr(uniqid(), 5);
						$result = $image->upload("images", "societe", $a);
						$name = $tab[$i];
						$this->$name = $result->filename;
						$this->save();
					}
				}	
				$i++;			
			}			
		}
	}




	//verifier le temps de latente entre deux actions de l'utilisateur
	public static function checkTimeout($section){
		$data = new RESPONSE;
		$session = 10 * 60;
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




	public function sentenseCreate(){}
	public function sentenseUpdate(){}
	public function sentenseDelete(){}


}



?>