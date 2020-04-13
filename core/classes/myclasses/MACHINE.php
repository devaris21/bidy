<?php
namespace Home;
use Native\RESPONSE;
use Native\FICHIER;
/**
 * 
 */
class MACHINE extends TABLE
{
	public static $tableName = __CLASS__;
	public static $namespace = __NAMESPACE__;

	public $name;
	public $marque;
	public $image = "default.jpg";
	public $modele;
	public $etatvehicule_id;


	public function enregistre(){
		$data = new RESPONSE;
		if ($this->name != "" && $this->marque != "") {
			$data = $this->save();
			if ($data->status) {
				if (isset($this->photo) && $this->photo["tmp_name"] != "") {
					$image = new FICHIER();
					$image->hydrater($this->photo);
					if ($image->is_image()) {
						$a = substr(uniqid(), 5);
						$result = $image->upload("images", "machines", $a);
						$this->image = $result->filename;
						$this->save();
					}
				}
			}
		}else{
			$data->status = false;
			$data->message = "Veuillez renseigner tous les champs !";
		}
		return $data;
	}
	

	/////////////////////////


	public function affectation(){
		$this->actualise();
		$this->fonction = "";
		if ($this->is_affecte()) {
			$datas = AFFECTATION::findBy(["vehicule_id="=>$this->getId(), "etat_id="=>0]);
			if (count($datas) > 0) {
				$affectation = $datas[0];
				return $affectation->actualise();
			}
		}
		return null;
	}


	public function is_affecte(){
		$datas = AFFECTATION::findBy(["vehicule_id ="=> $this->getId(), "etat_id="=>0]);
		if (count($datas) > 0) {
			return true;
		}else{
			return false;
		}
	}


	public function en_pret(){
		$this->etat();
		if ($this->etatvehicule_id == 4) {
			return true;
		}else{
			return false;
		}
	}

	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////


	public function indisponible(){
		$this->historique("Le vehicule ".$this->name()." est maintenant indisponible !");
		$this->etatvehicule_id = -1;
		return $this->save();
	}
	public function disponible(){
		$this->historique("Le vehicule ".$this->name()." est de nouveau disponible !");
		$this->etatvehicule_id = 0;
		return $this->save();
	}


	public function in(){
		$this->historique("Le vehicule ".$this->name()." fait de nouveau partir du parc !");
		$this->etatvehicule_id = 0;
		$this->date_sortie = null;
		return $this->save();
	}
	public function out(){
		$data = new RESPONSE;
		if ($this->location == 0) {
			$this->historique("Le vehicule ".$this->name()." ne fait plus partir du parc !");
			$this->etatvehicule_id = -2;
			$this->date_sortie = dateAjoute();
			$data =  $this->save();
		}else{
			$data->status = false;
			$data->message = "Ce véhicule est en location chez ARTCI, il ne peut donc être déclasser !";
		}
		return $data;
	}




////////////////////////////////////////////////////////////////////////////

	public static function parcauto(){
		static::etat();
		return static::findBy(["etatvehicule_id !="=> -2]);
	}

	public static function libres(){
		static::etat();
		return static::findBy(["etatvehicule_id ="=>0]);
	}

	public static function mission(){
		return static::findBy(["etatvehicule_id ="=>2]);
	}

	public static function open(){
		static::etat();
		$datas = static::findBy(["etatvehicule_id ="=>0]);
		foreach ($datas as $key => $vehicule) {
			if (!in_array($vehicule->groupevehicule_id, GROUPEVEHICULEOPEN::get())) {
				unset($datas[$key]);
			}
		}
		return $datas;
	}



	public static function pret_location(){
		$datas = static::loues();
		$datas1 = static::pretes();
		foreach ($datas1 as $key => $vehicule1) {
			foreach ($datas as $key => $vehicule) {
				if ($vehicule1->getId() == $vehicule->getId()) {
					unset($datas1[$key]);
				}
			}
		}
		return array_merge($datas, $datas1);
	}

////////////////////////////////////////////////////////////////////////////

	public static function co2(){
		$datas = static::findBy(["etatvehicule_id !="=> -2]);
		foreach ($datas as $key => $vehicule) {
			$carte = $vehicule->carteGrise();
			$total += dateDiffe($vehicule->date_mise_circulation, date("Y-m-d"));
		}
	}

	public static function carburant(){
		$datas = static::findBy(["etatvehicule_id !="=> -2]);
	}

	public static function avgKM(){
		$datas = static::findBy(["etatvehicule_id !="=> -2]);
		return comptage($datas, "kilometrage", "avg");
	}

	public static function avgAge(){
		$total = 0;
		$datas = static::findBy(["etatvehicule_id !="=> -2]);
		foreach ($datas as $key => $vehicule) {
			$total += dateDiffe($vehicule->date_mise_circulation, date("Y-m-d"));
		}
		return ceil($total / 30);
	}

////////////////////////////////////////////////////////////////////////////////////////////////////////////


	public function sentenseCreate(){
		return $this->sentense = "Enregistrement d'un nouveau véhicule N°$this->id immatriculé $this->immatriculation.";
	}


	public function sentenseUpdate(){
		return $this->sentense = "Modification des infos du véhicule N°$this->id immatriculé $this->immatriculation.";
	}


	public function sentenseDelete(){
		return $this->sentense = "Suppression définitive du véhicule N°$this->id immatriculé $this->immatriculation dans la base de données.";
	}

}
?>