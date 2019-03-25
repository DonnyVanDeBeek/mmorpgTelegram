<?php
	//CARNE CRUDA DI CINGHIALE
	class Item27 extends Item{
		private $itemId = 27;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}