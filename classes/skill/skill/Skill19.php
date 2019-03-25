<?php
	class Skill19 extends Skill{
		//VOLO
		private $id = 19;
		public function __construct(){
			parent::__construct($this->id);
		}

		public function trigger(){
			$Caster = $this->getCaster();
			$Target = $this->getTarget();
			$Equips = $this->getEquips();

			write($Caster->getNome() . ' vola in direzione di '.$Target->getNome().'!'."\n");

			$rand = rand(2,4);
			for($i = 0; $i < $rand; $i++)
				$Caster->moveTowards($Target);

			$this->equipOnAttack();
			$this->startCooldown($this->getCooldown());

			//$caster->setPA($caster->getPA() - 1);

			return true;
		}
	}