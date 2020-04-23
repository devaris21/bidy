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
		//$datas = $this->fourni("ligneproductionjour", ["DATE(created) <= "=>$date]);
		$datas = $this->fourni("ligneapprovisionnement");
		foreach ($datas as $key => $ligne) {
			$ligne->actualise();
			if (date("Y-m-d", strtotime($ligne->approvisionnement->created)) <= $date && $ligne->approvisionnement->etat_id == ETAT::TERMINEE) {
				$total += intval($ligne->quantite_recu);
			}			
		}

		$datas = $this->fourni("ligneconsommationjour");
		foreach ($datas as $key => $ligne) {
			$ligne->actualise();
			if ($ligne->productionjour->ladate <= $date) {
				$total -= intval($ligne->consommation);
			}			
		}
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