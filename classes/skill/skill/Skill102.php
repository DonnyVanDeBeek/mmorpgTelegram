<?php
	class Skill102 extends Skill{
		//BENEDIZIONE DEL DIO DELLA GLORIA
		private $id = 102;
		public function __construct(){
			parent::__construct($this->id);
		}

		public function trigger(){
			$Caster = $this->getCaster();
			$Target = $this->getTarget();
			$Equips = $this->getEquips();

			write($Caster->getNome() . " pianta la spada nel terreno recitando poemi epici" . "\n");

			$turni = 2;
			$min = 20;
			$max = 45;

			$Caster->giveBuff('CARISMA', rand($min,$max), $turni);
			$Caster->giveBuff('ARMATURA', rand($min,$max), $turni);
			$Caster->giveBuff('SALVAMAGIA', rand($min,$max), $turni);
			
			$this->startCooldown($this->getCooldown());

			return true;
		}
	}