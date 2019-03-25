<?php
	class Skill58 extends Skill{
		//AFFONDO
		private $id = 58;
		public function __construct(){
			parent::__construct($this->id);
		}

		public function trigger(){
			$Caster = $this->getCaster();
			$Target = $this->getTarget();
			$Equips = $this->getEquips();

			write($Caster->getNome() . " fissa minacciosamente  " . $Target->getNome() . ". Subito dopo parte con un affondo!" . "\n");

			$dmg = $Caster->getTotalStat('FORZA');
			$prec = $Caster->getTotalStat('PRECISIONE');

			$da = new Danno();
			$da->setDealer($Caster);
			$da->setDmg($dmg);
			$da->setTipo("PERFORANTE");
			$da->setPrecisione($prec);
			$da->setEquips($Equips);
			$da->setTarget($Target);

			$da->send();

			$this->equipOnAttack();
			$this->startCooldown($this->getCooldown());

			return true;
		}
	}