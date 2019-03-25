<?php
	//POLVERE CORROSIVA
	class Item170 extends Item{
		private $itemId = 170;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}