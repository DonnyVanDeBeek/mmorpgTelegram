<?php
	//TESCHIO
	class Item89 extends Item{
		private $itemId = 89;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}