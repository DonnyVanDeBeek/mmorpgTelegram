<?php
	//RETE APPESANTITA
	class Item91 extends Item{
		private $itemId = 91;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}