<?php
	//EDERA VELENOSA
	class Item102 extends Item{
		private $itemId = 102;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}