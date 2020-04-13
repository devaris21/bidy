<?php
namespace Home;
use Native\RESPONSE;/**
 * 
 */
class EXIGENCEPRODUCTION extends TABLE
{

	public static $tableName = __CLASS__;
	public static $namespace = __NAMESPACE__;

	public $produit_id;
	public $quantite;
	


	public function enregistre(){
		$data = new RESPONSE;
		$this->ladate = dateAjoute();
		return $this->save();
	}



	public static function today(){
		$datas = static::findBy(["ladate ="=>dateAjoute()]);
		if (count($datas) > 0) {
			return $datas[0];
		}else{
			$ti = new PRODUCTIONJOUR();
			$data = $ti->enregistre();
			if ($data->status) {
				foreach (PRODUIT::getAll() as $key => $produit) {
					$ligne = new LIGNEPRODUCTIONJOUR();
					$ligne->productionjour_id = $data->lastid;
					$ligne->produit_id = $produit->getId();
					$ligne->enregistre();
				}

				foreach (RESSOURCE::getAll() as $key => $ressource) {
					$ligne = new LIGNECONSOMMATIONJOUR();
					$ligne->productionjour_id = $data->lastid;
					$ligne->ressource_id = $ressource->getId();
					$ligne->enregistre();
				}
			}
			return $ti;
		}
	}


	public function sentenseCreate(){}
	public function sentenseUpdate(){}
	public function sentenseDelete(){}


}
?>