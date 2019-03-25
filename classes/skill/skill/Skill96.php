<?php
	class Skill96 extends Skill{
		//MORDHEAU
		private $id = 96;
		public function __construct(){
			parent::__construct($this->id);
		}

		public function trigger(){
			$Caster = $this->getCaster();
			$Target = $this->getTarget();
			$Equips = $this->getEquips();

			write($Caster->getNome() . " affera la spada al contrario e colpisce " . $Target->getNome() . " con l'elsa! L'urto è così potente da far arretrare ".$Target->getNome(). "\n");

			$dmg = $Caster->getPercentualeStat('FORZA', 75);
			$tipo = "CONTUNDENTE";
			$prec = $Caster->getTotalStat("PRECISIONE");

			$da = new Danno();
			$da->setDealer($Caster);
			$da->setDmg($dmg);
			$da->setTipo($tipo);
			$da->setPrecisione($prec);
			$da->setEquips($Equips);
			$da->setTarget($Target);
			$da->send();

			$Target->moveAwayFrom($Caster);

			$this->equipOnAttack();
			$this->startCooldown($this->getCooldown());
			
			return true;
		}
	}