<?php
	//ELSA
	class Item43 extends Item{
		private $itemId = 43;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}