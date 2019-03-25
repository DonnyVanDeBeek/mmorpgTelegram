<?php
	//FILO
	class Item40 extends Item{
		private $itemId = 40;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}