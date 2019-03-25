<?php
	//LAMA DI COLTELLO
	class Item55 extends Item{
		private $itemId = 55;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}