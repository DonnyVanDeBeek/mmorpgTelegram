<?php
	//MUSCHIO DEPURATIVO
	class Item52 extends Item{
		private $itemId = 52;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}