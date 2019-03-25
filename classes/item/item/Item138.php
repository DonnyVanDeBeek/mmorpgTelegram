<?php
	//BOTTIGLIA D'ACQUA
	class Item138 extends Item{
		private $itemId = 138;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}