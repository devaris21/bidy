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


				foreach (RESSOURCE::getAll() as $key => $ressource) {
					$datas = EXIGENCEPRODUCTION::findBy(["produit_id ="=>$data->lastid, "ressource_id ="=>$ressource->getId()]);
					if (count($datas) == 0) {
						$ligne = new EXIGENCEPRODUCTION();
						$ligne->produit_id = $data->lastid;
						$ligne->quantite_produit = 0;
						$ligne->ressource_id = $ressource->getId();
						$ligne->quantite_ressource = 0;
						$ligne->enregistre();
					}					
				}

				$ligne = new PAYE_PRODUIT();
				$ligne->produit_id = $data->lastid;
				$ligne->price = 0;
				$ligne->enregistre();

				$ligne = new PAYEFERIE_PRODUIT();
				$ligne->produit_id = $data->lastid;
				$ligne->price = 0;
				$ligne->enregistre();

				// $ligne = new LIGNEPRODUCTIONJOUR();
				// $ligne->productionjour_id = 1;
				// $ligne->produit_id = $data->lastid;
				// $ligne->production = $this->stock;
				// $ligne->setCreated(PARAMS::DATE_DEFAULT);
				// $ligne->save();

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



	public function stock(string $date1 ="2020-05-01", string $date2){
		return intval($this->stock) + $this->production($date1, $date2) + $this->achat($date1, $date2) - ($this->perte($date1, $date2) + $this->livree($date1, $date2)) ;
	}



	public function achat(string $date1 ="2020-05-01", string $date2){
		$requette = "SELECT SUM(quantite_recu) as quantite  FROM ligneachatstock, achatstock WHERE ligneachatstock.produit_id = ? AND ligneachatstock.achatstock_id = achatstock.id AND achatstock.etat_id = ? AND DATE(achatstock.created) >= ? AND DATE(achatstock.created) <= ? ";
		$item = LIGNEACHATSTOCK::execute($requette, [$this->getId(), ETAT::VALIDEE, $date1, $date2]);
		if (count($item) < 1) {$item = [new LIGNEACHATSTOCK()]; }
		return $item[0]->quantite;
	}


	public function production(string $date1 ="2020-05-01", string $date2){
		$requette = "SELECT SUM(production) as production  FROM ligneproductionjour, productionjour WHERE ligneproductionjour.produit_id =  ? AND ligneproductionjour.productionjour_id = productionjour.id AND productionjour.etat_id != ? AND DATE(productionjour.ladate) >= ? AND DATE(productionjour.ladate) <= ?";
		$item = LIGNEPRODUCTIONJOUR::execute($requette, [$this->getId(), ETAT::ANNULEE, $date1, $date2]);
		if (count($item) < 1) {$item = [new LIGNEPRODUCTIONJOUR()]; }
		return $item[0]->production;
	}


	public function enAttente(){
		$requette = "SELECT SUM(production) as production  FROM ligneproductionjour, productionjour WHERE ligneproductionjour.produit_id =  ? AND ligneproductionjour.productionjour_id = productionjour.id AND productionjour.etat_id = ?";
		$item = LIGNEPRODUCTIONJOUR::execute($requette, [$this->getId(), ETAT::PARTIEL]);
		if (count($item) < 1) {$item = [new LIGNEPRODUCTIONJOUR()]; }
		return $item[0]->production;
	}


	public function perte(string $date1 ="2020-05-01", string $date2){
		$total = 0;
		$requette = "SELECT SUM(perte) as perte  FROM ligneproductionjour, productionjour WHERE ligneproductionjour.produit_id =  ? AND ligneproductionjour.productionjour_id = productionjour.id AND productionjour.etat_id != ? AND DATE(productionjour.ladate) >= ? AND DATE(productionjour.ladate) <= ?";
		$item = LIGNEPRODUCTIONJOUR::execute($requette, [$this->getId(), ETAT::ANNULEE, $date1, $date2]);
		if (count($item) < 1) {$item = [new LIGNEPRODUCTIONJOUR()]; }
		$total += $item[0]->perte;

		$requette = "SELECT SUM(perte) as perte  FROM ligneautrepertejour, productionjour WHERE ligneautrepertejour.produit_id = ? AND ligneautrepertejour.productionjour_id = productionjour.id AND productionjour.etat_id != ? AND DATE(productionjour.ladate) <= ? AND DATE(productionjour.ladate) >= ? ";
		$item = LIGNEAUTREPERTEJOUR::execute($requette, [$this->getId(), ETAT::ANNULEE, $date1, $date2]);
		if (count($item) < 1) {$item = [new LIGNEAUTREPERTEJOUR()]; }
		$total += $item[0]->perte;

		$requette = "SELECT SUM(quantite)-SUM(quantite_livree) as quantite, SUM(perte) as perte FROM lignelivraison, livraison WHERE lignelivraison.produit_id = ? AND lignelivraison.livraison_id = livraison.id AND livraison.etat_id != ? AND DATE(lignelivraison.created) >= ? AND DATE(lignelivraison.created) <= ? ";
		$item = LIGNELIVRAISON::execute($requette, [$this->getId(), ETAT::ANNULEE, $date1, $date2]);
		if (count($item) < 1) {$item = [new LIGNELIVRAISON()]; }
		$total += $item[0]->quantite + $item[0]->perte;

		return $total;
	}
	

	public function livree(string $date1 ="2020-05-01", string $date2){
		$requette = "SELECT SUM(quantite_livree) as quantite  FROM lignelivraison, livraison WHERE lignelivraison.produit_id = ? AND lignelivraison.livraison_id = livraison.id AND livraison.etat_id != ? AND DATE(lignelivraison.created) >= ? AND DATE(lignelivraison.created) <= ? ";
		$item = LIGNELIVRAISON::execute($requette, [$this->getId(), ETAT::ANNULEE, $date1, $date2]);
		if (count($item) < 1) {$item = [new LIGNELIVRAISON()]; }
		return $item[0]->quantite;
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
			return $this->stock(PARAMS::DATE_DEFAULT, dateAjoute()) - $this->enAttente();
	}






	public function exigence(int $quantite, int $ressource_id){
		$datas = EXIGENCEPRODUCTION::findBy(["produit_id ="=>$this->getId(), "ressource_id ="=>$ressource_id]);
		if (count($datas) == 1) {
			$item = $datas[0];
			if ($item->quantite_produit == 0) {
				return 0;
			}
			return ($quantite * $item->quantite_ressource) / $item->quantite_produit;
		}
		return 0;
	}


	public function coutProduction(String $type, int $quantite){
		if(isJourFerie(dateAjoute())){
			$datas = PAYEFERIE_PRODUIT::findBy(["produit_id ="=>$this->getId()]);
		}else{
			$datas = PAYE_PRODUIT::findBy(["produit_id ="=>$this->getId()]);
		}
		if (count($datas) > 0) {
			$ppr = $datas[0];
			switch ($type) {
				case 'production':
				$prix = $ppr->price;
				break;
				
				case 'rangement':
				$prix = $ppr->price_rangement;
				break;

				case 'livraison':
				$prix = $ppr->price_livraison;
				break;

				default:
				$prix = $ppr->price;
				break;
			}
			return $quantite * $prix;
		}
		return 0;
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