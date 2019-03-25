<?php
	//TRAPPOLA PER ORSI
	class Item46 extends Item{
		private $itemId = 46;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}