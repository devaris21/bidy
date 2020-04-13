<?php
namespace Home;
use Native\RESPONSE;
use Native\EMAIL;
/**
 * 
 */
class ENTREPRISEPROPRIETAIRE extends TABLE
{
	public static $tableName = __CLASS__;
	public static $namespace = __NAMESPACE__;

	public $name;
	public $email;
	public $login;
	public $password;
	public $adresse;
	public $contact;
	public $contact2;


	public $zones;



	public function enregistre(){
		$data = new RESPONSE;
		if ($this->name != "") {
			if ($this->adresse != "" && $this->contact != "") {
				$data = $this->save();
			}else{
				$data->status = false;
				$data->message = "Veuillez renseigner tous les champs marqués d'un * !";
			}
		}else{
			$data->status = false;
			$data->message = "Veuillez renseigner le nom de votre entreprise (votre flotte) !";
		}
		return $data;
	}





	public function statistiques(){
		$tableau_mois = ["", "Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"];
		$mois1 = date("m", strtotime("-1 year")); $year1 = date("Y", strtotime("-1 year"));
		$mois2 = date("m"); $year2 = date("Y");
		$tableaux = [];
		while ( $year2 >= $year1) {
			$debut = $year1."-".$mois1."-01";
			$fin = $year1."-".$mois1."-".cal_days_in_month(CAL_GREGORIAN, ($mois1), $year1);
			$data = new RESPONSE;
			//$data->name = $tableau_mois[intval($mois1)]." ".$year1;
			$data->name = $year1."-".start0($mois1)."-".cal_days_in_month(CAL_GREGORIAN, ($mois1), $year1);;
			$data->no = $data->ex = $data->ci = $data->af = $data->mo = 0;
			$data->Nno = $data->Nex = $data->Nci = $data->Naf = $data->Nmo = 0;
			////////////
			$datas = COMMANDE::findBy(["entrepriselivreur_id="=>$this->getId(), "etatcommande_id ="=>3, "modified >= "=>$debut, "modified <="=>$fin]);
			foreach ($datas as $key => $commande) {
				if ($commande->typecommande_id == 1) {
					$data->no += $commande->price;
					$data->Nno++;
				}else if ($commande->typecommande_id == 2) {
					$data->ex += $commande->price;
					$data->Nex++;
				}else if ($commande->typecommande_id == 3) {
					$data->ci += $commande->price;
					$data->Nci++;
				}else if ($commande->typecommande_id == 4) {
					$data->af += $commande->price;
					$data->Naf++;
				}else if ($commande->typecommande_id == 5) {
					$data->mo += $commande->price;
					$data->Nmo++;
				}
			}
			$tableaux[] = $data;
			///////////////////////
			if ($mois2 == $mois1 && $year2 == $year1) {
				break;
			}else{
				if ($mois1 == 12) {
					$mois1 = 01;
					$year1++;
				}else{
					$mois1++;
				}
			}
		}
		return $tableaux;
	}



	public function sentenseCreate(){}
	public function sentenseUpdate(){}
	public function sentenseDelete(){}

}



?>