<?php
	//PUNTA DA SCARPONE IN FERRO
	class Item163 extends Item{
		private $itemId = 163;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}