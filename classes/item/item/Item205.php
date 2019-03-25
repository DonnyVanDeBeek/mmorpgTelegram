<?php
	//LUCANO
	class Item205 extends Item{
		private $itemId = 205;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}