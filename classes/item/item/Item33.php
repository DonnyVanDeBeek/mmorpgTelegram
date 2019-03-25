<?php
	//MANICO PER UTENSILI
	class Item33 extends Item{
		private $itemId = 33;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}