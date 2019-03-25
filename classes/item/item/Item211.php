<?php
	//BREVETTO DI DISPOSITIVO IGIENICO SPECIALISTICO
	class Item211 extends Item{
		private $itemId = 211;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}