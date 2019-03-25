<?php
	class Skill104 extends Skill{
		//CATENACCIO FANTASMA
		private $id = 104;
		public function __construct(){
			parent::__construct($this->id);
		}

		public function trigger(){
			$Caster = $this->getCaster();
			$Target = $this->getTarget();
			$Equips = $this->getEquips();

			write($Caster->getNome() . " colpisce " . $Target->getNome() . " con il catenaccio!" . "\n");

			$dmg = $Caster->getTotalStat('MAGIA');
			$precisione = $Caster->getTotalStat('PRECISIONE');

			$da = new Danno();
			$da->setDealer($Caster);
			$da->setDmg($dmg);
			$da->setTipo("CONTUNDENTE");
			$da->setPrecisione(95);
			$da->setEquips($Equips);
			$da->setTarget($Target);

			$percentuale = 100;
			if(Functions::percentuale($percentuale)){
				$Stordimento = 15;
				$OT = OverTime::create($Target, $Stordimento, 0, 1);
				$da->addOverTime($OT);
			}

			$da->send();

			$this->startCooldown($this->getCooldown());

			return true;
		}
	}