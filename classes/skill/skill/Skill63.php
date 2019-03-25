<?php
	class Skill63 extends Skill{
		//FIAMMELLA
		private $id = 63;
		public function __construct(){
			parent::__construct($this->id);
		}

		public function trigger(){
			$Caster = $this->getCaster();
			$Target = $this->getTarget();
			$Equips = $this->getEquips();

			write($Caster->getNome() . " crea una piccola fiammella e la lancia contro " . $Target->getNome() . "\n");

			$dmg = $Caster->getTotalStat('MAGIA') * 0.5;
			$prec = $Caster->getTotalStat('PRECISIONE');

			$Danno = new Danno();
			$Danno->setDealer($Caster);
			$Danno->setDmg($dmg);
			$Danno->setTipo("FUOCO");
			$Danno->setPrecisione($prec);
			$Danno->setEquips($Equips);
			$Danno->setTarget($Target);
			$Danno->isRanged(true);
			$Danno->isSpell(true);

			$percScottatura = 25;
			if(Functions::percentuale($percScottatura)){
				$Bruciatura = 1;
				$turni = 3;
				$OT = OverTime::create($Target, $Bruciatura, $dmg, $turni);
				$Danno->addOverTime($OT);
			}

			$Danno->send();

			$this->startCooldown($this->getCooldown());

			return true;
		}
	}