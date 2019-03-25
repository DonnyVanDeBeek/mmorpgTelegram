<?php
	//CIONDOLO DELLA NONNA
	class Item171 extends Item{
		private $itemId = 171;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}