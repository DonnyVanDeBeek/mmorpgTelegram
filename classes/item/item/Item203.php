<?php
	//TROBOLI
	class Item203 extends Item{
		private $itemId = 203;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}