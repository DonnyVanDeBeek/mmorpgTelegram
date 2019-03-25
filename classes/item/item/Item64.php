<?php
	//AMANITA MUSCARIA
	class Item64 extends Item{
		private $itemId = 64;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}