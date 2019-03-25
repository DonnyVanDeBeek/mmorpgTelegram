<?php
	class Skill93 extends Skill{
		//SCUDO IN POSIZIONE!
		private $id = 93;
		public function __construct(){
			parent::__construct($this->id);
		}

		public function trigger(){
			$Caster = $this->getCaster();

			write($Caster->getNome() . " sistema il suo scudo nella posizione più protetta che riesce a trovare!". "\n");

			$val = 20;
			$turni = 2;
			$Caster->giveBuff('ARMATURA', $val, $turni);			

			$this->startCooldown($this->getCooldown());

			return true;
		}
	}