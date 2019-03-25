<?php
	class Skill38 extends Skill{
		//MAZZATA
		private $id = 38;
		public function __construct(){
			parent::__construct($this->id);
		}

		public function trigger(){
			$Caster = $this->getCaster();
			$Target = $this->getTarget();
			$Equips = $this->getEquips();

			write($Caster->getNome() . " percuote " . $Target->getNome() . " con una possente mazzata!" . "\n");

			$dmg = $Caster->getTotalStat('FORZA');
			$prec = $Caster->getPercentualeStat('PRECISIONE', 50);
			$tipo = "CONTUNDENTE";

			$Danno = new Danno();
			$Danno->setTarget($Target);
			$Danno->setDealer($Caster);
			$Danno->setDmg($dmg);
			$Danno->setTipo($tipo);
			$Danno->setPrecisione($prec);
			$Danno->setEquips($Equips);

			$percStun = 15;

			if(rand(1,100) <= $percStun){
				$Stordimento = 15;
				$val = 0;
				$turni = 1;
				$OverTime = OverTime::create($Target, $Stordimento, $val, $turni);
				$Danno->addOverTime($OverTime);
			}

			$Danno->send();

			$this->equipOnAttack();
			$this->startCooldown($this->getCooldown());

			return true;
		}
	}