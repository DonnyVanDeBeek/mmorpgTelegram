<?php
	//PUNTA DI FRECCIA
	class Item45 extends Item{
		private $itemId = 45;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}