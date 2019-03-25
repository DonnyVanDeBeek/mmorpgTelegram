<?php
	Class Item15 extends Item{
		private $itemId = 15;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}
