<?php
	//MUSO DI CINGHIALE
	class Item49 extends Item{
		private $itemId = 49;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}