<?php
	//NINFEA
	class Item132 extends Item{
		private $itemId = 132;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}