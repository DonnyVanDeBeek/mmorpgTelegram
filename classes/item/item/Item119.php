<?php
	//POLVERE DA SPARO
	class Item119 extends Item{
		private $itemId = 119;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}