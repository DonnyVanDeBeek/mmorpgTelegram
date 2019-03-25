<?php
	//FOGLIO DI CARTA
	class Item66 extends Item{
		private $itemId = 66;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}