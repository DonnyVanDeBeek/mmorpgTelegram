<?php
	//CRISANTEMO
	class Item220 extends Item{
		private $itemId = 220;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}