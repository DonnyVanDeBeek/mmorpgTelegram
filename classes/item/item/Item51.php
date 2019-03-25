<?php
	//CARTA DA GIOCO
	class Item51 extends Item{
		private $itemId = 51;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}