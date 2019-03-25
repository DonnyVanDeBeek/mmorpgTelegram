<?php
	//PIUMA DI FENICE
	class Item78 extends Item{
		private $itemId = 78;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}