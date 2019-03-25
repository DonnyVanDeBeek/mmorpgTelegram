<?php
	Class Item11 extends Item{
		private $itemId = 11;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}
	}
