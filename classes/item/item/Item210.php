<?php
	//VINO DI QUALITà
	class Item210 extends Item{
		private $itemId = 210;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}