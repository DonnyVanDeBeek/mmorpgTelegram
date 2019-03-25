<?php
	//STELLA ALPINA
	class Item93 extends Item{
		private $itemId = 93;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}

		public function trigger(){
			if(!$this->togliItem())
				return $this->printNoItemErr();

			$Ut = $this->getUtente();
			$Ut->removeDebuff('SALVAMAGIA');
			$Ut->removeDebuff('INTELLIGENZA');
			$Ut->removeDebuff('SAGGEZZA');

			write("Tutti i tuoi debuff a salvamagia, intelligenza e saggezza sono stati purificati e quindi rimossi.\n");

			return true;
		}
	}