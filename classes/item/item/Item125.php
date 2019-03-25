<?php
	//CIPOLLA SELVATICA
	class Item125 extends Item{
		private $itemId = 125;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}