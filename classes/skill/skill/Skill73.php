<?php
	class Skill73 extends Skill{
		//INCORNATA
		private $id = 73;
		public function __construct(){
			parent::__construct($this->id);
		}

		public function trigger(){
			$Caster = $this->getCaster();
			$Target = $this->getTarget();
			$Equips = $this->getEquips();

			write($Caster->getNome() . " corre a tutta velocità verso " . $Target->getNome() . " per incornarlo!" . "\n");

			$Caster->setX($Target->getX());
			$Caster->setY($Target->getY());

			$dmg = $Caster->getTotalStat('FORZA');

			$da = new Danno();
			$da->setDealer($Caster);
			$da->setDmg($dmg);
			$da->setTipo("PERFORANTE");
			$da->setEquips($Equips);
			$da->setTarget($Target);
			$da->isMelee(true);
			$da->send();

			$this->startCooldown($this->getCooldown());

			return true;
		}
	}