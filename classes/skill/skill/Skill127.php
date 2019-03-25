<?php
	class Skill127 extends Skill{
		//ACCENDERSI DELLA SACRA FIAMMA
		private $id = 127;
		public function __construct(){
			parent::__construct($this->id);
		}

		public function trigger(){
			$Caster = $this->getCaster();
			$Target = $this->getTarget();
			$Equips = $this->getEquips();

			write($Caster->getNome() . " attiva la Sacra Fiamma su di se!" . "\n");

			$SacraFiamma = 19;
			$Caster->giveOverTime($SacraFiamma, 0, 5);
			
			$this->startCooldown($this->getCooldown());

			return true;
		}
	}