<?php
	//FORCINA
	class Item22 extends Item{
		private $itemId = 22;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}