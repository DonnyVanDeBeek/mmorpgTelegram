<?php
	//CARNE SECCA
	class Item198 extends Item{
		private $itemId = 198;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}

		public function trigger(){
			if(!$this->togliItem())
				return $this->printNoItemErr();

			$Ut = $this->getUtente();

			write("Mangi la carne secca\n");

			$heal = $Ut->getTotalStat('COSTITUZIONE') + 12;
			$Ut->heal($heal);
		}
	}