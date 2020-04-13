<?php
namespace Home;
use Native\RESPONSE;
/**
 * 
 */
class MESSAGE extends TABLE
{
	public static $tableName = __CLASS__;
	public static $namespace = __NAMESPACE__;

	public $client_id = 0;
	public $fullname;
	public $contact;
	public $email;
	public $subject;
	public $content;
	public $etat_id = 0;


	public function enregistre(){
		$data = new RESPONSE;
		if ($this->fullname != "") {
			if (filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
				if ($this->subject != "") {
					if ($this->content != "") {
						$data = $this->save();
					}else{
						$data->status = false;
						$data->message = "Vous n'avez rien écrit comme message !";
					}
				}else{
					$data->status = false;
					$data->message = "Veuillez renseigner un objet pour votre message !";
				}
			}else{
				$data->status = false;
				$data->message = "Votre adresse email n'est pas correcte !";
			}
		}else{
			$data->status = false;
			$data->message = "Veuillez renseigner votre nom !";
		}

		return  $data;
	}



	public function sentenseCreate(){}
	public function sentenseUpdate(){}
	public function sentenseDelete(){}

}



?>