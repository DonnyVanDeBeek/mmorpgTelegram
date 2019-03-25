<?php
	//FIORE DI BACH
	class Item127 extends Item{
		private $itemId = 127;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}