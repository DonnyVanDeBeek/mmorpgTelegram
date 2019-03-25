<?php
	class Skill18 extends Skill{
		//ALITO DI FUOCO
		private $id = 18;
		public function __construct(){
			parent::__construct($this->id);
		}

		public function trigger(){
			$Caster = $this->getCaster();
			$Target = $this->getTarget();
			$Equips = $this->getEquips();

			write($Caster->getNome() . ' spalanca la bocca e una caldissima vampata di calore si sprigiona verso '.$Target->getNome().'!'."\n");

			$dmg = (int)$Caster->getTotalStat('MAGIA') + rand(25, 50);


			$da = new Danno();
			$da->setDealer($Caster);
			$da->setTipo('MAGICO');
			$da->setPrecisione($Caster->getTotalStat('PRECISIONE') + 50);
			$da->setDmg($dmg);
			$da->setTarget($Target);
			$da->setEquips($Equips);
			$da->send();

			$this->equipOnAttack();
			$this->startCooldown($this->getCooldown());

			//$caster->setPA($caster->getPA() - 1);

			return true;
		}
	}