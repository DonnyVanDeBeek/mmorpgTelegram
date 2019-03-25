<?php
	//PEZZO DI FUNGO
	class Item73 extends Item{
		private $itemId = 73;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}