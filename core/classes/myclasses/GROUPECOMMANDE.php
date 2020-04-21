<?php
namespace Home;
use Native\RESPONSE;/**
 * 
 */
class GROUPECOMMANDE extends TABLE
{

	public static $tableName = __CLASS__;
	public static $namespace = __NAMESPACE__;

	public $client_id;
	public $etat_id = ETAT::ENCOURS;
	

	public function enregistre(){
		return $data = $this->save();
	}


	public static function etat(){
		foreach (static::findBy(["etat_id ="=>ETAT::ENCOURS]) as $key => $groupe) {
			$test = false;
			foreach (PRODUIT::getAll() as $key => $produit) {
				if ($groupe->reste($produit->getId()) > 0) {
					$test = true;
					break;
				}
			}
			if (!$test) {
				$groupe->etat_id = ETAT::VALIDEE;
				$groupe->save();
			}
		}
	} 

	public static function encours(){
		return static::findBy(["etat_id ="=>ETAT::ENCOURS]);
	}


	public function reste(int $produit_id){
		$total = 0;
		$datas = $this->fourni("commande", ["etat_id !="=>ETAT::ANNULEE]);
		foreach ($datas as $key => $item) {
			$lots = $item->fourni("lignecommande", ["produit_id ="=>$produit_id]);
			$total += comptage($lots, "quantite", "somme");
		}
		$datas = $this->fourni("livraison", ["etat_id !="=>ETAT::ANNULEE]);
		foreach ($datas as $key => $item) {
			$lots = $item->fourni("lignelivraison", ["produit_id ="=>$produit_id]);
			$total -= comptage($lots, "quantite_livree", "somme");
		}
		return $total;
	}


	public function sentenseCreate(){}
	public function sentenseUpdate(){}
	public function sentenseDelete(){}


}
?>