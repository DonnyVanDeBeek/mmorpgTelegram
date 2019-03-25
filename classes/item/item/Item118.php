<?php
	//FUOCO ARTIFICIALE
	class Item118 extends Item{
		private $itemId = 118;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}