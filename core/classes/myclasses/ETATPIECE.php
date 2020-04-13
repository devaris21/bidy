<?php
namespace Home;
use Native\RESPONSE;/**
 * 
 */
class ETATPIECE extends TABLE
{

	/* -1 = annuler;
		0= encours
		1= terminer
		*/

		public static $tableName = __CLASS__;
		public static $namespace = __NAMESPACE__;

		public $name;
		public $class;

		public function enregistre(){}


		public function sentenseCreate(){}
		public function sentenseUpdate(){}
		public function sentenseDelete(){}

	}
	?>