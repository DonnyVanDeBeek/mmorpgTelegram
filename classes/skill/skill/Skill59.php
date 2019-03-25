<?php
	class Skill59 extends Skill{
		//DARDO MAGICO
		private $id = 59;
		public function __construct(){
			parent::__construct($this->id);
		}

		public function trigger(){
			$Caster = $this->getCaster();
			$Target = $this->getTarget();
			$Equips = $this->getEquips();

			write($Caster->getNome() . " crea un dardo fatto di magia pura e lo fa librare in direzione di " . $Target->getNome() . "!" . "\n");

			$dmg = $Caster->getPercentualeStat('MAGIA', 60);
			$prec = $Caster->getTotalStat('PRECISIONE');

			$da = new Danno();
			$da->setDealer($Caster);
			$da->setDmg($dmg);
			$da->setTipo("MAGICO");
			$da->setPrecisione($prec);
			$da->setEquips($Equips);
			$da->setTarget($Target);

			$this->equipBuff($da);
			$this->overtimeBuff($da);

			$da->send();

			$this->equipOnAttack();
			$this->startCooldown($this->getCooldown());

			return true;
		}
	}