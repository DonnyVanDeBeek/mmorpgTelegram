<?php
	//CORDA DI PELLE
	class Item161 extends Item{
		private $itemId = 161;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}