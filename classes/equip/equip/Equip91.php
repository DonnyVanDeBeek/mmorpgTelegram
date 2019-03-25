<?php
	//ARMATURA SPINATA
	class Equip91 extends Equip{
		private $equipId = 91;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}

		public function onGetHitten(&$Da){
			if($Da->getDealer() === NULL) return false;
			$Target = $Da->getDealer();
			if($this->utente->getDistanceFrom($Target) <= 1.4){
				$flat = 40;
				$dmg = $this->utente->calculateLevel() + $flat;

				write($Target->getNome().' entra in contatto con le spine dell\'armatura di '.$this->utente->getNome()."\n");

				$Danno = new Danno();
				$Danno->setTipo('PERFORANTE');
				$Danno->setDealer(null);
				$Danno->setPrecisione(99999);
				$Danno->setDmg($dmg);
				$Danno->setTarget($Target);
				$Danno->send();

				return true;
			}

			return false;
		}
	}