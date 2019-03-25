<?php
	//TESTA DI GOBLIN
	class Item97 extends Item{
		private $itemId = 97;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}