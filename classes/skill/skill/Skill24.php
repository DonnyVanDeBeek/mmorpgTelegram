<?php
	class Skill24 extends Skill{
		//GRAFFIO
		private $id = 24;
		public function __construct(){
			parent::__construct($this->id);
		}

		public function trigger(){
			$Caster = $this->getCaster();
			$Target = $this->getTarget();

			write($Caster->getNome() . " lacera " . $Target->getNome() . " con un graffio" . "\n");

			$dannoFisico = $Caster->getPercentualeStat('FORZA', 80);
			$dannoTaglio = $Caster->getPercentualeStat('FORZA', 20);
			$precisione  = $Caster->getTotalStat('PRECISIONE');
			$precBase    = 100;

			$Danno = new Danno();
			$Danno->setDealer($Caster);
			$Danno->setDmg($dannoTaglio + $dannoFisico);
			$Danno->setTipo("TAGLIENTE");
			$Danno->setPrecisione($precBase + $precisione);
			$Danno->setTarget($Target);

			$this->overtimeBuff($Danno);

			$Danno->send();

			$this->equipOnAttack();
			$this->startCooldown($this->getCooldown());

			return true;
		}
	}