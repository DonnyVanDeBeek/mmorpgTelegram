<?php
	//LEGNO
	class Item9 extends Item{
		private $itemId = 9;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}