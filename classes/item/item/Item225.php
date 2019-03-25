<?php
	//POZIONE DEL VIGORE
	class Item225 extends Item{
		private $itemId = 225;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}