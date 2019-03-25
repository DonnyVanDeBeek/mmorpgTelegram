<?php
	//CUOIO CONCIATO
	class Item69 extends Item{
		private $itemId = 69;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}