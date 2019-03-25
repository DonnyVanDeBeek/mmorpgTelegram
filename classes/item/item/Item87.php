<?php
	//TARTUFO
	class Item87 extends Item{
		private $itemId = 87;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}