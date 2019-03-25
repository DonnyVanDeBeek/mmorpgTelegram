<?php
	//TESTA D'ASCIA
	class Item110 extends Item{
		private $itemId = 110;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}