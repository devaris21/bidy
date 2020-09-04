<?php
namespace Home;
use Native\RESPONSE;
use Native\EMAIL;
use Native\FICHIER;
/**
 * 
 */
class RESSOURCE extends TABLE
{
	public static $tableName = __CLASS__;
	public static $namespace = __NAMESPACE__;

	public $name;
	public $description;
	public $unite;
	public $abbr;
	public $image = "default.png";
	public $stock = 0;


	public function enregistre(){
		$data = new RESPONSE;
		if ($this->name != "") {
			$data = $this->save();
			if ($data->status) {
				$this->uploading($this->files);

				foreach (PRODUIT::getAll() as $key => $produit) {
					$datas = EXIGENCEPRODUCTION::findBy(["produit_id ="=>$produit->getId(), "ressource_id ="=>$data->lastid]);
					if (count($datas) == 0) {
						$ligne = new EXIGENCEPRODUCTION();
						$ligne->ressource_id = $data->lastid;
						$ligne->quantite_produit = 0;
						$ligne->produit_id = $produit->getId();
						$ligne->quantite_ressource = 0;
						$ligne->enregistre();
					}
				}

				// $ligne = new LIGNEAPPROVISIONNEMENT();
				// $ligne->approvisionnement_id = 1;
				// $ligne->ressource_id = $data->lastid;
				// $ligne->quantite = $ligne->quantite_recu = $this->stock;
				// $ligne->save();

				// $ligne = new LIGNECONSOMMATIONJOUR();
				// $ligne->productionjour_id = 1;
				// $ligne->ressource_id = $data->lastid;
				// $ligne->consommation = 0;
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
						$result = $image->upload("images", "ressources", $a);
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



	public function stock(String $date1, String $date2){
		return $this->achat($date1, $date2) - $this->consommee($date1, $date2) - $this->perte($date1, $date2) + intval($this->initial);
	}


	public function achat(string $date1, string $date2){
		$requette = "SELECT SUM(quantite_recu) as quantite  FROM ligneapprovisionnement, approvisionnement WHERE ligneapprovisionnement.ressource_id = ? AND ligneapprovisionnement.approvisionnement_id = approvisionnement.id AND approvisionnement.etat_id = ? AND DATE(approvisionnement.created) >= ? AND DATE(approvisionnement.created) <= ? ";
		$item = LIGNEAPPROVISIONNEMENT::execute($requette, [$this->id, ETAT::VALIDEE, $date1, $date2]);
		if (count($item) < 1) {$item = [new LIGNEAPPROVISIONNEMENT()]; }
		return $item[0]->quantite;
	}



	public function consommee(string $date1, string $date2){
		$requette = "SELECT SUM(consommation) as consommation  FROM ligneconsommationjour, productionjour WHERE ligneconsommationjour.ressource_id =  ? AND ligneconsommationjour.productionjour_id = productionjour.id AND productionjour.etat_id = ? AND DATE(productionjour.created) >= ? AND DATE(productionjour.created) <= ? ";
		$item = LIGNECONSOMMATIONJOUR::execute($requette, [$this->id, ETAT::VALIDEE, $date1, $date2]);
		if (count($item) < 1) {$item = [new LIGNECONSOMMATIONJOUR()]; }
		return $item[0]->consommation;
	}



	public function perte(string $date1, string $date2){
		$requette = "SELECT SUM(quantite) as quantite  FROM perteentrepot WHERE perteentrepot.ressource_id = ? AND  perteentrepot.etat_id = ? AND DATE(perteentrepot.created) >= ? AND DATE(perteentrepot.created) <= ? ";
		$item = PERTEENTREPOT::execute($requette, [$this->id, ETAT::VALIDEE, $date1, $date2]);
		if (count($item) < 1) {$item = [new PERTEENTREPOT()]; }
		return $item[0]->quantite;
	}




	public function exigence(int $quantite, int $produit_id){
		$datas = EXIGENCEPRODUCTION::findBy(["ressource_id ="=>$this->getId(), "produit_id ="=>$produit_id]);
		if (count($datas) == 1) {
			$item = $datas[0];
			if ($item->quantite_ressource == 0) {
				return 0;
			}
			return ($quantite * $item->quantite_produit) / $item->quantite_ressource;
		}
		return 0;
	}


	public function price(){
		$requette = "SELECT SUM(quantite_recu) as quantite, SUM(ligneapprovisionnement.price) as price FROM ligneapprovisionnement, approvisionnement WHERE ligneapprovisionnement.ressource_id = ? AND ligneapprovisionnement.approvisionnement_id = approvisionnement.id AND approvisionnement.etat_id = ? ";
		$datas = LIGNEAPPROVISIONNEMENT::execute($requette, [$this->id, ETAT::VALIDEE]);
		if (count($datas) < 1) {$datas = [new LIGNEAPPROVISIONNEMENT()]; }
		$item = $datas[0];

		if ($item->quantite == 0) {
			return 0;
		}
		$total = ($item->price / $item->quantite);
		return $total;
	}


	public function sentenseCreate(){
		return $this->sentense = "Ajout d'une nouvelle ressource : $this->name dans les paramétrages";
	}
	public function sentenseUpdate(){
		return $this->sentense = "Modification des informations de la ressource $this->id : $this->name ";
	}
	public function sentenseDelete(){
		return $this->sentense = "Suppression definitive de la ressource $this->id : $this->name";
	}


}



?>