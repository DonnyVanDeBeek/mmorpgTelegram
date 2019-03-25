<?php
	//CHIAVE SCHELETRO
	class Item21 extends Item{
		private $itemId = 21;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}