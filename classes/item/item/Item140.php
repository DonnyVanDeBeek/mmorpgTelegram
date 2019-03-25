<?php
	//TINTURA SCIAMANICA
	class Item140 extends Item{
		private $itemId = 140;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}