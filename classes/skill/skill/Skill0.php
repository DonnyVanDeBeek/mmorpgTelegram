<?php
	class Skill0 extends Skill{
		//ATTACCO BASE
		private $id = 0;
		public function __construct(){
			parent::__construct($this->id);
		}

		public function loadVars(){
			$this->addVar(0, 'Prova', 'Prova', 1);
		}

		public function trigger(){
			$Caster = $this->getCaster();
			$Target = $this->getTarget();
			$Equips = $this->getEquips();

			write($this->getFrase(0));

			$moltiplicatore = $this->getVar(0);
			$sommatore = $this->getVar(1);
			$dmg = ($Caster->getTotalStat('FORZA') * $moltiplicatore) + $sommatore;

			$moltiplicatore = $this->getVar(2);
			$sommatore = $this->getVar(3);
			$prec = ($Caster->getTotalStat('PRECISIONE') * $moltiplicatore) + $sommatore;

			$da = new Danno();
			$da->setDealer($Caster);
			$da->setDmg($dmg);
			$da->setTipo('FISICO');
			$da->setPrecisione($prec);
			$da->setEquips($Equips);
			$da->setTarget($Target);
			$da->send();

			$this->equipOnAttack();
			$this->startCooldown($this->getCooldown());
			
			//$caster->setPA($Caster->getPA() - 1);

			return true;
		}
	}