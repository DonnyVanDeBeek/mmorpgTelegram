<?php
	//ITEM DA CANCELLARE55
	class Item111 extends Item{
		private $itemId = 111;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}