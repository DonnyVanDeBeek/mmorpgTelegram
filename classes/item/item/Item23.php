<?php
	//OLIO
	class Item23 extends Item{
		private $itemId = 23;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}