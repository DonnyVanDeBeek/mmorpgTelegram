<?php
	class Skill26 extends Skill{
		//BALZO
		private $id = 26;
		public function __construct(){
			parent::__construct($this->id);
		}

		public function trigger(){
			/*
			write("Se stai leggendo questo significa che codesta skill non è ancora stata programmata\nVai da Donny e digli di muovere il culo!");
			return false;
			*/
			
			$Caster = $this->getCaster();
			$Target = $this->getTarget();

			write($Caster->getNome() . " balza addosso a " . $Target->getNome()."\n");

			$X = $Target->getX();
			$Y = $Target->getY();

			$Caster->setX($X);
			$Caster->setY($Y);

			
			$this->startCooldown($this->getCooldown());

			return true;
		}
	}