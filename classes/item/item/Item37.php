<?php
	//BOMBA FIORITA
	class Item37 extends Item{
		private $itemId = 37;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}