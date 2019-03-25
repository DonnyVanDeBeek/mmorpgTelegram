<?php
	//SCIROPPO DI IPECAPUANA
	class Item98 extends Item{
		private $itemId = 98;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}

		public function trigger(){
			if(!$this->togliItem())
				return $this->printNoItemErr();

			$Avvelenamento = 4;

			$Ut = $this->getUtente();
			$Ut->removeOvertime($Avvelenamento);

			write("Grazie allo sciroppo sei stato purificato da ogni avvelenamento!");
			return true;
		}
	}