<?php
	//DIAMANTE
	class Item4 extends Item{
		private $itemId = 4;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}