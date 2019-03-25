<?php
	//PELLE DI LUPO
	class Item30 extends Item{
		private $itemId = 30;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}