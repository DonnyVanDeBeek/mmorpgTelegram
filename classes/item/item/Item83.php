<?php
	//ITEM DA CANCELLARE3
	class Item83 extends Item{
		private $itemId = 83;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}