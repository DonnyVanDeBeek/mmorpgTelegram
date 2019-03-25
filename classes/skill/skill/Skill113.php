<?php
	class Skill113 extends Skill{
		//PICCOLO SOLE
		private $id = 113;
		public function __construct(){
			parent::__construct($this->id);
		}

		public function trigger(){
			$Caster = $this->getCaster();
			$Target = $this->getTarget();
			$Equips = $this->getEquips();

			write($Caster->getNome() . " crea una palla di fuoco e la lancia in direzione di " . $Target->getNome()."\n");

			$prec = $Caster->getTotalStat('PRECISIONE');
			$magia = $Caster->getTotalStat('MAGIA');
			$dmg = $magia;
			$dmgCollaterale = $magia * 0.25;

			$Danno = new Danno();
			$Danno->setDealer($Caster);
			$Danno->setDmg($dmg);
			$Danno->setTipo("ESPLOSIONE");
			$Danno->setPrecisione($prec);
			$Danno->setEquips($Equips);
			$Danno->setTarget($Target);
			$Danno->isRanged(true);
			$Danno->send();

			if(!$Danno->isDodged()){
				$range = 1;
				$TS = $Danno->getTarget()->getTargetsInRange($range);
				$n = count($TS);
				for($i = 0; $i < $n; $i++){
					write($TS[$i]->getNome().' viene colpito dal danno collaterale dell\'esplosione!');
					$D = new Danno();
					$D->setDmg($dmgCollaterale);
					$D->setTipo("FUOCO");
					$D->notDodgeable();
					$D->setTarget($TS[$i]);
					$D->send();
				}
			}

			$this->startCooldown($this->getCooldown());

			return true;
		}
	}