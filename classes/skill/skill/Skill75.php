<?php
	class Skill75 extends Skill{
		//SBOBBA DISGUSTOSA
		private $id = 75;
		public function __construct(){
			parent::__construct($this->id);
		}

		public function trigger(){
			$Caster = $this->getCaster();
			$Target = $this->getTarget();
			$Equips = $this->getEquips();

			write($Caster->getNome() . "  tira fuori dal suo grembiule una poltiglia nauseante e se la schiaffa in bocca" . "\n");

			$heal = $Caster->getTotalStat('HP') * 0.2;
			$Caster->heal($heal);
			$Caster->giveBuff('COSTITUZIONE', 30, 5);

			$this->startCooldown($this->getCooldown());

			return true;
		}
	}