<?php
	//REPELLENTE PER CINGHIALI
	class Item60 extends Item{
		private $itemId = 60;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}