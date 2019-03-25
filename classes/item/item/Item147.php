<?php
	//CALCE
	class Item147 extends Item{
		private $itemId = 147;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}