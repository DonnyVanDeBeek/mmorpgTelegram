<?php
	//BACCA DI LEPROSPINO
	class Item128 extends Item{
		private $itemId = 128;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}