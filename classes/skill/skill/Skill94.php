<?php
	class Skill94 extends Skill{
		//SCUDO SUL NASO
		private $id = 94;
		public function __construct(){
			parent::__construct($this->id);
		}

		public function trigger(){
			$Caster = $this->getCaster();
			$Target = $this->getTarget();
			$Equips = $this->getEquips();

			write($Caster->getNome() . " sferra lo scudo contro " . $Target->getNome() . "!" . "\n");

			$dmg = $Caster->getTotalStat('FORZA') * 0.1;
			$prec = $Caster->getTotalStat('PRECISIONE');

			$da = new Danno();
			$da->setDealer($Caster);
			$da->setDmg($dmg);
			$da->setTipo("CONTUNDENTE");
			$da->setPrecisione($prec);
			$da->setEquips($Equips);
			$da->setTarget($Target);

			$this->equipBuff($da);
			$this->overtimeBuff($da);

			$res = $da->send();

			if($res !== false && rand(1,10) >= 5){
				write($Target->getNome().' tentenna!'."\n");
				/*$turni = $Target->getMemo('STUN') + 1;
				$Target->setMemo('STUN', $turni);*/
				$Stun = 15;
				$Target->giveOverTime($Stun, 0, 1); 
			}

			$this->equipOnAttack();
			$this->startCooldown($this->getCooldown());

			return true;
		}
	}