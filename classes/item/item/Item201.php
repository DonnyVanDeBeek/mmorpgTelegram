<?php
	//OSSIDIANA
	class Item201 extends Item{
		private $itemId = 201;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}