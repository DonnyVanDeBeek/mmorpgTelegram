<?php
	//TESTA DI MANTICORA
	class Item59 extends Item{
		private $itemId = 59;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}