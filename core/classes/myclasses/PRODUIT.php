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
		$requette = "SELECT SUM(production) - SUM(perte) as production  FROM ligneproductionjour, produit, productionjour WHERE ligneproductionjour.produit_id = produit.id AND produit.id = ? AND ligneproductionjour.productionjour_id = productionjour.id AND DATE(productionjour.ladate) <= ? GROUP BY produit.id";
		$item = LIGNEPRODUCTIONJOUR::execute($requette, [$this->getId(), $date]);
		if (count($item) < 1) {$item = [new LIGNEPRODUCTIONJOUR()]; }
		$total += $item[0]->production;


		$requette = "SELECT SUM(quantite) as quantite  FROM lignelivraison, produit, livraison WHERE lignelivraison.produit_id = produit.id AND lignelivraison.livraison_id = livraison.id AND produit.id = ? AND livraison.etat_id != ? AND DATE(livraison.created) <= ? GROUP BY produit.id";
		$item = LIGNELIVRAISON::execute($requette, [$this->getId(), ETAT::ANNULEE, $date]);
		if (count($item) < 1) {$item = [new LIGNELIVRAISON()]; }
		$total -= $item[0]->quantite;

		return $total;
	}



	public function production(string $date1 = "2020-04-01", string $date2){
		$requette = "SELECT SUM(production) as production  FROM ligneproductionjour, produit WHERE ligneproductionjour.produit_id = produit.id AND produit.id = ? AND DATE(ligneproductionjour.created) >= ? AND DATE(ligneproductionjour.created) <= ? GROUP BY produit.id";
		$item = LIGNEPRODUCTIONJOUR::execute($requette, [$this->getId(), $date1, $date2]);
		if (count($item) < 1) {$item = [new LIGNEPRODUCTIONJOUR()]; }
		return $item[0]->production;
	}


	public function perte(string $date1 = "2020-04-01", string $date2){
		$total = 0;

		$requette = "SELECT SUM(perte) as perte FROM ligneproductionjour, produit WHERE ligneproductionjour.produit_id = produit.id AND produit.id = ? AND DATE(ligneproductionjour.created) >= ? AND DATE(ligneproductionjour.created) <= ? GROUP BY produit.id";
		$item = LIGNEPRODUCTIONJOUR::execute($requette, [$this->getId(), $date1, $date2]);
		if (count($item) < 1) {$item = [new LIGNEPRODUCTIONJOUR()]; }
		$total += $item[0]->perte;

		$requette = "SELECT SUM(quantite)-SUM(quantite_livree) as quantite FROM lignelivraison, produit, livraison WHERE lignelivraison.produit_id = produit.id AND lignelivraison.livraison_id = livraison.id AND livraison.etat_id != ? AND produit.id = ? AND DATE(lignelivraison.created) >= ? AND DATE(lignelivraison.created) <= ? GROUP BY produit.id";
		$item = LIGNELIVRAISON::execute($requette, [ETAT::ANNULEE, $this->getId(), $date1, $date2]);
		if (count($item) < 1) {$item = [new LIGNELIVRAISON()]; }
		$total -= $item[0]->quantite;

		return $total;
	}
	

	public function livree(string $date1 = "2020-04-01", string $date2){
		$requette = "SELECT SUM(quantite_livree) as quantite_livree  FROM lignelivraison, produit, livraison WHERE lignelivraison.produit_id = produit.id AND lignelivraison.livraison_id = livraison.id AND produit.id = ? AND livraison.etat_id != ? AND DATE(lignelivraison.created) >= ? AND DATE(lignelivraison.created) <= ? GROUP BY produit.id";
		$item = LIGNELIVRAISON::execute($requette, [$this->getId(), ETAT::ANNULEE, $date1, $date2]);
		if (count($item) < 1) {$item = [new LIGNELIVRAISON()]; }
		return $item[0]->quantite_livree;
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

		$requette = "SELECT SUM(production) - SUM(perte) as production  FROM ligneproductionjour, produit, productionjour WHERE ligneproductionjour.produit_id = produit.id AND produit.id = ? AND ligneproductionjour.productionjour_id = productionjour.id AND productionjour.etat_id = ? GROUP BY produit.id";
		$item = LIGNEPRODUCTIONJOUR::execute($requette, [$this->getId(), ETAT::VALIDEE]);
		if (count($item) < 1) {$item = [new LIGNEPRODUCTIONJOUR()]; }
		$total += $item[0]->production;


		$requette = "SELECT SUM(quantite) as quantite  FROM lignelivraison, produit, livraison WHERE lignelivraison.produit_id = produit.id AND lignelivraison.livraison_id = livraison.id AND produit.id = ? AND livraison.etat_id != ?  GROUP BY produit.id";
		$item = LIGNELIVRAISON::execute($requette, [$this->getId(), ETAT::ANNULEE]);
		if (count($item) < 1) {$item = [new LIGNELIVRAISON()]; }
		$total -= $item[0]->quantite;

		return $total;
	}



	public function enAttente(){
		$total = 0;

		$requette = "SELECT SUM(production) - SUM(perte) as production  FROM ligneproductionjour, produit, productionjour WHERE ligneproductionjour.produit_id = produit.id AND produit.id = ? AND ligneproductionjour.productionjour_id = productionjour.id AND productionjour.etat_id = ? GROUP BY produit.id";
		$item = LIGNEPRODUCTIONJOUR::execute($requette, [$this->getId(), ETAT::PARTIEL]);
		if (count($item) < 1) {$item = [new LIGNEPRODUCTIONJOUR()]; }
		return $item[0]->production;
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