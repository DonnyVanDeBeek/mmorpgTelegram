<?php
	//TAUTITE
	class Item180 extends Item{
		private $itemId = 180;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}