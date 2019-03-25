<?php
	//POLVERE ESPLOSIVA
	class Item38 extends Item{
		private $itemId = 38;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}