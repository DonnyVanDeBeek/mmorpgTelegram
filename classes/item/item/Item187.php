<?php
	//PISTOLETTA MONOUSO
	class Item187 extends Item{
		private $itemId = 187;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}