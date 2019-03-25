<?php
	//TESTA DI ASCIA
	class Item31 extends Item{
		private $itemId = 31;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}