<?php
	//PIUMA
	class Item35 extends Item{
		private $itemId = 35;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}