<?php
namespace Home;
use Native\RESPONSE;
use Native\FICHIER;
/**
 * 
 */
class ACCESSOIRE extends TABLE
{
	public static $tableName = __CLASS__;
	public static $namespace = __NAMESPACE__;

	public $typeaccessoire_id;
	public $name;
	public $marque;
	public $price = 0;
	public $stock = 0;
	public $comment;
	public $image;


	public function enregistre(){
		$data = new RESPONSE;
		if ($this->name != "") {
			$data = $this->save();
			if ($data->status) {
				if (isset($this->photo) && $this->photo["tmp_name"] != "") {
					$image = new FICHIER();
					$image->hydrater($this->photo);
					if ($image->is_image()) {
						$a = substr(uniqid(), 5);
						$result = $image->upload("images", "accessoires", $a);
						$this->image = $result->filename;
						$this->save();
					}
				}
			}
		}else{
			$data->status = false;
			$data->message = "Veuillez renseigner le nom du produit !";
		}
		return $data;
	}


	public static function stock(){
		return comptage(self::getAll(), "stock", "somme");
	}


	public static function utilises(){
		return comptage(ACCESSOIRE_VEHICULE::getAll(), "quantite", "somme");
	}


	public function destock(Int $qte){
		$data = new RESPONSE;
		if (intval($qte) > 0) {
			if ($this->stock >= $qte) {
				$this->stock -= $qte;
				$this->historique("Déstockage de l'accessoire $this->name pour $qte unités ");
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




	public function approvisionner(Int $qte, Int $price){
		$data = new RESPONSE;
		if (intval($qte) > 0) {
			if (intval($price) > 0) {
				if ($this->stock < 0) {
					$this->stock = 0;
				}
				$this->stock += $qte;
				$this->historique("Approvisionnement de stock de l'accessoire $this->name à +$qte unités !");
				$data = $this->save();
				if ($data->status) {
					$app = new APPROVISIONNEMENT;
					$app->accessoire_id = $data->lastid;
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




	public function sentenseCreate(){
		return $this->sentense = "Enregistrement d'un nouveau accessoire $this->name .";
	}


	public function sentenseUpdate(){
		return $this->sentense = "Modification des infos de l'accessoire N°$this->id  $this->name .";
	}


	public function sentenseDelete(){
		return $this->sentense = "Suppression définitive de l'accessoire $this->name  dans la base de données.";
	}

}



?>