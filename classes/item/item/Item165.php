<?php
	//TESSUTO
	class Item165 extends Item{
		private $itemId = 165;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}