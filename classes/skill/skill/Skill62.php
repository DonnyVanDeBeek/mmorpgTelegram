<?php
	class Skill62 extends Skill{
		//PUNZECCHIARE
		private $id = 62;
		public function __construct(){
			parent::__construct($this->id);
		}

		public function trigger(){
			$Caster = $this->getCaster();
			$Target = $this->getTarget();
			$Equips = $this->getEquips();

			write($Caster->getNome() . " punzecchia " . $Target->getNome() . " con la punta dell'arma!" . "\n");

			$dmg = $Caster->getTotalStat('FORZA');

			$da = new Danno();
			$da->setDealer($Caster);
			$da->setDmg($dmg);
			$da->setTipo("PERFORANTE");
			$da->isMelee(true);
			$da->setEquips($Equips);
			$da->setTarget($Target);
			$da->send();

			$this->startCooldown($this->getCooldown());

			return true;
		}
	}