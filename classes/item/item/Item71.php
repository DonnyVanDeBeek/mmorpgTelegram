<?php
	//BASTONE
	class Item71 extends Item{
		private $itemId = 71;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}