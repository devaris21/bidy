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
					$lots = $produit->fourni("exigenceproduction");
					if (count($lots) == 1 ) {
						$exi = $lots[0];
						$datas = LIGNEEXIGENCEPRODUCTION::findBy(["exigenceproduction_id ="=>$exi->getId(), "ressource_id ="=>$data->lastid]);
						if (count($datas) == 0) {
							$ligne = new LIGNEEXIGENCEPRODUCTION();
							$ligne->exigenceproduction_id = $exi->getId();
							$ligne->ressource_id = $data->lastid;
							$ligne->quantite = 0;
							$ligne->enregistre();
						}
					}
				}

				$ligne = new LIGNEAPPROVISIONNEMENT();
				$ligne->approvisionnement_id = 1;
				$ligne->ressource_id = $data->lastid;
				$ligne->quantite = $ligne->quantite_recu = $this->stock;
				$ligne->save();

				$ligne = new LIGNECONSOMMATIONJOUR();
				$ligne->productionjour_id = 1;
				$ligne->ressource_id = $data->lastid;
				$ligne->consommation = 0;
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



	public function stock(String $date){
		$total = 0;
		$requette = "SELECT SUM(quantite_recu) as quantite  FROM ligneapprovisionnement, ressource, approvisionnement WHERE ligneapprovisionnement.ressource_id = ressource.id AND ressource.id = ? AND ligneapprovisionnement.approvisionnement_id = approvisionnement.id AND DATE(approvisionnement.created) <= ? AND approvisionnement.etat_id = ? GROUP BY ressource.id";
		$item = LIGNEAPPROVISIONNEMENT::execute($requette, [$this->getId(), $date, ETAT::VALIDEE]);
		if (count($item) < 1) {$item = [new LIGNEAPPROVISIONNEMENT()]; }
		$total += $item[0]->quantite;


		$requette = "SELECT SUM(consommation) as consommation  FROM ligneconsommationjour, ressource, productionjour WHERE ligneconsommationjour.ressource_id = ressource.id AND ressource.id = ? AND ligneconsommationjour.productionjour_id = productionjour.id AND DATE(productionjour.ladate) <= ? GROUP BY ressource.id";
		$item = LIGNECONSOMMATIONJOUR::execute($requette, [$this->getId(), $date]);
		if (count($item) < 1) {$item = [new LIGNECONSOMMATIONJOUR()]; }
		$total -= $item[0]->consommation;

		return $total;
	}



	public function consommee(string $date1 = "2020-04-01", string $date2){
		$total = 0;
		$datas = $this->fourni("ligneconsommationjour", ["DATE(created) >= " => $date1, "DATE(created) <= " => $date2]);
		foreach ($datas as $key => $ligne) {
			$total += $ligne->consommation;			
		}
		return $total;
	}



	public function exigence(int $quantite, int $produit_id){
		$total = 0;
		$datas = $this->fourni("exigenceproduction");
		foreach ($datas as $key => $exigence) {
			$lot =  $exigence->fourni("ligneexigenceproduction", ["ressource_id ="=>$ressource_id])();
			foreach ($lot as $cle => $item) {
				$total += ($quantite * $item->quantite) / $exigence->quantite;
			}
		}
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