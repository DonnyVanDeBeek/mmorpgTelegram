<?php
	//CRANIO INCENDIARIO
	class Item50 extends Item{
		private $itemId = 50;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}