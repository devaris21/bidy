<?php
namespace Home;
use Native\RESPONSE;
use Native\EMAIL;
use Native\FICHIER;
/**
 * 
 */
class PRODUIT extends TABLE
{
	public static $tableName = __CLASS__;
	public static $namespace = __NAMESPACE__;

	public $name;
	public $description = "";
	public $image = "default.png";

	public $stock = 0;


	public function enregistre(){
		$data = new RESPONSE;
		if ($this->name != "") {
			$data = $this->save();
			if ($data->status) {
				$this->uploading($this->files);
				foreach (ZONELIVRAISON::getAll() as $key => $zonelivraison) {
					$datas = PRIX_ZONELIVRAISON::findBy(["zonelivraison_id ="=>$zonelivraison->getId(), "produit_id ="=>$data->lastid]);
					if (count($datas) == 0) {
						$ligne = new PRIX_ZONELIVRAISON();
						$ligne->produit_id = $data->lastid;
						$ligne->zonelivraison_id = $zonelivraison->getId();
						$ligne->price = 0;
						$ligne->enregistre();
					}
				}

				$ligne = new EXIGENCEPRODUCTION();
				$ligne->produit_id = $data->lastid;
				$ligne->quantite = 0;
				$lot = $ligne->enregistre();
				foreach (RESSOURCE::getAll() as $key => $ressource) {
					$datas = LIGNEEXIGENCEPRODUCTION::findBy(["exigenceproduction_id ="=>$lot->lastid, "ressource_id ="=>$ressource->getId()]);
					if (count($datas) == 0) {
						$ligne = new LIGNEEXIGENCEPRODUCTION();
						$ligne->exigenceproduction_id = $lot->lastid;
						$ligne->ressource_id = $ressource->getId();
						$ligne->quantite = 0;
						$ligne->enregistre();
					}					
				}

				$ligne = new PAYE_PRODUIT();
				$ligne->produit_id = $data->lastid;
				$ligne->price = 0;
				$ligne->enregistre();

				$ligne = new LIGNEPRODUCTIONJOUR();
				$ligne->productionjour_id = 1;
				$ligne->produit_id = $data->lastid;
				$ligne->production = $this->stock;
				$ligne->setCreated(PARAMS::DATE_DEFAULT);
				$ligne->save();

			}
		}else{
			$data->status = false;
			$data->message = "Veuillez renseigner le nom du produit !";
		}
		return $data;
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
						$result = $image->upload("images", "produits", $a);
						$name = $tab[$i];
						$this->$name = $result->filename;
						$this->save();
					}
				}	
				$i++;			
			}			
		}
	}


	public function livrer(int $quantite){
		$this->stock -= $quantite;
		$data = $this->save();	
	}



	public function stock(String $date){
		$total = 0;
		//$datas = $this->fourni("ligneproductionjour", ["DATE(created) <= "=>$date]);
		$datas = $this->fourni("ligneproductionjour");
		foreach ($datas as $key => $ligne) {
			$ligne->actualise();
			if ($ligne->productionjour->ladate <= $date) {
				$total += $ligne->production;
				$total -= $ligne->perte;
			}			
		}
		$datas = $this->fourni("lignelivraison", ["DATE(created) <= "=>$date]);
		foreach ($datas as $key => $ligne) {
			$ligne->actualise();
			if ($ligne->livraison->etat_id != ETAT::ANNULEE) {
				$total -= $ligne->quantite;
			}
		}
		return $total;
	}



	public function production(string $date1 = "2020-04-01", string $date2){
		$datas = $this->fourni("ligneproductionjour", ["DATE(created) >= " => $date1, "DATE(created) <= " => $date2]);
		return comptage($datas, "production", "somme");
	}


	public function perte(string $date1 = "2020-04-01", string $date2){
		$total = 0;
		$datas = $this->fourni("ligneproductionjour", ["DATE(created) >= " => $date1, "DATE(created) <= " => $date2]);
		$total += comptage($datas, "perte", "somme");

		$datas = $this->fourni("lignelivraison", ["DATE(created) >= " => $date1, "DATE(created) <= " => $date2]);
		foreach ($datas as $key => $ligne) {
			$ligne->actualise();
			if ($ligne->livraison->etat_id != ETAT::ANNULEE) {
				$total += $ligne->quantite - $ligne->quantite_livree;
			}
		}

		return $total;
	}
	

	public function livree(string $date1 = "2020-04-01", string $date2){
		$datas = $this->fourni("lignelivraison", ["DATE(created) >= " => $date1, "DATE(created) <= " => $date2]);
		foreach ($datas as $key => $ligne) {
			$ligne->actualise();
			if ($ligne->livraison->etat_id != ETAT::ANNULEE) {
				unset($datas[$key]);
			}
		}
		return comptage($datas, "quantite_livree", "somme");
	}


	public function commandee(){
		$total = 0;
		$datas = GROUPECOMMANDE::encours();
		foreach ($datas as $key => $comm) {
			$total += $comm->reste($this->getId());
		}
		return $total;
	}


	public function livrable(){
		$total = 0;
		//$datas = $this->fourni("ligneproductionjour", ["DATE(created) <= "=>$date]);
		$datas = $this->fourni("ligneproductionjour");
		foreach ($datas as $key => $ligne) {
			$ligne->actualise();
			if ($ligne->productionjour->etat_id == ETAT::VALIDEE) {
				$total += $ligne->production;
				$total -= $ligne->perte;
			}			
		}
		$datas = $this->fourni("lignelivraison");
		foreach ($datas as $key => $ligne) {
			$ligne->actualise();
			if ($ligne->livraison->etat_id != ETAT::ANNULEE) {
				$total -= $ligne->quantite;
			}
		}
		return $total;
	}



	public function enAttente(){
		$total = 0;
		//$datas = $this->fourni("ligneproductionjour", ["DATE(created) <= "=>$date]);
		$datas = $this->fourni("ligneproductionjour");
		foreach ($datas as $key => $ligne) {
			$ligne->actualise();
			if ($ligne->productionjour->etat_id == ETAT::PARTIEL) {
				$total += $ligne->production;
				$total -= $ligne->perte;
			}			
		}
		return $total;
	}

	public function exigence(int $quantite, int $ressource_id){
		$total = 0;
		$datas = $this->fourni("exigenceproduction");
		foreach ($datas as $key => $exigence) {
			if ($exigence->quantite > 0) {
				$lot =  $exigence->fourni("ligneexigenceproduction", ["ressource_id ="=>$ressource_id]);
				foreach ($lot as $cle => $item) {
					$total += ($quantite * $item->quantite) / $exigence->quantite;
				}
			}
		}
		return $total;
	}


	public function sentenseCreate(){
		return $this->sentense = "Ajout d'un nouveau produit : $this->name dans les paramétrages";
	}
	public function sentenseUpdate(){
		return $this->sentense = "Modification des informations du produit $this->id : $this->name ";
	}
	public function sentenseDelete(){
		return $this->sentense = "Suppression definitive du produit $this->id : $this->name";
	}

}



?>