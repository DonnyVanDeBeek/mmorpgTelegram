<?php
	//BRACCIALE DEI DESIDERI
	class Item191 extends Item{
		private $itemId = 191;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}