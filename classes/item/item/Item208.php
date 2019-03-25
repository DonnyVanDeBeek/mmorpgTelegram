<?php
	//FILTRO DELL'IMMATERIALITà
	class Item208 extends Item{
		private $itemId = 208;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}

		public function trigger(){
			if(!$this->togliItem())
				return $this->printNoItemErr();

			$Immaterialita = 10;
			$turni = 1;
			$val = 0;
			$msg = "Bevi il filtro dell'immaterialità!";

			write($msg);
			$this->getUtente()->removeOverTime($Immaterialita);
			$this->getUtente()->giveOverTime($Immaterialita, $val, $turni);
		}
	}