<?php
	//SCHEGGIA DI VETRO
	class Item202 extends Item{
		private $itemId = 202;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}