<?php
	//ANTIMATERIA
	class Item14 extends Item{
		private $itemId = 14;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}