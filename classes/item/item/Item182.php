<?php
	//EFFIGIE DI LEGNO
	class Item182 extends Item{
		private $itemId = 182;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}