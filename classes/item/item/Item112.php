<?php
	//ITEMPROVA
	class Item112 extends Item{
		private $itemId = 112;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}