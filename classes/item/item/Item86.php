<?php
	//POZIONE PETRADERMA
	class Item86 extends Item{
		private $itemId = 86;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}

		public function trigger(){
			if(!$this->togliItem())
				return $this->printNoItemErr();
			
			$Ut = $this->getUtente();
			$turni = 3;
			$ImmunitaSanguinamento = 9;
			$value = 0;

			write('Bevi la pozione petraderma! Senti la tua pelle irrobustirsi e diventare di consistenza rocciosa'."\n");

			$OT = new OverTime();
			$OT->setTarget($Ut);
			$OT->setTurni($turni);
			$OT->setTipoOverTimeId($ImmunitaSanguinamento);
			$OT->setValue($value);
			$OT->send();

			return true;
		}
	}