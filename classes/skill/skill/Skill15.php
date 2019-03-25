<?php
	class Skill15 extends Skill{
		//SALTO LACERATIVO
		private $id = 15;
		public function __construct(){
			parent::__construct($this->id);
		}

		public function trigger(){
			$Caster = $this->getCaster();
			$Target = $this->getTarget();
			$Equips = $this->getEquips();

			write($Caster->getNome() . ' usa tutta la sua forza per sferrare un fendente a  '.$Target->getNome().'!'."\n");

			$dmg = (int)$Caster->getTotalStat('FORZA') * rand(0.9, 1.1);

			$da = new Danno();
			$da->setDealer($Caster);
			$da->setTipo('FISICO');
			$da->setPrecisione($Caster->getTotalStat('PRECISIONE') + 100);
			$da->setDmg($dmg);
			$da->setTarget($Target);
			$da->setEquips($Equips);
			$da->send();

			write('La potenza del fendente sbalza '.$Caster->getNome().' all\'indietro!'."\n");
			
			$n = rand(1,2);
			for($i = 0; $i < $n; $i++)
				$Caster->moveAwayFrom($Target);

			$this->equipOnAttack();
			$this->startCooldown($this->getCooldown());

			//$caster->setPA($caster->getPA() - 1);

			return true;
		}
	}