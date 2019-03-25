<?php
	class Skill88 extends Skill{
		//URLO DA GUERRA
		private $id = 88;
		public function __construct(){
			parent::__construct($this->id);
		}

		public function trigger(){
			$Caster = $this->getCaster();
			$Target = $this->getTarget();
			$Equips = $this->getEquips();

			write($Caster->getNome() . " batte un colpo a terra e pianta un urlo squarciagola". "\n");

			$Targs = $Caster->getTargetsInRange(999);
			$n = count($Targs);
			for($i = 0; $i < $n; $i++){
				$Targs[$i]->spaventarsi($Caster);
			}

			$this->startCooldown($this->getCooldown());

			return true;
		}
	}
