<?php
	class Skill100 extends Skill{
		//ANATEMA DELLA DEBOLEZZA
		private $id = 100;
		public function __construct(){
			parent::__construct($this->id);
		}

		public function trigger(){
			$Caster = $this->getCaster();
			$Target = $this->getTarget();
			$Equips = $this->getEquips();

			write($Caster->getNome() . " lancia un'anatema della debolezza a " . $Target->getNome()."\n");

			$turni = 4;
			$min = -50;
			$max = -30;

			$Target->giveBuff('FORZA', rand($min, $max), $turni);
			$Target->giveBuff('ARMATURA', rand($min, $max), $turni);
			$Target->giveBuff('SALVAMAGIA', rand($min, $max), $turni);

			$this->startCooldown($this->getCooldown());

			return true;
		}
	}