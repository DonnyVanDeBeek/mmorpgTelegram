<?php
	class Skill150 extends Skill{
		//CONGELAMENTO
		private $id = 150;
		public function __construct(){
			parent::__construct($this->id);
		}

		public function trigger(){
			$Caster = $this->getCaster();
			$Target = $this->getTarget();
			$Equips = $this->getEquips();

			write($Caster->getNome() . " lancia un incantesimo di congelamento contro " . $Target->getNome()."\n");

			$Congelamento = 12;
			$numTurni = 3;
			$Target->giveOverTime($Congelamento, $Target->provaDi('MAGIA'), $numTurni);

			$this->startCooldown($this->getCooldown());

			return true;
		}
	}