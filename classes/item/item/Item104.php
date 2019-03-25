<?php
	//MUSCHIO
	class Item104 extends Item{
		private $itemId = 104;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}