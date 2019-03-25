<?php
	//CORNO DI IDROMELE
	class Item221 extends Item{
		private $itemId = 221;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}