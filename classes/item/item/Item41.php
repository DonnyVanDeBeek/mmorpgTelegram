<?php
	//TESSUTO DI IUTA
	class Item41 extends Item{
		private $itemId = 41;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}