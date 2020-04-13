<?php
namespace Home;
use Native\RESPONSE;
use Native\EMAIl;
use \DateTime;
use \DateInterval;
/**
/**
 * 
 */
class ADMIN extends AUTH
{
	public static $tableName = __CLASS__;
	public static $namespace = __NAMESPACE__;

	public $matricule;
	public $name;
	public $lastname;
	public $is_allowed = 1;
	public $started;
	public $is_new = 1;
	public $code;
	public $image = "default.png";
	public $is_connecte = false;
	


	public function enregistre(){
		$data = new RESPONSE;
		$this->login = substr(uniqid(), 6);
		$pass = substr(uniqid(), 5);
		$this->password = hasher($pass);
		if ($this->login != "" && $this->password != "") {
			$datas = static::findBy(["email ="=>$this->email]);
			if (count($datas) == 0) {
				$datas = GESTIONNAIRE::findBy(["login ="=>$this->login]);
				if (count($datas) == 0) {
					$data = $this->save();
					$this->setId($data->lastid)->actualise();

					//@TODO refaire email welcome gestionnaire
					ob_start();
					include(__DIR__."/../../sections/home/elements/mails/welcome_gestionnaire.php");
					$contenu = ob_get_contents();
					ob_end_clean();
					EMAIL::send([$this->email], "Bienvenue - ARTCI | Gestion du parc auto", $contenu);
				}else{
					$data->status = false;
					$data->message = "Ce login ne peut plus etre utilisé !";
				}
			}else{
				$data->status = false;
				$data->message = "Cet email a déjà un compte. Veuillez en prendre un autre !";
			}
		}else{
			$data->status = false;
			$data->message = "Veuillez renseigner le login et le mot de passe du nouvel employé !";
		}
		return $data;
	}


	public static function getEmailGestionnaires(){
		$emails = [];
		$datas = static::findBy(["is_admin < "=>2]);
		foreach ($datas as $key => $value) {
			$emails[] = $value->email;
		}
		return $emails;
	}


	public function fullname(){
		return $this->name.' '.$this->lastname;
	}



	public function se_connecter(){
		$connexion = new CONNEXION;
		$connexion->admin_id = $this->getId();
		$connexion->connexion_gestionnaire();
	}



	public function se_deconnecter(){
		$connexion = new CONNEXION;
		$connexion->admin_id = $this->getId();
		$connexion->deconnexion_gestionnaire();
	}


	public function last_connexion(){
		$datas = CONNEXION::findBy(["admin_id = "=> $this->getId()], [], ["id"=>"DESC"], 1);
		if (count($datas) == 1) {
			$connexion = $datas[0];
			if ($connexion->date_deconnexion == null) {
				return date("Y-m-d H:i:s");
			}else{
				return $connexion->date_deconnexion;
			}
		}
	}




	public static function getAllConnected(){
		$datas = self::findBy(["allowed = "=> 1]);
		foreach ($datas as $key => $gestionnaire) {
			if (!$gestionnaire->is_connected()) {
				unset($datas[$key]);
			}
		}
		return $datas;
	}

	public function is_admin(){
		if ($this->typeadministrateur_id >= 3) {
			return true;
		}else{
			return false;
		}
	}


	
	



	public function is_connected(){
		$datas = CONNEXION::findBy(["admin_id = "=> $this->getId()], [], ["id"=>"DESC"], 1);
		if (count($datas) == 1) {
			$connexion = $datas[0];
			if ($connexion->date_deconnexion == null) {
				return true;
			}else{
				return false;
			}
		}
	}






	public function relog_gestionnaire(string $login, string $password){
		$data = new RESPONSE;
		if ($password != "" && $login != "") {
			$datas = self::findBy(["login = "=>$login, "id !="=> $this->getId()]);
			if (count($datas) == 0) {
				if($this->password != hasher($password)){
					if ($this->set_login($login)) {
						$this->set_password($password);
						$this->is_new = 1;
						$data = $this->save();
						$data->setUrl("master", "dashboard");
					}else{
						$data->status = false;
						$data->message = "Cet identifiant est déjà utilisé. Changez-le !!!";
					}
				}else{
					$data->status = false;
					$data->message = "Veuillez ne pas utiliser l'ancien mot de passe. Changez-le !!!";
				}
			}else{
				$data->status = false;
				$data->message = "Vous ne pouvez pas utiliser ce login !";
			}
		}else{
			$data->status = false;
			$data->message = "Veuillez renseigner integralement vos parametres de connexion !";
		}
		return $data;
	}


	public function changer_admin(){
		if ($this->is_admin == 1) {
			$this->is_admin = 0;
		}else{
			$this->is_admin = 1;
		}
		$name = ($this->is_admin == 1)?"Administrateur":"Gestionnaire";
		$this->historique("Changement du niveau d'administration du gestionnaire ".$this->name()." au niveau $name");
		$data = $this->save();	
		return $data;
	}


	public function reinitialiserCompte(){
		$data = new RESPONSE;
		if ($this->set_login(substr(md5(uniqid()), 0, 9))) {
			$this->set_password("6ed78djf21ga");
			$this->is_new = 0;
			$this->historique("Reinitialisation des parametres de compte de $this->name $this->lastname");
			$data = $this->save();
		}else{
			$data->status = false;
			$data->message = "Cet identifiant est déjà utilisé. Veuillez reessayer !!!";
		}	
		return $data;
	}


	public function interdireCompte(){
		$this->allowed = 0;
		$this->historique("Restriction d'accès pour le compte de $this->name $this->lastname");
		$data = $this->save();	
		return $data;
	}


	public function accesCompte(){
		$this->allowed = 1;
		$this->historique("Reouverture d'accès pour le compte de $this->name $this->lastname");
		$data = $this->save();	
		return $data;
	}


	public function supprimerCompte(){
		$this->valide = 0;
		$this->allowed = 0;
		$this->set_password(substr(md5(uniqid()), 7, 12));
		$this->historique("Suppression du compte compte de $this->name $this->lastname");
		$data = $this->save();	
		return $data;
	}




	public function validate(){
		$data = new RESPONSE;
		$query = new QUERY;
		$datas = self::findBy(["login = "=>$this->login]);
		if (count($datas) == 0) {
			$data->status = true;
			$data->message = "aucun login semblabe, valide!";
		}else{
			$gestionnaireTemp = $datas[0];
			if ($gestionnaireTemp->id === $this->id) {
				$data->status = true;
				$data->message = "C'est son login'";
			}else{
				$data->status = false;
				$data->message = "Ce identifiant n'est pas disponible. veuillez le changer !";
			}
		}
		return $data;
	}




	public function sentenseCreate(){
		return $this->sentense = "Ajout d'un nouveau gestionnaire dans le parc auto : $this->name $this->lastname";
	}


	public function sentenseUpdate(){
		return $this->sentense = "Modification des informations du gestionnaire $this->id $this->name $this->lastname.";
	}


	public function sentenseDelete(){
		return $this->sentense = "Suppression définitive du gestionnaire $this->id $this->name $this->lastname.";
	}



}

?>