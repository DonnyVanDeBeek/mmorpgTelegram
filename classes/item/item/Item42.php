<?php
	//SABBIA TASCABILE
	class Item42 extends Item{
		private $itemId = 42;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}