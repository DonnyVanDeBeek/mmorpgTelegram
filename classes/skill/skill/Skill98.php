<?php
	class Skill98 extends Skill{
		//SOVERCHIARE
		private $id = 98;
		public function __construct(){
			parent::__construct($this->id);
		}

		public function trigger(){
			$Caster = $this->getCaster();
			$Target = $this->getTarget();
			$Equips = $this->getEquips();

			write($Caster->getNome() . " sferra un fendente tagliente a " . $Target->getNome() . "\n");

			$dmg = $Caster->getTotalStat('FORZA') * 1.25;
			$prec = $Caster->getTotalStat('PRECISIONE');

			$da = new Danno();
			$da->setDealer($Caster);
			$da->setDmg($dmg);
			$da->setTipo("TAGLIENTE");
			$da->setPrecisione($perc);
			$da->setEquips($Equips);
			$da->setTarget($Target);
			$da->send();

			if(!$da->isDodged()){
				write('Il fendente è così potente da spingere '.$da->getTarget()->getNome().' all\'indietro!');
				$spostamento = rand(1,3);
				$da->getTarget()->moveAwayFrom($Caster);
			}

			$this->startCooldown($this->getCooldown());

			return true;
		}
	}