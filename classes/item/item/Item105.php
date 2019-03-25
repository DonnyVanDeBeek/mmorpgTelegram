<?php
	//AMPOLLA VUOTA
	class Item105 extends Item{
		private $itemId = 105;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}