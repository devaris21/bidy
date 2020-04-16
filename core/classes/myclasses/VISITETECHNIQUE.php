<?php
namespace Home;
use Native\RESPONSE;
use Native\FICHIER;



/**
 * 
 */
class VISITETECHNIQUE extends TABLE
{

	public static $tableName = __CLASS__;
	public static $namespace = __NAMESPACE__;


	public $name;
	public $numero_piece;
	public $vehicule_id;
	public $date_etablissement; 
	public $started;
	public $finished;
	public $duree;
	public $typeduree_id;
	public $etatpiece_id = 0;
	public $price;
	public $gestionnaire_id;
	public $image1;
	public $image2;



	public function enregistre(){
		$data = new RESPONSE;
		if ($this->price >= 0) {
			if ($this->numero_piece != "") {
				$this->vehicule_id = getSession("vehicule_id");
				$datas = VEHICULE::findBy(["id ="=>$this->vehicule_id]);
				if (count($datas) == 1) {
					$this->name = "VISITE TECHNIQUE ".date("Y", strtotime($this->date_etablissement));
					$this->gestionnaire_id = getSession("gestionnaire_connecte_id");
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
				$result = $image->upload("images", "visitetechniques", $a);
				$this->image1 = $result->filename;
				$this->save();
			}
		}
		if (isset($this->image2) && $this->image2["tmp_name"] != "") {
			$image = new FICHIER();
			$image->hydrater($this->image2);
			if ($image->is_image()) {
				$a = substr(uniqid(), 5);
				$result = $image->upload("images", "visitetechniques", $a);
				$this->image2 = $result->filename;
				$this->save();
			}
		}
	}


	public static function coutAnnuel(){
		return comptage(static::findBy(["DATE(date_etablissement) >= "=> date("Y")."-01-01"]), "price", "somme");
	}

	
	public function sentenseCreate(){}
	public function sentenseUpdate(){}
	public function sentenseDelete(){}

}



?>