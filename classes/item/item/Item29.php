<?php
	//FUOCO D'ARTIFICIO
	class Item29 extends Item{
		private $itemId = 29;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}