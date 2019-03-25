<?php
	//AMPOLLA DI SANGUE
	class Item95 extends Item{
		private $itemId = 95;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}