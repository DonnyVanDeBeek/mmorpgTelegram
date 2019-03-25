<?php
	class Skill13 extends Skill{
		//CARICA
		private $id = 13;
		public function __construct(){
			parent::__construct($this->id);
		}

		public function trigger(){
			$Caster = $this->getCaster();
			$Target = $this->getTarget();
			$Equips = $this->getEquips();

			write($Caster->getNome().' carica su '.$Target->getNome()."!\n");

			$dmg = $Caster->getTotalStat('FORZA') * 0.3;

			$Caster->setX($Target->getX());
			$Caster->setY($Target->getY());

			$dan = new Danno();
			$dan->setDealer($Caster);
			$dan->setDmg((int)$dmg);
			$dan->setTipo('FISICO');
			$dan->setElemento('LOTTA');
			$dan->setPrecisione(70);
			$dan->setTarget($Target);

			$this->equipBuff($da);

			$dan->send();
			
			$this->equipOnAttack();
			$this->startCooldown($this->getCooldown());

			return true;
		}
	}