<?php
	//CARNE IN PUTREFAZIONE
	class Item185 extends Item{
		private $itemId = 185;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}