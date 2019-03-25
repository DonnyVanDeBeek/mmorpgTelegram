<?php
	//IDENTIKIT DELL'UOMO IN VERDE
	class Item213 extends Item{
		private $itemId = 213;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}