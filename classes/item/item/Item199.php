<?php
	//NUTRIA IN UMIDO
	class Item199 extends Item{
		private $itemId = 199;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}

		public function trigger(){
			if(!$this->togliItem())
				return $this->printNoItemErr();
			
			$Ut = $this->getUtente();

			write('Mangi una deliziosa nutria in umido! Mmmh che buona, è come quella di zio Gerry!');

			$flat = 20;
			$heal = $Ut->getPercentualeStat('COSTITUZIONE', 30) + 20; 

			$Ut->heal($heal);
		}
	}