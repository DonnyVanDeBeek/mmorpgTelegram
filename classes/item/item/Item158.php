<?php
	//POZIONE DI CURA
	class Item158 extends Item{
		private $itemId = 158;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}