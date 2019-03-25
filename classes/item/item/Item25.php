<?php
	//ZANNA DI LUPO
	class Item25 extends Item{
		private $itemId = 25;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}