<?php
	//MANICO DI PUGNALE
	class Item56 extends Item{
		private $itemId = 56;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}