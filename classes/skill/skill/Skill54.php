<?php
	class Skill54 extends Skill{
		//RICHIAMO DI YVOR
		private $id = 54;
		public function __construct(){
			parent::__construct($this->id);
		}

		public function trigger(){
			$Caster = $this->getCaster();
			$Target = $this->getTarget();
			$Equips = $this->getEquips();

			write($Caster->getNome() . " richiama dal cielo il potente dio Yvor". "\n");

			$carisma = $Caster->getTotalStat('CARISMA');

			$da = new Danno();
			$da->setDealer($Caster);
			$da->setDmg($carisma);
			$da->setTipo("PURO");
			$da->setPrecisione($carisma);
			$da->setEquips($Equips);
			$da->setTarget($Target);

			$da->send();

			$this->equipOnAttack();
			$this->startCooldown($this->getCooldown());
			
			return true;
		}
	}