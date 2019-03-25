<?php
	//FUNGHI DI LUNA
	class Item24 extends Item{
		private $itemId = 24;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}