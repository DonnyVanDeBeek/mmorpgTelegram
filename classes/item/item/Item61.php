<?php
	//GABBIA PER ANIMALI
	class Item61 extends Item{
		private $itemId = 61;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}