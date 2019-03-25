<?php
	//ELISIR DI STELLA ALPINA
	class Item94 extends Item{
		private $itemId = 94;

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

			write("Bevi l'elisir. Tutti i tuoi debuff a salvamagia, intelligenza e saggezza sono stati purificati e quindi rimossi.\n");

			$min = 30;
			$max = 50;
			$turni = 4;

			$Buff = new Buff();
			$Buff->setStat('SALVAMAGIA');
			$Buff->setTarget($Ut);
			$Buff->setValue(rand($min,$max));
			$Buff->setTurni($turni);
			$Buff->send();
			unset($Buff);

			$Buff = new Buff();
			$Buff->setStat('INTELLIGENZA');
			$Buff->setTarget($Ut);
			$Buff->setValue(rand($min,$max));
			$Buff->setTurni($turni);
			$Buff->send();
			unset($Buff);

			$Buff = new Buff();
			$Buff->setStat('SAGGEZZA');
			$Buff->setTarget($Ut);
			$Buff->setValue(rand($min,$max));
			$Buff->setTurni($turni);
			$Buff->send();
			unset($Buff);

			return true;
		}
	}