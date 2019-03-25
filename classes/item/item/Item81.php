<?php
	//ITEM DA CANCELLARE
	class Item81 extends Item{
		private $itemId = 81;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}