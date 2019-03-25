<?php
	//ALMANACCO DEL CACCIATORE DI SPETTRI
	class Item215 extends Item{
		private $itemId = 215;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}