<?php
	//COTE
	class Item168 extends Item{
		private $itemId = 168;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}