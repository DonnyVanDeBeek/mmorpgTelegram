<?php
	//SACCOCCIA DI MONETE SOLUBILI
	class Item117 extends Item{
		private $itemId = 117;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}

		public function trigger(){
			if(!$this->togliItem())
				return $this->printNoItemErr();

			$Ut = $this->getUtente();

			write('Apri la saccoccia e trovi 25 monete solubili. Incredibile, pensi, sono identiche alle monete originali'."\n");

			$Soldi = 25;
			$Ut->giveSoldi($Soldi);
			$Ut->notifyGiveSoldi($Soldi);

			return true;
		}
	}