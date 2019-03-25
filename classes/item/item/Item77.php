<?php
	//LIQUORE DI CIPOLLA
	class Item77 extends Item{
		private $itemId = 77;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}