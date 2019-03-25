<?php
	//POZIONE PICCOLA DI RESILIENZA
	class Item53 extends Item{
		private $itemId = 53;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}