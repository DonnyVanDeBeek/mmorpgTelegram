<?php
	//RITRATTO: SOLDATO & ORCO
	class Item181 extends Item{
		private $itemId = 181;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}