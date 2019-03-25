<?php
	class Skill124 extends Skill{
		//PATTEGGIAMENTO CON EKATON
		private $id = 124;
		public function __construct(){
			parent::__construct($this->id);
		}

		public function trigger(){
			$Caster = $this->getCaster();
			$Target = $this->getTarget();
			$Equips = $this->getEquips();

			write($Caster->getNome() . " esegue il patteggiamento con Ekaton. " . $Target->getNome() . " viene curato completamente!" . "\n");

			$Target->heal(99999);

			$Target->giveOverTime(18, 0, 3);

			//$this->startCooldown($this->getCooldown());

			return true;
		}
	}