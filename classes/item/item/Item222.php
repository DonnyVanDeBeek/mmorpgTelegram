<?php
	//CORNO
	class Item222 extends Item{
		private $itemId = 222;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}