<?php
	//PICCOLA FORGIA MAGICA
	class Item99 extends Item{
		private $itemId = 99;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}