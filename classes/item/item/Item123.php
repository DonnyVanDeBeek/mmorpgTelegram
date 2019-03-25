<?php
	//TAROCCO DELLA TORRE
	class Item123 extends Item{
		private $itemId = 123;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}