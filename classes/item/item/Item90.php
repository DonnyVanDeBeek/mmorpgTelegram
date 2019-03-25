<?php
	//RETE
	class Item90 extends Item{
		private $itemId = 90;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}