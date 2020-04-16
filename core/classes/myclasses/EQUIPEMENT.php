<?php
namespace Home;
use Native\RESPONSE;
use Native\FICHIER;
/**
 * 
 */
class EQUIPEMENT extends TABLE
{
	public static $tableName = __CLASS__;
	public static $namespace = __NAMESPACE__;

	public $typeequipement_id;
	public $name;
	public $marque;
	public $stock = 0;
	public $comment;
	public $image;


	public function enregistre(){
		$data = new RESPONSE;
		if ($this->name != "") {
			$data = $this->save();
			if ($data->status) {
				$this->uploading($this->files);
			}
		}else{
			$data->status = false;
			$data->message = "Veuillez renseigner le nom du produit !";
		}
		return $data;
	}


	public function uploading(Array $files){
		if (isset($this->image) && $this->image["tmp_name"] != "") {
			$image = new FICHIER();
			$image->hydrater($this->image);
			if ($image->is_image()) {
				$a = substr(uniqid(), 5);
				$result = $image->upload("images", "equipements", $a);
				$this->image = $result->filename;
				$this->save();
			}
		}
	}


	public static function stock(){
		return comptage(self::getAll(), "stock", "somme");
	}


	public static function utilises(){
		return comptage(EQUIPEMENT_VEHICULE::getAll(), "quantite", "somme");
	}


	public function approvisionner(Int $qte, Int $price){
		$data = new RESPONSE;
		if (intval($qte) > 0) {
			if (intval($price) > 0) {
				if ($this->stock < 0) {
					$this->stock = 0;
				}
				$this->stock += $qte;
				$this->historique("Approvisionnement de stock de l'equipement $this->name à +$qte unités !");
				$data = $this->save();
				if ($data->status) {
					$app = new APPROVISIONNEMENT;
					$app->equipement_id = $data->lastid;
					$app->quantite = $qte;
					$app->price = $price;
					$app->save();
				}
			}else{
				$data->status = false;
				$data->message = "La prix est incorrect !";
			}
		}else{
			$data->status = false;
			$data->message = "La quantité est incorrect !";
		}		
		return $data;
	}


	public function destock(Int $qte){
		$data = new RESPONSE;
		if (intval($qte) > 0) {
			if ($this->stock >= $qte) {
				$this->stock -= $qte;
				$this->historique("Déstockage de l'equipement $this->name pour $qte unités ");
				$data = $this->save();
			}else{
				$data->status = false;
				$data->message = "Il ne reste que $this->stock unités de cet équipement !";
			}
		}else{
			$data->status = false;
			$data->message = "La quantité est incorrect !";
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



	public function sentenseCreate(){
		return $this->sentense = "Enregistrement d'un nouveau equipement $this->name .";
	}


	public function sentenseUpdate(){
		return $this->sentense = "Modification des infos de l'equipement N°$this->id  $this->name .";
	}


	public function sentenseDelete(){
		return $this->sentense = "Suppression définitive de l'equipement $this->name  dans la base de données.";
	}

}



?>