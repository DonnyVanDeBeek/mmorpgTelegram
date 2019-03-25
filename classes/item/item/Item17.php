<?php
	//BIRRA
	class Item17 extends Item{
		private $itemId = 17;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}