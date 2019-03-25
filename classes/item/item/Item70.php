<?php
	//CHIODI DI FERRO
	class Item70 extends Item{
		private $itemId = 70;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}