<?php
	//FRECCIA MAGICA
	class Item80 extends Item{
		private $itemId = 80;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}