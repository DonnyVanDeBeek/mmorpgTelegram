<?php
	//CONTRATTO PALUDE
	class Item2 extends Item{
		private $itemId = 2;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}