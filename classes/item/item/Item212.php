<?php
	//FAZZOLETTO ROSSO
	class Item212 extends Item{
		private $itemId = 212;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}