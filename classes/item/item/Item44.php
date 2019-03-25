<?php
	//PEZZO DI FERRO
	class Item44 extends Item{
		private $itemId = 44;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}