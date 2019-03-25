<?php
	class Skill126 extends Skill{
		//SCOSSE DELLO SCETTRO
		private $id = 126;
		public function __construct(){
			parent::__construct($this->id);
		}

		public function trigger(){
			$Caster = $this->getCaster();
			$Target = $this->getTarget();
			$Equips = $this->getEquips();

			write($this->getFrase(0));

			$Bersagli = $Caster->getTargetsInRange($this->getVar(0));
			$n = count($Bersagli);
			for($i = 0; $i < $n; $i++){
				$Target = &$Bersagli[$i];
				$Target->randomMovement();
				$turni = rand($this->getVar(1),$this->getVar(2));
				$val = rand($this->getVar(3),$this->getVar(4));
				$stat = "PRECISIONE";
				$Target->giveBuff($stat, $val, $turni);
			}

			$this->startCooldown($this->getCooldown());

			return true;
		}
	}