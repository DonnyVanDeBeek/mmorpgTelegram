<?php
	class Skill36 extends Skill{
		//RAFFICA DI SFERZATE
		private $id = 36;
		public function __construct(){
			parent::__construct($this->id);
		}

		public function trigger(){
			$Caster = $this->getCaster();
			$Target = $this->getTarget();
			$Equips = $this->getEquips();

			write($Caster->getNome() . " si prepara a sforacchiare " . $Target->getNome() . "\n");

			$dmg = $Caster->getTotalStat('FORZA') * 0.33;
			$prec = $Caster->getTotalStat('PRECISIONE');

			$armEn = $Target->getTotalStat('ARMATURA');

			$n = 4;
			for($i = 0; $i < $n; $i++){
				write('Parte il fendente numero '.$i+1.'!');
				$da = new Danno();
				$da->setDealer($Caster);
				$da->setDmg($dmg);
				$da->setTipo("TAGLIENTE");
				$da->setPrecisione($prec);
				$da->setEquips($Equips);
				$da->setTarget($Target);

				$provaSanguinamento = 50;
				if(Functions::diceRoll($armEn) < Functions::diceRoll($provaSanguinamento)){
					$OT = OverTime::create($Target, 3, 25, 1);
					$da->addOverTime($OT);
				}

				$da->send();
			}

			$this->startCooldown($this->getCooldown());
			
			return true;
		}
	}