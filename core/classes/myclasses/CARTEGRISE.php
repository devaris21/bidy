<?php
namespace Home;
use Native\RESPONSE;
use Native\FICHIER;


/**
 * 
 */
class CARTEGRISE extends TABLE
{

	public static $tableName = __CLASS__;
	public static $namespace = __NAMESPACE__;


	public $name;
	public $numero_piece;
	public $vehicule_id;
	public $date_etablissement; 
	public $price;
	public $couleur;
	public $energie_id;


	public function enregistre(){
		$data = new RESPONSE;
		if ($this->price >= 0) {
			if ($this->numero_piece != "") {
				$this->vehicule_id = getSession("vehicule_id");
				$datas = VEHICULE::findBy(["id ="=>$this->vehicule_id]);
				if (count($datas) == 1) {
					$this->name = "CARTE GRISE ".date("Y", strtotime($this->date_etablissement));
					$data = $this->save();
					if ($data->status) {
						$this->uploading($this->files);
					}
				}else{
					$data->status = false;
					$data->message = "Une erreur s'est produite lors de l'opération, veuillez recommencer !";
				}
			}else{
				$data->status = false;
				$data->message = "Veuillez renseigner les champs marqués d'un * !";
			}
		}else{
			$data->status = false;
			$data->message = "Veuillez entrer un prix correct pour cette piece !";
		}		
		return $data;
	}


	public function uploading(Array $files){
		if (isset($this->image1) && $this->image1["tmp_name"] != "") {
			$image = new FICHIER();
			$image->hydrater($this->image1);
			if ($image->is_image()) {
				$a = substr(uniqid(), 5);
				$result = $image->upload("images", "cartegrises", $a);
				$this->image1 = $result->filename;
				$this->save();
			}
		}
		if (isset($this->image2) && $this->image2["tmp_name"] != "") {
			$image = new FICHIER();
			$image->hydrater($this->image2);
			if ($image->is_image()) {
				$a = substr(uniqid(), 5);
				$result = $image->upload("images", "cartegrises", $a);
				$this->image2 = $result->filename;
				$this->save();
			}
		}
	}


	public static function coutAnnuel(){
		return comptage(static::findBy(["DATE(date_etablissement) >= "=> date("Y")."-01-01"]), "price", "somme");
	}


	public function sentenseCreate(){
		return $this->sentense = "Nouvelle carte grise pour la ".$this->vehicule->name();
	}

	public function sentenseUpdate(){}
	public function sentenseDelete(){}

}



?>