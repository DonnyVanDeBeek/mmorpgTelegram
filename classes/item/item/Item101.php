<?php
	//CUORE DI TROLL
	class Item101 extends Item{
		private $itemId = 101;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}