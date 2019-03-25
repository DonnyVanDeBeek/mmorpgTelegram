<?php
	//BOTTIGLIA VUOTA
	class Item137 extends Item{
		private $itemId = 137;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}