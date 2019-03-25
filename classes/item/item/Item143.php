<?php
	//SUCCO DI MANDRAGOLA
	class Item143 extends Item{
		private $itemId = 143;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}