<?php
	Class Item5 extends Item{
		private $itemId = 5;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}

	}
