<?php
	//INVITO AL COMPLEANNO DI VETTO
	class Item108 extends Item{
		private $itemId = 108;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}