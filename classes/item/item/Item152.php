<?php
	//PEZZO DI ZUCCA ABERRANTE
	class Item152 extends Item{
		private $itemId = 152;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}