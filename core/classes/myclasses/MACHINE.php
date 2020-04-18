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
			$data = $this->save();
					if ($data->status) {
						$this->uploading($this->files);
					}
		}else{
			$data->status = false;
			$data->message = "Veuillez renseigner tous les champs !";
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
						$result = $image->upload("images", "machines", $a);
						$name = $tab[$i];
						$this->$name = $result->filename;
						$this->save();
					}
				}	
				$i++;			
			}			
		}
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


////////////////////////////////////////////////////////////////////////////////////////////////////
/// 
/// 
	public function sentenseCreate(){
		return $this->sentense = "Enregistrement d'un nouveau machine ".$this->name();
	}


	public function sentenseUpdate(){
		return $this->sentense = "Modification des infos du machine N°$this->id ". $this->name();
	}


	public function sentenseDelete(){
		return $this->sentense = "Suppression définitive du machine N°$this->id ". $this->name();
	}

}
?>