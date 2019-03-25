<?php
	//MAZZA TAMBURO
	class Item65 extends Item{
		private $itemId = 65;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}