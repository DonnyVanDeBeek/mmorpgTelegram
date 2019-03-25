<?php
	//RENE D`ORCO
	class Item85 extends Item{
		private $itemId = 85;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}