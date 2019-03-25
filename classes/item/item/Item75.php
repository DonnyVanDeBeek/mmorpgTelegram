<?php
	//PROIETTILE D'ARGENTO
	class Item75 extends Item{
		private $itemId = 75;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}