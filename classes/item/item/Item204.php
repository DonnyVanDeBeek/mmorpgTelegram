<?php
	//ANELLO DI FERRO
	class Item204 extends Item{
		private $itemId = 204;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}