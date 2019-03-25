<?php
	//LEGNAME
	class Item32 extends Item{
		private $itemId = 32;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}