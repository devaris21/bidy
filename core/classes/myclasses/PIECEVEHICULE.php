<?php
namespace Home;
use Native\RESPONSE;
use Native\FICHIER;



/**
 * 
 */
class PIECEVEHICULE extends TABLE
{

	public static $tableName = __CLASS__;
	public static $namespace = __NAMESPACE__;


	public $name;
	public $numero_piece;
	public $vehicule_id;
	public $typepiecevehicule_id;
	public $date_etablissement; 
	public $started;
	public $finished;
	public $price;
	public $duree;
	public $typeduree_id;
	public $etatpiece_id = 1;
	public $gestionnaire_id;
	public $image1;
	public $image2;

	

	public function enregistre(){
		$data = new RESPONSE;
		if ($this->price >= 0) {
			if ($this->numero_piece != "") {
				$datas = TYPEPIECEVEHICULE::findBy(["id ="=>$this->typepiecevehicule_id]);
				if (count($datas) == 1) {
					$item = $datas[0];
					$this->name = $item->name." ".date("Y", strtotime($this->date_etablissement));
					$this->vehicule_id = getSession("vehicule_id");
					$datas = VEHICULE::findBy(["id ="=>$this->vehicule_id]);
					if (count($datas) == 1) {
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


	public function etat(){
		if ($this->finished >= dateAjoute()) {
			$this->etatpiece_id = 1;
		}else{
			$this->etatpiece_id = -1;
		}
		$this->save();
	}



	public function uploading(Array $files){
		if (isset($this->image1) && $this->image1["tmp_name"] != "") {
			$image = new FICHIER();
			$image->hydrater($this->image1);
			if ($image->is_image()) {
				$a = substr(uniqid(), 5);
				$result = $image->upload("images", "piecevehicules", $a);
				$this->image1 = $result->filename;
				$this->save();
			}
		}
		if (isset($this->image2) && $this->image2["tmp_name"] != "") {
			$image = new FICHIER();
			$image->hydrater($this->image2);
			if ($image->is_image()) {
				$a = substr(uniqid(), 5);
				$result = $image->upload("images", "piecevehicules", $a);
				$this->image2 = $result->filename;
				$this->save();
			}
		}
	}


	public static function coutAnnuel(){
		return comptage(static::findBy(["DATE(date_etablissement) >= "=> date("Y")."-01-01"]), "price", "somme");
	}

	
	public function sentenseCreate(){
		return $this->sentense = "Nouvelle piece administrative pour la ".$this->vehicule->name();
	}

	public function sentenseUpdate(){}
	public function sentenseDelete(){}

}



?>