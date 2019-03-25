<?php
	class Skill30 extends Skill{
		//ULULATO
		private $id = 30;
		public function __construct(){
			parent::__construct($this->id);
		}

		public function trigger(){
			$Caster = $this->getCaster();
			$Target = $this->getTarget();
			$Equips = $this->getEquips();

			write($Caster->getNome() . " ulula al cielo!" . "\n");

			$Lupi = 3;
			$Targs = $Caster->getTargetsOfCategoriaInRange($Lupi, 999);
			$n = count($Targs);
			for($i = 0; $i < $n; $i++){
				$T = &$Targs[$i];
				$turni = rand(2,4);
				$valueForza = $T->getTotalStat('FORZA') * 0.1;
				$valueDestr = $T->getTotalStat('DESTREZZA') * 0.1;
				$T->giveBuff('FORZA', $valueForza, $turni);
				$T->giveBuff('DESTREZZA', $valueDestr, $turni);
			}

			$this->startCooldown($this->getCooldown());

			return true;
		}
	}
