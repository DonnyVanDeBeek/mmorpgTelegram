<?php
	//SALDO DELL'EMPORIO
	class Item124 extends Item{
		private $itemId = 124;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}