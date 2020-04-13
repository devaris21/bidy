<?php
namespace Home;
use Native\RESPONSE;
/**
 * 
 */
class CONNEXION extends TABLE
{

	public static $tableName = __CLASS__;
	public static $namespace = __NAMESPACE__;


	public $date_connexion;
	public $date_deconnexion ;
	public $employe_id = null;
	public $utilisateur_id = null;
	//public $carplan_id = null;
	public $prestataire_id = null;

	public function enregistre(){
		return $this->save();
	}


	
	//connecter un employé
	public function connexion_employe(){
		$this->deconnexion_employe();
		session("employe_connecte_id", $this->employe_id);
		$this->date_connexion = date("Y-m-d H:i:s");
		$this->date_deconnexion = null;
		$this->enregistre();
	}



	//deconnecter un employé
	public function deconnexion_employe(){
		$datas = CONNEXION::findBy(["employe_id = "=> $this->employe_id], [], ["id"=>"DESC"], 1);
		if (count($datas) > 0) {
			$connexion = $datas[0];
			$connexion->actualise();
			if ($connexion->date_deconnexion == null) {
				$connexion->date_deconnexion = date("Y-m-d H:i:s");
				$connexion->historique("Déconnexion du employe".$connexion->employe->name." ".$connexion->employe->lastname);
				$connexion->save();
			}
		}
	}


/////////////////////////////////////////////////////////////////////////////////////////////////////


	//connecter un utilisateur
	public function connexion_utilisateur(){
		$this->deconnexion_utilisateur();
		session("utilisateur_connecte_id", $this->utilisateur_id);
		$this->date_connexion = date("Y-m-d H:i:s");
		$this->date_deconnexion = null;
		$this->enregistre();
	}



	//deconnecter un utilisateur
	public function deconnexion_utilisateur(){
		$datas = CONNEXION::findBy(["utilisateur_id = "=> $this->utilisateur_id], [], ["id"=>"DESC"], 1);
		if (count($datas) > 0) {
			$connexion = $datas[0];
			$connexion->actualise();
			if ($connexion->date_deconnexion == null) {
				$connexion->date_deconnexion = date("Y-m-d H:i:s");
				$connexion->historique("Déconnexion de l'utilisateur ".$connexion->utilisateur->name());
				$connexion->save();
			}
		}
	}


/////////////////////////////////////////////////////////////////////////////////////////////////////


	//connecter un carplan
	public function connexion_carplan(){
		$this->deconnexion_carplan();
		session("carplan_id", $this->carplan_id);
		$this->date_connexion = date("Y-m-d H:i:s");
		$this->date_deconnexion = null;

		$this->enregistre();
	}



	//deconnecter un carplan
	public function deconnexion_carplan(){
		$datas = CONNEXION::findBy(["carplan_id = "=> $this->carplan_id], [], ["id"=>"DESC"], 1);
		if (count($datas) > 0) {
			$connexion = $datas[0];
			$connexion->actualise();
			if ($connexion->date_deconnexion == null) {
				$connexion->date_deconnexion = date("Y-m-d H:i:s");
				$connexion->historique("Déconnexion du carplan ".$connexion->carplan->name." ".$connexion->carplan->lastname);
				$connexion->save();
			}
		}
	}


/////////////////////////////////////////////////////////////////////////////////////////////////////

	//connecter un prestataire
	public function connexion_prestataire(){
		$this->deconnexion_prestataire();
		session("prestataire_connecte_id", $this->prestataire_id);
		$this->date_connexion = date("Y-m-d H:i:s");
		$this->date_deconnexion = null;
		$this->enregistre();
	}



	//deconnecter un prestataire
	public function deconnexion_prestataire(){
		$datas = CONNEXION::findBy(["prestataire_id = "=> $this->prestataire_id], [], ["id"=>"DESC"], 1);
		if (count($datas) > 0) {
			$connexion = $datas[0];
			$connexion->actualise();
			if ($connexion->date_deconnexion == null) {
				$connexion->date_deconnexion = date("Y-m-d H:i:s");
				$connexion->historique("Déconnexion du prestataire ".$connexion->prestataire->name());
				$connexion->save();
			}
		}
	}


/////////////////////////////////////////////////////////////////////////////////////////////////////



	public function sentenseCreate(){
		return $this->sentense = "Nouvelle connexion";
	}


	public function sentenseUpdate(){
		return $this->sentense = "Modification des informations de la connexion de ".$this->employe->name." ".$this->employe->lastname." du ".datelong($this->created);
	}


	public function sentenseDelete(){
		return $this->sentense = "Supprimer de la connexion de  ".$this->employe->name." ".$this->employe->lastname." du ".datelong($this->created);
	}

}
?>