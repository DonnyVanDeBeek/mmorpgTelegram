<?php
	class Skill120 extends Skill{
		//TIZZONI VOLANTI
		private $id = 120;
		public function __construct(){
			parent::__construct($this->id);
		}

		public function loadVars(){
			//Frase
			$this->addFrase(0, 'Fraze iniziale', '', '_caster:nome_ materializza dei tizzoni ardenti che vengono scagliati in direzione di _target:nome_');
			$this->addFrase(1, 'Statistica', 'la statistica sulla quale il danno della bruciatura scala', 'MAGIA');

			//Variabili
			$this->addVar(1, 'SOMMATORE BRUCIATURA', '', 10);
			$this->addVar(2, 'MOLTIPLICATORE BRUCIATURA', '', 0);
			$this->addVar(3, 'TURNI BRUCIATURA', '', 3);
		}

		public function trigger(){
			$Caster = $this->getCaster();
			$Target = $this->getTarget();
			$Equips = $this->getEquips();

			write($this->getFrase(0));
			
			$stat = Stat::filter($this->getFrase(1));
			$moltBruc = $this->getVar(2);
			$sommBruc = $this->getVar(1);
			$turni = $this->getVar(3);

			$Bruciatura = 1;
			$val = ($Caster->getTotalStat($stat) * $moltBruc) + $sommBruc;
			$Target->giveOverTime($Bruciatura, $val, $turni);		

			$this->startCooldown($this->getCooldown());

			return true;
		}
	}