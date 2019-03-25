<?php
	class Equip11 extends Equip{
		private $equipId = 11;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}

		public function onAttack(&$target){
			$utente = &$this->utente;

			write($utente->getNome() . ' attiva l\'effetto di Spada Cipollosa!'."\n");

			$hp = (int)$target->getTotalStat('HP')/10;
			$hp += 5;

			if(rand(0, 1) == 0){
				$this->utente->heal($hp);
			}
			else{
				$Buff = new Buff();
				$Buff->setUtente($utente);
				$Buff->setStat('Forza');
				$Buff->setValue(rand(5, 15));
				$Buff->setDurata(60);
				$Buff->send();
			}

			return true;
		}
	}
