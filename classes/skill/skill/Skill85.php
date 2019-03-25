<?php
	class Skill85 extends Skill{
		//BAMBOLINA VOODOO
		private $id = 85;
		public function __construct(){
			parent::__construct($this->id);
		}

		public function trigger(){
			$Caster = $this->getCaster();
			$Target = $this->getTarget();
			$Equips = $this->getEquips();

			write($Caster->getNome() . " alza lo spillone e trafigge un bambolotto dalle sembianze di " . $Target->getNome()." il quale sente delle fitte lancinanti\n");

			$dmg = $Caster->getPercentualeStat('CARISMA', 75);

			$da = new Danno();
			$da->setDealer($Caster);
			$da->setDmg($dmg);
			$da->setTipo("PURO");
			$da->setPrecisione(99999);
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