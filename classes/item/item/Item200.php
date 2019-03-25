<?php
	//CANNA DI PALUDE
	class Item200 extends Item{
		private $itemId = 200;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}