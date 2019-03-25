<?php
	class Skill149 extends Skill{
		//GRAVITà AUMENTATA
		private $id = 149;
		public function __construct(){
			parent::__construct($this->id);
		}

		public function trigger(){
			$Caster = $this->getCaster();
			$Target = $this->getTarget();

			write($Caster->getNome().' lancia un incantesimo su '.$Target->getNome().', appesantendolo!');

			$val = $Target->getPercentualeStat("DESTREZZA", 50);
			$turni = 3;
			$Target->giveBuff("DESTREZZA", $val * -1, $turni);

			$this->startCooldown($this->getCooldown());

			return true;
		}
	}
